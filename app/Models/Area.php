<?php

 namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
        'branch_id',
        'name',
        'code',
        'note',
        'status',
        'created_by'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}