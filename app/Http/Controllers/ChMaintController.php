<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChMaintRequest;
use App\Http\Requests\UpdateChMaintRequest;
use Illuminate\Http\Request;
use App\Models\My_kart;
use App\Models\ChMaint;
use App\Models\ChMaintCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ChMaintController extends Controller
{
    public function show($id)
    {
        $maint = DB::table('ch_maints')
        ->join('my_karts','my_karts.id','=','ch_maints.my_kart_id')
        ->join('makers','makers.id','=','my_karts.maker_id')
        ->join('ch_maint_categories','ch_maint_categories.id','=','ch_maints.ch_maint_category_id')
        ->where('ch_maints.id' ,$id)
        ->select('ch_maints.id as maint_id','ch_maints.maint_date','ch_maints.maint_fee','ch_maints.my_kart_id','ch_maint_categories.ch_maint_name','ch_maints.maint_info')
        ->first();

        $ch_maint_categories = DB::table('ch_maint_categories')
        ->get();


        // dd($maints,$ch_categories);

        return view('maint.ch_maint_show',compact('maint','ch_maint_categories'));
    }

    public function create($id)
    {
        $ch_maint_categories =  DB::table('ch_maint_categories')->get();

        $mykart = DB::table('my_karts')
        ->where('my_karts.id',$id)
        ->first();

        // dd($id,$mykart,$ch_maint_categories);

        return view('maint.ch_maint_create',compact('mykart','ch_maint_categories'));

    }

    public function store(StoreChMaintRequest $request)
    {
        ChMaint::create([
            'user_id' => Auth::id(),
            'my_kart_id'=> $request['mykart_id2'],
            'ch_maint_category_id'=> $request['ch_maint_category_id'],
            'maint_date' => $request['maint_date'],
            'maint_fee' => $request['maint_fee'],
            'maint_info' => $request['maint_info'],

        ]);

        return to_route('chassis_show',['chassis'=>$request->mykart_id2])->with(['message'=>'Chassisメンテナンスが登録されました','status'=>'info']);
    }

    public function edit($id)
    {
        $maint = DB::table('ch_maints')
        ->join('my_karts','my_karts.id','=','ch_maints.my_kart_id')
        ->join('makers','makers.id','=','my_karts.maker_id')
        ->join('ch_maint_categories','ch_maint_categories.id','=','ch_maints.ch_maint_category_id')
        ->where('ch_maints.id' ,$id)
        ->select('ch_maints.id as maint_id','ch_maints.maint_date','ch_maints.maint_fee','ch_maints.my_kart_id','ch_maints.ch_maint_category_id','ch_maint_categories.ch_maint_name','ch_maints.maint_info')
        ->first();

        $ch_maint_categories = DB::table('ch_maint_categories')
        ->get();

        // dd($engines);

        return view('maint.ch_maint_edit',compact('maint','ch_maint_categories'));

    }

    public function update(UpdateChMaintRequest $request,$id)
    {
        $ch_maint = ChMaint::findOrFail($id);

        $ch_maint->user_id = Auth::id();
        $ch_maint->my_kart_id = $request['mykart_id2'];
        $ch_maint->ch_maint_category_id = $request['ch_maint_category_id'];
        $ch_maint->maint_date = $request['maint_date'];
        $ch_maint->maint_fee = $request['maint_fee'];
        $ch_maint->maint_info = $request['maint_info'];

        // dd($request->kart_info);

        $ch_maint->save();

        return to_route('chassis_show',['chassis'=>$request->mykart_id2])->with(['message'=>'Chassisメンテナンスが更新されました','status'=>'info']);

    }

    public function destroy(Request $request,$id)
    {
        $my_kart_id = $request['mykart_id2'];

        dd($my_kart_id);

        ChMaint::findOrFail($id)->delete();

        return to_route('chassis_show',['chassis'=>$my_kart_id])->with(['message'=>'Chassisメンテナンスが削除されました','status'=>'alert']);
    }

}
