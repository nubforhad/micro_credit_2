<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    protected $fillable = [
        'area_id',
        'name',
        'code',
        'meeting_day',
        'meeting_time',
        'address',
        'status',
        'created_by'
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}