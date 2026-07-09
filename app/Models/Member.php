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

    public function loanPayments()
    {
        return $this->hasMany(LoanPayment::class);
    }
     public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function savvings()
    {
        return $this->hasMany( Savvings::class);
    }

    public function savings()
    {
        return $this->hasMany(Saving::class);
    }

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }

    public function collectionDetails()
    {
        return $this->hasMany(CollectionDetail::class);
    }


}