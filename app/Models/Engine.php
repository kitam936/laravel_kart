<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Engine extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'engine_name',
        'engine_info',
        'sort_order'
    ];
}
