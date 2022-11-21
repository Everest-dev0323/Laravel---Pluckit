<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessImage extends Model
{
     protected $fillable = [
        'business_id','business_photo','business_photo_name','business_photo_size'
    ];
}
