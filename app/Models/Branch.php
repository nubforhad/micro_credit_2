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

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }

    public function collectionSheets()
    {
        return $this->hasMany(CollectionSheet::class);
    }
}