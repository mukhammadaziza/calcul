<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PackagingMaterialBoxPallet extends Model
{
    protected $table = "packaging_materials_box_pallet";
    protected $guarded = [];

    public function work_type(): BelongsTo
    {
        return $this->belongsTo(WorkType::class);
    }
}
