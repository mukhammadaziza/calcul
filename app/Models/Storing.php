<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Storing extends Model
{
    protected $table = 'storing_services';
    protected $guarded = [];

    public function work_type(): BelongsTo
    {
        return $this->belongsTo(WorkType::class);
    }
}
