<?php

namespace App\Http\Controllers;


use App\Models\Loan;
use App\Models\LoanInstallment;
use App\Models\Member;
use App\Models\Savvings;
use App\Models\DpsAccount;
use App\Models\DpsPayment;
use Carbon\Carbon;



class DashboardController extends Controller
{


    public function index()
    {


        // Members

        $totalMember = Member::count();



        // Loan

        $totalLoan = Loan::count();


        $runningLoan = Loan::where(
            'status',
            'running'
        )->count();



        $totalLoanAmount = Loan::sum('amount');





        // Collection

        $totalCollection = LoanInstallment::sum(
            'paid_amount'
        );



        $todayCollection = LoanInstallment::whereDate(
            'updated_at',
            Carbon::today()
        )
        ->sum('paid_amount');





        // Due

        $todayDue = LoanInstallment::whereDate(
            'due_date',
            Carbon::today()
        )
        ->where('status','!=','paid')
        ->count();





        // Overdue

        $overdue = LoanInstallment::where(
            'due_date',
            '<',
            Carbon::today()
        )
        ->where('status','!=','paid')
        ->count();







        // Savings


        $savingAmount = Savvings::where(
            'type',
            'deposit'
        )
        ->sum('amount');







        // DPS


        $totalDps = DpsAccount::count();



        $dpsCollection = DpsPayment::sum(
            'amount'
        );








        // Recent Loan


        $recentLoans = Loan::with('member')
        ->latest()
        ->limit(5)
        ->get();





        return view(
            'dashboard.index',
            compact(

                'totalMember',

                'totalLoan',

                'runningLoan',

                'totalLoanAmount',

                'totalCollection',

                'todayCollection',

                'todayDue',

                'overdue',

                'savingAmount',

                'totalDps',

                'dpsCollection',

                'recentLoans'

            )
        );


    }



}