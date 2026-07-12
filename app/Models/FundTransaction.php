<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundTransaction extends Model
{
    use HasFactory;


    protected $fillable = [

        'fund_account_id',

        'transaction_date',

        'type',

        'dr_cr',

        'amount',

        'balance_after',

        'reference_type',

        'reference_id',

        'remarks',

        'created_by',

    ];


    protected $casts = [

        'transaction_date' => 'date',

        'amount' => 'decimal:2',

        'balance_after' => 'decimal:2',

    ];
 

    /**
     * Fund Account Relation
     */
    public function fundAccount()
    {
        return $this->belongsTo(FundAccount::class);
    }



    /**
     * Created User Relation
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }



    /**
     * Get Reference Model Dynamically
     * Loan / Savings / DPS etc.
     */
    public function reference()
    {
        return $this->morphTo();
    }

}