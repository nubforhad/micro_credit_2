<?php

namespace App\Http\Controllers;

use App\Models\FundAccount;
use App\Models\FundTransaction;
use App\Models\Loan;
use App\Models\LoanPayment;
use App\Models\Savvings;
use App\Models\DpsAccount;
use App\Models\DpsPayment;
use App\Models\DpsMaturity;
use App\Models\IncomeExpense;
use Illuminate\Http\Request;
use Carbon\Carbon;


class ReportController extends Controller
{


    public function dashboard(Request $request)
    {


        /*
        |--------------------------------------------------------------------------
        | Fund Summary
        |--------------------------------------------------------------------------
        */


        $currentFund = FundAccount::sum('current_balance');


        $totalCredit = FundTransaction::where('dr_cr','credit')
            ->sum('amount');


        $totalDebit = FundTransaction::where('dr_cr','debit')
            ->sum('amount');





        /*
        |--------------------------------------------------------------------------
        | Loan Summary
        |--------------------------------------------------------------------------
        */


        $totalLoanAmount = Loan::sum('amount');


        $totalLoanCollection = LoanPayment::sum('amount');


        $activeLoan = Loan::where('status','running')
            ->count();


        $closedLoan = Loan::where('status','closed')
            ->count();







        /*
        |--------------------------------------------------------------------------
        | Savings Summary
        |--------------------------------------------------------------------------
        */


        $totalSavingDeposit = Savvings::where('type','deposit')
            ->where('status','approved')
            ->sum('amount');



        $totalSavingWithdraw = Savvings::where('type','withdraw')
            ->where('status','approved')
            ->sum('amount');



        $savingBalance =
            $totalSavingDeposit
            -
            $totalSavingWithdraw;









        /*
        |--------------------------------------------------------------------------
        | DPS Summary
        |--------------------------------------------------------------------------
        */


        $activeDps = DpsAccount::where('status','running')
            ->count();



        $completedDps = DpsAccount::where('status','completed')
            ->count();



        $totalDpsCollection = DpsPayment::sum('amount');



        $totalMaturityPaid = DpsMaturity::where('status','paid')
            ->sum('maturity_amount');








        /*
        |--------------------------------------------------------------------------
        | Income Expense
        |--------------------------------------------------------------------------
        */


        $totalIncome = IncomeExpense::where('type','income')
            ->sum('amount');



        $totalExpense = IncomeExpense::where('type','expense')
            ->sum('amount');



        $netProfit =
            $totalIncome
            -
            $totalExpense;








        /*
        |--------------------------------------------------------------------------
        | Monthly Collection Chart Data
        |--------------------------------------------------------------------------
        */


        $monthlyCollection = LoanPayment::selectRaw(
                'MONTH(payment_date) as month,
                 SUM(amount) as total'
            )

            ->whereYear(
                'payment_date',
                date('Y')
            )

            ->groupBy('month')

            ->pluck('total','month');








        return view(
            'reports.dashboard',
            compact(

                'currentFund',

                'totalCredit',

                'totalDebit',


                'totalLoanAmount',

                'totalLoanCollection',

                'activeLoan',

                'closedLoan',


                'totalSavingDeposit',

                'totalSavingWithdraw',

                'savingBalance',


                'activeDps',

                'completedDps',

                'totalDpsCollection',

                'totalMaturityPaid',


                'totalIncome',

                'totalExpense',

                'netProfit',


                'monthlyCollection'

            )
        );



    }


}