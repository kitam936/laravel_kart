<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKartRequest;
use App\Http\Requests\UpdateKartRequest;
use InterventionImage;
use App\Models\My_kart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MyKartController extends Controller
{
    public function index()
    {
        $karts = DB::table('my_karts')
        ->join('makers','makers.id','=','my_karts.maker_id')
        ->where('my_karts.user_id',Auth::id())
        ->select('my_karts.id as kart_id','my_karts.maker_id','my_karts.model_year','makers.maker_name','my_karts.purchase_date')
        ->orderBy('my_karts.purchase_date','desc')
        ->get();

        // dd($karts);

        return view('mykart.chassis_list',compact('karts'));
        // dd($roles,$areas,$users);

    }

    public function create()
    {

        $makers = DB::table('makers')
        ->get();

        // dd($karts);

        return view('mykart.chassis_create',compact('makers'));

    }

    public function show($id)
    {
        $kart = DB::table('my_karts')
        ->join('makers','makers.id','=','my_karts.maker_id')
        ->where('my_karts.id',$id)
        ->select('my_karts.id as kart_id','my_karts.maker_id','my_karts.model_year','makers.maker_name',
        'my_karts.purchase_date','my_karts.photo1','my_karts.photo2','my_karts.my_kart_info')
        ->first();

        $makers = DB::table('makers')
        ->get();

        // dd($karts);

        return view('mykart.chassis_show',compact('kart','makers'));

    }

    public function store(StoreKartRequest $request)
    {
        $folderName='kart';
        if(!is_null($request->file('image1'))){
            $fileName1 = uniqid(rand().'_');
            $extension1 = $request->file('image1')->extension();
            $fileNameToStore1 = $fileName1. '.' . $extension1;
            $resizedImage1 = InterventionImage::make($request->file('image1'))->resize(400, 400,function($constraint){$constraint->aspectRatio();})->encode();
            Storage::put('public/kart/' . $fileNameToStore1, $resizedImage1 );
        }else{
            $fileNameToStore1 = '';
        };

        if(!is_null($request->file('image2'))){
            $fileName2 = uniqid(rand().'_');
            $extension2 = $request->file('image2')->extension();
            $fileNameToStore2 = $fileName2. '.' . $extension2;
            $resizedImage2 = InterventionImage::make($request->file('image2'))->resize(400, 400,function($constraint){$constraint->aspectRatio();})->encode();
            Storage::put('public/kart/' . $fileNameToStore2, $resizedImage2 );
        }else{
            $fileNameToStore2 = '';
        };

    //    dd($startDate,$pastlaps,$request,$fileNameToStore1,$fileNameToStore2,$fileNameToStore3);

        My_kart::create([
            'user_id' => Auth::id(),
            'maker_id'=> $request['maker_id'],
            'purchase_date' => $request['purchase_date'],
            'model_year' => $request['model_year'],
            'my_kart_info' => $request['my_kart_info'],
            'photo1' => $fileNameToStore1,
            'photo2' => $fileNameToStore2,

        ]);

        return to_route('chassis_index')->with(['message'=>'Chassisが登録されました','status'=>'info']);


    }


    public function edit($id)
    {
        $kart = DB::table('my_karts')
        ->join('makers','makers.id','=','my_karts.maker_id')
        ->where('my_karts.id',$id)
        ->select('my_karts.id as kart_id','my_karts.maker_id','my_karts.model_year','makers.maker_name',
        'my_karts.purchase_date','my_karts.photo1','my_karts.photo2','my_karts.my_kart_info')
        ->first();

        $makers = DB::table('makers')
        ->get();

        // dd($karts);

        return view('mykart.chassis_edit',compact('kart','makers'));

    }

    public function update(UpdateKartRequest $request,$id)
    {
        $kart=My_kart::findOrFail($id);
        $filePath1 = 'public/kart/' . $kart->photo1;
        if(!empty($request->image1) && (Storage::exists($filePath1))){
            Storage::delete($filePath1);
            // dd($filePath1,$request->image1);
        }
        $filePath2 = 'public/kart/' . $kart->photo2;
        if(!empty($request->image2) && (Storage::exists($filePath2))){
            Storage::delete($filePath2);
            // dd($filePath2,$request->image2);
        }

        if(!is_null($request->file('image1'))){
            $fileName1 = uniqid(rand().'_');
            $extension1 = $request->file('image1')->extension();
            $fileNameToStore1 = $fileName1. '.' . $extension1;
            $resizedImage1 = InterventionImage::make($request->file('image1'))->resize(400, 400,function($constraint){$constraint->aspectRatio();})->encode();
            Storage::put('public/kart/' . $fileNameToStore1, $resizedImage1 );
        }else{
            $fileNameToStore1 = $kart->photo1;
        };

        if(!is_null($request->file('image2'))){
            $fileName2 = uniqid(rand().'_');
            $extension2 = $request->file('image2')->extension();
            $fileNameToStore2 = $fileName2. '.' . $extension2;
            $resizedImage2 = InterventionImage::make($request->file('image2'))->resize(400, 400,function($constraint){$constraint->aspectRatio();})->encode();
            Storage::put('public/kart/' . $fileNameToStore2, $resizedImage2 );
        }else{
            $fileNameToStore2 = $kart->photo2;
        };
        $kart->user_id = Auth::id();
        $kart->maker_id = $request['maker_id'];
        $kart->purchase_date = $request['purchase_date'];
        $kart->model_year = $request['model_year'];
        $kart->my_kart_info = $request['my_kart_info'];
        $kart->photo1 = $fileNameToStore1;
        $kart->photo2 = $fileNameToStore2;

        // dd($request->kart_info);

        $kart->save();

        return to_route('chassis_index')->with(['message'=>'Chassisが更新されました','status'=>'info']);

    }


    public function destroy($id)
    {
        $kart=My_kart::findOrFail($id);
        $filePath1 = 'public/kart/' . $kart->photo1;
        // if(!empty($request->photo1) && (Storage::exists($filePath1))){
        if((Storage::exists($filePath1))){
            Storage::delete($filePath1);
            // dd($filePath1,$request->photo1);
        }
        $filePath2 = 'public/kart/' . $kart->photo2;
        // if(!empty($request->photo2) && (Storage::exists($filePath2))){
        if((Storage::exists($filePath2))){
            Storage::delete($filePath2);
            // dd($filePath2,$request->photo2);
        }


        My_kart::findOrFail($id)->delete();

        return to_route('chassis_index')->with(['message'=>'Chassisが削除されました','status'=>'alert']);
    }
}
