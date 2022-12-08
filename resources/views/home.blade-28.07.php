@extends('layouts.front-end.app')

@section('content')
<!-- Banner -->
<div id="banner" class="overlay">
    <img class="img-fluid" src="{{ ('/public') }}/front-assets/images/banner.jpg" alt="">
    <div class="description absolute-center">
     <div class="container">
	   <h1>Find a Pluckin’ Tradie. <br class="d-md-block d-none">See who your friends recommend</h1>
		<form class="form" method="get" action="{{ url('/search')}}" >
		  <ul class="list-unstyled clearfix">
			<li class="categories icon">
				<input type="text" class="form-control" id="categories" name="cat" placeholder="Find Your Category Or Business" value="{{ !empty($get['cat']) ? $get['cat'] : '' }}">
				  <span class="loader loader-category d-none">
					<i class="fa fa-spin fa-spinner"></i>
				  </span>
				</li>
			<li class="location icon">
			  <input type="text" class="form-control" id="location" name="loc" placeholder="Find Your Location" value="{{ !empty($get['loc']) ? $get['loc'] : '' }}">
			  <span class="loader loader-location d-none">
				  <i class="fa fa-spin fa-spinner"></i>
			  </span>
			</li>
			<li>
			<input type="hidden" name="hid_type" id="hid_type" value="{{ !empty($get['hid_type']) ? $get['hid_type'] : '' }}">
			<button type="submit" class="btn btn-primary">See Recommendations</button></li>
		  </ul>
		</form>
		</div>
    </div>
    <div class="footer-text text-center d-none d-md-block">
      <div class="container position-relative">
        <p class="d-md-inline-block mb-md-0"><strong>For Tradies - Claim Your Business </strong></p>
        <a href="{{ url('business/user/signup') }}" class="btn btn-primary ml-md-3">START NOW</a>
      </div>
    </div>
  </div>
  <!-- /Banner -->
  <!-- Content -->
  <div id="content" class="pt-0">
    <!-- Section -->
    <section class="section bg-gray-light featured-services">
      <div class="container custom-container">
        <div class="row">
          <div class="col-sm-6 col-lg-3">
            <div class="media">
             <figure class="figure">
               <img class="img-fluid align-self-center" src="{{ ('/public') }}/front-assets/images/icon/shield-check.png" alt="shield-check
              "></figure>
              <div class="media-body">
                <h5 class="mb-1">Verified Reviews</h5>
                <p class="mb-0">From verified reviewers</p>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="media">
            <figure class="figure">
              <img class="img-fluid align-self-center" src="{{ ('/public') }}/front-assets/images/icon/recommendations.png" alt="shield-check
              ">
            </figure>
              <div class="media-body">
                <h5 class="mb-1">Friend Recommendations</h5>
                <p class="mb-0">Helps you decide</p>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="media">
            <figure class="figure">
              <img class="img-fluid align-self-center" src="{{ ('/public') }}/front-assets/images/icon/pencil.png" alt="shield-check
              ">
            </figure>
              <div class="media-body">
                <h5 class="mb-1">Write Reviews</h5>
                <p class="mb-0">Share your experience</p>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="media">
            <figure class="figure">
              <img class="img-fluid align-self-center" src="{{ ('/public') }}/front-assets/images/icon/hands-helping.png" alt="shield-check
              ">
            </figure>
              <div class="media-body">
                <h5 class="mb-1">Pluckit for Brands</h5>
                <p class="mb-0">Connect with customers</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /Section -->
    <!-- Section -->
    <section class="section three-columns">
      <div class="container">
        <div class="section-head">
          <h2 class="heading-style">How Pluckit Works</h2>
          <p>A greater, connected platform to leverage referrals & recommendations suggested by your family and
            friends to hire reliable pluckin’ Tradies.</p>
        </div>
        <div class="row text-center">
          <div class="col-sm-6 col-md-4">
            <div class="box bg-gray-light box-shadow shape-yellow">
              <figure class="figure">
                <img class="img-fluid" src="{{ ('/public') }}/front-assets/images/image1.png" alt="">
              </figure>
              <div class="box-content">
                <h6>LOGIN USING SOCIAL MEDIA</h6>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut</p>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-4">
            <div class="box bg-gray-light box-shadow shape-yellow shape-bottom">
              <figure class="figure">
                <img class="img-fluid" src="{{ ('/public') }}/front-assets/images/image2.png" alt="">
              </figure>
              <div class="box-content">
                <h6>IMPORT FRIENDLIST</h6>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut</p>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-4">
            <div class="box bg-gray-light box-shadow shape-yellow shape-right">
              <figure class="figure">
                <img class="img-fluid" src="{{ ('/public') }}/front-assets/images/image3.png" alt="">
              </figure>
              <div class="box-content">
                <h6>CHECK FRIEND’S <br />RECOMMENDATIONS</h6>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut</p>
              </div>
            </div>
          </div>
        </div>
        <div class="text-center text-sm-right">
          <a href="#" class="btn btn-primary">Pluck a Tradie</a>
        </div>
      </div>
    </section>
    <!-- /Section-->
    <!-- Section -->
    <section class="section bg-primary text-center success-story overlay">
      <div class="container">
        <h4 class="mb-5 position-relative">We help more Australians complete more jobs every day</h4>
        <div class="row justify-content-center align-items-center">
          <div class="col-md-4">
            <h3>125,659</h3>
            <p>Professional Tradies Sydney Wide</p>
          </div>
          <div class="col-md-4">
            <h3>Recommended Tradies</h3>
            <p>By Your Friends</p>
          </div>
          <div class="col-md-4">
            <h3>362,564</h3>
            <p>Customer Recommendations</p>
          </div>
        </div>
      </div>
    </section>
    <!-- /Section-->
    <!-- Section -->
    <section class="section three-columns">
      <div class="container">
        <h2 class="heading-style">Who Is Using Pluckit</h2>
        <div class="row text-center">
          <div class="col-sm-6 col-md-4">
            <div class="box bg-gray-light box-shadow shape-yellow">
              <figure class="figure">
                <img class="img-fluid" src="{{ ('/public') }}/front-assets/images/image5.png" alt="">
              </figure>
              <div class="box-content">
                <h6>TRADIES</h6>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut</p>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-4">
            <div class="box bg-gray-light box-shadow shape-yellow shape-bottom">
              <figure class="figure">
                <img class="img-fluid" src="{{ ('/public') }}/front-assets/images/image6.png" alt="">
              </figure>
              <div class="box-content">
                <h6>CUSTOMERS</h6>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut</p>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-4">
            <div class="box bg-gray-light box-shadow shape-yellow shape-right">
              <figure class="figure">
                <img class="img-fluid" src="{{ ('/public') }}/front-assets/images/image7.png" alt="">
              </figure>
              <div class="box-content">
                <h6>EVERYONE</h6>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut</p>
              </div>
            </div>
          </div>
        </div>
        <div class="text-center text-sm-right">
          <a href="{{ url('business/user/signup') }}" class="btn btn-primary">Become a Pluckit Tradie</a>
        </div>
      </div>
    </section>
    <!-- /Section-->
    <!-- Recommendations -->
    <section class="section recommendations promo-bg">
      <div class="container">
        <h2 class="heading-style alt">Latest Recommendations</h2>
        <div class="card-deck mb-5">
		@if(!empty($latestReview))
			 @php $i=1;@endphp
			@foreach($latestReview as $review)
		@php
		    $getBusiness = \App\BusinessListing::where('id',$review->businessId)->first();
			$category = \App\BusinessListingCategory::where('business_listing_categories.business_id',$review->businessId);
			$category = $category->join('categories as c','c.alias','=','business_listing_categories.business_category_alias');
			$category = $category->first(['c.name as category_name']);
	    @endphp
		    @if($i<4)
            <div class="card border-0 rounded-0 hover-styled">
			  <a href="{{ !empty($getBusiness->business_slug) ? url('business').'/'.$getBusiness->business_slug : '#' }}">
				 @if(!empty($getBusiness->business_image))
				  <img src="{{ $getBusiness->business_image }}" class="img-card-top" alt="Image">
				 @else
				 <img src="{{ ('/public') }}/front-assets/images/default-image.jpg" class="img-card-top" alt="Image">
				 @endif
			   </a>
              <div class="card-body clearfix">
                <div class="rating text-right">
                  <small>RATING</small>
                  <ul class="list-unstyled">
                    <li><a href="#"><i class="
						  <?php
						  if($getBusiness->business_rating == 0) {
							  echo 'fa fa-star text-gray';
						  }else	{
							 if($getBusiness->business_rating > 0 && $getBusiness->business_rating < 1){
								 echo 'fa fa-star-half-alt';
							 }else{
								 echo 'fa fa-star';
							 }
						  }
						?>
						"></i></a></li>
                         <li><a href="#"><i class="
						 <?php
						 if($getBusiness->business_rating > 1 && $getBusiness->business_rating < 2){
							 echo 'fa fa-star-half-alt';
						 }else{
							 if($getBusiness->business_rating >= 2){
								echo 'fa fa-star';
							 }else{
								 echo 'fa fa-star text-gray';
							 }
						 }
						 ?>
						 "></i></a></li>
						  <li><a href="#"><i class="
						  <?php
						  if($getBusiness->business_rating > 2 && $getBusiness->business_rating < 3){
							  echo 'fas fa-star-half-alt';
						  }else{
							  if($getBusiness->business_rating >= 3){
							  echo 'fa fa-star';
							  }else{
								  echo 'fa fa-star text-gray';
							  }
						  }
						  ?>"></i></a></li>
						  <li><a href="#"><i class="
						  <?php
						  if($getBusiness->business_rating > 3 && $getBusiness->business_rating < 4){
							  echo 'fa fa-star-half-alt';
						  }else{
							  if($getBusiness->business_rating >= 4){
							  echo 'fa fa-star';
							  }else{
							  echo 'fa fa-star text-gray';
							  }
						  }
						  ?>"></i></a></li>
						  <li><a href="#"><i class="
						  <?php if($getBusiness->business_rating > 4 && $getBusiness->business_rating < 5){
							  echo 'fa fa-star-half-alt';
						  }else{
							  if($getBusiness->business_rating >= 5){
								echo 'fa fa-star';
							  }else{
								echo 'fa fa-star text-gray' ;
							  }
						  };?>"></i></a></li>
                  </ul>
                </div>
				@php $str =  "The user didn't write a review, and has left just a rating."; @endphp
                <h5><a href="{{ !empty($getBusiness->business_slug) ? url('business').'/'.$getBusiness->business_slug : '#' }}">{{ $getBusiness->business_name }}</a></h5>
                <p>
				{{ (!empty($review->review_text) && (strlen($review->review_text) > 120)) ? substr($review->review_text,0,120).'...' : $review->review_text }}
				</p>
				<div class="user-info">
                  <a href="#">
				  @if(!empty($review->user_image))
                    <img class="img-fluid avatar" src="{{ $review->user_image }}" alt="Image">
			      @else
					  <img class="img-fluid avatar" src="{{ ('/public') }}/front-assets/images/img1.jpg" alt="Image">
			      @endif
                    By {{ !empty($review->user_name) ? $review->user_name : '---' }}
                  </a>
                </div>
                <div class="category float-right">
                  <a href="#">{{ !empty($category->category_name) ? $category->category_name : '---' }}</a>
                </div>
              </div>
            </div>
         @endif
		  @php $i=$i+1;@endphp
		  @endforeach
		 @endif

      </div>
    </section>
    <!-- /Recommendations -->
    <!-- Section -->
    <section class="section categories">
      <div class="container">
        <h2 class="heading-style">Categories</h2>
			@if(!empty($categories[0]))
        <div class="row mb-lg-5">

			@php $i=1; @endphp
		 @foreach($categories as $category)
		 @php
		    $varRating = 0;
			$varReviewCount = 0;
			$varCount = 0;
			$varTotalRating = 0;
		    $categoryRating = \App\BusinessListingCategory::where('business_listing_categories.business_category_alias',$category->alias)->get(['business_listing_categories.business_id']);
			if(!empty($categoryRating[0])){
				$varCount = count($categoryRating);
				foreach($categoryRating as $ratingCategory){
					$businessReview = \App\BusinessListing::where('id',$ratingCategory->business_id)->first();
					if(!empty($businessReview)){
					   $varReviewCount = $varReviewCount+$businessReview->business_review_count;
					   $varRating = $varRating+$businessReview->business_rating;
				    }else{
						$varReviewCount = $varReviewCount+0;
						$varRating = $varRating+0;
					}

				}
				$varTotalRating = round(($varRating/$varCount),1);
			}
		@endphp
          <div class="col-md-6 col-lg-3">
            <div class="card border-0 card-hover">
			<a href="{{ url('/search?cat='.$category->name.'&hid_type=category') }}">
			@if(!empty($category->category_image))
              <img class="card-img-top rounded-1" src="{{ $category->category_image }}" alt="Image">
		    @else
			  <img class="card-img-top rounded-1" src="{{ ('/public') }}/front-assets/images/default-image.jpg" alt="Image">
			@endif
			</a>
              <div class="card-body pt-3 p-0">
                <div class="row">
                  <div class="col-8">
                    <h5><a href="{{ url('/search?cat='.$category->name.'&hid_type=category') }}">{{ $category->name }}</a></h5>
                    <div class="rating d-flex justify-content-start align-items-md-center">
                      <div class="view-count mr-2">
					  {{ $varTotalRating }}
                      </div>
                      <ul class="list-unstyled">
                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                      </ul>
                      <div class="reviews ml-2">
                        <a href="#">({{ $varReviewCount }} reviews)</a>
                      </div>
                    </div>
                  </div>
                  <div class="col-4 text-right">
				  @if(!empty($category->category_icon))
                    <img class="icon" src="{{ $category->category_icon }}" alt="icon">
				  @else
				    <img class="icon" src="{{ ('/public') }}/front-assets/images/category-default-icon.png" alt="icon">
				  @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
		   @if($i%4==0)
			  </div>

		  <div class="row mb-lg-5 {{ ($i==8) ?'d-none' : ''}}">
		  @endif
		  @php $i=$i+1;@endphp
		 @endforeach
		</div>
	@endif
        <div class="text-center text-sm-right">
          <a href="{{ url('/view-categories') }}" class="btn btn-primary">See more categories</a>
        </div>
      </div>
    </section>
    <!-- Section -->
    <section class="section bg-primary popular-tradies">
      <div class="container">
        <h2 class="heading-style alt">Top Rated Tradies</h2>
        <div class="card-deck">
		@if(!empty($businessRatedTradies[0]))
			@foreach($businessRatedTradies as $businessTradies)
			@php
				$category = \App\BusinessListingCategory::where('business_listing_categories.business_id',$businessTradies->id);
				$category = $category->join('categories as c','c.alias','=','business_listing_categories.business_category_alias');
				$category = $category->first(['c.name as category_name']);

			@endphp
			  <div class="card border-0 rounded-0 hover-styled">
				  <figure class="figure m-4 text-center divider">
				  <a href="{{ !empty($businessTradies->business_slug) ? url('business').'/'.$businessTradies->business_slug : '#' }}">
				  @if(!empty($businessTradies->business_image))
					<img src="{{ $businessTradies->business_image }}" class="img-fluid" alt="Image">
				  @else
					<img src="{{ ('/public') }}/front-assets/images/default-image.jpg" class="img-fluid" alt="Image">
				  @endif
				  </a>
				  </figure>
				  <div class="card-body clearfix">
					<h5><a href="{{ !empty($businessTradies->business_slug) ? url('business').'/'.$businessTradies->business_slug : '#' }}">{{ $businessTradies->business_name }}</a></h5>
					<div class="rating d-flex justify-content-start align-items-md-center mb-3">
					  <ul class="list-unstyled">
					  <li><a href="#"><i class="
						  <?php
						  if($businessTradies->business_rating == 0) {
							  echo 'fa fa-star text-gray';
						  }else	{
							 if($businessTradies->business_rating > 0 && $businessTradies->business_rating < 1){
								 echo 'fa fa-star-half-alt';
							 }else{
								 echo 'fa fa-star';
							 }
						  }
						?>
						"></i></a></li>
                         <li><a href="#"><i class="
						 <?php
						 if($businessTradies->business_rating > 1 && $businessTradies->business_rating < 2){
							 echo 'fa fa-star-half-alt';
						 }else{
							 if($businessTradies->business_rating >= 2){
								echo 'fa fa-star';
							 }else{
								 echo 'fa fa-star text-gray';
							 }
						 }
						 ?>
						 "></i></a></li>
						  <li><a href="#"><i class="
						  <?php
						  if($businessTradies->business_rating > 2 && $businessTradies->business_rating < 3){
							  echo 'fas fa-star-half-alt';
						  }else{
							  if($businessTradies->business_rating >= 3){
							  echo 'fa fa-star';
							  }else{
								  echo 'fa fa-star text-gray';
							  }
						  }
						  ?>"></i></a></li>
						  <li><a href="#"><i class="
						  <?php
						  if($businessTradies->business_rating > 3 && $businessTradies->business_rating < 4){
							  echo 'fa fa-star-half-alt';
						  }else{
							  if($businessTradies->business_rating >= 4){
							  echo 'fa fa-star';
							  }else{
							  echo 'fa fa-star text-gray';
							  }
						  }
						  ?>"></i></a></li>
						  <li><a href="#"><i class="
						  <?php if($businessTradies->business_rating > 4 && $businessTradies->business_rating < 5){
							  echo 'fa fa-star-half-alt';
						  }else{
							  if($businessTradies->business_rating >= 5){
								echo 'fa fa-star';
							  }else{
								echo 'fa fa-star text-gray' ;
							  }
						  };?>"></i></a></li>
						</ul>
					  <div class="reviews ml-2">
						<a href="#">({{ $businessTradies->business_review_count }})</a>
					  </div>
					</div>
					<p>{{ (!empty($businessTradies->review_text) && (strlen($businessTradies->review_text) > 215)) ? substr($businessTradies->review_text,0,215).'...' : $businessTradies->review_text }}</p>
					<div class="location float-left">
					  <a href="#"><i class="fas fa-map-marker-alt mr-1"></i>{{ !empty($businessTradies->business_address_1) ? $businessTradies->business_address_1 : '-' }}</a>
					</div>
					<div class="category float-right">
					  <a href="#">{{ $category->category_name }}</a>
					</div>
				  </div>
				</div>

			  @endforeach
		  @endif


        </div>
      </div>
    </section>
    <!-- /Section-->
    <!-- Section -->
    <section class="section">
      <div class="container text-center">
        <h2>Looking to get a job done?</h2>
        <a href="#" class="btn btn-primary">Check who your friends suggest<i
            class="ml-3 fas fa-arrow-circle-right"></i></a>
      </div>
    </section>
    <!-- /Section-->
  </div>
  <!-- /content -->
@endsection
@section('extracontent')
<script>
$("body").on('keyup', '#categories', function () {
	$('#hid_type').val('');
 });
 $("body").on('keyup', '#categories-top', function () {
	$('#hid_type_top').val('');
 });
 </script>
@endsection
