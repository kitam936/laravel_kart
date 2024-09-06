<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Circuit;
use App\Models\User;
class Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'cir_id',
    ];

    public function circuit()
    {
        return $this->belongsTo(Circuit::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
