@extends('layouts.front-end.app')
@section('content')
@php
 $businessSlug = !empty($objBusinessList->business_slug) ? url('business').'/'.$objBusinessList->business_slug : '';
 $userId = !empty($user) ? $user->id : 0;
 $userType = !empty($user) ? $user->user_type : 1;
 $getObjBusinessListReview = \App\BusinessListReview::where('business_id',$objBusinessList->id)->where('user_id',$userId)->first();
   if(!empty($getObjBusinessListReview)){
	   $userReviewCount = 1;
   }else{
	   $userReviewCount = 0;
   }
   $objBusinessEmail = \App\User::where('id',$objBusinessList->user_id)->where('user_type',2)->first();
   $friendRecommendationListText = '';
    if(!empty($objFriendRecommendation[0]))
	   foreach($objFriendRecommendation as $friendRecommendation) {
		$friendRecommendationListText .= $friendRecommendation->user_name.', ';
	   }
	   if($friendRecommendationListText != '')
	   $friendRecommendationListText = substr($friendRecommendationListText, 0, -2);

 @endphp
    <!-- page-head-search -->
     @include('search-form')
    <!-- /page-head-search -->
    <!-- Content -->
    <div id="content" class="mb-5">
      <section class="section tradie-page">
        <div class="container">
          <div class="row">
            <main id="main" class="col-lg-8 pr-lg-5">
              <div class="service-box">
                <div class="service-img">
				<a href="{{ !empty($objBusinessList->business_slug) ? url('business').'/'.$objBusinessList->business_slug : '#' }}">
					@if(!empty($objBusinessList->business_image))
						<img class="img-fluid" src="{{ $objBusinessList->business_image }}" alt="{{ $objBusinessList->business_name }}">
					  @else
						<img class="img-fluid" src="{{ url('public/')}}/front-assets/images/trade-icon.png" alt="butterfield">
					  @endif
			    </a>

                </div>

				<div class="service-content">
                    <div class="left mr-sm-3">
                      <h4><a href="{{ !empty($objBusinessList->business_slug) ? url('business').'/'.$objBusinessList->business_slug : '#' }}">
					  {{ $objBusinessList->business_name }}  @if(!empty($objBusinessList->callout))- <span class="status text-warning">{{ $objBusinessList->callout }}</span><i class="fas fa-check-circle ml-1"></i>@endif</a></h4>
                      <div class="rating d-flex justify-content-start align-items-md-center mb-2">
                        <ul class="list-unstyled">
						<li><a href="#"><i class="
						  <?php
						  if($objBusinessList->business_rating == 0) {
							  echo 'fa fa-star text-gray';
						  }else	{
							 if($objBusinessList->business_rating > 0 && $objBusinessList->business_rating < 1){
								 echo 'fa fa-star-half-alt';
							 }else{
								 echo 'fa fa-star';
							 }
						  }
						?>
						"></i></a></li>
                         <li><a href="#"><i class="
						 <?php
						 if($objBusinessList->business_rating > 1 && $objBusinessList->business_rating < 2){
							 echo 'fa fa-star-half-alt';
						 }else{
							 if($objBusinessList->business_rating >= 2){
								echo 'fa fa-star';
							 }else{
								 echo 'fa fa-star text-gray';
							 }
						 }
						 ?>
						 "></i></a></li>
						  <li><a href="#"><i class="
						  <?php
						  if($objBusinessList->business_rating > 2 && $objBusinessList->business_rating < 3){
							  echo 'fas fa-star-half-alt';
						  }else{
							  if($objBusinessList->business_rating >= 3){
							  echo 'fa fa-star';
							  }else{
								  echo 'fa fa-star text-gray';
							  }
						  }
						  ?>"></i></a></li>
						  <li><a href="#"><i class="
						  <?php
						  if($objBusinessList->business_rating > 3 && $objBusinessList->business_rating < 4){
							  echo 'fa fa-star-half-alt';
						  }else{
							  if($objBusinessList->business_rating >= 4){
							  echo 'fa fa-star';
							  }else{
							  echo 'fa fa-star text-gray';
							  }
						  }
						  ?>"></i></a></li>
						  <li><a href="#"><i class="
						  <?php if($objBusinessList->business_rating > 4 && $objBusinessList->business_rating < 5){
							  echo 'fa fa-star-half-alt';
						  }else{
							  if($objBusinessList->business_rating >= 5){
								echo 'fa fa-star';
							  }else{
								echo 'fa fa-star text-gray' ;
							  }
						  };?>"></i></a></li>

                        </ul>
                        <div class="reviews ml-2">
                          <a href="#">({{ $objBusinessList->business_review_count }})</a>
                        </div>
                      </div>
                      <div class="service-provider">
                        <p><a href="{{ url('view-categories')}}">{{ $objBusinessList->category_name }}</a></p>
                      </div>
                      <ul class="contact-info mb-1">
                        <li><i class="fas fa-map-marker-alt"></i> {{ !empty($objBusinessList->business_city) ? $objBusinessList->business_city : '-' }} <a target="_blank" href="https://www.google.com/maps?z=12&t=m&q=loc:{{ $objBusinessList->business_lattitude }}+{{ $objBusinessList->business_longitude }}">Location<i
                              class="fas fa-directions ml-1"></i></a></li>
                        <li><i class="far fa-clock mr-1"></i>{{ !empty($objBusinessList->business_default_hours) ? $objBusinessList->business_default_hours : '7AM - 5PM' }}
						<a href="javascript:;" data-id="{{$objBusinessList->id  }}" class="viewWorkingHoursModal">View working hours</a>
						</li>
                      </ul>
                      <p>
					  @if($userId == 0)
						<a><b>Login to see your friends recommendations</b></a>
					  @else
						@php $friendReviewText = "";@endphp
						@if($objFriendRecommendationCount != 0)
						 @if($objFriendRecommendationCount == 1)
								@php $friendReviewText = "Person"; @endphp
							@else
								@php $friendReviewText = "people"; @endphp
							@endif
						    <a href="#friend-slide" title = "{{ $friendRecommendationListText }}"><u>{{ $objFriendRecommendationCount.' '.$friendReviewText }}</u> you might know refer or recommend this business</a>
					    @endif
					  @endif
					  </p>
                      <div class="user-block text-left">
                        <a href="javascript:;" class="btn btn-outline-success mr-2" onClick="clickRecommendation({{ $objBusinessList->id }},{{ $userId }},{{ $userType }},{{ $userReviewCount }})"><i class="far fa-edit mr-2"></i>Leave a
                          Recommendation</a>
                        <a href="javascript:;" class="btn btn-outline-secondary btn-share social-share" data-href="{{$businessSlug }}" data-business-id="{{ $objBusinessList->id }}"><i class="fas fa-share-square mr-2"></i>Share</a>
                       <!-- <a href="#" class="btn btn-outline-secondary btn-share" data-href="{{$businessSlug }}" data-business-id="{{ $objBusinessList->id }}"><i class="fas fa-share-square mr-2"></i>Share</a>-->
						<a href="javascript:;" class="btn btn-link btn-like thumbs_up" data-busisiness-id ="{{ $objBusinessList->id }}" data-user-id ="{{ $userId }}" data-user-type="{{ $userType }}" data-user-count="{{ $likeCount }}"><i class="far fa-thumbs-up mr-2"></i>{{ $likeCount }}</a>
                        <a href="javascript:;" class="btn btn-link btn-dislike thumbs_down" data-busisiness-id ="{{ $objBusinessList->id }}" data-user-id ="{{ $userId }}" data-user-type="{{ $userType }}" data-user-count="{{ $unlikeCount }}"><i class="far fa-thumbs-down mr-2"></i>{{ $unlikeCount }}</a>
                      </div>
                    </div>
                   <div class="right">
                      <ul class="list-unstyled user-links mb-sm-3">
					  @if(!empty($objBusinessList->business_phone))
                        <li>
						 <a href="javascript:;" class="tel callusButton" id="callusButton-{{ $objBusinessList->id }}" data_business_id="{{ $objBusinessList->id }}" data_phone="{{ $objBusinessList->business_phone }}">
						   <span><i class="fas fa-phone fa-rotate-90"></i></span>
							Call
						 </a>
						 <a href="tel:{{ $objBusinessList->business_phone }}" class="tel " id="hidcallusButton"></a>
						</li>
						@endif
						@if(!empty($objBusinessList->business_phone))
						<li><a href="javascript:;" onClick="clickMessage({{ $objBusinessList->id }},{{ $userId }},{{ preg_replace('/\s+/', '', $objBusinessList->business_phone) }})"  class="email"><span><i class="fas fa-envelope"></i></span>Message</a></li>
                        @endif
						@if(!empty($objBusinessList->email))
						<li>
						<a href="javascript:;" class="comment emailusButton" data_business_id="{{ $objBusinessList->id }}" data_email="{{ !empty($objBusinessList->email) ? $objBusinessList->email : 'pluckit20@gmail.com' }}" target="_blank"><span><i class="far fa-comment-dots"></i></span>Email
						  </a>
						  <a href="mailto:{{ !empty($objBusinessList->email) ? $objBusinessList->email : 'pluckit20@gmail.com' }}" class="comment " id="hidEmailUsButton" target="_blank"></a>
					     </li>
						 @endif
						 @if(!empty($objBusinessList->business_website_url))
                        <li>
						@if(!empty($objBusinessList->business_website_url))
							<a href="https://{{ $objBusinessList->business_website_url }}" data_business_id="{{ $objBusinessList->id }}" data_website="{{ !empty($objBusinessList->business_website_url) ? $objBusinessList->business_website_url : '' }}" class="globe websiteButton" target="_blank">
							<span><i class="fas fa-globe"></i></span>Website
							</a>
						@endif
						<a href="https://{{ $objBusinessList->business_website_url }}" class="globe " id="hidWebsiteButton" target="_blank"></a>
						</li>
						@endif
                      </ul>
					   @if(!empty($objBusinessList->business_review_url))
						  <div class="rating rating-trustpilot">
							<a href="{{ $objBusinessList->business_review_url }}" target="_blank">
								<img class="img-fluid" src="{{ ('/public') }}/front-assets/images/trustpilot.svg" alt="Trustpilot">
							</a>
							<ul class="list-unstyled ml-1">
								<li><a href="#"><i class="
						  <?php
						  if($objBusinessList->business_rating == 0) {
							  echo 'fa fa-star text-gray';
						  }else	{
							 if($objBusinessList->business_rating > 0 && $objBusinessList->business_rating < 1){
								 echo 'fa fa-star-half-alt';
							 }else{
								 echo 'fa fa-star';
							 }
						  }
						?>
						"></i></a></li>
                         <li><a href="#"><i class="
						 <?php
						 if($objBusinessList->business_rating > 1 && $objBusinessList->business_rating < 2){
							 echo 'fa fa-star-half-alt';
						 }else{
							 if($objBusinessList->business_rating >= 2){
								echo 'fa fa-star';
							 }else{
								 echo 'fa fa-star text-gray';
							 }
						 }
						 ?>
						 "></i></a></li>
						  <li><a href="#"><i class="
						  <?php
						  if($objBusinessList->business_rating > 2 && $objBusinessList->business_rating < 3){
							  echo 'fas fa-star-half-alt';
						  }else{
							  if($objBusinessList->business_rating >= 3){
							  echo 'fa fa-star';
							  }else{
								  echo 'fa fa-star text-gray';
							  }
						  }
						  ?>"></i></a></li>
						  <li><a href="#"><i class="
						  <?php
						  if($objBusinessList->business_rating > 3 && $objBusinessList->business_rating < 4){
							  echo 'fa fa-star-half-alt';
						  }else{
							  if($objBusinessList->business_rating >= 4){
							  echo 'fa fa-star';
							  }else{
							  echo 'fa fa-star text-gray';
							  }
						  }
						  ?>"></i></a></li>
						  <li><a href="#"><i class="
						  <?php if($objBusinessList->business_rating > 4 && $objBusinessList->business_rating < 5){
							  echo 'fa fa-star-half-alt';
						  }else{
							  if($objBusinessList->business_rating >= 5){
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
			  <div class="top-search d-none" id="friend-recommendation-{{ $objBusinessList->id }}" data-status=''>
                      <!-- review-list -->

                      <div class="review-list mt-lg-4">
					  @if(!empty($objFriendRecommendation[0]))
						  <p class="lead">{{ $objFriendRecommendationCount.' '.$friendReviewText }} you might know refer or recommend this business</p>
                        @foreach($objFriendRecommendation as $friendRecommendation)
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

              <hr />

              <!--Tabs-->
              <div class="nav-wrap my-5">
                <ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="pills-about-tab" data-toggle="pill" href="#pills-about" role="tab"
                      aria-controls="pills-about" aria-selected="true">ABOUT</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="pills-services-tab" data-toggle="pill" href="#pills-services" role="tab"
                      aria-controls="pills-services" aria-selected="false">SERVICES</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="pills-photos-tab" data-toggle="pill" href="#pills-photos" role="tab"
                      aria-controls="pills-photos" aria-selected="false">PHOTOS</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="pills-certificates-tab" data-toggle="pill" href="#pills-certificates"
                      role="tab" aria-controls="pills-certificates" aria-selected="false">CERTIFICATES</a>
                  </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="pills-about" role="tabpanel" aria-labelledby="pills-about-tab">
				  <h5>About</h5>
				 <?php echo !empty($objBusinessList->business_about) ? $objBusinessList->business_about : '';?>
                   <!-- <div class="media mb-3">
                      <img class="img-fluid mr-3" src="{{ url('public/front-assets/images') }}/avatar.png" alt="Avatar">
                      <div class="media-body">
                        <h6>Will Smith</h6>
                        <p>Business Owner</p>
                      </div>
                    </div>
                    <p>Will has over 19yrs experience in Roof Tiling and his business Hampton Park Roofing offers a
                      range
                      of services for all your roofing needs. Our business is fully insurance with a warranty on all
                      workmanship that is completed. Based out of Narre Warren South but we service all areas of
                      Melbourne.</p>-->
                  </div>
                  <div class="tab-pane fade" id="pills-services" role="tabpanel" aria-labelledby="pills-services-tab">
                    <h5>SERVICES</h5>
					<?php echo !empty($objBusinessList->business_services) ? $objBusinessList->business_services : '' ;?>
                  </div>
                  <div class="tab-pane fade" id="pills-photos" role="tabpanel" aria-labelledby="pills-photos-tab">
                    <h5>PHOTOS</h5>
                   <div class="gallery mt-md-4">
				   @if(!empty($objBusinessList->image))
                   <ul>
						@foreach($objBusinessList->image as $image)
						  <li>
							  <a data-fancybox="images" href="{{ $image->business_photo }}"><img src="{{ $image->business_photo }}" alt="Image" class="img-fluid"></a>
						  </li>
						  @endforeach
                   </ul>
				   @endif
                   </div>
                  </div>
                  <div class="tab-pane fade" id="pills-certificates" role="tabpanel"
                    aria-labelledby="pills-certificates-tab">
                    <h5>CERTIFICATES</h5>
					<div class="gallery mt-md-4">
				   @if(!empty($objBusinessList->certificate))
                   <ul class="match-height">
						@foreach($objBusinessList->certificate as $image)
						@if(substr(strrchr($image->business_cerificate,'.'),1) == 'pdf')
							@php $certificateImage = url('public/front-assets/images/default-image.jpg'); @endphp
						@else
							@php $certificateImage = $image->business_cerificate; @endphp
						@endif

						 <li>
							 <a data-fancybox="cerificate-images" href="{{ $image->business_cerificate }}">
							    <img src="{{ $certificateImage }}" alt="Image" class="img-fluid">
							 </a>
						  </li>
						  @endforeach
                   </ul>
				   @endif
                   </div>
                  </div>
                </div>
              </div>
              <!--/Tabs-->
            <!-- review-list -->
			  @if(!empty($objFriendRecommendation[0]))
              <h5>Friends Recommendation</h5>
              <div class="review-list mb-lg-4" id="friend-slide">
			  @foreach($objFriendRecommendation as $friendRecommendation)
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

              </div>

              <!-- /review-list -->
              <hr class="mb-lg-4">
			  @endif
              <!-- review-list -->

			   @if(!empty($objBusinessReviews[0]))
              <h5>Recent Reviews</h5>

              <div class="review-list mt-lg-4">

                    @foreach($objBusinessReviews as $review)
					  @php $getObjUser = \App\User::where('id',$review->user_id)->first(); @endphp
                        <div class="box bg-gray-light box-shadow">
                            <div class="media">
                                <figure class="figure2 mr-3">
                                <img class="img-fluid" src="{{ (!empty($getObjUser->user_image)) ? $getObjUser->user_image : url('/public/front-assets/images/default-profile.jpg') }}" alt="Avatar">
                                </figure>
                                <div class="media-body">
                                <h6>{{ $review->user_name }} <span class="review-date">{{ date("M d, Y",strtotime($review->review_time_created)) }}</span></h6>
                                <div class="rating">
                                    <ul class="list-unstyled">
										<li><a href="#"><i class="
										  <?php
										  if($review->rating == 0) {
											  echo 'fa fa-star text-gray';
										  }else	{
											 if($review->rating > 0 && $review->rating < 1){
												 echo 'fa fa-star-half-alt';
											 }else{
												 echo 'fa fa-star';
											 }
										  }
										?>
										"></i></a></li>
										 <li><a href="#"><i class="
										 <?php
										 if($review->rating > 1 && $review->rating < 2){
											 echo 'fa fa-star-half-alt';
										 }else{
											 if($review->rating >= 2){
												echo 'fa fa-star';
											 }else{
												 echo 'fa fa-star text-gray';
											 }
										 }
										 ?>
										 "></i></a></li>
										  <li><a href="#"><i class="
										  <?php
										  if($review->rating > 2 && $review->rating < 3){
											  echo 'fas fa-star-half-alt';
										  }else{
											  if($review->rating >= 3){
											  echo 'fa fa-star';
											  }else{
												  echo 'fa fa-star text-gray';
											  }
										  }
										  ?>"></i></a></li>
										  <li><a href="#"><i class="
										  <?php
										  if($review->rating > 3 && $review->rating < 4){
											  echo 'fa fa-star-half-alt';
										  }else{
											  if($review->rating >= 4){
											  echo 'fa fa-star';
											  }else{
											  echo 'fa fa-star text-gray';
											  }
										  }
										  ?>"></i></a></li>
										  <li><a href="#"><i class="
										  <?php if($review->rating > 4 && $review->rating < 5){
											  echo 'fa fa-star-half-alt';
										  }else{
											  if($review->rating >= 5){
												echo 'fa fa-star';
											  }else{
												echo 'fa fa-star text-gray' ;
											  }
										  };?>"></i></a></li>
                                    </ul>
                                </div>
                                </div>
                            </div>
                            <div class="review-content">
                                 @php $str =  "The user didn't write a review, and has left just a rating."; @endphp
					             <p>{{ !empty($review->review_text) ? '“'.$review->review_text.'”': '“'.htmlspecialchars_decode($str, ENT_QUOTES).'”' }}</p>
                            </div>
                        </div>
                    @endforeach

              </div>
			  @endif
			  <div class="ht-80 bd d-flex align-items-center justify-content-end">
					<ul class="pagination pagination-basic pagination-primary mg-r-10">
						{{ $objBusinessReviews->links() }}
					</ul>
				</div>
              <!-- /review-list -->
              <div class="text-center d-none">
                <a href="#" class="btn btn-link button2">Load more<i class="fas fa-angle-down ml-2"></i></a>
              </div>
            </main>
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
						<img class="img-fluid" src="{{ url('public/') }}/front-assets/images/user.png" alt="Avatar">
					 @endif
                    </figure>
                    <div class="media-body">
                      <h6>{{ $yowMightKnow->name }}</h6>
                      <p><a href="javascript:;" class="user_add_to_contact" id="user_add_to_contact_{{ $yowMightKnow->id }}" onClick="clickUserAddToContact({{ $yowMightKnow->id }})"><i class="fas fa-user-plus mr-1"></i>Add to my Network</a></p>
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
					   @if($relatedBusinessList->id != $objBusinessList->id)
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
						@endif
                    @endforeach
                </ul>
              </div>
              @endif

            </aside>
          </div>
        </div>
      </section>
    </div>
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
<!-- /Modal -->
<div class="modal fade" id="recommendation">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-wrap">
          <div class="modal-header border-0 align-items-center">
            <h4 class="modal-title">Leave a Recommendation</h4>
            <button type="button" class="close close_recommendation" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body pt-0">
            <form class="form" action="{{ url('business/user/review')}}" method="post" enctype="multipart/form-data" id="user_review_form" onsubmit="return false">
                  {{ csrf_field() }}
                    <div class="form-group">
                      <textarea name="review" id="review" class="form-control review_cancel" placeholder="Type here" required data-parsley-minlength="5" data-parsley-maxlength="200" data-parsley-minlength-message="You need to enter at least a 5 character comment.."></textarea>
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
                      <button class="btn btn-primary float-right button_submit" type="submit">Submit</button>
                      <button type="button" class="btn btn-secondary cancel_recommendation" data-dismiss="modal">Cancel</button>
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
<script src="{{ ('/public') }}/front-assets/lib/parsleyjs/parsley.min.js"></script>
<script src="{{ url('public/front-assets/') }}/javascripts/jquery.form-validator.js"></script>
<script src="{{ url('public/js/share.js') }}"></script>
<script>
//$('#user_review_form').parsley();

  $.validate({
    form : '#user_message_form'
  });


  $('#hidcallusButton').trigger('click');
  $('#hidcallusButton').click();
$('.thumbs_up').click(function () {
	var data_busisiness_id = $(this).attr('data-busisiness-id');
	var data_user_id = $(this).attr('data-user-id');
	var data_user_type = $(this).attr('data-user-type');
	var data_user_count = $(this).attr('data-user-count');
    var serviceUrl = BASE_URL + '/business/user/like';
	if(data_user_id != 0){
		if(data_user_type == 1){
			if(data_user_count == 0){
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
						$(".thumbs_up").html('<i class="far fa-thumbs-up mr-2"></i>'+ callback.result);
					  }
					 });
				}else{
					toastr.error("You have already voted this tradie.");
					return false;
				}
		}else{
			toastr.error("You need to login with normal user to like this account.");
			return false;
		}
	}else{
		toastr.error("You need to login to vote");
		return false;
	}

});
$('.thumbs_down').click(function () {
	var data_busisiness_id = $(this).attr('data-busisiness-id');
	var data_user_id = $(this).attr('data-user-id');
	var data_user_type = $(this).attr('data-user-type');
	var data_user_count = $(this).attr('data-user-count');
    var serviceUrl = BASE_URL + '/business/user/unlike';
	if(data_user_id != 0){
		if(data_user_type == 1){
			if(data_user_count == 0){
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
					$(".thumbs_down").html('<i class="far fa-thumbs-down mr-2"></i>'+ callback.result);
				  }
				 });
				}else{
					toastr.error("You have already voted this tradie.");
					return false;
				}
		}else{
			toastr.error("You need to login with normal user to unlike this account.");
			return false;
		}
	}else{
		toastr.error("You need to login to vote");
		return false;
	}
});
function clickUserAddToContact(data_user_id) {
	    var data_user_id = data_user_id
		var serviceUrl = BASE_URL + '/user/add-to-contact';
		if(data_user_id != 0){
			$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
					}
				});
				var objData = {};
				var sendData = {};
				sendData = {
					data_user_id: data_user_id,
					};
					objData = {
				      url: serviceUrl,
						type: 'post',
						sendData: sendData
					 };
					send_ajax_request(objData, function (callback) {
						if (callback.status == "200") {
							toastr.success(callback.message);
							$('#select_user_'+data_user_id).remove();
							var count_user = $('#check_user_parent ul').children("li").length;
							if(count_user == 0){
								$('.check_parent_people').remove();
							}
							 return false;
						}else{
							toastr.success("Something Wents wrong");
				            return false;
						}
					 });


		}else{
			toastr.error("Something wents wrong!");
			return false;
		}

};
function clickRecommendation(data_busisiness_id,data_user_id,data_user_type,data_review_count){
	        var data_busisiness_id = data_busisiness_id
			var data_user_id = data_user_id;
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



function clickShareSocial(data_href){
	 var data_href = data_href;
	 alert(data_href);
	 $('#sharepopup').modal('show', {backdrop: 'static'});
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
				data_href: data_href,
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
	var windowWidth = $(window).width();
	if(data_phone !=''){
		 $.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				}
			});
		  var serviceUrl = BASE_URL + '/business/click/callusButton';
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
					 if(windowWidth <= 767){
						  $('#hidcallusButton')[0].click();
					  }else{
					      $('#callusButton-'+data_business_id).html('<span><i class="fas fa-phone fa-rotate-90"></i></span> '+data_phone);
					  }
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
		  var serviceUrl = BASE_URL + '/business/click/emailusButton';
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
					 $('#hidEmailUsButton')[0].click();
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
		  var serviceUrl = BASE_URL + '/business/click/websiteButton';
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
					 //$('#hidWebsiteButton')[0].click();
				  }
				 });
	 }
 });
  $('.cancel_recommendation').on('click',function(){
	$('.review_cancel').val('');
 });
 $('.close_recommendation').on('click',function(){
	$('.review_cancel').val('');
 });
 $(".button_submit").on('click', function(){
	 if ($('#user_review_form').parsley().validate() == true) {
		 $(".button_submit").html('Loading...');
		 $('#user_review_form').attr('onsubmit','return true');
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
