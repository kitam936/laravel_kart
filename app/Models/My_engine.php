<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Stint;
use App\Models\Favorite;

class My_engine extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'engine_id',
        'my_engine_info',
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

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}
