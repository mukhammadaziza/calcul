<?php

namespace App\Http\Controllers;

use App\Models\WorkType;
use Illuminate\Http\Request;

class WorkTypeController extends Controller
{
    public function store(Request $request)
    {
        $work_types = [
            'name' => $request->work_type_name
        ];

        WorkType::create($work_types);
        return redirect('/tariffs');
    }

    public function update(Request $request, $id)
    {
        $work_types = [
            'name' => $request->work_type_name
        ];

        $service = WorkType::findOrFail($id);
        $service->update($work_types);
        return redirect('/tariffs');
    }

    public function destroy($id)
    {
        $work_type = WorkType::findOrFail($id);
        $work_type->delete();
        return redirect('/tariffs');
    }
}
