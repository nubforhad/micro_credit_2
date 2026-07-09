<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DpsPayment extends Model
{
    use HasFactory;


    protected $fillable = [

        'dps_account_id',
        'member_id',
        'installment_no',
        'amount',
        'payment_method',
        'payment_date',
        'note',

    ];


    public function account()
    {
        return $this->belongsTo(DpsAccount::class,'dps_account_id');
    }


    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}