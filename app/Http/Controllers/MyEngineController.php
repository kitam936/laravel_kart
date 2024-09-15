<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\My_engine;
use App\Models\EgMaint;
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

    public function show(Request $request,$id)
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

        $stints = DB::table('stints')
        ->join('my_engines','my_engines.id','=','stints.my_engine_id')
        ->join('engines','engines.id','=','my_engines.engine_id')
        ->join('circuits','circuits.id','=','stints.cir_id')
        ->where('stints.my_engine_id' ,$id)
        ->select('stints.id','stints.start_date','stints.my_engine_id','my_engines.engine_id','my_engines.engine_id','engines.engine_name','stints.laps','stints.distance','stints.best_time','circuits.cir_name')
        ->get();

        $first_date = DB::table('eg_maints')
        ->where('eg_maints.my_engine_id' ,$id)
        ->select('eg_maints.my_engine_id')
        ->selectRaw('min(maint_date) as latest')
        ->groupBy('eg_maints.my_engine_id')
        ->first();

        $max_date = DB::table('eg_maints')
        ->where('eg_maints.my_engine_id' ,$id)
        ->where('eg_maints.eg_maint_category_id','LIKE','%'.($request->category_id).'%')
        ->select('eg_maints.my_engine_id','eg_maints.eg_maint_category_id')
        ->selectRaw('max(maint_date) as latest')
        ->groupBy('eg_maints.my_engine_id','eg_maints.eg_maint_category_id')
        ->first();

        if(is_null($request->category_id) | is_null($max_date)){
            $maint_date = $first_date;
        }else{
            $maint_date = $max_date;
        };


        $stints_total = DB::table('stints')
        ->where('stints.my_engine_id' ,$id)
        ->wheredate('stints.start_date' ,'>=',$maint_date->latest)
        ->select('stints.my_engine_id')
        ->selectRaw('SUM(stints.laps) as laps')
        ->selectRaw('SUM(stints.distance) as distance')
        ->selectRaw('avg(stints.best_time) as time')
        ->groupBy('stints.my_engine_id')
        ->first();

        $maints = DB::table('eg_maints')
        ->join('my_engines','my_engines.id','=','eg_maints.my_engine_id')
        ->join('engines','engines.id','=','my_engines.engine_id')
        ->join('eg_maint_categories','eg_maint_categories.id','=','eg_maints.eg_maint_category_id')
        ->where('eg_maints.my_engine_id' ,$id)
        ->where('eg_maints.eg_maint_category_id','LIKE','%'.($request->category_id).'%')
        ->select('eg_maints.id as maint_id','eg_maints.maint_date','eg_maint_categories.eg_maint_name','eg_maints.maint_info','eg_maints.eg_maint_category_id')
        ->orderBy('maint_date','desc')
        ->get();

        $maint_categories = DB::table('eg_maint_categories')->get();

        // dd($request->category_id,$first_date,$max_date,$min_date,$maint_date->latest,$stints_total);

        return view('mykart.myengine_show',compact('myengine','engines','stints','stints_total','maints','maint_categories'));

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
        $my_engine = My_engine::findOrFail($id);

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
