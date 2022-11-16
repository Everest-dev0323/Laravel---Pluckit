<?php

namespace App\Http\Controllers;
ini_set('max_execution_time', 60000);
use Illuminate\Http\Request;
use App\Category;
use App\BusinessListing;
use App\BusinessListingCategory;
use App\BusinessListReview;
use App\MapCategory;
use Illuminate\Support\Facades\Mail;
class TrustPilot extends Controller
{
	private $varApi = "1bWFBMiEToqAGFfceM5W9sR0JnFgdxeT";
    /**
     * get data from yelp api and insert into our database
     *
     */
    public function importCategoryList()
    {
        // get data from the json file
        // $varEndpoint = file_get_contents("https://api.trustpilot.com/v1/categories?apikey=1bWFBMiEToqAGFfceM5W9sR0JnFgdxeT&country=AU");
        // $jsonData = json_decode($varEndpoint);
		$argArrData = ['apikey'=>$this->varApi,'country'=>'AU'];
        $varEndpoint = "https://api.trustpilot.com/v1/categories?".http_build_query($argArrData);
        $jsonData = $this->hitCurl($varEndpoint);
		//echo "<pre>";var_dump($jsonData);exit;
        foreach($jsonData['categories'] as $arritems){
            // create if the category is root category
            if(empty($arritems['parentId'])){
                $arrDataToCreate = [
                    'name'=>$arritems['displayName'],
                    'alias'=>$arritems['name'],
                    'slug'=>preg_replace('/\\s+/', '-', preg_replace('/[^A-Za-z0-9. -]/', '', strtolower($arritems['displayName']))),
					'category_list_type'=>'trustpilot',
                ];
                $savedCategories  = Category::updateOrCreate(
                    $arrDataToCreate,['alias' => $arritems['name']]
                );
            }else{
                $arrDataToCreate = [
                    'name'=>$arritems['displayName'],
                    'alias'=>$arritems['name'],
                    'slug'=>preg_replace('/\\s+/', '-', preg_replace('/[^A-Za-z0-9. -]/', '', strtolower($arritems['displayName']))),
                    'parent_id'=>$arritems['parentId'],
					'category_list_type'=>'trustpilot',
                ];
                $savedCategories  = Category::updateOrCreate(
                    $arrDataToCreate,['alias' => $arritems['name']]
                );
            }
        }
    }
	/**
     * get data from yelp api and insert into our database
     *
     */
    public function importBusinessList()
    { 
        $userDataFormail = array();
		Mail::send('emails.forgot', ['user'=>array('email'=>'sumitmca11@gmail.com'), 'code' => 'sdfsd'], function ($message) use ($userDataFormail)
		{
			$message->to('sumitmca11@gmail.com');
			$message->subject("Reset Your Password");
		});
        $objCategriesAll = Category::where('categories.category_list_type','trustpilot');
		$objCategriesAll = $objCategriesAll->join('map_categories as mc', 'mc.yelp_category_id', '=', 'categories.id');
		//$objCategriesAll = $objCategriesAll->join('categories as c', 'c.id', '=', 'mc.map_pluckit_category_id');
        $objCategriesAll = $objCategriesAll->select('categories.*', 'mc.map_pluckit_category_id')->groupBy('mc.yelp_category_id')->get();
		//echo "<pre>";var_dump($objCategriesAll->toArray());exit;
		if(!empty($objCategriesAll[0])){
			foreach($objCategriesAll as $category){
				$argArrData = ['apikey'=>$this->varApi,'country'=>'AU'];
                $varEndpoint = "https://api.trustpilot.com/v1/categories/{$category->alias}/business-units?".http_build_query($argArrData);
				$jsonData = $this->hitCurl($varEndpoint);
				
				if(!empty($jsonData['totalNumberOfBusinesses']) && $jsonData['totalNumberOfBusinesses']>0){
					$varTotalRecord = $jsonData['totalNumberOfBusinesses'];
                    $varLimit  = 20;
                    $totalPages = ceil($varTotalRecord / $varLimit);
					for($i=1;$i<=$totalPages;$i++){
					 $argArrDataInner = ['apikey'=>$this->varApi,'country'=>'AU','page'=> $i];
                        $varEndpointInner = "https://api.trustpilot.com/v1/categories/{$category->alias}/business-units?".http_build_query($argArrDataInner);
						$jsonDataInner = $this->hitCurl($varEndpointInner);
						dd($jsonDataInner);
						$jsonBusinessData = !empty($jsonDataInner['businessUnits']) ? $jsonDataInner['businessUnits'] : [];
						//echo "<pre>";var_dump($jsonBusinessData);exit;
						if(!empty($jsonBusinessData[0])){
							foreach($jsonBusinessData as $arrBusiness){
								$argArrDataBusinessInner = ['apikey'=>$this->varApi];
								$varEndpointBusinessInner = "https://api.trustpilot.com/v1/business-units/{$arrBusiness['businessUnitId']}/profileinfo?".http_build_query($argArrDataBusinessInner);
								$jsonDataBusinessInner = $this->hitCurl($varEndpointBusinessInner);
								
								$argArrDataWeblink = ['apikey'=>$this->varApi,'locale'=>'en-au'];
								$varEndpointWeblink = "https://api.trustpilot.com/v1/business-units/{$arrBusiness['businessUnitId']}/web-links?".http_build_query($argArrDataWeblink);
								$jsonDataWeblink = $this->hitCurl($varEndpointWeblink);
								$reviewBusinessUrl = !empty($jsonDataWeblink['profileUrl']) ? $jsonDataWeblink['profileUrl'] : '';
								$getBusinessDuplicate = BusinessListing::where('business_list_id',$arrBusiness['businessUnitId'])->where('business_list_type','trustpilot')->first();
								//if(empty($getBusinessDuplicate)){
									
										//Import Business Category
										if(!empty($arrBusiness['categories'][0])){
											foreach($arrBusiness['categories'] as $categoryBusiness){
												$getcategoryData = Category::where('categories.alias',$categoryBusiness['name']);
												$getcategoryData = $getcategoryData->join('map_categories as mc', 'mc.yelp_category_id', '=', 'categories.id');
											    //$getcategoryData = $getcategoryData->join('categories as c', 'c.id', '=', 'mc.map_pluckit_category_id');
												$getcategoryData = $getcategoryData->groupBy('mc.yelp_category_id')
													->select('categories.*', 'mc.map_pluckit_category_id', 'mc.id as catMapId', 'mc.yelp_category_id')->first();
												if(!empty($getcategoryData)){
													if(!empty($jsonDataBusinessInner['address']['countryCode']) && ($jsonDataBusinessInner['address']['countryCode'] == 'AU')){
													$getBusinessDuplicates = BusinessListing::where('business_list_id',$arrBusiness['businessUnitId'])->where('business_list_type','trustpilot')->first();
													if(empty($getBusinessDuplicates)){
													$arrDataToSavebussinessList = [
														'business_name'=>$arrBusiness['displayName'],
														'business_list_type'=>'trustpilot',
														'business_list_id'=>$arrBusiness['businessUnitId'],
														'business_slug'=>preg_replace('/\\s+/', '-', preg_replace('/[^A-Za-z0-9. -]/', '', strtolower($arrBusiness['displayName']))),
														'business_image'=>!empty($arrBusiness['logoUrl']) ? $arrBusiness['logoUrl'] : '',
														'business_review_count'=>!empty($arrBusiness['numberOfReviews']) ? $arrBusiness['numberOfReviews'] : 0,
														'business_rating'=>$arrBusiness['trustScore'],
														'business_lattitude'=>0,
														'business_longitude'=>0,
														'business_address_1'=>!empty($jsonDataBusinessInner['address']['street']) ? $jsonDataBusinessInner['address']['street'] : '',
														'business_address_2'=>'',
														'business_address_3'=>'',
														'business_city'=>!empty($jsonDataBusinessInner['address']['city']) ? $jsonDataBusinessInner['address']['city'] : '',
														'business_state'=>!empty($jsonDataBusinessInner['address']['city']) ? $jsonDataBusinessInner['address']['city'] : '',
														'business_country'=>!empty($jsonDataBusinessInner['address']['countryCode']) ? $jsonDataBusinessInner['address']['countryCode'] : '',
														'business_phone'=>!empty($jsonDataBusinessInner['phone']) ? $jsonDataBusinessInner['phone'] : "",
														'business_phone'=>!empty($jsonDataBusinessInner['phone']) ? $jsonDataBusinessInner['phone'] : "",
														'business_zipcode'=>!empty($jsonDataBusinessInner['address']['postcode']) ? $jsonDataBusinessInner['address']['postcode'] : "",
														'business_website_url'=>!empty($arrBusiness['identifyingName']) ? $arrBusiness['identifyingName'] : "",
														'business_email'=>!empty($jsonDataBusinessInner['email']) ? $jsonDataBusinessInner['email'] : "",
														'business_review_url'=>$reviewBusinessUrl
													];
													$saveBusinessListingData = BusinessListing::updateOrCreate(
														$arrDataToSavebussinessList,['business_list_id'=>$arrBusiness['businessUnitId']]
													);
													}
													$getAllMapCategory = MapCategory::where('yelp_category_id',$getcategoryData->yelp_category_id)->get();
													if(!empty($getAllMapCategory[0])){
														foreach($getAllMapCategory as $mapCategory){
															$getCatBusiness = Category::where('id',$mapCategory->map_pluckit_category_id)->first();
															$arrCatToSave = [
																'business_id'=>empty($getBusinessDuplicates) ? $saveBusinessListingData->id : $getBusinessDuplicates->id,
																'business_category_alias'=>$getCatBusiness->alias,
																'business_category_slug'=>$getCatBusiness->slug,
																'business_map_cat_id'=>$mapCategory->id
															];
															$savedCategories  = BusinessListingCategory::updateOrCreate(
																$arrCatToSave,['alias' => $getCatBusiness->alias,'business_id'=>empty($getBusinessDuplicates) ? $saveBusinessListingData->id : $getBusinessDuplicates->id]
															);
														}
													}
													//Import Business Review
													if(empty($getBusinessDuplicates)){
													if(!empty($arrBusiness['numberOfReviews'])){
														$varTotalRecordReview = $arrBusiness['numberOfReviews'];
														$varReviewLimit  = 20;
														$totalReviewsPages = ceil($varTotalRecordReview / $varReviewLimit);
														for($j=1;$j<=$totalReviewsPages;$j++){
															$argArrDataBusinessReview = ['apikey'=>$this->varApi,'page'=> $j];
															$varEndpointBusinessReview = "https://api.trustpilot.com/v1/business-units/{$arrBusiness['businessUnitId']}/reviews?".http_build_query($argArrDataBusinessReview);
															$jsonDataBusinessReview = $this->hitCurl($varEndpointBusinessReview);
															//echo "<pre>";var_dump($jsonDataBusinessReview);exit;
															$jsonBusinessReviewData = !empty($jsonDataBusinessReview['reviews']) ? $jsonDataBusinessReview['reviews'] : [];
															//echo "<pre>";var_dump($jsonDataWeblink['profileUrl']);exit;
															if(!empty($jsonBusinessReviewData[0])){
																foreach($jsonBusinessReviewData as $arrReviews){
																	$argArrDataUserProfile = ['apikey'=>$this->varApi];
																	$varEndpointUserProfile = "https://api.trustpilot.com/v1/consumers/{$arrReviews['consumer']['id']}/profile?".http_build_query($argArrDataUserProfile);
																	$jsonDataUserProfile = $this->hitCurl($varEndpointUserProfile);
																	$userProfileImage = !empty($jsonDataUserProfile['profileImage']['image73x73']['url']) ? $jsonDataUserProfile['profileImage']['image73x73']['url'] : '';
																	$arrToInsertReviews = [
																	  'business_id'=>$saveBusinessListingData->id,
																	  'user_id'=>$arrReviews['consumer']['id'],
																	  'user_name'=>$arrReviews['consumer']['displayName'],
																	  'user_image'=>$userProfileImage,
																	  'rating'=>$arrReviews['stars'],
																	  'review_text'=>$arrReviews['text'],
																	  'review_time_created'=>date('Y-m-d H:i:s',strtotime($arrReviews['createdAt'])),
																	  'review_type'=>'trustpilot'
																	  
																   ];
																   // edit or update the record in oud db
																   BusinessListReview::updateOrCreate(
																	 $arrToInsertReviews,['business_id'=>$saveBusinessListingData->id,'user_id'=>$arrReviews['consumer']['id']]
																   );	
																}
															}
														}
														
													}
													}
												}
												}
											}
											

										}
										
										
								//}	
							}
							
							
						}
				}
					
				}
				
				
			}
		}
        
    }
	/**
     * get data from Trust api for business reviews and store that 
     *
     */ 
    public function importAllBusinessReviews()
    {
        // fetch all teh data from our db business listing 
        $arrAllBusinessListings = BusinessListing::where('business_list_type','trustpilot')->get();
        if(!empty($arrAllBusinessListings)){
            foreach($arrAllBusinessListings as $objBusinessListing){
                // hit Trust to get all the reviews regarding each business id
				$argArrData = ['apikey'=>$this->varApi];
                $varEndpoint = "https://api.trustpilot.com/v1/business-units/{$objBusinessListing->business_list_id}/reviews?".http_build_query($argArrData);
                $jsonData = $this->hitCurl($varEndpoint);
                if(!empty($jsonData['reviews'])){
                   foreach($jsonData['reviews'] as $arrReviews){
                       $arrToInsertReviews = [
                          'business_id'=>$objBusinessListing->id,
                          'user_id'=>$arrReviews['consumer']['id'],
                          'user_name'=>$arrReviews['consumer']['displayName'],
                          'user_image'=>!empty($arrReviews['user']['image_url']) ? $arrReviews['user']['image_url'] : "",
                          'rating'=>$arrReviews['stars'],
                          'review_text'=>$arrReviews['text'],
                          'review_time_created'=>$arrReviews['time_created']
                       ];
                       // edit or update the record in oud db
                       BusinessListReview::updateOrCreate(
                         $arrToInsertReviews,['business_id'=>$objBusinessListing->id,'user_id'=>$arrReviews['consumer']['id']]
                       );
                   }
               }
            }
            
        }
    }
	 private function hitCurl($varEndpoint){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $varEndpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
		$jsonData = array();
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $jsonData = json_decode($response, true);
        }
        return $jsonData;
		//echo "<pre>";var_dump($jsonData);exit;
        
    }
}
