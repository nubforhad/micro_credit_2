<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'center_id',
        'member_no',
        'name',
        'father_name',
        'mother_name',
        'birth_date',
        'nid',
        'phone',
        'address',
        'photo',
        'nominee_name',
        'nominee_relation',
        'nominee_phone',
        'status',
        'created_by'
    ];

    public function center()
    {
        return $this->belongsTo(Center::class);
    }
}