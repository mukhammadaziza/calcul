<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogisticsWarehouses;

class LogisticsWarehousesController extends Controller
{
    public function store(Request $request)
    {
        $logistics_warehouses = [
            'work_type_id' => $request->work_type_id,
            'warehouse_name' => $request->warehouse_name,
            'value_0' => $request->value_0,
            'value_1' => $request->value_1,
            'value_2' => $request->value_2,
            'value_3' => $request->value_3,
            'value_4' => $request->value_4,
            'value_5' => $request->value_5,
            'value_6' => $request->value_6,
            'value_7' => $request->value_7,
            'value_8' => $request->value_8,
            'value_9' => $request->value_9,
            'value_10' => $request->value_10,
        ];
        
        LogisticsWarehouses::create($logistics_warehouses);
        return redirect('/tariffs');
    }

    public function update(Request $request, $id)
    {
        $logistics_warehouses = [
            'warehouse_name' => $request->warehouse_name,
            'value_0' => $request->value_0,
            'value_1' => $request->value_1,
            'value_2' => $request->value_2,
            'value_3' => $request->value_3,
            'value_4' => $request->value_4,
            'value_5' => $request->value_5,
            'value_6' => $request->value_6,
            'value_7' => $request->value_7,
            'value_8' => $request->value_8,
            'value_9' => $request->value_9,
            'value_10' => $request->value_10,
        ];
        
        $logistics_warehouse = LogisticsWarehouses::findOrfail($id);
        $logistics_warehouse->update($logistics_warehouses);
        return redirect('/tariffs');
    }

    public function destroy($id)
    {
        $logistics_warehouse = LogisticsWarehouses::findOrfail($id);
        $logistics_warehouse->delete();
        return redirect('/tariffs');
    }
}
