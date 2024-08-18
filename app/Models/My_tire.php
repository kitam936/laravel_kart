<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Stint;

class My_tire extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'tire_id',
        'my_tire_info',
        'purchase_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function stints()
    {
        return $this->hasMany(Stint::class);
    }
}
