<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EgMaintCategory;

class EgMaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'my_engine_id',
        'eg_maint_category_id',
        'maint_date',
        'maint_fee',
        'maint_info',
    ];

    public function egmaintcategory()
    {
        return $this->belongsTo(EgMaintCategory::class);
    }
}
