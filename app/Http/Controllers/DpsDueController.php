<?php

namespace App\Http\Controllers;

use App\Models\DpsAccount;
use Illuminate\Http\Request;
use Carbon\Carbon;


class DpsDueController extends Controller
{


    public function index()
    {


        $accounts = DpsAccount::with([
            'member',
            'plan'
        ])
        ->where('status','running')
        ->get();



        foreach($accounts as $account)
        {


            $paid =
            $account->paid_installment;



            $total =
            $account->total_installment;



            $account->due_installment =
            $total - $paid;



            $account->due_amount =
            $account->due_installment *
            $account->installment_amount;



        }



        return view(
            'modules.dps.due.index',
            compact('accounts')
        );

    }


}