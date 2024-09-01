<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Stint;

class My_kart extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'maker_id',
        'model_year',
        'photo1',
        'photo2',
        'my_kart_info',
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
