<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tire extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'tire_name',
        'sort_order'
    ];
}
