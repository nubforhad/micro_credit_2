<?php

namespace App\Http\Controllers;

use App\Models\DpsAccount;
use App\Models\DpsPayment;
use App\Models\DpsMaturity;
use Illuminate\Http\Request;

class DpsReportController extends Controller
{
    public function index(Request $request)
    {
        $query = DpsAccount::with([
            'member',
            'plan',
            'payments'
        ]);

        // Search by Account Number
        if ($request->filled('account_no')) {
            $query->where('account_no', $request->account_no);
        }

        // Filter by Start Date
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('start_date', [
                $request->from_date,
                $request->to_date
            ]);
        }

        $accounts = $query->get();

        // Single Account (Statement)
        $account = null;

        if ($request->filled('account_no')) {
            $account = $accounts->first();
        }

        $totalCollection = DpsPayment::sum('amount');
        $totalMaturity   = DpsMaturity::sum('maturity_amount');

        return view('modules.dps.reports.index', compact(
            'accounts',
            'account',
            'totalCollection',
            'totalMaturity'
        ));
    }
}