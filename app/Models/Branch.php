<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'company_id',
        'name',
        'code',
        'phone',
        'address',
        'status',
        'created_by'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}