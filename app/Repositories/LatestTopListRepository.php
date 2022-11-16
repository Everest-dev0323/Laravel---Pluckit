<?php

namespace App\Repositories;


use App\BusinessListReview;
use App\BusinessListing;
use DB;
use Illuminate\Database\Eloquent\Builder;
use App\LatestTopCategory;
use App\LatestTopList;


class LatestTopListRepository extends BaseRepository
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return LatestTopList::class;
    }

    /**
     * Create new event
     * @return stdobj of events 
    */
    private function getlatesTopcat($type){
        $topcat = LatestTopCategory::where('type',$type)->get();
        $top = array();
        foreach($topcat as $arr){
            $top[]=$arr->sub_cat_name;
        }
        return $top;
    }
    public function createLatestRec(){
       
        $top = $this->getlatesTopcat(2);
        LatestTopList::where('type',1)->delete();
        $latestReview = BusinessListReview::with(['businessListCat','businessList'])
        ->where('rating','>','4')
            ->whereIn('business_id', function ($query) use ($top) {
                $query->select('business_id')->from('business_listing_categories')->whereIn('business_category_alias', $top)->where('business_listing_categories.business_category_alias','!=','virtualsub');
            })
            ->whereHas('businessList', function ($query) {
                return $query->where('status', '=', 1);
            })
            
            ->inRandomOrder()
            ->orderBy('review_time_created', 'desc')
            ->limit(20)
            ->get()
            ->unique('business_id');
            $i = 0;
            foreach($latestReview as $getBusiness){
                $parentCat = DB::table('categories')->where('id','=',$getBusiness->businessListCat->catgory->parent_id)
                ->orWhere('alias','=',$getBusiness->businessListCat->catgory->parent_id)
                ->first();
                
                if(!empty($parentCat)){
                    if($i++ > 10){
                        break;
                    }
                    else{
                $list = new LatestTopList;
                $list->business_name=$getBusiness->businessList->business_name;
                $list->business_slug=$getBusiness->businessList->business_slug;
                $list->business_image= $getBusiness->businessList->business_image;
                $list->rating=$getBusiness->rating;
                $list->review_text=$getBusiness->review_text;
                $list->user_name=$getBusiness->user_name;
                $list->user_image=$getBusiness->user_image;
                $list->category_name = $getBusiness->businessListCat->catgory->name;
                $list->category_id = $getBusiness->businessListCat->catgory->id;
                $list->parent_category = $parentCat->name;
                $list->type = 1;
                $list->save();
                    }
                }
                else{
                    continue;
                }
            }
    }
    public function createTopTradies(){
       
        $top = $this->getlatesTopcat(2);
        LatestTopList::where('type',2)->delete();
        $businessRatedTradies = BusinessListing::with(['review','listingCat'])->where('status',1)->where('business_listings.business_rating', '5')
            ->whereIn('id', function ($query) use ($top) {
                $query->select('business_id')->from('business_listing_categories')->whereIn('business_category_alias', $top)->where('business_listing_categories.business_category_alias','!=','virtualsub');
            })
            ->inRandomOrder()
            ->limit(10)
            ->get();
            
            foreach($businessRatedTradies as $getBusiness){
                if(!empty($getBusiness->listingCat->catgory->name)){
                    $list = new LatestTopList;
                    $list->business_name=$getBusiness->business_name;
                    $list->business_slug=$getBusiness->business_slug;
                    $list->business_image= $getBusiness->business_image;
                    $list->rating=$getBusiness->business_rating;
                    $list->review_text=!empty($getBusiness->review->review_text)?$getBusiness->review->review_text:'';
                    $list->business_review_count=$getBusiness->business_review_count;
                    $list->business_city=$getBusiness->business_city;
                    $list->category_name = $getBusiness->listingCat->catgory->name ;
                    $list->category_id = $getBusiness->listingCat->catgory->id;
                    $list->type = 2;
                    $list->save();
                }
            }
            return;
    }

    /**
     * Get All Events List for datatable
     * @return datatable collection[]
    */

    public function getAllLatestRec(){
        $data = $this->_model->where('type', 1)
        ->inRandomOrder()
        ->limit(3)
        ->get();
        return $data;
    }

    public function getAllTopTradies(){
        $data = $this->_model->where('type', 2)
        ->inRandomOrder()
        ->limit(3)
        ->get();
        return $data;
    }
    
}
