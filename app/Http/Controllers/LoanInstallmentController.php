<?php

namespace App\Http\Controllers;

use App\Models\LoanInstallment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LoanInstallmentController extends Controller
{
    /**
     * Installment List
     */
    // public function index()
    // {
    //     $installments = LoanInstallment::with('loan.member')
    //         ->latest()
    //         ->paginate(20);

    //     return view('modules.installment.index', compact('installments'));
    // }

    public function index(Request $request)
{
    $query = LoanInstallment::with(['loan.member']);

    if ($request->search) {

        $query->whereHas('loan', function ($q) use ($request) {
            $q->where('loan_no', 'like', '%' . $request->search . '%')
              ->orWhereHas('member', function ($q2) use ($request) {
                  $q2->where('member_no', 'like', '%' . $request->search . '%')
                     ->orWhere('name', 'like', '%' . $request->search . '%');
              });
        });

    }

    $installments = $query->paginate(20);

    return view('modules.installment.index', compact('installments'));
}

    /**
     * Payment Page (optional simple view)
     */
    public function show($id)
    {
        $installment = LoanInstallment::with('loan')->findOrFail($id);

        return view('modules.installment.show', compact('installment'));
    }

    /**
     * Payment Receive (MAIN LOGIC)
     */
    public function pay(Request $request, $id)
    {
        $installment = LoanInstallment::findOrFail($id);

        $request->validate([
            'paid_amount' => 'required|numeric|min:0',
        ]);

        $payAmount = $request->paid_amount;

        // Add payment
        $installment->paid_amount += $payAmount;

        // Payment date set
        $installment->payment_date = Carbon::now();

        // Status update logic
        if ($installment->paid_amount >= $installment->amount) {
            $installment->paid_amount = $installment->amount;
            $installment->status = 'paid';
        } elseif ($installment->paid_amount > 0) {
            $installment->status = 'partial';
        } else {
            $installment->status = 'unpaid';
        }

        $installment->save();

        return back()->with('success', 'Payment received successfully');
    }

    /**
     * Delete installment (optional admin use)
     */
    public function destroy($id)
    {
        $installment = LoanInstallment::findOrFail($id);
        $installment->delete();

        return back()->with('success', 'Installment deleted successfully');
    }

    public function searchPage()
{
    return view('modules.installment.search');
}

public function searchResult(Request $request)
{
    $query = LoanInstallment::with(['loan.member']);

    if ($request->search) {

        $query->whereHas('loan', function ($q) use ($request) {
            $q->where('loan_no', 'like', '%' . $request->search . '%')
              ->orWhereHas('member', function ($q2) use ($request) {
                  $q2->where('member_no', 'like', '%' . $request->search . '%');
              });
        });
    }

    $installments = $query->paginate(20);

    return view('modules.installment.search', compact('installments'));
}


}