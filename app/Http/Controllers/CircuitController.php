<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreCircuitRequest;
use App\Http\Requests\UpdateCircuitRequest;
use InterventionImage;
use Carbon\Carbon;
use App\Models\Circuit;
use App\Models\Stint;
use App\Models\Area;
use App\Models\User;

class CircuitController extends Controller
{
    public function circuit_list(Request $request)
    {
        $circuits=DB::table('circuits')
        ->leftjoin('areas','areas.id','=','circuits.area_id')
        ->where('circuits.area_id','LIKE','%'.($request->area_id).'%')
        ->where('circuits.cir_name','LIKE','%'.($request->cir_name).'%')
        ->select(['circuits.id as cir_id','circuits.cir_name','areas.area_name'])
        ->get();

        $areas = DB::table('areas')
        ->select(['areas.id as area_id','areas.area_name'])
        ->get();

        // dd($circuits,$areas);

        return view('circuit.circuit_list',compact('circuits','areas'));
    }

    public function circuit_detail($id)
    {
        $circuit=DB::table('circuits')
        ->leftjoin('areas','areas.id','=','circuits.area_id')
        ->where('circuits.id',$id)
        ->select(['circuits.id as cir_id','circuits.cir_name','areas.area_name','circuits.length','circuits.url','circuits.cir_info','circuits.photo1','circuits.photo2'])
        ->first();

        $user = User::findOrFail(Auth::id());

        $stints = DB::table('stints')
        ->join('users','users.id','=','stints.user_id')
        ->join('my_engines','my_engines.id','=','stints.my_engine_id')
        ->join('engines','engines.id','=','my_engines.engine_id')
        ->join('my_karts','my_karts.id','=','stints.my_kart_id')
        ->join('makers','makers.id','=','my_karts.maker_id')
        ->join('my_tires','my_tires.id','=','stints.my_tire_id')
        ->join('tires','tires.id','=','my_tires.tire_id')
        ->join('circuits','circuits.id','=','stints.cir_id')
        ->join('areas','areas.id','=','circuits.area_id')
        ->where('stints.cir_id',$id)
        // ->whereDate('stints.start_date', 'LIKE','%'.$request['from_date'].'%')
        ->select('stints.id','stints.user_id','users.name as user_name','areas.area_name','stints.best_time',
        'engines.engine_name','tires.tire_name')
        ->orderBy('stints.best_time')
        ->get();

        // dd($circuit,$user,$stints);

        return view('circuit.circuit_detail',compact('circuit','user','stints'));
    }

    public function circuit_edit($id)
    {
        $circuit=DB::table('circuits')
        ->leftjoin('areas','areas.id','=','circuits.area_id')
        ->where('circuits.id',$id)
        ->select(['circuits.id as cir_id','circuits.cir_name','circuits.area_id',
        'circuits.length','circuits.url','circuits.cir_info','areas.area_name','circuits.photo1','circuits.photo2'])
        ->first();

        $areas = DB::table('areas')
        ->select(['areas.id as area_id','areas.area_name'])
        ->get();

        // dd($circuits,$areas);

        return view('circuit.circuit_edit',compact('circuit','areas'));
    }

    public function circuit_update(UpdateCircuitRequest $request, $id)
    {
        $circuit=Circuit::findOrFail($id);

        $filePath1 = 'public/circuit/' . $circuit->photo1;
        if(!empty($request->image1) && (Storage::exists($filePath1))){
            Storage::delete($filePath1);
            // dd($filePath1,$request->image1);
        }
        $filePath2 = 'public/circuit/' . $circuit->photo2;
        if(!empty($request->image2) && (Storage::exists($filePath2))){
            Storage::delete($filePath2);
            // dd($filePath2,$request->image2);
        }

        if(!is_null($request->file('image1'))){
            $fileName1 = uniqid(rand().'_');
            $extension1 = $request->file('image1')->extension();
            $fileNameToStore1 = $fileName1. '.' . $extension1;
            $resizedImage1 = InterventionImage::make($request->file('image1'))->resize(400, 400,function($constraint){$constraint->aspectRatio();})->encode();
            Storage::put('public/circuit/' . $fileNameToStore1, $resizedImage1 );
        }else{
            $fileNameToStore1 = $circuit->photo1;
        };

        if(!is_null($request->file('image2'))){
            $fileName2 = uniqid(rand().'_');
            $extension2 = $request->file('image2')->extension();
            $fileNameToStore2 = $fileName2. '.' . $extension2;
            $resizedImage2 = InterventionImage::make($request->file('image2'))->resize(400, 400,function($constraint){$constraint->aspectRatio();})->encode();
            Storage::put('public/circuit/' . $fileNameToStore2, $resizedImage2 );
        }else{
            $fileNameToStore2 = $circuit->photo2;
        };

        $circuit->area_id = $request['area_id'];
        $circuit->cir_name = $request['cir_name'];
        $circuit->length = $request['length'];
        $circuit->url = $request['url'];
        $circuit->cir_info = $request['cir_info'];
        $circuit->photo1 = $fileNameToStore1;
        $circuit->photo2 = $fileNameToStore2;

        // dd($circuit,$request);

        $circuit->save();

        return to_route('circuit_detail',['circuit'=>$request['cir_id']])->with(['message'=>'Circuitが更新されました','status'=>'info']);
    }

    public function circuit_create()
    {

        $areas = DB::table('areas')
        ->select(['areas.id as area_id','areas.area_name'])
        ->get();

        // dd($circuits,$areas);

        return view('circuit.circuit_create',compact('areas'));
    }

    public function circuit_store(StoreCircuitRequest $request)
    {

        $folderName='circuit';
        if(!is_null($request->file('image1'))){
            $fileName1 = uniqid(rand().'_');
            $extension1 = $request->file('image1')->extension();
            $fileNameToStore1 = $fileName1. '.' . $extension1;
            $resizedImage1 = InterventionImage::make($request->file('image1'))->resize(400, 400,function($constraint){$constraint->aspectRatio();})->encode();
            Storage::put('public/circuit/' . $fileNameToStore1, $resizedImage1 );
        }else{
            $fileNameToStore1 = '';
        };

        if(!is_null($request->file('image2'))){
            $fileName2 = uniqid(rand().'_');
            $extension2 = $request->file('image2')->extension();
            $fileNameToStore2 = $fileName2. '.' . $extension2;
            $resizedImage2 = InterventionImage::make($request->file('image2'))->resize(400, 400,function($constraint){$constraint->aspectRatio();})->encode();
            Storage::put('public/circuit/' . $fileNameToStore2, $resizedImage2 );
        }else{
            $fileNameToStore2 = '';
        };

    //    dd($request,$fileNameToStore1,$fileNameToStore2);

        Circuit::create([
            'area_id' => $request['area_id'],
            'cir_name' => $request['cir_name'],
            'length' => $request['length'],
            'url' => $request['url'],
            'cir_info' => $request['cir_info'],
            'photo1' => $fileNameToStore1,
            'photo2' => $fileNameToStore2,

        ]);

        return to_route('circuit_list')->with(['message'=>'Circuitが登録されました','status'=>'info']);
    }

    public function circuit_destroy($id)
    {
        $circuit=Circuit::findOrFail($id);
        $filePath1 = 'public/circuit/' . $circuit->photo1;
        if((Storage::exists($filePath1))){
            Storage::delete($filePath1);
            // dd($filePath1,$request->photo1);
        }
        $filePath2 = 'public/circuit/' . $circuit->photo2;
        if((Storage::exists($filePath2))){
            Storage::delete($filePath2);
            // dd($filePath2,$request->photo2);
        }

        Circuit::findOrFail($id)->delete();

        return to_route('circuit_list')->with(['message'=>'Circuitが削除されました','status'=>'alert']);
    }




}
