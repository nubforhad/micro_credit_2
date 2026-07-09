<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DpsPlan extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'duration_month',
        'installment_amount',
        'interest_rate',
        'status',
    ];


    public function accounts()
    {
        return $this->hasMany(DpsAccount::class);
    }
}