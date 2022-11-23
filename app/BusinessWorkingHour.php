<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessWorkingHour extends Model
{
    //
    protected $fillable = [
        'working_week','open_time','close_time','business_id'
    ];
}
