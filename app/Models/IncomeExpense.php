<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeExpense extends Model
{
    use HasFactory;


    protected $fillable = [

        'type',
        'category',
        'amount',
        'date',
        'payment_method',
        'note',
        'created_by'

    ];



    protected $casts = [

        'date'=>'date',
        'amount'=>'decimal:2'

    ];



    public function creator()
    {
        return $this->belongsTo(
            User::class,
            'created_by'
        );
    }

}