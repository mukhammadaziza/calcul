<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Storing;

class StoringController extends Controller
{
    public function store(Request $request)
    {
        $storing_service = [
            'work_type_id' => $request->work_type_id,
            'service_name' => $request->service_name,
            'price' => $request->service_price,
        ];

        Storing::create($storing_service);
        return redirect('/tariffs');
    }

    
    /**
     * Storing Xraneniya
     */
    public function storeNewStoringService(Request $request)
    {
        $storing_service = [
            'service_name' => $request->service_name,
            'price' => $request->service_price,
        ];

        Storing::create($storing_service);
        return redirect('/tariffs');
    }

    public function updateStoringService(Request $request, $id)
    {
        $storing_service = [
            'service_name' => $request->service_name,
            'price' => $request->service_price,
        ];

        $service = Storing::findOrFail($id);
        $service->update($storing_service);
        return redirect('/tariffs');
    }

    public function deleteStoringService($id)
    {
        $service = Storing::findOrFail($id);
        $service->delete();
        return redirect('/tariffs');
    }
}
