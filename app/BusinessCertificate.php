<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessCertificate extends Model
{
    protected $fillable = [
        'business_id','business_photo','business_certificate_name','business_certificate_size'
    ];
}
