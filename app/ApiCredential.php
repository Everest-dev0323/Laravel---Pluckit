<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiCredential extends Model
{
    protected $fillable = [
        'user_id','api_key','api_value'
    ];
}
