<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\LoanInstallment;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalLoan = Loan::count();

        $activeLoan = Loan::where('status', 'running')->count();

        $totalCollection = LoanInstallment::sum('paid_amount');

        $dueToday = LoanInstallment::whereDate('due_date', Carbon::today())->count();

        $overdue = LoanInstallment::where('due_date', '<', Carbon::today())
                    ->where('status', '!=', 'paid')
                    ->count();
        $overdueCount = LoanInstallment::where('due_date', '<', now())
                    ->where('status', '!=', 'paid')
                    ->count();

        $totalLoanAmount = Loan::sum('amount');

        return view('dashboard.index', compact(
            'totalLoan',
            'activeLoan',
            'totalCollection',
            'dueToday',
            'overdue',
            'totalLoanAmount',
            'overdueCount'
        ));
    }
}