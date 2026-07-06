<?php

namespace App\Http\Controllers;

use App\Models\LoanProduct;
use Illuminate\Http\Request;

class LoanProductController extends Controller
{
    public function index()
    {
        $products = LoanProduct::latest()->paginate(10);

        return view('modules.loan_product.index', compact('products'));
    }

    public function create()
    {
        return view('modules.loan_product.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|max:255',
            'code'          => 'required|unique:loan_products,code',
            'interest_rate' => 'required|numeric',
            'duration'      => 'required|integer|min:1',
            'min_amount'    => 'required|numeric',
            'max_amount'    => 'required|numeric|gte:min_amount',
        ]);

        LoanProduct::create([
            'name'              => $request->name,
            'code'              => strtoupper($request->code),
            'interest_rate'     => $request->interest_rate,
            'interest_type'     => $request->interest_type,
            'installment_type'  => $request->installment_type,
            'duration'          => $request->duration,
            'processing_fee'    => $request->processing_fee ?? 0,
            'insurance_fee'     => $request->insurance_fee ?? 0,
            'late_fee'          => $request->late_fee ?? 0,
            'min_amount'        => $request->min_amount,
            'max_amount'        => $request->max_amount,
            'status' => $request->status ?? 1,
            'description'       => $request->description,
            'created_by'        => auth()->id(),
        ]);

        return redirect()->route('loan-product.index')
            ->with('success', 'Loan Product Created Successfully');
    }

    public function show(LoanProduct $loan_product)
    {
        return view('modules.loan_product.show', compact('loan_product'));
    }

    public function edit(LoanProduct $loan_product)
    {
        return view('modules.loan_product.edit', compact('loan_product'));
    }

    public function update(Request $request, LoanProduct $loan_product)
    {
        $request->validate([
            'name'          => 'required|max:255',
            'code'          => 'required|unique:loan_products,code,' . $loan_product->id,
            'interest_rate' => 'required|numeric',
            'duration'      => 'required|integer|min:1',
            'min_amount'    => 'required|numeric',
            'max_amount'    => 'required|numeric|gte:min_amount',
        ]);

        $loan_product->update([
            'name'              => $request->name,
            'code'              => strtoupper($request->code),
            'interest_rate'     => $request->interest_rate,
            'interest_type'     => $request->interest_type,
            'installment_type'  => $request->installment_type,
            'duration'          => $request->duration,
            'processing_fee'    => $request->processing_fee ?? 0,
            'insurance_fee'     => $request->insurance_fee ?? 0,
            'late_fee'          => $request->late_fee ?? 0,
            'min_amount'        => $request->min_amount,
            'max_amount'        => $request->max_amount,
            'status'            => $request->status,
            'description'       => $request->description,
        ]);

        return redirect()->route('loan-product.index')
            ->with('success', 'Loan Product Updated Successfully');
    }

    public function destroy(LoanProduct $loan_product)
    {
        $loan_product->delete();

        return redirect()->route('loan-product.index')
            ->with('success', 'Loan Product Deleted Successfully');
    }
}