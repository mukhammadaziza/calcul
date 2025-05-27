<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoadingUnloading extends Model
{
    protected $table = 'loading_unloading';
    protected $guarded = [];

    public function work_type(): BelongsTo
    {
        return $this->belongsTo(WorkType::class);
    }
}
