<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessListingCategory extends Model
{
    //
    protected $fillable = [
        'business_id','business_category_alias','business_category_slug','business_map_cat_id'
    ];
	public function catgory(){
        return $this->belongsTo(Category::class, 'business_category_slug', 'slug');
    }
}
