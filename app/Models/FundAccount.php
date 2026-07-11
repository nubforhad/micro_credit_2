<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'opening_balance',
        'current_balance',
        'type',
        'is_default',
        'status',
        'remarks',
    ];

    protected $casts = [
        'opening_balance' => 'decimal:2',
        'current_balance' => 'decimal:2',
        'is_default'      => 'boolean',
        'status'          => 'boolean',
    ];

    public function transactions()
    {
        return $this->hasMany(FundTransaction::class);
    }
}