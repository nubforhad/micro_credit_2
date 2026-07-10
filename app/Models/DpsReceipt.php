<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class DpsReceipt extends Model
{

    use HasFactory;


    protected $fillable = [

        'dps_payment_id',

        'receipt_no',

        'collector_id',

    ];



    public function payment()
    {
        return $this->belongsTo(
            DpsPayment::class,
            'dps_payment_id'
        );
    }



    public function collector()
    {
        return $this->belongsTo(
            User::class,
            'collector_id'
        );
    }


}