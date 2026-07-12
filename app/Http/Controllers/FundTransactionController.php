<?php

namespace App\Http\Controllers;

use App\Models\FundTransaction;
use App\Models\FundAccount;
use Illuminate\Http\Request;

class FundTransactionController extends Controller
{

    /**
     * Fund Ledger
     */
    public function index(Request $request)
    {
        $query = FundTransaction::with([
            'fundAccount',
            'creator'
        ]);
        // Date Filter
        if($request->from_date && $request->to_date)
        {
            $query->whereBetween(
                'transaction_date',
                [
                    $request->from_date,
                    $request->to_date
                ]
            );
        }
        // Type Filter
        if($request->type)
        {
            $query->where(
                'type',
                $request->type
            );
        }
        $transactions = $query
            ->latest('transaction_date')
            ->paginate(20);
        $totalCredit = FundTransaction::where('dr_cr','credit')->sum('amount');
        $totalDebit = FundTransaction::where('dr_cr','debit') ->sum('amount');
        return view( 'fund_transactions.index', compact('transactions', 'totalCredit', 'totalDebit' )
        );
    }



    /**
     * Create Transaction
     */
    public function create()
    {
        $fundAccounts = FundAccount::where('status',true)
            ->get();
        return view( 'fund_transactions.create',  compact('fundAccounts') );
    }
    /**
     * Store Transaction
     */
    public function store(Request $request)
    {
        $request->validate([
            'fund_account_id'=>'required',
            'transaction_date'=>'required|date',
            'type'=>'required',
            'dr_cr'=>'required',
            'amount'=>'required|numeric',
        ]);
        $fund = FundAccount::findOrFail(
            $request->fund_account_id
        );
        if($request->dr_cr == 'credit')
        {
            $balance =  $fund->current_balance  + $request->amount;
        }
        else
        {
            $balance =  $fund->current_balance   -  $request->amount;
        }
        FundTransaction::create([
            'fund_account_id'=>$request->fund_account_id,
            'transaction_date'=>$request->transaction_date,
            'type'=>$request->type,
            'dr_cr'=>$request->dr_cr,
            'amount'=>$request->amount,
            'balance_after'=>$balance,
            'remarks'=>$request->remarks,
            'created_by'=>auth()->id(),
        ]);
        $fund->update([
            'current_balance'=>$balance
        ]);
        return redirect()->route('fund.ledger')->with('success','Fund Transaction Added Successfully');
    }


 public function ledger(Request $request)
{
    $query = FundTransaction::with('fundAccount')->latest('transaction_date');
    // Date Filter
    if ($request->filled('from_date') && $request->filled('to_date')) {
        $query->whereBetween('transaction_date', [
            $request->from_date,
            $request->to_date
        ]);
    }
    // Transaction Type Filter
    if ($request->filled('type')) {
        $query->where('type', $request->type);
    }
    // Fund Account Filter
    if ($request->filled('fund_account_id')) {
        $query->where('fund_account_id', $request->fund_account_id);
    }
    $transactions = $query->paginate(20);
    $fundAccounts = FundAccount::all();
    // Summary Cards
    $currentBalance = FundAccount::sum('current_balance');
    $todayCredit = FundTransaction::whereDate('transaction_date', today())->where('dr_cr', 'credit')->sum('amount');
    $todayDebit = FundTransaction::whereDate('transaction_date', today())->where('dr_cr', 'debit')->sum('amount');
    return view( 'fund_transactions.ledger', compact( 'transactions', 'fundAccounts', 'currentBalance',  'todayCredit', 'todayDebit' )
    );
}




}