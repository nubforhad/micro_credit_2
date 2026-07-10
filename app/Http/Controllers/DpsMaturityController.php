<?php

namespace App\Http\Controllers;

use App\Models\DpsAccount;
use App\Models\DpsMaturity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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


        return view(
            'modules.dps.maturity.create',
            compact('accounts')
        );

    }





    public function store(Request $request)
    {


        $request->validate([

            'dps_account_id'=>'required'

        ]);



        DB::transaction(function() use($request){


            $account = DpsAccount::with('plan')
            ->findOrFail(
                $request->dps_account_id
            );



            $totalDeposit =
            $account->installment_amount *
            $account->total_installment;



            $profit =
            ($totalDeposit *
            $account->plan->interest_rate)
            /100;



            $maturityAmount =
            $totalDeposit + $profit;




            DpsMaturity::create([

                'dps_account_id'=>$account->id,

                'total_deposit'=>$totalDeposit,

                'profit_amount'=>$profit,

                'maturity_amount'=>$maturityAmount,

                'paid_date'=>date('Y-m-d'),

                'status'=>'paid',

            ]);



        });



        return redirect()

        ->route('dps-maturities.index')

        ->with(
            'success',
            'DPS Maturity Paid Successfully'
        );


    }


}