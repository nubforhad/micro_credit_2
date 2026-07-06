<?php

 namespace App\Http\Controllers;

use App\Models\Saving;
use App\Models\Member;
use Illuminate\Http\Request;

class SavingController extends Controller
{
    public function index()
    {
        $savings = Saving::with('member')->latest()->paginate(10);
        return view('modules.saving.index', compact('savings'));
    }

    public function create()
    {
        $members = Member::all();
        return view('modules.saving.create', compact('members'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required',
            'amount' => 'required|numeric',
            'date' => 'required',
        ]);

        Saving::create([
            'member_id' => $request->member_id,
            'type' => $request->type,
            'amount' => $request->amount,
            'date' => $request->date,
            'note' => $request->note,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('saving.index')
            ->with('success', 'Saving record added successfully');
    }

    public function show($id)
    {
        $saving = Saving::with('member')->findOrFail($id);
        return view('modules.saving.show', compact('saving'));
    }

    public function edit($id)
    {
        $saving = Saving::findOrFail($id);
        $members = Member::all();
        return view('modules.saving.edit', compact('saving','members'));
    }

    public function update(Request $request, $id)
    {
        $saving = Saving::findOrFail($id);

        $saving->update([
            'member_id' => $request->member_id,
            'type' => $request->type,
            'amount' => $request->amount,
            'date' => $request->date,
            'note' => $request->note,
        ]);

        return redirect()->route('saving.index')
            ->with('success', 'Saving updated successfully');
    }

    public function destroy($id)
    {
        Saving::findOrFail($id)->delete();

        return redirect()->route('saving.index')
            ->with('success', 'Saving deleted successfully');
    }
}