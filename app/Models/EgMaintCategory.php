<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EgMaint;

class EgMaintCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'eg_maint_name',
        'eg_maint_category_info',
        'sort_order'
    ];

    public function egmaints()
    {
        return $this->hasMany(EgMaint::class);
    }
}
