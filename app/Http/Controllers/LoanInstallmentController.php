<?php

namespace App\Http\Controllers;

use App\Models\LoanInstallment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Loan;
use App\Models\LoanPayment;
use Illuminate\Support\Facades\DB;


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
    $request->validate([
        'paid_amount' => 'required|numeric|min:0.01',
        'payment_method' => 'nullable|string',
    ]);

    DB::beginTransaction();

    try {

        $installment = LoanInstallment::with('loan')->findOrFail($id);

        $payAmount = $request->paid_amount;

        // Remaining amount
        $remaining = $installment->amount - $installment->paid_amount;

        if ($payAmount > $remaining) {
            return back()->with('error', 'Payment amount cannot be greater than remaining amount.');
        }

        /*
        |------------------------------------------
        | Update Installment
        |------------------------------------------
        */

        $installment->paid_amount += $payAmount;

        $installment->payment_date = Carbon::now();

        if ($installment->paid_amount >= $installment->amount) {

            $installment->paid_amount = $installment->amount;
            $installment->status = 'paid';

        } elseif ($installment->paid_amount > 0) {

            $installment->status = 'partial';

        } else {

            $installment->status = 'unpaid';

        }

        $installment->save();

        /*
        |------------------------------------------
        | Save Payment History
        |------------------------------------------
        */
 
        LoanPayment::create([

            'loan_id' => $installment->loan_id,

            'loan_installment_id' => $installment->id,

            'member_id' => $installment->loan->member_id,

            'receipt_no' => 'RC-' . now()->format('YmdHis') . rand(100,999),

            'payment_date' => now(),

            'amount' => $payAmount,

            'payment_method' => $request->payment_method ?? 'Cash',

            'received_by' => auth()->id(),

        ]);

        /*
        |------------------------------------------
        | Auto Close Loan
        |------------------------------------------
        */

        $loan = Loan::with('installments')->find($installment->loan_id);

        if (
            $loan->installments()
                ->where('status', '!=', 'paid')
                ->count() == 0
        ) {

            $loan->status = 'closed';
            $loan->save();
        }

        DB::commit();

        return back()->with('success', 'Payment received successfully.');

    } catch (\Exception $e) {

        DB::rollBack();

        return back()->with('error', $e->getMessage());
    }
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

    public function overdue(Request $request)
    {
        $query = LoanInstallment::with(['loan.member'])
            ->where('due_date', '<', Carbon::today())
            ->where('status', '!=', 'paid');

        // optional search
        if ($request->search) {
            $query->whereHas('loan', function ($q) use ($request) {
                $q->where('loan_no', 'like', '%' . $request->search . '%')
                ->orWhereHas('member', function ($q2) use ($request) {
                    $q2->where('member_no', 'like', '%' . $request->search . '%')
                        ->orWhere('name', 'like', '%' . $request->search . '%');
                });
            });
        }

        $overdues = $query->orderBy('due_date', 'asc')->paginate(20);

        return view('modules.installment.overdue', compact('overdues'));
    }


}