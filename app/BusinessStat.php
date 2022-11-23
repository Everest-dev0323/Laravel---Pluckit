<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessStat extends Model
{
    protected $fillable = [
        'business','added_date'
    ];

    public function businessData(){
        return $this->belongsTo(BusinessListing::class, 'business');
    }
}
