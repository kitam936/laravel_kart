<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Models\Stint;

class DataController extends Controller
{
    public function myStintCSV_download()
    {
        $stints = Stint::where('stints.user_id', Auth::id())
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
        ->select('stints.id','users.name','circuits.cir_name','stints.start_date','stints.dry_wet','stints.road_temp',
                'roadtemps.roadtemp_range','stints.temp','temps.temp_range','stints.tire_temp','tiretemps.tiretemp_range',
                'stints.atm_pressure','stints.humidity','humidities.humi_range','stints.my_kart_id','my_karts.maker_id',
                'makers.maker_name','my_karts.model_year','stints.my_engine_id','my_engines.engine_id','engines.engine_name',
                'stints.my_tire_id','my_tires.tire_id','tires.tire_name','stints.laps','stints.best_time',
                'stints.max_rev','stints.min_rev','stints.fr_tread','stints.re_tread','stints.fr_sprocket',
                'stints.re_sprocket','stints.stabilizer','stints.tire_pres','stints.tire_age','stints.cab_hi',
                'stints.cab_lo','stints.stint_info',)
        ->orderby('stints.start_date','desc')
        ->get();

        $csvHeader = [
            'stint_id','member_name','circuit_name','start_date','dry_wet','roadtemp_id',
            'roadtemp_range','temp_id','temp_range','tiretemp_id','tiretemp_range',
            'atm_pressure','humidity_id','humidity_range','my_kart_id','maker_id',
            'maker_name','model_year','my_engine_id','engine_id','engine_name',
            'my_tire_id','tire_id','tire_name','laps','best_time',
            'max_rev','min_rev','front_tread','rear_tread','front_sprocket',
            'rear_sprocket','stabilizer','tire_pres','tire_age','cab_hi',
            'cab_lo','stint_info',];

        $csvData = $stints->toArray();

        // dd($stints,$csvHeader,$csvData);

        $response = new StreamedResponse(function () use ($csvHeader, $csvData) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $csvHeader);

            foreach ($csvData as $row) {
                mb_convert_variables('sjis-win','utf-8',$row);
                fputcsv($handle, $row);
            }

            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="my_stints.csv"',
        ]);

        return $response;

    }

    public function StintCSV_download()
    {
        $stints = Stint::join('users','users.id','=','stints.user_id')
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
        ->select('stints.id','users.name','circuits.cir_name','stints.start_date','stints.dry_wet','stints.road_temp',
                'roadtemps.roadtemp_range','stints.temp','temps.temp_range','stints.tire_temp','tiretemps.tiretemp_range',
                'stints.atm_pressure','stints.humidity','humidities.humi_range','stints.my_kart_id','my_karts.maker_id',
                'makers.maker_name','my_karts.model_year','stints.my_engine_id','my_engines.engine_id','engines.engine_name',
                'stints.my_tire_id','my_tires.tire_id','tires.tire_name','stints.laps','stints.best_time',
                'stints.max_rev','stints.min_rev','stints.fr_tread','stints.re_tread','stints.fr_sprocket',
                'stints.re_sprocket','stints.stabilizer','stints.tire_pres','stints.tire_age','stints.cab_hi',
                'stints.cab_lo','stints.stint_info',)
        ->orderby('stints.start_date','desc')
        ->get();
        $csvHeader = [
            'stint_id','member_name','circuit_name','start_date','dry_wet','roadtemp_id',
            'roadtemp_range','temp_id','temp_range','tiretemp_id','tiretemp_range',
            'atm_pressure','humidity_id','humidity_range','my_kart_id','maker_id',
            'maker_name','model_year','my_engine_id','engine_id','engine_name',
            'my_tire_id','tire_id','tire_name','laps','best_time',
            'max_rev','min_rev','front_tread','rear_tread','front_sprocket',
            'rear_sprocket','stabilizer','tire_pres','tire_age','cab_hi',
            'cab_lo','stint_info',];
        $csvData = $stints->toArray();

        // dd($stints,$csvHeader,$csvData);

        $response = new StreamedResponse(function () use ($csvHeader, $csvData) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $csvHeader);

            foreach ($csvData as $row) {
                mb_convert_variables('sjis-win','utf-8',$row);
                fputcsv($handle, $row);
            }

            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="stints_data.csv"',
        ]);

        return $response;

    }
}
