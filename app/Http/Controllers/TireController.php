<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tire;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TireController extends Controller
{
    public function index()
    {
        $tires = DB::table('tires')
        // ->select('my_tires.id as my_tire_id','my_tires.tire_id','tires.tire_name','my_tires.purchase_date')
        ->orderBy('tires.sort_order','asc')
        ->get();

        // dd($tires);

        return view('kart.tire_list',compact('tires'));
        // dd($roles,$areas,$users);

    }

    public function create()
    {

        $tires = DB::table('tires')
        ->get();

        // dd($tires);

        return view('kart.tire_create',compact('tires'));

    }

    public function show($id)
    {
        $tire = DB::table('tires')
        ->where('tires.id',$id)
        ->first();

        $login_user = User::findOrFail(Auth::id());


        // dd($tire,$login_user);

        return view('kart.tire_show',compact('tire','login_user'));

    }

    public function store(Request $request)
    {
        Tire::create([
            'tire_maker_name' => $request['tire_maker'],
            'tire_name'=> $request['tire_name'],
            'tire_info' => $request['tire_info'],
            'sort_order' => $request['sort_order'],
        ]);

        return to_route('tire_index')->with(['message'=>'tireが登録されました','status'=>'info']);
    }


    public function edit($id)
    {
        $tire = DB::table('tires')
        ->where('tires.id',$id)
        ->first();

        // dd($tires);

        return view('kart.tire_edit',compact('tire'));

    }

    public function update(Request $request,$id)
    {
        $tire = Tire::findOr($id);
        $tire->tire_maker_name = $request['tire_maker'];
        $tire->tire_name = $request['tire_name'];
        $tire->tire_info = $request['tire_info'];
        $tire->sort_order = $request['sort_order'];
        // dd($request->kart_info);

        $tire->save();

        return to_route('tire_index')->with(['message'=>'tireが更新されました','status'=>'info']);

    }


    public function destroy($id)
    {

        Tire::findOrFail($id)->delete();

        return to_route('tire_index')->with(['message'=>'tireが削除されました','status'=>'alert']);
    }
}
