<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PackagingMaterial;

class PackagingMaterialController extends Controller
{
    public function store(Request $request)
    {
        $packaging_materials = [
            'work_type_id' => $request->work_type_id,
            'name' => $request->packaging_material_name,
            'price' => $request->packaging_material_price,
        ];

        PackagingMaterial::create($packaging_materials);
        return redirect('/tariffs');
    }

    public function update(Request $request, $id)
    {
        $packaging_materials = [
            'name' => $request->packaging_material_name,
            'price' => $request->packaging_material_price,
        ];

        $packaging_material = PackagingMaterial::findOrFail($id);
        $packaging_material->update($packaging_materials);
        return redirect('/tariffs');
    }



    public function updatePackagingMaterial(Request $request, $id)
    {
        $storing_service = [
            'name' => $request->service_name,
            'price' => $request->service_price,
        ];

        $service = PackagingMaterial::findOrFail($id);
        $service->update($storing_service);
        return redirect('/tariffs');
    }

    public function destroy($id)
    {
        $service = PackagingMaterial::findOrFail($id);
        $service->delete();
        return redirect('/tariffs');
    }
}
