<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;
use App\Models\Area;
use App\Models\My_kart;
use App\Models\My_tire;
use App\Models\My_engine;
use App\Models\Stint;
use App\Models\Favorite;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $attributes = [
        'role_id' => 9,
        'area_id' => 9,
    ];


    protected $fillable = [
        'name',
        'name_kana',
        'email',
        'password',
        'photo1',
        'photo2',
        'user_info',
        'role_id',
        'area_id',
    ];



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function my_karts()
    {
        return $this->hasMany(My_kart::class);
    }

    public function my_tires()
    {
        return $this->hasMany(My_tire::class);
    }

    public function my_engines()
    {
        return $this->hasMany(My_engine::class);
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
