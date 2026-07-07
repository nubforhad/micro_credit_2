<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Savvings extends Model
{



protected $fillable = [

    'member_id',

    'receipt_no',

    'type',

    'status',

    'amount',

    'payment_method',

    'date',

    'approved_date',

    'approved_by',

    'note',

    'created_by'

];



public function member()
{

    return $this->belongsTo(
        Member::class
    );

}



public function creator()
{

    return $this->belongsTo(
        User::class,
        'created_by'
    );

}


}