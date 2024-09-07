<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Area;
use App\Models\Favorite;

class Circuit extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'cir_name',
        'area_id',
        'photo1',
        'photo2',
        'cir_info',
        'url',
        'length'
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function stints()
    {
        return $this->hasMany(Stint::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}
