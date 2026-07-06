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

    /**
     * Loan belongs to a Member
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    /**
     * Loan belongs to a Loan Product
     */
    public function loanProduct()
    {
        return $this->belongsTo(LoanProduct::class);
    }

    /**
     * Loan has many Installments
     */
    public function installments()
    {
        return $this->hasMany(LoanInstallment::class);
    }
}