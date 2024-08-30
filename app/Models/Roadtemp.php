<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roadtemp extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'roadtemp_range',
        'from',
        'to',
    ];
}
