<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkType extends Model
{
    protected $table = 'work_types';
    protected $guarded = [];

    public function product_preparations_names(): HasMany
    {
        return $this->hasMany(ProductPreparationName::class);
    }

    public function packaging_materials_box_pallet(): HasMany
    {
        return $this->hasMany(PackagingMaterialBoxPallet::class);
    }

    public function logistics_warehouses(): HasMany
    {
        return $this->hasMany(LogisticsWarehouses::class);
    }

    public function packaging_materials(): HasMany
    {
        return $this->hasMany(PackagingMaterial::class);
    }

    public function storing(): HasMany
    {
        return $this->hasMany(Storing::class);
    }

    public function loading_unloadings(): HasMany
    {
        return $this->hasMany(Storing::class);
    }
}
