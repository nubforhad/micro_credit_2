<?php

namespace App\Http\Controllers;

use App\Models\DpsPayment;
use App\Models\DpsAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\FundAccount;
use App\Models\FundTransaction;

class DpsPaymentController extends Controller
{ 
    public function index()
    {

        $payments = DpsPayment::with([
            'account.member'
        ])
        ->latest()
        ->get();


        return view(
            'modules.dps.payments.index',
            compact('payments')
        );

    } 
    public function create()
    {

        $accounts = DpsAccount::with('member','plan')
        ->where('status','running')
        ->get();



        return view(
            'modules.dps.payments.create',
            compact('accounts')
        );

    }
 
    public function store(Request $request)
{

    $request->validate([

        'dps_account_id'=>'required',

        'amount'=>'required|numeric',

        'payment_date'=>'required',

    ]);




    DB::transaction(function() use($request){



        $account = DpsAccount::findOrFail(
            $request->dps_account_id
        );



        $installmentNo =
            $account->paid_installment + 1;





        /*
        |--------------------------------------------------------------------------
        | Create DPS Payment
        |--------------------------------------------------------------------------
        */


        $payment = DpsPayment::create([


            'dps_account_id'=>$account->id,


            'member_id'=>$account->member_id,


            'installment_no'=>$installmentNo,


            'amount'=>$request->amount,


            'payment_method'=>$request->payment_method,


            'payment_date'=>$request->payment_date,


            'note'=>$request->note,


        ]);






        /*
        |--------------------------------------------------------------------------
        | Update DPS Account
        |--------------------------------------------------------------------------
        */


        $account->increment(
            'paid_installment'
        );




        if(
            $account->paid_installment >= 
            $account->total_installment
        )
        {


            $account->update([

                'status'=>'completed'

            ]);


        }






        /*
        |--------------------------------------------------------------------------
        | Fund Integration
        |--------------------------------------------------------------------------
        */


        $fundAccount = FundAccount::where('is_default',true)
            ->where('status',true)
            ->first();




        if(!$fundAccount)
        {

            throw new \Exception(
                'Default Fund Account not found.'
            );

        }




        // Increase Fund Balance


        $newBalance = 
            $fundAccount->current_balance 
            + $request->amount;




        $fundAccount->current_balance = $newBalance;


        $fundAccount->save();







        /*
        |--------------------------------------------------------------------------
        | Fund Transaction Entry
        |--------------------------------------------------------------------------
        */


        FundTransaction::create([


            'fund_account_id'=>$fundAccount->id,


            'transaction_date'=>$request->payment_date,


            'type'=>'dps_deposit',


            'dr_cr'=>'credit',


            'amount'=>$request->amount,


            'balance_after'=>$newBalance,


            'reference_type'=>'DpsPayment',


            'reference_id'=>$payment->id,


            'remarks'=>'DPS installment collection',


            'created_by'=>auth()->id(),


        ]);




    });





    return redirect()

        ->route('dps-payments.index')

        ->with(
            'success',
            'DPS Installment Collected Successfully'
        );


}
 
}