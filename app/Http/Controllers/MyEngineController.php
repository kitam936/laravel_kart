<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\My_engine;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MyEngineController extends Controller
{
    public function index()
    {
        $engines = DB::table('my_engines')
        ->join('engines','engines.id','=','my_engines.engine_id')
        ->where('my_engines.user_id',Auth::id())
        ->select('my_engines.id as my_engine_id','my_engines.engine_id','engines.engine_name','engines.engine_maker_name','my_engines.purchase_date')
        ->orderBy('my_engines.purchase_date','desc')
        ->get();

        // dd($engines);

        return view('mykart.myengine_list',compact('engines'));
        // dd($roles,$areas,$users);

    }

    public function create()
    {

        $engines = DB::table('engines')
        ->get();

        // dd($engines);

        return view('mykart.myengine_create',compact('engines'));

    }

    public function show($id)
    {
        $myengine = DB::table('my_engines')
        ->join('engines','engines.id','=','my_engines.engine_id')
        ->where('my_engines.id',$id)
        ->where('my_engines.user_id',Auth::id())
        ->select('my_engines.id as my_engine_id','my_engines.engine_id','engines.engine_name','my_engines.purchase_date','my_engines.my_engine_info')
        ->orderBy('my_engines.purchase_date','desc')
        ->first();

        $engines = DB::table('engines')
        ->get();

        // dd($engines);

        return view('mykart.myengine_show',compact('myengine','engines'));

    }

    public function store(Request $request)
    {
        My_engine::create([
            'user_id' => Auth::id(),
            'engine_id'=> $request['engine_id'],
            'purchase_date' => $request['purchase_date'],
            'my_engine_info' => $request['my_engine_info'],
        ]);

        return to_route('myengine_index')->with(['message'=>'MyEngineが登録されました','status'=>'info']);
    }


    public function edit($id)
    {
        $my_engine = DB::table('my_engines')
        ->join('engines','engines.id','=','my_engines.engine_id')
        ->where('my_engines.id',$id)
        ->where('my_engines.user_id',Auth::id())
        ->select('my_engines.id as my_engine_id','my_engines.engine_id','engines.engine_name',
        'my_engines.purchase_date','my_engines.my_engine_info')
        ->first();

        $engines = DB::table('engines')
        ->select('engines.engine_name','engines.id as engine_id','engines.engine_name')
        ->get();

        // dd($engines);

        return view('mykart.myengine_edit',compact('my_engine','engines'));

    }

    public function update(Request $request,$id)
    {
        $my_engine = My_engine::findOr($id);

        $my_engine->user_id = Auth::id();
        $my_engine->engine_id = $request['engine_id'];
        $my_engine->purchase_date = $request['purchase_date'];
        $my_engine->my_engine_info = $request['my_engine_info'];

        // dd($request->kart_info);

        $my_engine->save();

        return to_route('myengine_index')->with(['message'=>'MyEngineが更新されました','status'=>'info']);

    }


    public function destroy($id)
    {

        My_Engine::findOrFail($id)->delete();

        return to_route('myengine_index')->with(['message'=>'MyEngineが削除されました','status'=>'alert']);
    }
}
