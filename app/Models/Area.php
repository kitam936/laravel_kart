<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Circuit;

class Area extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'area_name',
        'area_info',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function circuits()
    {
        return $this->hasMany(Circuit::class);
    }


}
