<?php

namespace App\Http\Controllers;

use App\Models\FundTransaction;
use App\Models\FundAccount;
use Illuminate\Http\Request;


class CashBookController extends Controller
{


    public function index(Request $request)
    { 
        $date = $request->date ?? date('Y-m-d'); 
        $transactions = FundTransaction::with('fundAccount')

            ->whereDate(
                'transaction_date',
                $date
            )

            ->orderBy('id','asc')

            ->get(); 

        // Opening Balance

        $openingBalance = FundTransaction::whereDate(
                'transaction_date',
                '<',
                $date
            )

            ->latest('id')

            ->value('balance_after') ?? 0; 

        $credit = $transactions

            ->where('dr_cr','credit')

            ->sum('amount'); 
        $debit = $transactions

            ->where('dr_cr','debit')

            ->sum('amount'); 

        $closingBalance = 
            $openingBalance 
            +
            $credit 
            -
            $debit;
 
        return view(
            'cash_book.index',
            compact(
                'transactions',
                'date',
                'openingBalance',
                'credit',
                'debit',
                'closingBalance'
            )
        );


    }


}