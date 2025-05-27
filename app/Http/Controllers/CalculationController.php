<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\LoadingUnloading;
use App\Models\LogisticsWarehouses;
use App\Models\PackagingMaterial;
use App\Models\PackagingMaterialBoxPallet;
use App\Models\ProductPreparationDimension;
use App\Models\ProductPreparationName;
use App\Models\Storing;
use App\Models\WorkType;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CalculationController extends Controller
{
    public function index()
    {
        return Inertia::render('Index');
    }

    public function tariffs()
    {
        $storing_services = Storing::with('work_type')->get();
        $packaging_materials = PackagingMaterial::with('work_type')->get();
        $loading_unloadings = LoadingUnloading::all();
        $logistics_warehouses = LogisticsWarehouses::with('work_type')->get();
        $work_types = WorkType::all();

        $product_preparations_names = ProductPreparationName::with('dimensions')->get();
        $product_preparations_dimensions = ProductPreparationDimension::with('names')->get();
        return Inertia::render('Tariffs', compact(
                                                    'storing_services', 
                                                    'packaging_materials', 
                                                    'loading_unloadings', 
                                                    'logistics_warehouses',
                                                    'product_preparations_names',
                                                    'product_preparations_dimensions',
                                                    'work_types'
                                                ));
    }

    public function makeCalculation()
    {
        $storing_services = Storing::with('work_type')->get();
        $packaging_materials = PackagingMaterial::with('work_type')->get();
        $packaging_materials_box_pallet = PackagingMaterialBoxPallet::with('work_type')->get();
        $loading_unloadings = LoadingUnloading::with('work_type')->get();
        $logistics_warehouses = LogisticsWarehouses::with('work_type')->get();

        $product_preparation_names = ProductPreparationName::with(['dimensions', 'work_type'])->get();
        $product_preparation_dimensions = ProductPreparationDimension::with('names')->get();

        $work_types = WorkType::all();
        return Inertia::render('Calculator', compact(
                                                        'storing_services', 
                                                        'packaging_materials', 
                                                        'loading_unloadings',
                                                        'logistics_warehouses',
                                                        'packaging_materials_box_pallet',
                                                        'product_preparation_names',
                                                        'product_preparation_dimensions',
                                                        'work_types'
                                                    ));
    }


    public function generate_pdf(Request $request)
    {
        $storedValuesArray = json_decode($request->input('storedValuesArray'), true);
        $workTypesArray = json_decode($request->input('workTypesArray'), true);
        $WorkTypesAfterDiscount = json_decode($request->input('WorkTypesAfterDiscount'), true);
        $WorkTypesBeforeDiscount = json_decode($request->input('WorkTypesBeforeDiscount'), true);
        $loading_unloading_service_price = json_decode($request->input('loading_unloading_service_price'), true);
        $generated_date = date("Y-m-d");

        // var_dump($storedValuesArray);
        // var_dump($workTypesArray);
        // var_dump($WorkTypesAfterDiscount);
        // var_dump($WorkTypesBeforeDiscount);
        // var_dump($loading_unloading_service_price);
        // dd();
        $pdf = PDF::loadView('commercial_proposal', [
                                                    'storedValuesArray' => $storedValuesArray,
                                                    'workTypesArray' => $workTypesArray,
                                                    'WorkTypesAfterDiscount' => $WorkTypesAfterDiscount,
                                                    'WorkTypesBeforeDiscount' => $WorkTypesBeforeDiscount,
                                                    'generated_date' => $generated_date,
                                                    'loading_unloading_service_price' => $loading_unloading_service_price
                                                    ]);

        return $pdf->download('commercial_proposal.pdf');
    }
}
