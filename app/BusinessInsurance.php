<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessInsurance extends Model
{
    protected $fillable = [
        'business_id','business_insurance','business_insurance_name','business_insurance_size'
    ];
}
