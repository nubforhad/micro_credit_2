<?php

namespace App\Http\Controllers;

use App\Models\LoanPayment;
use Illuminate\Http\Request;
use Carbon\Carbon;


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

    public function dailyCollection(Request $request)
    {
        $date = $request->date ?? Carbon::today()->format('Y-m-d');

        $payments = LoanPayment::with([
            'loan',
            'member',
            'receiver'
        ])
        ->whereDate('payment_date', $date)
        ->latest()
        ->get();

        $totalCollection = $payments->sum('amount');

        return view(
            'modules.report.daily_collection',
            compact(
                'payments',
                'date',
                'totalCollection'
            )
        );
    }


}