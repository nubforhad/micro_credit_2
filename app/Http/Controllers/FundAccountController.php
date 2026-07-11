<?php

namespace App\Http\Controllers;

use App\Models\FundAccount;
use Illuminate\Http\Request;

class FundAccountController extends Controller
{

    public function index()
    {
        $funds = FundAccount::latest()->get();
        return view('fund_accounts.index', compact('funds'));
    }

    public function create()
    {
        return view('fund_accounts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'opening_balance' => 'required|numeric|min:0',
            'type' => 'required',
        ]);


        FundAccount::create([
            'name' => $request->name,
            'opening_balance' => $request->opening_balance,
            'current_balance' => $request->opening_balance,
            'type' => $request->type,
            'is_default' => $request->is_default ?? false,
            'status' => true,
            'remarks' => $request->remarks,
        ]);
        return redirect()
            ->route('fund-accounts.index')
            ->with('success','Fund Account Created Successfully');
    }

    public function show(FundAccount $fundAccount)
    {
        return view('fund_accounts.show', compact('fundAccount'));
    }

    public function edit(FundAccount $fundAccount)
    {
        return view('fund_accounts.edit', compact('fundAccount'));
    }

    public function update(Request $request, FundAccount $fundAccount)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required',
        ]);
        $fundAccount->update([
            'name'=>$request->name,
            'type'=>$request->type,
            'status'=>$request->status ?? true,
            'remarks'=>$request->remarks,
        ]);
        return redirect()
            ->route('fund-accounts.index')
            ->with('success','Fund Account Updated Successfully');

    }

    public function destroy(FundAccount $fundAccount)
    {
        $fundAccount->delete();
        return redirect()
            ->route('fund-accounts.index')
            ->with('success','Fund Account Deleted Successfully');
    }
}