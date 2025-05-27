<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PackagingMaterial extends Model
{
    protected $table = 'packaging_materials';
    protected $guarded = [];

    public function work_type(): BelongsTo
    {
        return $this->belongsTo(WorkType::class);
    }
}
