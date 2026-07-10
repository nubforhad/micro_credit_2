<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DpsReceipt;
use App\Models\DpsPayment;

class DpsReceiptController extends Controller
{
    public function show($id)
{
    $payment = DpsPayment::with([
        'account.member',
        'account.plan'
    ])
    ->findOrFail($id);


    $receipt = DpsReceipt::firstOrCreate(

        [
            'dps_payment_id'=>$payment->id
        ],

        [
            'receipt_no'=>'DPS-RCP-'
            .date('Y')
            .'-'
            .rand(10000,99999),

            'collector_id'=>auth()->id()
        ]

    );


    return view(
        'modules.dps.receipts.show',
        compact(
            'payment',
            'receipt'
        )
    );
}
}
