<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\My_tire;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MyTireController extends Controller
{
    public function index()
    {
        $tires = DB::table('my_tires')
        ->join('tires','tires.id','=','my_tires.tire_id')
        ->where('my_tires.user_id',Auth::id())
        ->select('my_tires.id as my_tire_id','my_tires.tire_id','tires.tire_name','my_tires.purchase_date')
        ->orderBy('my_tires.purchase_date','desc')
        ->get();

        $tires2 = DB::table('my_tires')
        ->leftjoin('stints','stints.my_tire_id','=','my_tires.id')
        ->join('tires','tires.id','=','my_tires.tire_id')
        ->where('my_tires.user_id',Auth::id())
        ->select('my_tires.id','stints.my_tire_id','my_tires.tire_id','tires.tire_name','my_tires.purchase_date')
        ->selectRaw('SUM(laps) as laps')
        ->selectRaw('SUM(stints.distance) as distance')
        ->groupBy('my_tires.id','stints.my_tire_id','my_tires.tire_id','tires.tire_name','my_tires.purchase_date')
        // ->select('my_tires.id as my_tire_id','my_tires.tire_id','tires.tire_name','my_tires.purchase_date','laps')
        ->orderBy('my_tires.purchase_date','desc')
        ->get();

        // dd($tires,$tires2);

        return view('mykart.mytire_list',compact('tires','tires2'));
        // dd($roles,$areas,$users);

    }

    public function create()
    {

        $tires = DB::table('tires')
        ->orderBy('sort_order')
        ->get();

        // dd($tires);

        return view('mykart.mytire_create',compact('tires'));

    }

    public function show($id)
    {
        $mytire = DB::table('my_tires')
        ->join('tires','tires.id','=','my_tires.tire_id')
        ->where('my_tires.id',$id)
        ->where('my_tires.user_id',Auth::id())
        ->select('my_tires.id as my_tire_id','my_tires.tire_id','tires.tire_name','my_tires.purchase_date','my_tires.my_tire_info')
        ->orderBy('my_tires.purchase_date','desc')
        ->first();

        $tires = DB::table('tires')
        ->get();

        // $stints = DB::table('stints')
        // ->join('my_tires','my_tires.id','=','stints.my_tire_id')
        // ->join('tires','tires.id','=','my_tires.tire_id')
        // ->join('circuits','circuits.id','=','stints.cir_id')
        // ->where('stints.my_tire_id' ,$id)
        // ->select('stints.id','stints.start_date','stints.my_tire_id','my_tires.tire_id','my_tires.tire_id','tires.tire_name','stints.laps','stints.distance','stints.best_time','circuits.cir_name')
        // ->orderBy('stints.start_date','desc')
        // ->get();

        $stints = DB::table('stints')
        ->join('my_tires','my_tires.id','=','stints.my_tire_id')
        ->join('tires','tires.id','=','my_tires.tire_id')
        ->join('circuits','circuits.id','=','stints.cir_id')
        ->where('stints.my_tire_id' ,$id)
        ->select('circuits.cir_name')
        ->selectRaw('DATE_FORMAT(stints.start_date, "%Y%m%d") as date')
        ->selectRaw('SUM(laps) as laps')
        ->selectRaw('SUM(distance) as distance')
        ->groupBy('date','circuits.cir_name')
        ->orderBy('date','desc')
        ->get();


        $stints_total = DB::table('stints')
        ->where('stints.my_tire_id' ,$id)
        ->select('stints.my_tire_id')
        ->selectRaw('SUM(stints.laps) as laps')
        ->selectRaw('SUM(stints.distance) as distance')
        ->groupBy('stints.my_tire_id')
        ->first();


        // dd($tires,$stints,$stints_total);

        return view('mykart.mytire_show',compact('mytire','tires','stints','stints_total'));

    }

    public function store(Request $request)
    {
        My_tire::create([
            'user_id' => Auth::id(),
            'tire_id'=> $request['tire_id'],
            'purchase_date' => $request['purchase_date'],
            'my_tire_info' => $request['my_tire_info'],
        ]);

        return to_route('mykart.index')->with(['message'=>'MyTireが登録されました','status'=>'info']);
    }


    public function edit($id)
    {
        $my_tire = DB::table('my_tires')
        ->join('tires','tires.id','=','my_tires.tire_id')
        ->where('my_tires.id',$id)
        ->where('my_tires.user_id',Auth::id())
        ->select('my_tires.id as my_tire_id','my_tires.tire_id','tires.tire_name',
        'my_tires.purchase_date','my_tires.my_tire_info')
        ->first();

        $tires = DB::table('tires')
        ->select('tires.tire_name','tires.id as tire_id','tires.tire_name')
        ->get();

        // dd($tires);

        return view('mykart.mytire_edit',compact('my_tire','tires'));

    }

    public function update(Request $request,$id)
    {
        $my_tire = My_tire::findOrFail($id);

        $my_tire->user_id = Auth::id();
        $my_tire->tire_id = $request['tire_id'];
        $my_tire->purchase_date = $request['purchase_date'];
        $my_tire->my_tire_info = $request['my_tire_info'];

        // dd($request->kart_info);

        $my_tire->save();

        return to_route('mykart.index')->with(['message'=>'MyTireが更新されました','status'=>'info']);

    }


    public function destroy($id)
    {

        My_tire::findOrFail($id)->delete();

        return to_route('mykart.index')->with(['message'=>'MyTireが削除されました','status'=>'alert']);
    }
}
