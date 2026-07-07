<?php

namespace App\Http\Controllers;

use App\Models\LoanPayment;
use Illuminate\Http\Request;

class LoanPaymentController extends Controller
{
    public function index(Request $request)
    {
        //dd('hi');
        $query = LoanPayment::with([
            'loan',
            'member',
            'installment',
            'receiver'
        ]);

        // Search
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('receipt_no', 'like', "%{$search}%")
                    ->orWhereHas('loan', function ($loan) use ($search) {

                        $loan->where('loan_no', 'like', "%{$search}%");

                    })
                    ->orWhereHas('member', function ($member) use ($search) {

                        $member->where('member_no', 'like', "%{$search}%")
                               ->orWhere('name', 'like', "%{$search}%");

                    });

            });

        }

        $payments = $query->latest()->paginate(15);

        return view('modules.payment.index', compact('payments'));
    }

    public function show($id)
    {
        $payment = LoanPayment::with([
            'loan',
            'member',
            'installment',
            'receiver'
        ])->findOrFail($id);

        return view('modules.payment.show', compact('payment'));
    }

    public function print($id)
{
    $payment = LoanPayment::with([
        'loan',
        'member',
        'installment',
        'receiver'
    ])->findOrFail($id);

    return view('modules.payment.print', compact('payment'));
}


}