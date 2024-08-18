<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stint extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'my_kart_id',
        'my_tire_id',
        'my_engine_id',
        'cir_id',
        'start_date',
        'laps',
        'best_time',
        'max_rev',
        'min_rev',
        'fr_tread',
        're_tread',
        'sprocket',
        'stabilizer',
        'tire_pres',
        'cab_hi',
        'cab_lo',
        'dry_wet',
        'temp',
        'humidity',
        'atm_pressure',
        'road_temp',
        'stint_info',
        'photo1',
        'photo2',
        'photo3',
        'filename',
    ];

}
