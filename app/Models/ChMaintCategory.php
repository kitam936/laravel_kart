<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ChMaint;

class ChMaintCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'ch_maint_name',
        'ch_maint_category_info',
        'sort_order'
    ];

    public function chmaints()
    {
        return $this->hasMany(ChMaint::class);
    }
}
