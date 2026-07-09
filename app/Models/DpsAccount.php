<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DpsAccount extends Model
{
    use HasFactory;


    protected $fillable = [

        'member_id',
        'dps_plan_id',
        'account_no',
        'start_date',
        'maturity_date',
        'installment_amount',
        'total_installment',
        'paid_installment',
        'status',

    ];


    public function member()
    {
        return $this->belongsTo(Member::class);
    }


    public function plan()
    {
        return $this->belongsTo(DpsPlan::class,'dps_plan_id');
    }


    public function payments()
    {
        return $this->hasMany(DpsPayment::class);
    }


    public function maturity()
    {
        return $this->hasOne(DpsMaturity::class);
    }
}