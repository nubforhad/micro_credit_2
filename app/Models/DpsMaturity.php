<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DpsMaturity extends Model
{
    use HasFactory;


    protected $fillable = [

        'dps_account_id',
        'total_deposit',
        'profit_amount',
        'maturity_amount',
        'paid_date',
        'status',

    ];


    public function account()
    {
        return $this->belongsTo(DpsAccount::class,'dps_account_id');
    }
}