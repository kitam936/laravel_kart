<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\ChMaintCategory;
use App\Models\EgMaintCategory;
use App\Models\TireCategory;

class MainteContoroller extends Controller
{
    public function index()
    {
        $login_user = User::findOrFail(Auth::id());

        $karts = DB::table('my_karts')
        ->join('makers','makers.id','=','my_karts.maker_id')
        ->where('my_karts.user_id',Auth::id())
        ->select('my_karts.id as kart_id','my_karts.maker_id','my_karts.model_year','makers.maker_name','my_karts.purchase_date')
        ->orderBy('my_karts.purchase_date','desc')
        ->get();

        $engines = DB::table('my_engines')
        ->join('engines','engines.id','=','my_engines.engine_id')
        ->where('my_engines.user_id',Auth::id())
        ->select('my_engines.id as my_engine_id','my_engines.engine_id','engines.engine_name','engines.engine_maker_name','my_engines.purchase_date')
        ->orderBy('my_engines.purchase_date','desc')
        ->get();

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


        return view('mykart.index',compact('login_user','karts','engines','tires','tires2'));

    }

    public function category_index()
    {
        return view('category.index');
    }

    public function ch_index()
    {
        $categories = ChMaintCategory::All();
        return view('category.chassis_list',compact('categories'));
    }

    public function ch_create()
    {

        return view('category.chassis_create');
    }

    public function ch_show($id)
    {
        $category = ChMaintCategory::findOrFail($id);

        return view('category.chassis_show',compact('category'));
    }

    public function ch_edit($id)
    {
        $category = ChMaintCategory::findOrFail($id);

        return view('category.chassis_edit',compact('category'));
    }

    public function ch_store(Request $request)
    {
        ChMaintCategory::create([
            'ch_maint_name' => $request['ch_maint_name'],
            'ch_maint_category_info' => $request['ch_maint_info'],
            'sort_order' => $request['sort_order'],
        ]);

        return to_route('ch_category_index')->with(['message'=>'Categoryが登録されました','status'=>'info']);
    }

    public function ch_update(Request $request,$id)
    {
        $category = ChMaintCategory::findOrFail($id);
        $category->ch_maint_name = $request['ch_maint_name'];
        $category->ch_maint_category_info =  $request['ch_maint_info'];
        $category->sort_order = $request['sort_order'];
        // dd($request->kart_info);

        $category->save();

        return to_route('ch_category_index')->with(['message'=>'Categoryが更新されました','status'=>'info']);

    }

    public function ch_destroy($id)
    {

        ChMaintCategory::findOrFail($id)->delete();

        return to_route('ch_category_index')->with(['message'=>'Categoryが削除されました','status'=>'alert']);
    }

    public function eg_index()
    {
        $categories = EgMaintCategory::All();
        return view('category.engine_list',compact('categories'));
    }

    public function eg_create()
    {

        return view('category.engine_create');
    }

    public function eg_show($id)
    {
        $category = EgMaintCategory::findOrFail($id);

        return view('category.engine_show',compact('category'));
    }

    public function eg_edit($id)
    {
        $category = EgMaintCategory::findOrFail($id);

        return view('category.engine_edit',compact('category'));
    }

    public function eg_store(Request $request)
    {
        EgMaintCategory::create([
            'eg_maint_name' => $request['eg_maint_name'],
            'eg_maint_category_info' => $request['eg_maint_info'],
            'sort_order' => $request['sort_order'],
        ]);

        return to_route('eg_category_index')->with(['message'=>'Categoryが登録されました','status'=>'info']);
    }

    public function eg_update(Request $request,$id)
    {
        $category = EgMaintCategory::findOrFail($id);
        $category->eg_maint_name = $request['eg_maint_name'];
        $category->eg_maint_category_info =  $request['eg_maint_info'];
        $category->sort_order = $request['sort_order'];
        // dd($request->kart_info);

        $category->save();

        return to_route('eg_category_index')->with(['message'=>'Categoryが更新されました','status'=>'info']);

    }

    public function eg_destroy($id)
    {

        EgMaintCategory::findOrFail($id)->delete();

        return to_route('eg_category_index')->with(['message'=>'Categoryが削除されました','status'=>'alert']);
    }
}
