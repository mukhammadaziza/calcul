<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductPreparationDimension extends Model
{
    protected $table = 'product_preparations_dimensions';
    protected $guarded = [];

    public function names(): BelongsToMany
    {
        return $this->belongsToMany(ProductPreparationName::class, 
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
