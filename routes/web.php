<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CalculationController;
use App\Http\Controllers\LoadingUnloadingController;
use App\Http\Controllers\LogisticsWarehousesController;
use App\Http\Controllers\PackagingMaterialController;
use App\Http\Controllers\StoringController;
use App\Http\Controllers\WorkTypeController;


Route::get('/', [CalculationController::class, 'index'])->name('calculation.index');
Route::get('/tariffs', [CalculationController::class, 'tariffs'])->name('calculation.tariffs');
Route::get('/calculator', [CalculationController::class, 'makeCalculation'])->name('calculation');
Route::post('/store_new_preparation', [CalculationController::class, 'storeNewPreparation'])->name('store_new_preparation');

Route::post('/storings', [StoringController::class, 'store'])->name('storings.store');

Route::post('/work_types', [WorkTypeController::class, 'store'])->name('work_types.store');
Route::put('/work_types{id}', [WorkTypeController::class, 'update'])->name('work_types.update');
Route::delete('/work_types/{id}', [WorkTypeController::class, 'destroy'])->name('work_types.destroy');

Route::post('/packaging_materials', [PackagingMaterialController::class, 'store'])->name('packaging_materials.store');
Route::put('/packaging_materials/{id}', [PackagingMaterialController::class, 'update'])->name('packaging_materials.update');
Route::delete('/packaging_materials/{id}', [PackagingMaterialController::class, 'destroy'])->name('packaging_materials.destroy');

Route::post('/logistics_warehouses', [LogisticsWarehousesController::class, 'store'])->name('logistics_warehouses.store');
Route::put('/logistics_warehouses/{id}', [LogisticsWarehousesController::class, 'update'])->name('logistics_warehouses.update');
Route::delete('/logistics_warehouses/{id}', [LogisticsWarehousesController::class, 'destroy'])->name('logistics_warehouses.destroy');

Route::post('/loadings_unloadings', [LoadingUnloadingController::class, 'store'])->name('loadings_unloadings.store');
Route::put('/loadings_unloadings/{id}', [LoadingUnloadingController::class, 'update'])->name('loadings_unloadings.update');
Route::delete('/loadings_unloadings/{id}', [LoadingUnloadingController::class, 'destroy'])->name('loadings_unloadings.destroy');



Route::post('/store_new_storing_service', [CalculationController::class, 'storeNewStoringService'])->name('store_new_storing_service');
Route::put('/update_storing_service/{id}', [CalculationController::class, 'updateStoringService'])->name('update_storing_service');
Route::delete('/delete_storing_service/{id}', [CalculationController::class, 'deleteStoringService'])->name('delete_storing_service');


Route::post('/store_new_packaging_material', [CalculationController::class, 'storeNewPackagingMaterial'])->name('store_new_packaging_material');
Route::put('/update_packaging_material/{id}', [CalculationController::class, 'updatePackagingMaterial'])->name('update_packaging_material');
Route::delete('/delete_packaging_material/{id}', [CalculationController::class, 'deletePackagingMaterial'])->name('delete_packaging_material');

Route::post('/store_new_loading_unloading', [CalculationController::class, 'storeNewLoadingUnloading'])->name('store_new_loading_unloading');
Route::put('/update_loading_unloading/{id}', [CalculationController::class, 'updateLoadingUnloading'])->name('update_loading_unloading');
Route::delete('/delete_loading_unloading/{id}', [CalculationController::class, 'deleteLoadingUnloading'])->name('delete_loading_unloading');

Route::post('/generate_pdf', [CalculationController::class, 'generate_pdf'])->name('generate_pdf');

Route::get('/pdf', [CalculationController::class, 'pdf'])->name('pdf');