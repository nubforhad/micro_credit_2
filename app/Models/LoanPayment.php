<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanPayment extends Model
{
    protected $fillable = [

        'loan_id',

        'loan_installment_id',

        'member_id',

        'receipt_no',

        'payment_date',

        'amount',

        'payment_method',

        'note',

        'received_by'

    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    public function installment()
    {
        return $this->belongsTo(LoanInstallment::class,'loan_installment_id');
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function receiver()
    {
        return $this->belongsTo(User::class,'received_by');
    }
}