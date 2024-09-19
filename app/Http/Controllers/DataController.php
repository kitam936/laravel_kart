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
                'roadtemps.roadtemp_range','temps.temp_range','stints.temp','stints.tire_temp','tiretemps.tiretemp_range',
                'stints.atm_pressure','stints.humidity','humidities.humi_range','stints.my_kart_id','my_karts.maker_id',
                'makers.maker_name','stints.my_engine_id','my_engines.engine_id','engines.engine_name','my_karts.model_year',
                'stints.my_tire_id','my_tires.tire_id','tires.tire_name','stints.laps','stints.best_time',
                'stints.max_rev','stints.min_rev','stints.fr_tread','stints.re_tread','stints.fr_sprocket',
                'stints.re_sprocket','stints.stabilizer','stints.tire_pres','stints.tire_age','stints.cab_hi',
                'stints.cab_lo','stints.stint_info',)
        ->get();

        $csvHeader = [
            'stints.id','users.name','circuits.cir_name','stints.start_date','stints.dry_wet','stints.road_temp',
            'roadtemps.roadtemp_range','temps.temp_range','stints.temp','stints.tire_temp','tiretemps.tiretemp_range',
            'stints.atm_pressure','stints.humidity','humidities.humi_range','stints.my_kart_id','my_karts.maker_id',
            'makers.maker_name','stints.my_engine_id','my_engines.engine_id','engines.engine_name','my_karts.model_year',
            'stints.my_tire_id','my_tires.tire_id','tires.tire_name','stints.laps','stints.best_time',
            'stints.max_rev','stints.min_rev','stints.fr_tread','stints.re_tread','stints.fr_sprocket',
            'stints.re_sprocket','stints.stabilizer','stints.tire_pres','stints.tire_age','stints.cab_hi',
            'stints.cab_lo','stints.stint_info',];
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
                'roadtemps.roadtemp_range','temps.temp_range','stints.temp','stints.tire_temp','tiretemps.tiretemp_range',
                'stints.atm_pressure','stints.humidity','humidities.humi_range','stints.my_kart_id','my_karts.maker_id',
                'makers.maker_name','stints.my_engine_id','my_engines.engine_id','engines.engine_name','my_karts.model_year',
                'stints.my_tire_id','my_tires.tire_id','tires.tire_name','stints.laps','stints.best_time',
                'stints.max_rev','stints.min_rev','stints.fr_tread','stints.re_tread','stints.fr_sprocket',
                'stints.re_sprocket','stints.stabilizer','stints.tire_pres','stints.tire_age','stints.cab_hi',
                'stints.cab_lo','stints.stint_info',)
        ->get();
        $csvHeader = [
            'stints.id','users.name','circuits.cir_name','stints.start_date','stints.dry_wet','stints.road_temp',
            'roadtemps.roadtemp_range','temps.temp_range','stints.temp','stints.tire_temp','tiretemps.tiretemp_range',
            'stints.atm_pressure','stints.humidity','humidities.humi_range','stints.my_kart_id','my_karts.maker_id',
            'makers.maker_name','stints.my_engine_id','my_engines.engine_id','engines.engine_name','my_karts.model_year',
            'stints.my_tire_id','my_tires.tire_id','tires.tire_name','stints.laps','stints.best_time',
            'stints.max_rev','stints.min_rev','stints.fr_tread','stints.re_tread','stints.fr_sprocket',
            'stints.re_sprocket','stints.stabilizer','stints.tire_pres','stints.tire_age','stints.cab_hi',
            'stints.cab_lo','stints.stint_info',];
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
