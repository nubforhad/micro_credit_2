<?php

namespace App\Http\Controllers;

use App\Models\LoanPayment;
use App\Models\Savvings;
use App\Models\DpsPayment;
use App\Models\User;
use Illuminate\Http\Request;


class DailyCollectionController extends Controller
{ 
    public function index(Request $request)
    { 
        $date = $request->date ?? date('Y-m-d'); 
        /*
        |--------------------------------------------------------------------------
        | Loan Collection
        |--------------------------------------------------------------------------
        */

        $loanCollections = LoanPayment::with([
            'member',
            'receiver'
        ])

        ->whereDate(
            'payment_date',
            $date
        )

        ->get(); 
        /*
        |--------------------------------------------------------------------------
        | Savings Collection
        |--------------------------------------------------------------------------
        */

        $savingCollections = Savvings::with([
            'member',
            'creator'
        ])

        ->where('type','deposit')

        ->where('status','approved')

        ->whereDate(
            'date',
            $date
        )

        ->get(); 
        /*
        |--------------------------------------------------------------------------
        | DPS Collection
        |--------------------------------------------------------------------------
        */

        $dpsCollections = DpsPayment::with([
            'member'
        ])

        ->whereDate(
            'payment_date',
            $date
        )

        ->get(); 
        $loanTotal = $loanCollections->sum('amount');


        $savingTotal = $savingCollections->sum('amount');


        $dpsTotal = $dpsCollections->sum('amount');



        $grandTotal = 
            $loanTotal
            +
            $savingTotal
            +
            $dpsTotal;
        return view(  'daily_collection.index',  compact(
                'date',
                'loanCollections',
                'savingCollections',
                'dpsCollections',
                'loanTotal',
                'savingTotal',
                'dpsTotal',
                'grandTotal'
            )
        );


    }


}