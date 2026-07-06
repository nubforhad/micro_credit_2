<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanProduct extends Model
{
    protected $fillable = [

        'name',
        'code',

        'interest_rate',

        'interest_type',

        'installment_type',

        'duration',

        'processing_fee',

        'insurance_fee',

        'late_fee',

        'min_amount',

        'max_amount',

        'status',

        'description',

        'created_by'

    ];

    public function loans()
{
    return $this->hasMany(Loan::class);
}


}