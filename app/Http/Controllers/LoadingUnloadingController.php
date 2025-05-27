<?php

namespace App\Http\Controllers;

use App\Models\LoadingUnloading;
use Illuminate\Http\Request;

class LoadingUnloadingController extends Controller
{
    public function store(Request $request)
    {
        $loading_unloadings = [
            'name' => $request->loading_unloading_name,
            'price' => $request->loading_unloading_price,
        ];

        LoadingUnloading::create($loading_unloadings);
        return redirect('/tariffs');
    }

    public function update(Request $request, $id)
    {
        $loading_unloadings = [
            'name' => $request->loading_unloading_name,
            'price' => $request->loading_unloading_price,
        ];

        $loading_unloading = LoadingUnloading::findOrfail($id);
        $loading_unloading->update($loading_unloadings);
        return redirect('/tariffs');
    }

    public function destroy($id)
    {
        $loading_unloading = LoadingUnloading::findOrfail($id);
        $loading_unloading->delete();
        return redirect('/tariffs');
    }
}
