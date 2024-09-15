<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEgMaintRequest;
use App\Http\Requests\UpdateEgMaintRequest;
use Illuminate\Http\Request;
use App\Models\My_engine;
use App\Models\EgMaint;
use App\Models\EgMaintCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EgMaintController extends Controller
{
    public function index()
    {
        //
    }

    public function create($id)
    {
        $eg_maint_categories =  DB::table('eg_maint_categories')->get();

        $myengine = DB::table('my_engines')
        ->where('my_engines.id',$id)
        ->first();

        // dd($id,$request['my_engine_id'],$myengine,$eg_maint_categories);

        return view('maint.eg_maint_create',compact('myengine','eg_maint_categories'));

    }

    public function show($id)
    {
        $maint = DB::table('eg_maints')
        ->join('my_engines','my_engines.id','=','eg_maints.my_engine_id')
        ->join('engines','engines.id','=','my_engines.engine_id')
        ->join('eg_maint_categories','eg_maint_categories.id','=','eg_maints.eg_maint_category_id')
        ->where('eg_maints.id' ,$id)
        ->select('eg_maints.id as maint_id','eg_maints.maint_date','eg_maints.maint_fee','eg_maint_categories.eg_maint_name','eg_maints.maint_info','my_engines.engine_id as myengine_id')
        ->first();

        $eg_maint_categories = DB::table('eg_maint_categories')
        ->get();


        // dd($maints,$eg_categories);

        return view('maint.eg_maint_show',compact('maint','eg_maint_categories'));

    }

    public function store(StoreEgMaintRequest $request)
    {
        // dd($request);
        EgMaint::create([
            'user_id' => Auth::id(),
            'my_engine_id'=> $request['myengine_id2'],
            'eg_maint_category_id'=> $request['eg_maint_category_id'],
            'maint_date' => $request['maint_date'],
            'maint_fee' => $request['maint_fee'],
            'maint_info' => $request['eg_maint_info'],

        ]);

        return to_route('myengine_show',['engine'=>$request->myengine_id2])->with(['message'=>'Engineメンテナンスが登録されました','status'=>'info']);
    }


    public function edit($id)
    {
        $maint = DB::table('eg_maints')
        ->join('my_engines','my_engines.id','=','eg_maints.my_engine_id')
        ->join('engines','engines.id','=','my_engines.engine_id')
        ->join('eg_maint_categories','eg_maint_categories.id','=','eg_maints.eg_maint_category_id')
        ->where('eg_maints.id' ,$id)
        ->select('eg_maints.id as maint_id','eg_maints.maint_date','eg_maints.maint_fee','eg_maints.my_engine_id','eg_maints.eg_maint_category_id','eg_maint_categories.eg_maint_name','eg_maints.maint_info')
        ->first();

        $eg_maint_categories = DB::table('eg_maint_categories')
        ->get();

        // dd($engines);

        return view('maint.eg_maint_edit',compact('maint','eg_maint_categories'));

    }

    public function update(UpdateEgMaintRequest $request,$id)
    {
        $eg_maint = EgMaint::findOrFail($id);

        $eg_maint->user_id = Auth::id();
        $eg_maint->my_engine_id = $request['myengine_id2'];
        $eg_maint->eg_maint_category_id = $request['eg_maint_category_id'];
        $eg_maint->maint_date = $request['maint_date'];
        $eg_maint->maint_fee = $request['maint_fee'];
        $eg_maint->maint_info = $request['eg_maint_info'];

        // dd($request->kart_info);

        $eg_maint->save();

        return to_route('myengine_show',['engine'=>$request->myengine_id2])->with(['message'=>'Engineメンテナンスが更新されました','status'=>'info']);

    }


    public function destroy(Request $request,$id)
    {
        $my_engine_id = $request['myengine_id2'];

        // dd($my_engine_id);

        EgMaint::findOrFail($id)->delete();

        return to_route('myengine_show',['engine'=>$my_engine_id])->with(['message'=>'Engineメンテナンスが削除されました','status'=>'alert']);
    }
}
