<?php

namespace App\Http\Controllers;

use App\Models\DpsPayment;
use App\Models\DpsAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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



            DpsPayment::create([


                'dps_account_id'=>$account->id,


                'member_id'=>$account->member_id,


                'installment_no'=>$installmentNo,


                'amount'=>$request->amount,


                'payment_method'=>$request->payment_method,


                'payment_date'=>$request->payment_date,


                'note'=>$request->note,


            ]);




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



        });




        return redirect()

        ->route('dps-payments.index')

        ->with(
            'success',
            'DPS Installment Collected Successfully'
        );


    }





}