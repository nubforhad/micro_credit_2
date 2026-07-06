<?php

 namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Company;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::with('company')->latest()->paginate(10);
        return view('modules.branch.index', compact('branches'));
    }

    public function create()
    {
        $companies = Company::all();
        return view('modules.branch.create', compact('companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required',
            'name' => 'required',
        ]);

        Branch::create([
            'company_id' => $request->company_id,
            'name' => $request->name,
            'code' => $request->code,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $request->status ?? 1,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('branch.index')
            ->with('success', 'Branch created successfully');
    }

    public function show($id)
    {
        $branch = Branch::with('company')->findOrFail($id);
        return view('modules.branch.show', compact('branch'));
    }

    public function edit($id)
    {
        $branch = Branch::findOrFail($id);
        $companies = Company::all();
        return view('modules.branch.edit', compact('branch','companies'));
    }

    public function update(Request $request, $id)
    {
        $branch = Branch::findOrFail($id);

        $branch->update([
            'company_id' => $request->company_id,
            'name' => $request->name,
            'code' => $request->code,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $request->status ?? 1,
        ]);

        return redirect()->route('branch.index')
            ->with('success', 'Branch updated successfully');
    }

    public function destroy($id)
    {
        Branch::findOrFail($id)->delete();

        return redirect()->route('branch.index')
            ->with('success', 'Branch deleted successfully');
    }
}