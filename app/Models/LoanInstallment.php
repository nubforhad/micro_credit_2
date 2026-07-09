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

    public function payments()
    {
        return $this->hasMany(LoanPayment::class);
    }

    public function collections()
    {
        return $this->hasMany(Collection::class, 'installment_id');
    }

    public function collectionDetails()
    {
        return $this->hasMany(CollectionDetail::class, 'installment_id');
    }


}