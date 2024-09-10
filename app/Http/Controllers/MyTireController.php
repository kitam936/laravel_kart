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

        // dd($tires);

        return view('mykart.mytire_list',compact('tires'));
        // dd($roles,$areas,$users);

    }

    public function create()
    {

        $tires = DB::table('tires')
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

        // dd($tires);

        return view('mykart.mytire_show',compact('mytire','tires'));

    }

    public function store(Request $request)
    {
        My_tire::create([
            'user_id' => Auth::id(),
            'tire_id'=> $request['tire_id'],
            'purchase_date' => $request['purchase_date'],
            'my_tire_info' => $request['my_tire_info'],
        ]);

        return to_route('mytire_index')->with(['message'=>'MyTTireが登録されました','status'=>'info']);
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
        $my_tire = My_tire::findOr($id);

        $my_tire->user_id = Auth::id();
        $my_tire->tire_id = $request['tire_id'];
        $my_tire->purchase_date = $request['purchase_date'];
        $my_tire->my_tire_info = $request['my_tire_info'];

        // dd($request->kart_info);

        $my_tire->save();

        return to_route('mytire_index')->with(['message'=>'MyTireが更新されました','status'=>'info']);

    }


    public function destroy($id)
    {

        My_tire::findOrFail($id)->delete();

        return to_route('mytire_index')->with(['message'=>'MyTireが削除されました','status'=>'alert']);
    }
}
