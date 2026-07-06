<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::latest()->paginate(10);
        return view('modules.company.index', compact('companies'));
    }

    public function create()
    {
        return view('modules.company.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $request->status ?? 1,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('company.index')
            ->with('success', 'Company created successfully');
    }

    public function show($id)
    {
        $company = Company::findOrFail($id);
        return view('modules.company.show', compact('company'));
    }

    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('modules.company.edit', compact('company'));
    }

    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        $company->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $request->status ?? 1,
        ]);

        return redirect()->route('company.index')
            ->with('success', 'Company updated successfully');
    }

    public function destroy($id)
    {
        Company::findOrFail($id)->delete();

        return redirect()->route('company.index')
            ->with('success', 'Company deleted successfully');
    }
}