<?php

 namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanInstallment extends Model
{
    protected $fillable=[
        'loan_id',
        'installment_no',
        'due_date',
        'amount',
        'paid_amount',
        'status',
        'payment_date'
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}