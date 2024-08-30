<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Stint;
use App\Models\User;
use App\Models\Area;
use App\Models\Status;
use Carbon\Carbon;
use App\Http\Requests\StoreStintRequest;
use App\Http\Requests\UpdateStintRequest;


class StintController extends Controller
{
    public function my_stint_list(Request $request)
    {
        $stints = DB::table('stints')
        ->join('my_engines','my_engines.id','=','stints.my_engine_id')
        ->join('engines','engines.id','=','my_engines.engine_id')
        ->join('my_karts','my_karts.id','=','stints.my_kart_id')
        ->join('makers','makers.id','=','my_karts.maker_id')
        ->join('my_tires','my_tires.id','=','stints.my_tire_id')
        ->join('tires','tires.id','=','my_tires.tire_id')
        ->join('circuits','circuits.id','=','stints.cir_id')
        ->join('areas','areas.id','=','circuits.area_id')
        ->where('stints.user_id',Auth::id())
        ->where('circuits.id','LIKE','%'.($request->cir_id).'%')
        ->where('makers.id','LIKE','%'.($request->kart_id).'%')
        ->where('tires.id','LIKE','%'.($request->tire_id).'%')
        ->where('engines.id','LIKE','%'.($request->engine_id).'%')
        ->where('stints.temp','LIKE','%'.($request->temp_id).'%')
        ->where('stints.road_temp','LIKE','%'.($request->road_temp_id).'%')
        ->where('stints.humidity','LIKE','%'.($request->humi_id).'%')
        // ->whereDate('stints.start_date', 'LIKE','%'.$request['from_date'].'%')
        ->select('stints.id as stint_id','stints.user_id','stints.start_date','circuits.cir_name','areas.area_name','stints.best_time',
        'stints.laps','stints.max_rev','stints.min_rev')
        ->orderBy('stints.best_time')
        ->get();

        $circuits = DB::table('circuits')->get();

        $karts = DB::table('makers')
        ->get();

        $tires = DB::table('tires')
        ->get();

        $engines = DB::table('engines')
        ->get();

        $temps = DB::table('temps')
        ->where('temps.id','>',0)
        ->where('temps.id','<',7)
        ->get();

        $road_temps = DB::table('roadtemps')
        ->where('roadtemps.id','>',0)
        ->where('roadtemps.id','<',13)
        ->get();

        $humis = DB::table('humidities')
        ->get();


        $num_of_laps = DB::table('stints')
        ->join('my_karts','my_karts.id','=','stints.my_kart_id')
        ->join('makers','makers.id','=','my_karts.maker_id')
        ->join('my_tires','my_tires.id','=','stints.my_tire_id')
        ->join('tires','tires.id','=','my_tires.tire_id')
        ->join('my_engines','my_engines.id','=','stints.my_engine_id')
        ->join('engines','engines.id','=','my_engines.engine_id')
        ->where('stints.user_id',Auth::id())
        ->where('stints.cir_id','LIKE','%'.($request->cir_id).'%')
        ->where('makers.id','LIKE','%'.($request->kart_id).'%')
        ->where('tires.id','LIKE','%'.($request->tire_id).'%')
        ->where('engines.id','LIKE','%'.($request->engine_id).'%')
        ->where('stints.temp','LIKE','%'.($request->temp_id).'%')
        ->where('stints.road_temp','LIKE','%'.($request->road_temp_id).'%')
        ->where('stints.humidity','LIKE','%'.($request->humi_id).'%')
        ->selectRaw('SUM(stints.laps) as laps')
        ->selectRaw('COUNT(stints.id) as number_of_laps')
        ->get();

        // dd($road_temps);
        // dd($stints,$circuits,$engines,$karts,$tires,$temps,$road_temps,$humis);
        return view('stints.my_stint_list',compact('stints','circuits','karts','tires','engines','num_of_laps','temps','road_temps','humis'));
    }

    public function my_stint_show($id)
    {
        $stint_id = $id;
        $stint = DB::table('stints')
        ->join('users','users.id','=','stints.user_id')
        ->join('my_engines','my_engines.id','=','stints.my_engine_id')
        ->join('engines','engines.id','=','my_engines.engine_id')
        ->join('my_karts','my_karts.id','=','stints.my_kart_id')
        ->join('makers','makers.id','=','my_karts.maker_id')
        ->join('my_tires','my_tires.id','=','stints.my_tire_id')
        ->join('tires','tires.id','=','my_tires.tire_id')
        ->join('circuits','circuits.id','=','stints.cir_id')
        ->join('areas','areas.id','=','circuits.area_id')
        ->leftjoin('temps','temps.id','=','stints.temp')
        ->leftjoin('roadtemps','roadtemps.id','=','stints.road_temp')
        ->leftjoin('tiretemps','tiretemps.id','=','stints.tire_temp')
        ->leftjoin('humidities','humidities.id','=','stints.humidity')
        ->where('stints.user_id',Auth::id())
        // ->select('stints.id as stint_id','stints.user_id','stints.start_date','circuits.cir_name','areas.area_name','stints.best_time',
        // 'stints.laps','stints.max_rev','stints.min_rev')
        ->where('stints.id' ,$id)
        // ->select('reservations.id as resv_id','reservations.event_id','events.start_date','events.end_date','events.event_name',
        // 'events.place','reservations.secondary_category_id','secondary_categories.secondary_name','reservations.sub_category_id',
        // 'sub_categories.sub_name','reservations.number','reservations.real_name','reservations.real_name_kana','reservations.resv_info',
        // 'reservations.number_of_sub','reservations.number_of_main','events.main_fee','events.sub_fee')
        ->first();


        // dd($stint);
        return view('stints.my_stint_show',compact('stint','stint_id'));
    }

    public function stint_create()
    {

        $user = User::findOrFail(Auth::id());

        $cirs = DB::table('circuits')->get();

        $karts = DB::table('my_karts')
        ->join('makers','makers.id','=','my_karts.maker_id')
        ->where('my_karts.user_id',Auth::id())
        ->orderBy('my_karts.id','desc')
        ->get();

        $tires = DB::table('my_tires')
        ->join('tires','tires.id','=','my_tires.tire_id')
        ->where('my_tires.user_id',Auth::id())
        ->orderBy('my_tires.id','desc')
        ->get();

        $engines = DB::table('my_engines')
        ->join('engines','engines.id','=','my_engines.engine_id')
        ->where('my_engines.user_id',Auth::id())
        ->orderBy('my_engines.id','desc')
        ->get();

        $temps = DB::table('temps')
        ->where('temps.id','>',0)
        ->where('temps.id','<',7)
        ->get();

        $road_temps = DB::table('roadtemps')
        ->get();

        $tire_temps = DB::table('tiretemps')
        ->get();

        $humis = DB::table('humidities')
        ->get();

        // dd($road_temps);
        // dd($engines,$karts,$tires,$cirs,$user);
        return view('stints.stint_create',compact('tire_temps','temps','road_temps','humis','cirs','karts','tires','engines','user'));
    }

    public function stint_store(StoreStintRequest $request)
    {
        $planner = DB::table('users')
        ->where('users.id',Auth::id())
        ->select(['users.id','users.name','users.email','users.name'])
        ->first();

        // dd($planner->email);

        $areas = DB::table('areas')
        ->select(['areas.id','areas.area_name'])
        ->get();



        $start = $request['event_date'] . " " . $request['start_time'];
        $startDate = Carbon::createFromFormat(
        'Y-m-d H:i', $start );

        $end = $request['event_date'] . " " . $request['end_time'];
        $endDate = Carbon::createFromFormat(
        'Y-m-d H:i', $end );

        Stint::create([
            'event_name' => $request['event_name'],
            'information' => $request['information'],
            'place_area_id' => $request['area_id'],
            'place' => $request['place'],
            'main_fee' => $request['main_fee'],
            'sub_fee' => $request['sub_fee'],
            'start_date' => $startDate,
            'end_date' => $endDate,
            'capacity' => $request['capacity'],
            'is_visible' => $request['is_visible'],
            'planner' => $request['planner'],
            'planner_name' => $planner->name,
            'planner_email' => $planner->email,
        ]);

        return to_route('my_stint')->with(['message'=>'Stintが登録されました','status'=>'info']);

    }


    public function stint_list(Request $request)
    {
        $stints = DB::table('stints')
        ->join('users','users.id','=','stints.user_id')
        ->join('my_engines','my_engines.id','=','stints.my_engine_id')
        ->join('engines','engines.id','=','my_engines.engine_id')
        ->join('my_karts','my_karts.id','=','stints.my_kart_id')
        ->join('makers','makers.id','=','my_karts.maker_id')
        ->join('my_tires','my_tires.id','=','stints.my_tire_id')
        ->join('tires','tires.id','=','my_tires.tire_id')
        ->join('circuits','circuits.id','=','stints.cir_id')
        ->join('areas','areas.id','=','circuits.area_id')
        ->where('circuits.id','LIKE','%'.($request->cir_id).'%')
        ->where('makers.id','LIKE','%'.($request->kart_id).'%')
        ->where('tires.id','LIKE','%'.($request->tire_id).'%')
        ->where('engines.id','LIKE','%'.($request->engine_id).'%')
        ->where('stints.temp','LIKE','%'.($request->temp_id).'%')
        ->where('stints.road_temp','LIKE','%'.($request->road_temp_id).'%')
        ->where('stints.humidity','LIKE','%'.($request->humi_id).'%')
        // ->whereDate('stints.start_date', 'LIKE','%'.$request['from_date'].'%')
        ->select('stints.id as stint_id','stints.user_id','users.name','stints.start_date','circuits.cir_name','areas.area_name','stints.best_time',
        'stints.laps','stints.max_rev','stints.min_rev')
        ->orderBy('stints.best_time')
        ->get();

        $circuits = DB::table('circuits')->get();

        $karts = DB::table('makers')
        ->get();

        $tires = DB::table('tires')
        ->get();

        $engines = DB::table('engines')
        ->get();

        $temps = DB::table('temps')
        ->where('temps.id','>',0)
        ->where('temps.id','<',7)
        ->get();

        $road_temps = DB::table('roadtemps')
        ->where('roadtemps.id','>',0)
        ->where('roadtemps.id','<',13)
        ->get();

        $humis = DB::table('humidities')
        ->get();


        // dd($stints,$circuits,$engines,$karts,$tires,$temps,$road_temps,$humis);
        return view('stints.stint_list',compact('stints','circuits','karts','tires','engines','temps','road_temps','humis'));
    }

    public function stint_show($id)
    {
        $stint_id = $id;
        $login_user = Auth::id();
        $stint = DB::table('stints')
        ->join('users','users.id','=','stints.user_id')
        ->join('my_engines','my_engines.id','=','stints.my_engine_id')
        ->join('engines','engines.id','=','my_engines.engine_id')
        ->join('my_karts','my_karts.id','=','stints.my_kart_id')
        ->join('makers','makers.id','=','my_karts.maker_id')
        ->join('my_tires','my_tires.id','=','stints.my_tire_id')
        ->join('tires','tires.id','=','my_tires.tire_id')
        ->join('circuits','circuits.id','=','stints.cir_id')
        ->join('areas','areas.id','=','circuits.area_id')
        ->leftjoin('temps','temps.id','=','stints.temp')
        ->leftjoin('roadtemps','roadtemps.id','=','stints.road_temp')
        ->leftjoin('tiretemps','tiretemps.id','=','stints.tire_temp')
        ->leftjoin('humidities','humidities.id','=','stints.humidity')
        // ->select('stints.id as stint_id','stints.user_id','stints.start_date','circuits.cir_name','areas.area_name','stints.best_time',
        // 'stints.laps','stints.max_rev','stints.min_rev')
        ->where('stints.id' ,$id)
        // ->select('reservations.id as resv_id','reservations.event_id','events.start_date','events.end_date','events.event_name',
        // 'events.place','reservations.secondary_category_id','secondary_categories.secondary_name','reservations.sub_category_id',
        // 'sub_categories.sub_name','reservations.number','reservations.real_name','reservations.real_name_kana','reservations.resv_info',
        // 'reservations.number_of_sub','reservations.number_of_main','events.main_fee','events.sub_fee')
        ->first();



        // dd($stint);
        return view('stints.stint_show',compact('stint','stint_id','login_user'));
    }

    public function stint_destroy($id)
    {
        Stint::findOrFail($id)->delete();

        return to_route('my_stint')->with(['message'=>'Stintが削除されました','status'=>'alert']);
    }


}
