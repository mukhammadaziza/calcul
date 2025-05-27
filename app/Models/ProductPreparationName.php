<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductPreparationName extends Model
{
    protected $table = 'product_preparations_names';
    protected $guarded = [];

    public function work_type(): BelongsTo
    {
        return $this->belongsTo(WorkType::class);
    }

    public function dimensions(): BelongsToMany
    {
        return $this->belongsToMany(ProductPreparationDimension::class, 
                                                                    'product_preparation_name_dimension', 
                                                                    'preparation_name_id', 
                                                                    'product_dimension_id' )
                                                                        ->withPivot([
                                                                                        'preparation_name_id', 
                                                                                        'product_dimension_id', 
                                                                                        'value'
                                                                                    ]);
    }
}
