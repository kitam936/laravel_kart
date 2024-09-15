<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maker;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MakerController extends Controller
{
    public function index()
    {
        $makers = DB::table('makers')
        // ->select('my_makers.id as my_maker_id','my_makers.maker_id','makers.maker_name','my_makers.purchase_date')
        ->orderBy('makers.sort_order','asc')
        ->get();

        // dd($makers);

        return view('kart.maker_list',compact('makers'));
        // dd($roles,$areas,$users);

    }

    public function create()
    {

        $makers = DB::table('makers')
        ->get();

        // dd($makers);

        return view('kart.maker_create',compact('makers'));

    }

    public function show($id)
    {
        $maker = DB::table('makers')
        ->where('makers.id',$id)
        ->first();

        $login_user = User::findOrFail(Auth::id());


        // dd($maker,$login_user);

        return view('kart.maker_show',compact('maker','login_user'));

    }

    public function store(Request $request)
    {
        Maker::create([
            'maker_name' => $request['maker_name'],
            'maker_info' => $request['maker_info'],
            'sort_order' => $request['sort_order'],
        ]);

        return to_route('maker_index')->with(['message'=>'Makerが登録されました','status'=>'info']);
    }


    public function edit($id)
    {
        $maker = DB::table('makers')
        ->where('makers.id',$id)
        ->first();

        // dd($makers);

        return view('kart.maker_edit',compact('maker'));

    }

    public function update(Request $request,$id)
    {
        $maker = Maker::findOrfail($id);
        $maker->maker_name = $request['maker_name'];
        $maker->maker_info = $request['maker_info'];
        $maker->sort_order = $request['sort_order'];
        // dd($request->kart_info);

        $maker->save();

        return to_route('maker_index')->with(['message'=>'Makerが更新されました','status'=>'info']);

    }


    public function destroy($id)
    {

        Maker::findOrFail($id)->delete();

        return to_route('maker_index')->with(['message'=>'Makerが削除されました','status'=>'alert']);
    }
}
