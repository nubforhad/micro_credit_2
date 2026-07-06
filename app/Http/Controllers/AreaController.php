<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Branch;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index()
    {
        $areas = Area::with('branch')->latest()->paginate(10);
        return view('modules.area.index', compact('areas'));
    }

    public function create()
    {
        $branches = Branch::with('company')->get();
        return view('modules.area.create', compact('branches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'branch_id' => 'required',
            'name' => 'required',
        ]);

        Area::create([
            'branch_id' => $request->branch_id,
            'name' => $request->name,
            'code' => $request->code,
            'note' => $request->note,
            'status' => $request->status ?? 1,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('area.index')
            ->with('success', 'Area created successfully');
    }

    public function show($id)
    {
        $area = Area::with('branch')->findOrFail($id);
        return view('modules.area.show', compact('area'));
    }

    public function edit($id)
    {
        $area = Area::findOrFail($id);
        $branches = Branch::all();
        return view('modules.area.edit', compact('area','branches'));
    }

    public function update(Request $request, $id)
    {
        $area = Area::findOrFail($id);

        $area->update([
            'branch_id' => $request->branch_id,
            'name' => $request->name,
            'code' => $request->code,
            'note' => $request->note,
            'status' => $request->status ?? 1,
        ]);

        return redirect()->route('area.index')
            ->with('success', 'Area updated successfully');
    }

    public function destroy($id)
    {
        Area::findOrFail($id)->delete();

        return redirect()->route('area.index')
            ->with('success', 'Area deleted successfully');
    }
}