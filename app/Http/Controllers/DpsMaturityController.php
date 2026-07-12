<?php

namespace App\Http\Controllers;

use App\Models\DpsAccount;
use App\Models\DpsMaturity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\FundAccount;
use App\Models\FundTransaction;

class DpsMaturityController extends Controller
{
    public function index()
    {

        $accounts = DpsAccount::with([
            'member',
            'plan'
        ])
        ->where('status','completed')
        ->whereDoesntHave('maturity')
        ->latest()
        ->get();


        return view(
            'modules.dps.maturity.index',
            compact('accounts')
        );

    }

    public function create()
    {
        $accounts = DpsAccount::with([
            'member',
            'plan'
        ])
        ->where('status','completed')
        ->whereDoesntHave('maturity')
        ->get();
        return view( 'modules.dps.maturity.create', compact('accounts') );
    }

  public function store(Request $request)
    {
        $request->validate([
            'dps_account_id'=>'required'
        ]);
        DB::transaction(function() use($request){
            $account = DpsAccount::with('plan')->findOrFail($request->dps_account_id); 
            $totalDeposit = $account->installment_amount *  $account->total_installment;
            $profit = ($totalDeposit *  $account->plan->interest_rate)  /100;
            $maturityAmount = $totalDeposit + $profit;
    
            // Create DPS Maturity   
            $maturity = DpsMaturity::create([
                'dps_account_id'=>$account->id,
                'total_deposit'=>$totalDeposit,
                'profit_amount'=>$profit,
                'maturity_amount'=>$maturityAmount,
                'paid_date'=>date('Y-m-d'),
                'status'=>'paid',
            ]); 
            // Fund Account Check    
            $fundAccount = FundAccount::where('is_default',true)
                ->where('status',true)
                ->first();
            if(!$fundAccount)
            {
                throw new \Exception(
                    'Default Fund Account not found.'
                );
            }
            // Check Fund Balance
            if($fundAccount->current_balance < $maturityAmount)
            {
                throw new \Exception(
                    'Insufficient fund balance.'
                );
            } 
            // Reduce Fund Balance
            $newBalance =  $fundAccount->current_balance  - $maturityAmount;
            $fundAccount->current_balance = $newBalance;
            $fundAccount->save(); 
            // Fund Transaction Debit
            FundTransaction::create([
                'fund_account_id'=>$fundAccount->id,
                'transaction_date'=>date('Y-m-d'),
                'type'=>'dps_maturity',
                'dr_cr'=>'debit',
                'amount'=>$maturityAmount,
                'balance_after'=>$newBalance,
                'reference_type'=>'DpsMaturity',
                'reference_id'=>$maturity->id,
                'remarks'=>'DPS maturity payment to member',
                'created_by'=>auth()->id(),
            ]); 
        }); 
        return redirect() ->route('dps-maturities.index') ->with('success', 'DPS Maturity Paid Successfully');

    }


}