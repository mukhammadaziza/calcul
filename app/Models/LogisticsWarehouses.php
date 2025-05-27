<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogisticsWarehouses extends Model
{
    protected $table = 'logistics_warehouses';
    protected $guarded = [];

    public function work_type(): BelongsTo
    {
        return $this->belongsTo(WorkType::class);
    }
}
