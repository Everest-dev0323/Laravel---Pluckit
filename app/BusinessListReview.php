<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessListReview extends Model
{
    //
    protected $fillable = [
        'business_id','user_id','user_name','user_email_id','user_mobile_no','user_image','rating','review_text','review_time_created','status','review_type'
     ];

     public function businessListCat(){
        return $this->belongsTo(BusinessListingCategory::Class,'business_id','business_id');
    }
    public function businessList(){
        return $this->belongsTo(BusinessListing::Class,'business_id','id');
    }
}
