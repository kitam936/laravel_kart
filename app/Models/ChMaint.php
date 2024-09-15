<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ChMaintCategory;

class ChMaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'my_kart_id',
        'ch_maint_category_id',
        'maint_date',
        'maint_fee',
        'maint_info',
    ];

    public function chmaintcategory()
    {
        return $this->belongsTo(ChMaintCategory::class);
    }


}
