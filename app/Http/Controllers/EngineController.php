<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Engine;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class EngineController extends Controller
{
    public function index()
    {
        $engines = DB::table('engines')
        // ->select('my_engines.id as my_engine_id','my_engines.engine_id','engines.engine_name','my_engines.purchase_date')
        ->orderBy('engines.sort_order','asc')
        ->get();

        // dd($engines);

        return view('kart.engine_list',compact('engines'));
        // dd($roles,$areas,$users);

    }

    public function create()
    {

        $engines = DB::table('engines')
        ->get();

        // dd($engines);

        return view('kart.engine_create',compact('engines'));

    }

    public function show($id)
    {
        $engine = DB::table('engines')
        ->where('engines.id',$id)
        ->first();

        $login_user = User::findOrFail(Auth::id());


        // dd($engine,$login_user);

        return view('kart.engine_show',compact('engine','login_user'));

    }

    public function store(Request $request)
    {
        Engine::create([
            'engine_maker_name' => $request['engine_maker'],
            'engine_name'=> $request['engine_name'],
            'engine_info' => $request['engine_info'],
            'sort_order' => $request['sort_order'],
        ]);

        return to_route('engine_index')->with(['message'=>'Engineが登録されました','status'=>'info']);
    }


    public function edit($id)
    {
        $engine = DB::table('engines')
        ->where('engines.id',$id)
        ->first();

        // dd($engines);

        return view('kart.engine_edit',compact('engine'));

    }

    public function update(Request $request,$id)
    {
        $engine = Engine::findOrFail($id);
        $engine->engine_maker_name = $request['engine_maker'];
        $engine->engine_name = $request['engine_name'];
        $engine->engine_info = $request['engine_info'];
        $engine->sort_order = $request['sort_oeder'];
        // dd($request->kart_info);

        $engine->save();

        return to_route('engine_index')->with(['message'=>'Engineが更新されました','status'=>'info']);

    }


    public function destroy($id)
    {

        Engine::findOrFail($id)->delete();

        return to_route('engine_index')->with(['message'=>'Engineが削除されました','status'=>'alert']);
    }
}
