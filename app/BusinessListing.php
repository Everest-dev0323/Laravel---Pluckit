<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessListing extends Model
{
    //
    protected $fillable = [
        'business_name','user_id','user_type',
        'business_list_type','business_list_id','business_slug'
        ,'business_image','business_review_count','business_rating',
        'business_lattitude','business_longitude','business_address_1',
        'business_address_2','business_address_3','business_city','business_state',
        'business_country','business_phone','business_zipcode','business_abn','business_website_url',
		'business_about','business_services','business_default_hours','business_working_hours','show_on_home','business_review_url'
    ];

    public function review() { 
        return $this->belongsTo(BusinessListReview::class,'id','business_id'); 
    }
    public function cat() { 

        return $this->hasMany('App\BusinessListingCategory', 'business_id', 'id'); 
    }
	public function image() { 

        return $this->hasMany('App\BusinessImage', 'business_id', 'id'); 
    }
	public function certificate(){

        return $this->hasMany('App\BusinessCertificate', 'business_id', 'id'); 
    }
	public function listingCat() { 
        return $this->belongsTo(BusinessListingCategory::class,'id','business_id'); 
    }
}
