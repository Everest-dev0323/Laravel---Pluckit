@extends('layouts.front-end.app')
@section('content')
 @php
    $parentCat = !empty($get['parent_cat']) ? $get['parent_cat'] : $get['cat'];
	$getCategory = \App\Category::where('name',$parentCat)->where('category_list_type','pluckit')->where('pluckit_parent_id',0)->first();
	if(!empty($getCategory)){
	$getSubCategory = \App\Category::where('pluckit_parent_id',$getCategory->id)->where('category_list_type','pluckit')->where('pluckit_parent_id','!=',0)->get();
	}else{
	$getSubCategory = [];
	}
 @endphp
<!-- page-head-search -->
     @include('search-form')
    <!-- /page-head-search -->
    <!-- Content -->
    <div id="content" class="{{ !empty($objBusinessList[0]) ? 'mb-5' : '' }}">
      <!-- Search-result -->
      <section class="section search-result">
        <div class="container">
          <div class="row">
            <!-- Main -->
            <main id="main" class="col-lg-8 pr-lg-5">
			  @php $hidType = !empty($get['hid_type']) ? $get['hid_type'] : ''; @endphp
              @if(empty($get['cat']) && empty($get['loc']))
				  @php  $allUrl = url('search'); @endphp
                  <p class="lead">Browse top category and compare ratings and reviews</p>
		      @elseif(!empty($get['cat']) && !empty($get['loc']))
			     @php $allUrl = url('search').'?cat='.$get['cat'].'&loc='.$get['loc'].'&hid_type='.$hidType;@endphp
			      @if($objBusinessListCont !=0)
				    <h3 class="mb-2 mb-md-0">Top {{ $objBusinessListCont.' '.$get['cat'] }} near you</h3>
			      @else
					<h3 class="mb-2 mb-md-0">{{ 'No ' .$get['cat'] }} near you</h3>
				  @endif
			      <p class="lead">Browse {{ $get['cat'] }}, {{ $get['loc']}} and compare ratings and reviews</p>
			  @elseif(!empty($get['cat']))
			     @php $allUrl = url('search').'?cat='.$get['cat'].'&hid_type='.$hidType; @endphp
				 @if($objBusinessListCont !=0)
			         <h3 class="mb-2 mb-md-0">Top {{ $objBusinessListCont.' '.$get['cat'] }} near you</h3>
			     @else
					 <h3 class="mb-2 mb-md-0">{{ 'No ' .$get['cat'] }} near you</h3>
				 @endif
			      <p class="lead">Browse {{ $get['cat'] }} and compare ratings and reviews</p>
			  @else
				   @php $allUrl = url('search').'?loc='.$get['loc'].'&hid_type='.$hidType;@endphp
				  <p class="lead">Browse {{ $get['loc']}} and compare ratings and reviews</p>
		      @endif

              <!-- Search Filter -->
              <div class="search-filter">
                <!-- filter-nav -->
				<form action="{{ url('search/') }}" method="" class="form form-layout2 mb-4" id="get-filter-form">
                <div class="filter-nav">

                    <div class="search-by">
                      <a href="javascript:;" id="all-filter" class="{{ (!empty($get['cat']) && (!empty($get['hid_type']) || empty($get['hid_type']))) ? 'active' : ''}}"><i class="fas fa-sliders-h mr-2"></i>All</a>
					  <input type="hidden" name="hid_type" id="" value="{{ !empty($get['hid_type']) ? $get['hid_type'] : '' }}">
					  <input type="hidden" name="loc" id="" value="{{ !empty($get['loc']) ? $get['loc'] : '' }}">
					  <input type="hidden" name="near_postcode" id="near_postcode" value="{{ !empty($get['near_postcode']) ? $get['near_postcode'] : 25 }}">
					  <input type="hidden" name="parent_cat" id="parent_cat" value="{{ !empty($get['parent_cat']) ? $get['parent_cat'] : $get['cat']}}">


                    </div>
                    <div class="search-by">
                      <span class="selectbox">
                        <select name="rating" id="rating-filter" class="form-control {{ (!empty($get['rating'])) ? 'active' : ''  }}">
                          <option value="">Rating</option>
                          <option value="1" {{ (!empty($get['rating']) && ($get['rating'] == 1)) ? 'selected' : ''  }}>1</option>
                          <option value="2" {{ (!empty($get['rating']) && ($get['rating'] == 2)) ? 'selected' : ''  }}>2</option>
						  <option value="3" {{ (!empty($get['rating']) && ($get['rating'] == 3)) ? 'selected' : ''  }}>3</option>
						  <option value="4" {{ (!empty($get['rating']) && ($get['rating'] == 4)) ? 'selected' : ''  }}>4</option>
						  <option value="5" {{ (!empty($get['rating']) && ($get['rating'] == 5)) ? 'selected' : ''  }}>5</option>
                        </select>
                      </span>
                    </div>
                    <div class="search-by">
					    <a href="javascript:;" id="only-friend-recommendation" data-user-id="{{ !empty($user) ? $user->id : ''}}" class="{{ !empty($get['onlyfrnrec']) ? 'active' : ''}}">Only friend recommendations</a>
						<input type="hidden" name="onlyfrnrec" id="onlyfrnrec" value="{{ !empty($get['onlyfrnrec']) ? $get['onlyfrnrec'] : '' }}">
					</div>
                    <div class="search-by">
					<a href="javascript:;" data-user-id="{{ !empty($user) ? $user->id : ''}}"  id="onlyme-filter" class="{{ !empty($get['onlyme']) ? 'active' : ''}}">Only me</a>
					<input type="hidden" name="onlyme" id="onlyme" value="{{ !empty($get['onlyme']) ? $get['onlyme'] : '' }}">
					</div>

                </div>
				<!-- /filter-nav -->
                <!-- filter-content -->
             <!-- Breadcrumb -->
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb bg-gray-light">
						<li class="breadcrumb-item"><a href="{{ url('/')}}">Home</a></li>
						@if(empty($get['hid_type']))
						   <li class="breadcrumb-item active" aria-current="page">{{ !empty($get['cat']) ? $get['cat'] : ''}}</li>
						@else
							<li class="breadcrumb-item"><a href="{{ url('/view-categories')}}">Categories</a></li>
						    <li class="breadcrumb-item active" aria-current="page">{{ !empty($get['parent_cat']) ? $get['parent_cat'] : $get['cat']}}</li>
						@endif
					</ol>
				</nav>
				<!-- /Breadcrumb -->
				<!-- Categories -->
				@if(!empty($get['hid_type']))
				<div class="form-group row">
					<div class="col-sm-6">
						<span class="selectbox">
							<select name="cat" id="sub-categories" class="form-control rounded">
								<option value="{{ !empty($get['parent_cat']) ? $get['parent_cat'] : '' }}" {{ (!empty($get['parent_cat'])) ? 'selected' : ''  }}>Show all</option>
								@if(!empty($getSubCategory[0]))
									@foreach($getSubCategory as $subcategory)
										<option value="{{ $subcategory->name }}" {{ (!empty($get['cat']) && ($get['cat'] == $subcategory->name)) ? 'selected' : ''  }}>{{ $subcategory->name }}</option>
									@endforeach
								@endif
							</select>
						</span>
					</div>
					</div>
				 @else
					 <input type="hidden" name="cat" value="{{ !empty($get['cat']) ? $get['cat'] : '' }}">
				 @endif
				 </form>
				<!-- /Categories -->
              <div class="filter-content show-more">
				<input type="hidden" id="home_page" value="1" />
                <input type="hidden" id="home_max_page" value="{{ $max_page }}" />
				@if(!empty($objBusinessList[0]))
				@foreach($objBusinessList as $business)
			     @php
				   $businessSlug = !empty($business->business_slug) ? url('business').'/'.$business->business_slug : '';
				   $userId = !empty($user) ? $user->id : 0;
				   $userType = !empty($user) ? $user->user_type : 1;
				   $userLikeCount = \App\UserLike::where('business_id',$business->id)->get([DB::raw('count(*) as total')]);
				   $userLikeCont = $userLikeCount[0]['total'];
				   $likeCount = $userLikeCont;
				   $userUnLikeCount = \App\UserUnlike::where('business_id',$business->id)->get([DB::raw('count(*) as total')]);
				   $userUnLikeCont = $userUnLikeCount[0]['total'];
				   $unlikeCount = $userUnLikeCont;
				   $getObjBusinessListReview = \App\BusinessListReview::where('business_id',$business->id)->where('user_id',$userId)->first();
				   if(!empty($getObjBusinessListReview)){
					   $userReviewCount = 1;
				   }else{
					   $userReviewCount = 0;
				   }
				   $objFriendRecommendationList = \App\BusinessListReview::whereIn('user_id',$arrFriendRecommendation)->where('status',1)->where('business_id',$business->id)->orderBy('review_time_created','desc')->limit(3)->get();
				   $objFriendRecommendationCount = \App\BusinessListReview::whereIn('user_id',$arrFriendRecommendation)->where('status',1)->where('business_id',$business->id)->get()->count();
				   $objBusinessEmail = \App\User::where('id',$business->user_id)->where('user_type',2)->first();
				 @endphp
                  <!-- Filter Item -->
                  <div class="filter-item">
                    <div class="service-box">
                      <div class="service-img">
					  <a href="{{ !empty($business->business_slug) ? url('business').'/'.$business->business_slug : '#' }}">
						 @if(!empty($business->business_image))
						   <img class="img-fluid" src="{{ $business->business_image }}" alt="{{ $business->business_name }}">
						  @else
							<img class="img-fluid" src="{{ url('public/')}}/front-assets/images/trade-icon.png" alt="butterfield">
						  @endif
					  </a>
                      </div>
					  <div class="service-content">
                    <div class="left mr-3">

					 <h4><a href="{{ !empty($business->business_slug) ? url('business').'/'.$business->business_slug : '#' }}"> {{ $business->business_name }}  @if(!empty($business->callout))<span class="status">({{ $business->callout }})</span><i class="fas fa-check-circle ml-1"></i>@endif</a></h4>
                      <div class="rating d-flex justify-content-start align-items-md-center mb-2">
                        <ul class="list-unstyled">
                          <li><a href="#"><i class="
							  <?php
							  if($business->business_rating == 0) {
								  echo 'fa fa-star text-gray';
							  }else	{
								 if($business->business_rating > 0 && $business->business_rating < 1){
									 echo 'fa fa-star-half-alt';
								 }else{
									 echo 'fa fa-star';
								 }
							  }
							?>
							"></i></a></li>
							 <li><a href="#"><i class="
							 <?php
							 if($business->business_rating > 1 && $business->business_rating < 2){
								 echo 'fa fa-star-half-alt';
							 }else{
								 if($business->business_rating >= 2){
									echo 'fa fa-star';
								 }else{
									 echo 'fa fa-star text-gray';
								 }
							 }
							 ?>
							 "></i></a></li>
							  <li><a href="#"><i class="
							  <?php
							  if($business->business_rating > 2 && $business->business_rating < 3){
								  echo 'fas fa-star-half-alt';
							  }else{
								  if($business->business_rating >= 3){
								  echo 'fa fa-star';
								  }else{
									  echo 'fa fa-star text-gray';
								  }
							  }
							  ?>"></i></a></li>
							  <li><a href="#"><i class="
							  <?php
							  if($business->business_rating > 3 && $business->business_rating < 4){
								  echo 'fa fa-star-half-alt';
							  }else{
								  if($business->business_rating >= 4){
								  echo 'fa fa-star';
								  }else{
								  echo 'fa fa-star text-gray';
								  }
							  }
							  ?>"></i></a></li>
							  <li><a href="#"><i class="
							  <?php if($business->business_rating > 4 && $business->business_rating < 5){
								  echo 'fa fa-star-half-alt';
							  }else{
								  if($business->business_rating >= 5){
									echo 'fa fa-star';
								  }else{
									echo 'fa fa-star text-gray' ;
								  }
							  };?>"></i></a></li>
                        </ul>
                        <div class="reviews ml-2">
                          <a href="#">({{ $business->business_review_count }})</a>
                        </div>
                      </div>
                      <div class="service-provider">
                        <p>{{ $business->category_name }}</p>
                      </div>
                      <ul class="contact-info mb-1">
                        <li><i class="fas fa-map-marker-alt mr-2"></i>{{ $business->business_address_1 }} <a target="_blank" href="https://www.google.com/maps?z=12&t=m&q=loc:{{ $business->business_lattitude }}+{{ $business->business_longitude }}">Get directions<i
                              class="fas fa-directions ml-1"></i></a></li>
                        <li><i class="far fa-clock mr-2"></i>{{ !empty($business->business_default_hours) ? $business->business_default_hours : '10AM - 9PM' }}
						<a href="javascript:;" data-id="{{$business->id  }}" class="viewWorkingHoursModal">View working hours</a>
						</li>
                      </ul>
                      <p>
					  @if($userId == 0)
						  <a>Login to see who has recommend this business from your contacts </a>
					  @else
						  @if($objFriendRecommendationCount != 0)
							<a href="javascript:;"  onClick="clickFriendRecommendation({{ $business->id }})">{{ $objFriendRecommendationCount }} people you might know refer or recommend this business</a>
						  @endif
					  @endif
					  </p>
                      <div class="user-block text-left">
                        <a href="javascript:;" class="btn btn-outline-primary mr-2" onClick="clickRecommendation({{ $business->id }},{{ $userId }},{{ $userType }},{{ $userReviewCount }})"><i class="far fa-edit mr-2"></i>Leave a
                          Recommendation</a>

                        <a href="javascript:;" class="btn btn-outline-secondary btn-share social-share" data-href="{{$businessSlug }}" data-business-id="{{ $business->id }}"><i class="fas fa-share-square mr-2"></i>Share</a>
						<!--
						<a href="#" class="btn btn-outline-secondary btn-share" data-href="{{$businessSlug }}" data-business-id="{{ $business->id }}"><i class="fas fa-share-square mr-2"></i>Share</a>
						-->
                        <a href="javascript:;" class="btn btn-link btn-like thumbs_up" id="thumbs_up_{{ $business->id }}"  onClick="clickUserLike({{ $business->id }},{{ $userId }},{{ $userType }})"><i class="far fa-thumbs-up mr-2"></i>{{ $likeCount }}</a>
                        <a href="javascript:;" class="btn btn-link btn-dislike thumbs_down" id="thumbs_down_{{ $business->id }}" onClick="clickUserUnLike({{ $business->id }},{{ $userId }},{{ $userType }})"><i class="far fa-thumbs-down mr-2"></i>{{ $unlikeCount }}</a>
                      </div>
                    </div>
                   <div class="right">
                      <ul class="list-unstyled user-links">
					  @if(!empty($business->business_phone))
					   <li>
						 <a href="javascript:;" class="tel callusButton" data_business_id="{{ $business->id }}" data_phone="{{ $business->business_phone }}">
						   <i class="fas fa-phone fa-rotate-90"></i>
							Call us
						 </a>
						 <a href="tel:{{ $business->business_phone }}" class="tel " id="hidcallusButton_{{ $business->id }}"></a>
						</li>
						@endif
						@if(!empty($business->business_phone))
						<li><a href="javascript:;" onClick="clickMessage({{ $business->id }},{{ $userId }},{{ $business->business_phone }})"  class="email"><i class="fas fa-envelope"></i>Message us</a></li>
					    @endif
						@if(!empty($objBusinessEmail->email))
                        <li>
						  <a href="javascript:;" class="comment emailusButton" data_business_id="{{ $business->id }}" data_email="{{ !empty($objBusinessEmail->email) ? $objBusinessEmail->email : 'pluckit20@gmail.com' }}" target="_blank"><i class="far fa-comment-dots"></i>Email us
						  </a>
						   <a href="mailto:{{ !empty($objBusinessEmail->email) ? $objBusinessEmail->email : 'pluckit20@gmail.com' }}" class="comment " id="hidEmailUsButton_{{ $business->id }}" target="_blank"></a>
					    </li>
						@endif
						@if(!empty($business->business_website_url))
                       <li>
						<a href="{{ $business->business_website_url }}" data_business_id="{{ $business->id }}" data_website="{{ !empty($objBusinessList->business_website_url) ? $objBusinessList->business_website_url : '' }}" class="globe websiteButton" target="_blank">
						  <i class="fas fa-globe"></i>Website
						</a>
						<a href="{{ $business->business_website_url }}" class="globe " id="hidWebsiteButton_{{ $business->id }}" target="_blank"></a>
						</li>
						@endif

                      </ul>
					  @if(!empty($business->business_review_url))
						  <div class="rating rating-trustpilot text-center">
							<a href="{{ $business->business_review_url }}" target="_blank">
								<div class="logo">
									<img src="{{ ('/public') }}/front-assets/images/trustpilot.svg" alt="Trustpilot">
								</div>
							</a>
							<ul class="list-unstyled ml-1">
								<li><a href="#"><i class="
						  <?php
						  if($business->business_rating == 0) {
							  echo 'fa fa-star text-gray';
						  }else	{
							 if($business->business_rating > 0 && $business->business_rating < 1){
								 echo 'fa fa-star-half-alt';
							 }else{
								 echo 'fa fa-star';
							 }
						  }
						?>
						"></i></a></li>
                         <li><a href="#"><i class="
						 <?php
						 if($business->business_rating > 1 && $business->business_rating < 2){
							 echo 'fa fa-star-half-alt';
						 }else{
							 if($business->business_rating >= 2){
								echo 'fa fa-star';
							 }else{
								 echo 'fa fa-star text-gray';
							 }
						 }
						 ?>
						 "></i></a></li>
						  <li><a href="#"><i class="
						  <?php
						  if($business->business_rating > 2 && $business->business_rating < 3){
							  echo 'fas fa-star-half-alt';
						  }else{
							  if($business->business_rating >= 3){
							  echo 'fa fa-star';
							  }else{
								  echo 'fa fa-star text-gray';
							  }
						  }
						  ?>"></i></a></li>
						  <li><a href="#"><i class="
						  <?php
						  if($business->business_rating > 3 && $business->business_rating < 4){
							  echo 'fa fa-star-half-alt';
						  }else{
							  if($business->business_rating >= 4){
							  echo 'fa fa-star';
							  }else{
							  echo 'fa fa-star text-gray';
							  }
						  }
						  ?>"></i></a></li>
						  <li><a href="#"><i class="
						  <?php if($business->business_rating > 4 && $business->business_rating < 5){
							  echo 'fa fa-star-half-alt';
						  }else{
							  if($business->business_rating >= 5){
								echo 'fa fa-star';
							  }else{
								echo 'fa fa-star text-gray' ;
							  }
						  };?>"></i></a></li>

							</ul>
						  </div>
						@endif
                    </div>

                </div>

                    </div>
					<div class="top-search d-none" id="friend-recommendation-{{ $business->id }}" data-status=''>
                      <!-- review-list -->
                      <p class="lead">{{ ($objFriendRecommendationCount <= 3) ? $objFriendRecommendationCount : '3' }} people you might know refer or recommend this business</p>
                      <div class="review-list mt-lg-4">
					  @if(!empty($objFriendRecommendationList[0]))
                        @foreach($objFriendRecommendationList as $friendRecommendation)
							<div class="box bg-gray-light box-shadow">
							  <div class="media">
								<figure class="figure2 mr-3">
								@if(!empty($friendRecommendation->user_image))
								  <img class="img-fluid" src="{{ $friendRecommendation->user_image }}" alt="Avatar">
								@else
								  <img class="img-fluid" src="{{ url('public/front-assets/images') }}/default-profile.jpg" alt="Avatar">
								@endif
								</figure>
								<div class="media-body">
								  <h6>{{ $friendRecommendation->user_name }}<span class="review-date">{{ date("M d, Y",strtotime($friendRecommendation->review_time_created)) }}</span></h6>
								  <div class="rating">
									<ul class="list-unstyled">
									  <li><a href="#"><i class="{{ ($friendRecommendation->rating >= 1)?'fa fa-star':'fa fa-star text-gray' }}"></i></a></li>
									  <li><a href="#"><i class="{{ ($friendRecommendation->rating >= 2)?'fa fa-star':'fa fa-star text-gray' }}"></i></a></li>
									  <li><a href="#"><i class="{{ ($friendRecommendation->rating >= 3)?'fa fa-star':'fa fa-star text-gray' }}"></i></a></li>
									  <li><a href="#"><i class="{{ ($friendRecommendation->rating >= 4)?'fa fa-star':'fa fa-star text-gray' }}"></i></a></li>
									  <li><a href="#"><i class="{{ ($friendRecommendation->rating >= 5)?'fa fa-star':'fa fa-star text-gray' }}"></i></a></li>
									</ul>
								  </div>
								</div>
							  </div>
							  <div class="review-content">
								   @php $str =  "The user didn't write a review, and has left just a rating."; @endphp
								   <p>{{ !empty($friendRecommendation->review_text) ? '“'.$friendRecommendation->review_text.'”': '“'.htmlspecialchars_decode($str, ENT_QUOTES).'”' }}</p>
								</div>
							</div>
							@endforeach
				      @endif
                      </div>
                      <!-- /review-list -->
                    </div>

                  </div>
                  <!-- /Filter Item -->
				@endforeach
				@else
				<div class="empty-content border radius rounded text-center p-3">
					<!-- <h3 class="text-center">No Data Found</h3> -->
					<div class="empty-content-imag">
                       <img class="img-fluid" src="{{ url('public/') }}/front-assets/images/404.png" alt="Image">
					</div>
					<h4 class="text-primary">Looks like you have no find any related search result.</h4>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. It is a long established fact that a reader will be distracted by the readable content of a page, go to home <a href="{{ url('') }}">click here</a>.</p>
				</div>
					    @endif

                </div>
				<div class="business-loader">

                </div>
                <!-- /filter-content -->
				@if(($max_page >1))
                <a href="javascript:;" class="btn btn-link button2 load-more">Load more<i class="fas fa-angle-down ml-2"></i></a>
                @endif
              </div>
              <!-- Search Filter -->
            </main>
            <!-- /Main -->
            <!-- Sidebar -->
            <aside id="sidebar" class="col-lg-4 pl-lg-5">
			@if(!empty($getPeopleYouMightKnow[0]))
              <h5>People You Might Know</h5>
              <div class="widget box bg-gray-light box-shadow">
                <ul class="list-unstyled">
				@foreach($getPeopleYouMightKnow as $yowMightKnow)
                  <li class="media">
                    <figure class="figure2 mr-3">
					  @if(!empty($yowMightKnow->user_image))
                       <img class="img-fluid" src="{{ $yowMightKnow->user_image }}" alt="{{ $yowMightKnow->name }}">
				     @else
						<img class="img-fluid" src="{{ url('public/') }}/front-assets/images/avatar.png" alt="Avatar">
					 @endif
                    </figure>
                    <div class="media-body">
                      <h6>{{ $yowMightKnow->name }}</h6>
                      <p><a href="#"><i class="fas fa-user-plus mr-1"></i>Add to Contacts</a></p>
                    </div>
                  </li>
				  @endforeach
                </ul>
              </div>
			   <hr class="mt-md-4 mb-lg-5" />
			  @endif
			   @if(!empty($objRelatedBusinessList[0]))

				  <h5>Other Related Tradies</h5>
				  <div class="widget box bg-gray-light box-shadow tradies">
					<ul class="list-unstyled">
					 @foreach($objRelatedBusinessList as $relatedBusinessList)
                        <li class="media">
                            <figure class="figure2 mr-3">
                            <a href="{{ url('/business/'.$relatedBusinessList->business_slug) }}">
							  <img class="img-fluid" src="{{ (!empty($relatedBusinessList->business_image))?$relatedBusinessList->business_image:url('/public/front-assets/images/trade-icon.png') }}" alt="{{ $relatedBusinessList->business_name }}">
							</a>
                            </figure>
                            <div class="media-body">
                            <h6><a href="{{ url('/business/'.$relatedBusinessList->business_slug) }}">{{ $relatedBusinessList->business_name }}</a></h6>
                            <div class="rating">
                                <ul class="list-unstyled">
                               <li><a href="#"><i class="
								  <?php
								  if($relatedBusinessList->business_rating == 0) {
									  echo 'fa fa-star text-gray';
								  }else	{
									 if($relatedBusinessList->business_rating > 0 && $relatedBusinessList->business_rating < 1){
										 echo 'fa fa-star-half-alt';
									 }else{
										 echo 'fa fa-star';
									 }
								  }
								?>
								"></i></a></li>
								 <li><a href="#"><i class="
								 <?php
								 if($relatedBusinessList->business_rating > 1 && $relatedBusinessList->business_rating < 2){
									 echo 'fa fa-star-half-alt';
								 }else{
									 if($relatedBusinessList->business_rating >= 2){
										echo 'fa fa-star';
									 }else{
										 echo 'fa fa-star text-gray';
									 }
								 }
								 ?>
								 "></i></a></li>
								  <li><a href="#"><i class="
								  <?php
								  if($relatedBusinessList->business_rating > 2 && $relatedBusinessList->business_rating < 3){
									  echo 'fas fa-star-half-alt';
								  }else{
									  if($relatedBusinessList->business_rating >= 3){
									  echo 'fa fa-star';
									  }else{
										  echo 'fa fa-star text-gray';
									  }
								  }
								  ?>"></i></a></li>
								  <li><a href="#"><i class="
								  <?php
								  if($relatedBusinessList->business_rating > 3 && $relatedBusinessList->business_rating < 4){
									  echo 'fa fa-star-half-alt';
								  }else{
									  if($relatedBusinessList->business_rating >= 4){
									  echo 'fa fa-star';
									  }else{
									  echo 'fa fa-star text-gray';
									  }
								  }
								  ?>"></i></a></li>
								  <li><a href="#"><i class="
								  <?php if($relatedBusinessList->business_rating > 4 && $relatedBusinessList->business_rating < 5){
									  echo 'fa fa-star-half-alt';
								  }else{
									  if($relatedBusinessList->business_rating >= 5){
										echo 'fa fa-star';
									  }else{
										echo 'fa fa-star text-gray' ;
									  }
								  };?>"></i></a></li>
						  </ul>
                                <div class="reviews ml-2">
                                <a href="#">({{ $relatedBusinessList->business_review_count }} reviews)</a>
                                </div>
                            </div>
                            </div>
                        </li>
                    @endforeach

					</ul>
				  </div>
			  @endif
            </aside>
            <!-- /Sidebar -->
          </div>
        </div>
      </section>
      <!-- /Search-result -->
    </div>

	<!-- /Modal -->
  <div class="modal fade" id="sharepopup">
		<div class="modal-dialog modal-dialog-centered" role="document">
		  <div class="modal-content">
			<div class="modal-wrap">
			  <div class="modal-header border-0 align-items-center">
				<h4 class="modal-title d-none">Share</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body pt-0 text-center" id="show_share">

			  </div>

			</div>
		  </div>
		</div>
    </div>
<div class="modal fade" id="recommendation">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-wrap">
          <div class="modal-header border-0 align-items-center">
            <h4 class="modal-title">Leave a Recommendation</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body pt-0">
            <form class="form" action="{{ url('business/user/review')}}" method="post" enctype="multipart/form-data" id="user_review_form">
                  {{ csrf_field() }}
                    <div class="form-group">
                      <textarea name="review" id="review" class="form-control" placeholder="Type here" data-validation="required"></textarea>
                    </div>
					<div class="rating" id="rating">
					<span class="mr-3">Rating</span>
                        <a href="javascript:;" class="star" title="Poor" data-value="1"><i class="fa fa-star"></i></a>
						  <a href="javascript:;" class="star" title="Fair" data-value="2"><i class="far fa-star text-gray"></i></a>
						  <a href="javascript:;" class="star" title="Good" data-value="3"><i class="far fa-star text-gray"></i></a>
						  <a href="javascript:;" class="star" title="Excellent" data-value="4"><i class="far fa-star text-gray"></i></a>
						  <a href="javascript:;" class="star" title="WOW!!!" data-value="5"><i class="far fa-star text-gray"></i></a>
                      </div>
                    </div>
                    <div class="modal-footer">
					  <input type="hidden" name="rating" id="hid_rating" value="1">
					  <input type="hidden" name="user_id" id="user_id" value="{{ !empty($user) ? $user->id : ''}}">
					  <input type="hidden" name="business_id" id="hid_business_id" value="">
                      <button class="btn btn-primary float-right" type="submit">Submit</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="sendMessage">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-wrap">
          <div class="modal-header border-0 align-items-center">
            <h4 class="modal-title">Type a Message</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body pt-0">
            <form class="form" action="{{ url('send-message')}}" method="post" id="user_message_form">
			  {{ csrf_field() }}

				<div class="form-group">
				  <textarea name="business_message" id="business_message" class="form-control" placeholder="Type here" data-validation="required"></textarea>
				</div>

				</div>
				<div class="modal-footer">
				<input type="hidden" name="business_number" id="hid_business_number" value="">
			  <input type="hidden" name="business_id" id="hid_message_business_id" value="">
				  <button class="btn btn-primary float-right" type="submit">Send</button>
				  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				</div>
			</form>
        </div>
      </div>
    </div>
  </div>

    <!-- /content -->
@endsection
@section('extracontent')
<script src="{{ url('public/front-assets/') }}/javascripts/jquery.form-validator.js"></script>
<script src="{{ url('public/js/share.js') }}"></script>
<script>
$.validate({
    form : '#user_review_form'
  });
$.validate({
    form : '#user_message_form'
  });

$('#home_page').val(1);
$('.load-more').click(function () {
var homepage = parseInt($('#home_page').val());
var home_max_page = parseInt($('#home_max_page').val());
if (homepage < home_max_page) {
    $('#home_page').val(homepage + 1);
	getBusinessPosts();
	$('#end_of_page').hide();
} else {
	$('#end_of_page').fadeIn();
}
});
function getBusinessPosts() {
var currentURL=location.protocol + '//' + location.host + location.pathname;
var fullUrl = "{{ url()->full() }}";
fullUrl = fullUrl.replace(/&amp;/gi, '&');
$('.load-more').html("Loading items...");
var homepage = "#home_page";
   // fullUrl = fullUrl.replace('search', 'searchmore');
   if(fullUrl == currentURL){
	var serviceUrl = fullUrl +'?page='+ $(homepage).val();
   }else{
	var serviceUrl = fullUrl +'&page='+ $(homepage).val();
   }
	console.log(serviceUrl);
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	});

	$.ajax({
		url: serviceUrl,
		type: 'post',
		data: {
				data: JSON.stringify({
				'type': 'ajax'
			})
		},
		success: function (result) {
		   // alert(result.result.institute);
		   var homepage = $('#home_page').val();
		   var homemaxpage = $('#home_max_page').val();
		   if(homepage != homemaxpage){
		    $('.load-more').html('<a href="javascript:;" class="btn btn-link button2 load-more">Load more<i class="fas fa-angle-down ml-2"></i></a>');
		   }else{
			$('.load-more').html('');
		   }
		   //fullUrl = fullUrl.replace('searchmore', 'search');
		   $(".business-loader").append(result.result);


		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			$('#loading').remove();
			//alert('asdf');
			$('.loading-more').html('<a href="javascript:;" class="btn btn-link button2 load-more">Load more<i class="fas fa-angle-down ml-2"></i></a>');
		}
	});

}
function clickUserLike(data_busisiness_id,data_user_id,data_user_type) {
	var data_busisiness_id = data_busisiness_id
		var data_user_id = data_user_id;
		var serviceUrl = BASE_URL + '/business/user/like';
		if(data_user_id != 0){
			if(data_user_type == 1){

				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
					}
				});
				var objData = {};
				var sendData = {};
				sendData = {
					data_busisiness_id: data_busisiness_id,
					data_user_id: data_user_id,
					};
					objData = {
				      url: serviceUrl,
					  type: 'post',
					  sendData: sendData
					 };
					send_ajax_request(objData, function (callback) {
					  if (callback.status == "200") {
						$("#thumbs_up_"+data_busisiness_id).html('<i class="far fa-thumbs-up mr-2"></i>'+ callback.result);
					  }
					 });
				}else{
					toastr.error("You need to login with normal user to like this account.");
					return false;
				}
		}else{
			//alert('You need to login to vote');
			toastr.error("You need to login to vote");
			return false;
		}

};
function clickUserUnLike(data_busisiness_id,data_user_id,data_user_type) {
	    var data_busisiness_id = data_busisiness_id
		var data_user_id = data_user_id;
		var serviceUrl = BASE_URL + '/business/user/unlike';
		if(data_user_id !== 0){
			if(data_user_type == 1){

			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				}
			});
			var objData = {};
			var sendData = {};
			sendData = {
				data_busisiness_id: data_busisiness_id,
				data_user_id: data_user_id,
				};
				objData = {
			      url: serviceUrl,
				  type: 'post',
				  sendData: sendData
				 };
				send_ajax_request(objData, function (callback) {
				  if (callback.status == "200") {
					$("#thumbs_down_"+data_busisiness_id).html('<i class="far fa-thumbs-down mr-2"></i>'+ callback.result);
				  }
				 });
				}else{
					toastr.error("You need to login with normal user to unlike this account.");
					return false;
				}
		}else{
			//alert('You need to login to vote');
			toastr.error("You need to login to vote");
			return false;
		}

};
function clickRecommendation(data_busisiness_id,data_user_id,data_user_type,data_review_count){
	        var data_busisiness_id = data_busisiness_id
			var data_user_id = data_user_id;
			var data_user_type = data_user_type;
			var data_review_count = data_review_count;
			if(data_user_id != 0){
				if(data_user_type == 1){
		         if(data_review_count == 0){
					$('#recommendation').modal('show', {backdrop: 'static'});
					$('#hid_business_id').val(data_busisiness_id);
					}else{
						toastr.error("You have already reviewed this tradie.");
						return false;
						}
					}else{
						toastr.error("You need to login normal user then leave a recommendation.");
						return false;
					}
			}else{
				toastr.error("You need to login first then leave a recommendation");
				//alert('You need to login first then leave a recommendation');
				return false;
			}

}


function clickMessage(busisiness_id,data_user_id,busisiness_number){
		var data_busisiness_number = busisiness_number
		var data_busisiness_id = busisiness_id;
		var data_user_id = data_user_id;
		if(data_user_id != 0){
			if(data_busisiness_id != 0){
				if(data_busisiness_number != 0){
					$('#sendMessage').modal('show', {backdrop: 'static'});
					$('#hid_business_number').val('+'+data_busisiness_number);
					$('#hid_message_business_id').val(data_busisiness_id);

					}else{
						toastr.error("please update Number.");
						return false;
					}
			}else{
				toastr.error("Your busisiness id is empty");
				return false;
			}
		}else{
			toastr.error("You need to login first then leave a Message");
			return false;
		}

}

$('#rating a').on('click', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently selected
	var stars = $(this).parent().children('a.star');
    $("#hid_rating").val(onStar);
    for (i = 0; i < stars.length; i++) {
      $(stars[i]).html('<i class="far fa-star text-gray"></i>');
    }
    for (i = 0; i < onStar; i++) {
      $(stars[i]).html('<i class="fa fa-star"></i>');
    }
 });
 $('#rating-filter').on('change', function(){
    $('#get-filter-form').submit();
	 });
  $('#sub-categories').on('change', function(){
	  $('#get-filter-form').submit();
	});

 $('#only-friend-recommendation').on('click', function(){
	var val = $(this).attr('data-user-id');
	if(val != ''){
		if ($('#only-friend-recommendation').hasClass('active')) {
		   $('#onlyfrnrec').val('');
		   $('#get-filter-form').submit();
		}else{
			$('#onlyfrnrec').val(val);
		   $('#get-filter-form').submit();
		}
	}else{
	 toastr.error("You need to login first then filter by only friend recommendations");
	 return false;
	}

 });

  $('#onlyme-filter').on('click', function(){
    var val = $(this).attr('data-user-id');
	if(val != ''){
		if ($('#onlyme-filter').hasClass('active')) {
		   $('#onlyme').val('');
	       $('#get-filter-form').submit();
		}else{
			$('#onlyme').val(val);
	        $('#get-filter-form').submit();
		}

	}else{
	 toastr.error("You need to login first then filter by only me");
	 return false;
	}

 });
   $('#all-filter').on('click', function(){
	 $('#rating-filter').val('');
	 $('#only-friend-recommendation').val('');
	 $('#onlyme-filter').val('');
	 $('#onlyme').val('');
	 $('#onlyfrnrec').val('');
     $('#get-filter-form').submit();

 });
  $('.social-share').on('click', function(){
	 var data_href = $(this).attr('data-href');
	 var data_business_id = $(this).attr('data-business-id');
	 if(data_href !=''){
		 $('#sharepopup').modal('show', {backdrop: 'static'});
		 $("#show_share").html('Loading ..');
		 var serviceUrl = BASE_URL + '/business/user/share';
		 var objData = {};
			var sendData = {};
			sendData = {
				data_href : data_href,
				data_business_id : data_business_id
				};
				objData = {
			      url: serviceUrl,
				  type: 'post',
				  sendData: sendData
				 };
				send_ajax_request(objData, function (callback) {
				  if (callback.status == "200") {
					$("#show_share").html('');
					$("#show_share").html(callback.result);
				  }
				 });
     }
 });
$("body").on('keyup', '#categories', function () {
	$('#hid_type').val('');
 });
 $("body").on('keyup', '#categories-top', function () {
	$('#hid_type_top').val('');
 });
 $('.callusButton').on('click', function(){
    var data_business_id = $(this).attr('data_business_id');
	var data_phone = $(this).attr('data_phone');
	if(data_phone !=''){
		 $.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				}
			});
		  var serviceUrl = BASE_URL + '/search/click/callusButton';
		  var objData = {};
			var sendData = {};
			sendData = {
				data_business_id : data_business_id
				};
				objData = {
			      url: serviceUrl,
				  type: 'post',
				  sendData: sendData
				 };
				send_ajax_request(objData, function (callback) {
				 if (callback.status == "200") {
					 $('#hidcallusButton_'+data_business_id)[0].click();
				  }
				 });
	 }
 });
  $('.emailusButton').on('click', function(){
    var data_business_id = $(this).attr('data_business_id');
	var data_email = $(this).attr('data_email');
	if(data_email !=''){
		 $.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				}
			});
		  var serviceUrl = BASE_URL + '/search/click/emailusButton';
		  var objData = {};
			var sendData = {};
			sendData = {
				data_business_id : data_business_id
				};
				objData = {
			      url: serviceUrl,
				  type: 'post',
				  sendData: sendData
				 };
				send_ajax_request(objData, function (callback) {
				 if (callback.status == "200") {
					 $('#hidEmailUsButton_'+data_business_id)[0].click();
				  }
				 });
	 }
 });
  $('.websiteButton').on('click', function(){
    var data_business_id = $(this).attr('data_business_id');
	var data_website = $(this).attr('data_website');
	if(data_website !=''){
		 $.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				}
			});
		  var serviceUrl = BASE_URL + '/search/click/websiteButton';
		  var objData = {};
			var sendData = {};
			sendData = {
				data_business_id : data_business_id
				};
				objData = {
			      url: serviceUrl,
				  type: 'post',
				  sendData: sendData
				 };
				send_ajax_request(objData, function (callback) {
				 if (callback.status == "200") {
					 $('#hidWebsiteButton_'+data_business_id)[0].click();
				  }
				 });
	 }
 });
 function clickFriendRecommendation(business_id){
	 var business_id=business_id;
	 var chkStatus = $('#friend-recommendation-'+business_id).attr('data-status');
	 if(chkStatus == ''){
	    $('#friend-recommendation-'+business_id).removeClass('d-none');
		$('#friend-recommendation-'+business_id).attr('data-status',1);
	 }else{
		$('#friend-recommendation-'+business_id).addClass('d-none');
		$('#friend-recommendation-'+business_id).attr('data-status','');
	 }
 }


</script>
@endsection
