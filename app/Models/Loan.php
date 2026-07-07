<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = [
        'member_id',
        'loan_product_id',
        'loan_no',
        'amount',
        'total_payable',
        'status',
        'start_date',
        'note',
        'created_by',
    ];

    
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    
    public function loanProduct()
    {
        return $this->belongsTo(LoanProduct::class);
    }

    
    public function installments()
    {
        return $this->hasMany(LoanInstallment::class);
    }
    public function payments()
    {
        return $this->hasMany(LoanPayment::class);
    }



}