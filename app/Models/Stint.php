<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;
use App\Models\Circuit;
use App\Models\User;

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
        'distance',
        'best_time',
        'max_rev',
        'min_rev',
        'fr_tread',
        're_tread',
        'fr_sprocket',
        're_sprocket',
        'stabilizer',
        'tire_pres',
        'tire_temp',
        'tire_age',
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

    // protected function startDate(): Attribute
    // { return new Attribute(
    // get: fn () => Carbon::parse($this->start_date)->format('Y年m月d日'),);}
    // protected function startTime(): Attribute
    // { return new Attribute(
    // get: fn () => Carbon::parse($this->start_date)->format('H時i分'), ); }
    // protected function editStartDate(): Attribute
    // { return new Attribute(
    // get: fn () => Carbon::parse($this->start_date)->format('Y-m-d'),
    // );}

    public function circuit()
    {
        return $this->belongsTo(Circuit::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }



}
