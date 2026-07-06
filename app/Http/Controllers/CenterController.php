<?php

 namespace App\Http\Controllers;

use App\Models\Center;
use App\Models\Area;
use Illuminate\Http\Request;

class CenterController extends Controller
{
    public function index()
    {
        $centers = Center::with('area')->latest()->paginate(10);
        return view('modules.center.index', compact('centers'));
    }

    public function create()
    {
        $areas = Area::with('branch')->get();
        return view('modules.center.create', compact('areas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'area_id' => 'required',
            'name' => 'required',
        ]);

        Center::create([
            'area_id' => $request->area_id,
            'name' => $request->name,
            'code' => $request->code,
            'meeting_day' => $request->meeting_day,
            'meeting_time' => $request->meeting_time,
            'address' => $request->address,
            'status' => $request->status ?? 1,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('center.index')
            ->with('success', 'Center created successfully');
    }

    public function show($id)
    {
        $center = Center::with('area')->findOrFail($id);
        return view('modules.center.show', compact('center'));
    }

    public function edit($id)
    {
        $center = Center::findOrFail($id);
        $areas = Area::all();
        return view('modules.center.edit', compact('center','areas'));
    }

    public function update(Request $request, $id)
    {
        $center = Center::findOrFail($id);

        $center->update([
            'area_id' => $request->area_id,
            'name' => $request->name,
            'code' => $request->code,
            'meeting_day' => $request->meeting_day,
            'meeting_time' => $request->meeting_time,
            'address' => $request->address,
            'status' => $request->status ?? 1,
        ]);

        return redirect()->route('center.index')
            ->with('success', 'Center updated successfully');
    }

    public function destroy($id)
    {
        Center::findOrFail($id)->delete();

        return redirect()->route('center.index')
            ->with('success', 'Center deleted successfully');
    }
}