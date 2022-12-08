@extends('layouts.front-end.app')
@section('content')
<!-- MultiStep Form -->
<div class="container-fluid" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-10 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <h2 class="mb-2"><strong>Leave a Recommendation</strong></h2>
               <!-- <p>Fill out the sections below to progress to the next step</p> -->
                <div class="row mt-3">
                    <div class="col-md-12 mx-0 p-0" id="msform">
					<?php
					if(!empty($getDemoReview)){
						$contactName = !empty($getDemoReview->contact_name) ? $getDemoReview->contact_name : '';
						$phoneNo = !empty($getDemoReview->phone_no) ? $getDemoReview->phone_no : '';
						$emailId = !empty($getDemoReview->email_id) ? $getDemoReview->email_id : '';
						$website = !empty($getDemoReview->website) ? $getDemoReview->website : '';
						$city = !empty($getDemoReview->city) ? $getDemoReview->city : '';
						$suburb = !empty($getDemoReview->suburb) ? $getDemoReview->suburb : '';
						$postcode = !empty($getDemoReview->postcode) ? $getDemoReview->postcode : '';
						if(!empty($getDemoReview->rating) && ($getDemoReview->rating == 1)){
							$firstStar = 'fa fa-star';
							$secondStar = 'far fa-star text-gray';
							$thirdStar = 'far fa-star text-gray';
							$fourthStar = 'far fa-star text-gray';
							$fifthStar = 'far fa-star text-gray';
						}else if(!empty($getDemoReview->rating) && ($getDemoReview->rating == 2)){
							$firstStar = 'fa fa-star';
							$secondStar = 'fa fa-star';
							$thirdStar = 'far fa-star text-gray';
							$fourthStar = 'far fa-star text-gray';
							$fifthStar = 'far fa-star text-gray';
						}else if(!empty($getDemoReview->rating) && ($getDemoReview->rating == 3)){
							$firstStar = 'fa fa-star';
							$secondStar = 'fa fa-star';
							$thirdStar = 'fa fa-star';
							$fourthStar = 'far fa-star text-gray';
							$fifthStar = 'far fa-star text-gray';
						}else if(!empty($getDemoReview->rating) && ($getDemoReview->rating == 4)){
							$firstStar = 'fa fa-star';
							$secondStar = 'fa fa-star';
							$thirdStar = 'fa fa-star';
							$fourthStar = 'fa fa-star';
							$fifthStar = 'far fa-star text-gray';
						}else if(!empty($getDemoReview->rating) && ($getDemoReview->rating == 5)){
							$firstStar = 'fa fa-star';
							$secondStar = 'fa fa-star';
							$thirdStar = 'fa fa-star';
							$fourthStar = 'fa fa-star';
							$fifthStar = 'fa fa-star';
						}else{
							$firstStar = 'far fa-star text-gray';
							$secondStar = 'far fa-star text-gray';
							$thirdStar = 'far fa-star text-gray';
							$fourthStar = 'far fa-star text-gray';
							$fifthStar = 'far fa-star text-gray';
						}
					}else{
						    $firstStar = 'far fa-star text-gray';
							$secondStar = 'far fa-star text-gray';
							$thirdStar = 'far fa-star text-gray';
							$fourthStar = 'far fa-star text-gray';
							$fifthStar = 'far fa-star text-gray';
							$contactName = '';
							$phoneNo = '';
							$emailId = '';
							$website = '';
							$city = '';
							$suburb = '';
							$postcode = '';
					}
					if(empty($get['step'])){
						$firstActive = 'active';
						$secondActive = '';
						$thirdActive = '';
						$fourthActive = '';
						}
					elseif(!empty($get['step']) && ($get['step'] <=1)){
					    $firstActive = 'active';
						$secondActive = '';
						$thirdActive = '';
						$fourthActive = '';
						}
					elseif(!empty($get['step']) && ($get['step'] <=2)){
					    $firstActive = 'active';
						$secondActive = 'active';
						$thirdActive = '';
						$fourthActive = '';
						}
					elseif(!empty($get['step']) && ($get['step'] <=3)){
					    $firstActive = 'active';
						$secondActive = 'active';
						$thirdActive = 'active';
						$fourthActive = '';
						}
					elseif(!empty($get['step']) && ($get['step'] <=4)){
					    $firstActive = 'active';
						$secondActive = 'active';
						$thirdActive = 'active';
						$fourthActive = 'active';
						}
					if(!empty($get)){
					if(!empty($get) && !empty($get['r'])){
						$getQuery = $get['r'];
						$cookie_name = "review-recommend";
						$cookie_value = $get['r'];
						setcookie($cookie_name, $cookie_value, time() + (60 * 20), "/");
					}else{
						$getQuery = '';
					}
					}else{
						$getQuery = '';
					}
					?>


                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li class="{{ $firstActive}}" id="account"><strong>Recommend</strong></li>
                                <li id="personal" class="{{ $secondActive }}"><strong>Tradie details</strong></li>
                                <li id="payment" class="{{ $thirdActive }}"><strong>Verify</strong></li>
                                <li id="confirm" class="{{ $fourthActive }}"><strong>Finish</strong></li>
                            </ul> <!-- fieldsets -->
                            <fieldset style="{{ (empty($get['step']) || (!empty($get['step']) && ($get['step'] == 1))) ? 'display: block; opacity: 1;' : 'display: none; position: relative; opacity: 0;'}}">
                               <form class="form" action="{{ url('business/review/saveReview')}}" method="post" enctype="multipart/form-data" id="frontreview" onsubmit="return false">
                             {{ csrf_field() }}
							   <div class="form-card">
                                   <!-- <h2 class="fs-title">Leave a recommendation</h2> -->
									<h4>We’re here to help each other. We’d love to hear about your experience.</h4>
									<p></p>
									<p></p>
									<p>Please enter the Tradie business name you are looking to recommend.</p>
									 <div class="row">
                                       <div class="col-12">
									     <div class="mb30">
											<input class="form-control" name="business_name_recommend" id="business_name_recommend" placeholder="Start typing business name" type="text" required  value="{{ !empty($getDemoReview) ? $getDemoReview->business_name : '' }}">
										</div>
										</div>
										</div>
									<div class="row">
                                       <div class="col-12">
										<div class="mb30 {{ (!empty($getDemoReview) && ($getDemoReview->trade)) ? '' :'d-none' }}" id="trade">
										<p>Select the trade: </p>
										<span class="selectbox2">
											<select class="form-control select2-show-search" name="trade" data-placeholder="Search for an Electrician, a Plumber, etc.">
												<option value="">Search for an Electrician, a Plumber, etc.</option>
												@if(!empty($trades[0]))
													@foreach($trades as $tr)
													  <option value="{{ $tr->alias}}" {{ (!empty($getDemoReview) && ($getDemoReview->trade == $tr->alias)) ? 'selected' : '' }}>{{ $tr->name}}</option>
													 @endforeach
												@endif
											</select>
										</span>
										</div>
									 </div>
									 </div>
									 <div class="row">
                                       <div class="col-12">
										<p>What rating do you give this business?</p>
										<div class="mb30">
											<div class="rating-leave d-flex justify-content-start align-items-md-center mb-2 font-1rem" id="rating">
												  <a style="font-size:1.7rem !important" href="javascript:;" class="star" title="Poor" data-value="1"><i class="{{ $firstStar }}"></i></a>
												  <a style="font-size:1.7rem !important" href="javascript:;" class="star" title="Fair" data-value="2"><i class="{{ $secondStar }}"></i></a>
												  <a  style="font-size:1.7rem !important" href="javascript:;" class="star" title="Good" data-value="3"><i class="{{ $thirdStar }}"></i></a>
												  <a style="font-size:1.7rem !important" href="javascript:;" class="star" title="Excellent" data-value="4"><i class="{{ $fourthStar }}"></i></a>
												  <a style="font-size:1.7rem !important" href="javascript:;" class="star" title="WOW!!!" data-value="5"><i class="{{ $fifthStar }}"></i></a>
												<div class="reviews rating ml-2">
												   <span style="font-size:1.2rem !important; color:#f8c323;" href="#" class="review_count">({{ !empty($getDemoReview) ? $getDemoReview->rating : 0 }})</span>
												</div>
											</div>
											<p style="color:#B94A48;" class="d-none" id="error-star">This value is required.</p>
										</div>
										</div>
										</div>
									<div class="row">
                                       <div class="col-12">
										<p>Do you give this business a thumbs up, or thumbs down?</p>
										<div class="mb30">
											<div class="user-block text-left font-1rem">
												<a href="javascript:;"  class="btn btn-link btn-like thumbs_up" data-like="0"><i style="font-size:1.7rem !important" class="far fa-thumbs-up mr-2"></i>{{ !empty($getDemoReview) ? $getDemoReview->likes : 0 }}</a>
												<a href="javascript:;" class="btn btn-link btn-dislike thumbs_down" data-unlike="0"><i style="font-size:1.7rem !important" class="far fa-thumbs-down mr-2"></i>{{ !empty($getDemoReview) ? $getDemoReview->unlikes : 0 }}</a>
											  </div>
										</div>
										</div>
										</div>
										<div class="row">
                                       <div class="col-12">
										<p>Any comments you wish to leave</p>
										<div class="mb30">
											<textarea class="form-control" name="comments" id="comments" placeholder="Start typing..." rows="3" required>{{ !empty($getDemoReview) ? $getDemoReview->comments : '' }}</textarea>
										</div>
										</div>
										</div>
										<input type="hidden" name="rating" id="hid_rating" value="{{ !empty($getDemoReview) ? $getDemoReview->rating : 0 }}">
										<input type="hidden" name="user_id" id="user_id" value="{{ !empty($user) ? $user->id : ''}}">
										<input type="hidden" name="hid_business_id" id="hid_business_id" value="{{ !empty($getDemoReview) ? $getDemoReview->business_id : 0 }}">
										<input type="hidden" name="hid_like" id="hid_like" value="">
										<input type="hidden" name="hid_unlike" id="hid_unlike" value="">
										<input type="hidden" name="hid_trade" id="hid_trade" value="">
										<input type="hidden" name="hid_demo_review_id" id="hid_demo_review_id" value="{{ !empty($get['r']) ? $get['r'] : '' }}">
                                </div>
								<input type="submit" name="next" class="next action-button button_submit" value="Next Step" />
								</form>
                            </fieldset>
                            <fieldset style="{{  (!empty($get['step']) && ($get['step'] == 2)) ? 'display: block; opacity: 1;' : 'display: none; position: relative; opacity: 0;'}}">
							 <form class="form" action="{{ url('business/review/submission/save')}}" method="post" enctype="multipart/form-data">
							  {{ csrf_field() }}
                                <div class="form-card">
                                  <!--  <h2 class="fs-title">Add business details</h2> -->
                                    	<h4>Please add any of the business details that you have on hand. Leaving the mobile number alerts the Tradie that you have left them a recommendation to say thanks.</h4>
									<p></p>
									<p></p>
									<div class="row">
                                        <div class="col-md-6">
										    <div class="form-group">
												<input type="text" name="contactName" id="contactName" class="form-control" placeholder="Tradie contact name (Recommended)" value="{{ !empty($getDemoReview->contact_name) ? $getDemoReview->contact_name : $contactName }}"/>
											</div>
										</div>
										<div class="col-md-6">
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text" id="basic-addon1">+61</span>
												</div>
												<input type="tel" name="contactPhone" id="contactPhone" maxlength="10" class="form-control" placeholder="Phone (Recommended)" value="{{ !empty($getBusinessListing->business_phone) ? $getBusinessListing->business_phone : $phoneNo  }}"{{ !empty($getBusinessListing->business_phone) ? 'disabled' : '' }} />
											</div>
									     	<!-- <div class="row form-group">
												<div class="col-2 col-md-1 pr-0">

												</div>
												<div class="col-10 col-md-11">
													<input type="tel" name="contactPhone" id="contactPhone" maxlength="10" class="form-control" placeholder="Phone (Optional)" value="{{ !empty($getBusinessListing->business_phone) ? $getBusinessListing->business_phone : '' }}"{{ !empty($getBusinessListing->business_phone) ? 'disabled' : '' }} />
												</div>
											</div> -->
                                        </div>
									</div>
									<div class="row">
											<div class="col-md-6">
												<div class="form-group">
														<input type="email" name="contactEmail" id="contactEmail" class="form-control" placeholder="Email (Optional)" value="{{ !empty($getBusinessListing->business_email) ? $getBusinessListing->business_email : $emailId  }}"{{ !empty($getBusinessListing->business_email) ? 'disabled' : '' }}/>
											    </div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<input type="text" name="contactWebsite" id="contactWebsite" class="form-control" placeholder="Website (Optional)" value="{{ !empty($getBusinessListing->business_website_url) ? $getBusinessListing->business_website_url : $website  }}"{{ !empty($getBusinessListing->business_website_url) ? 'disabled' : '' }} />
												</div>
											</div>
                                    </div>
									<div class="row">
								     	<div class="col-md-6">
											<div class="form-group">
												<span class="selectbox d-block ">
													<select class="form-control rounded" name="city" id="city">
														<option value="">State (Optional)</option>
														@if(!empty($states[0]))
															@foreach($states as $st)
														        <?php
																if(!empty($getDemoReview) && ($getDemoReview->city)){
																    $selectedCity = (!empty($getDemoReview) && ($getDemoReview->city == $st->name)) ? 'selected' : '';
																}else{
																	$selectedCity = '';
																}
																?>
																<option value="{{ $st->name}}" {{ (!empty($getBusinessListing->business_state) && ($getBusinessListing->business_state == $st->name)) ? 'selected' : $selectedCity }} {{ (!empty($getBusinessListing->business_state) && ($getBusinessListing->business_state == $st->name)) ? 'disabled' : '' }}>{{ $st->name}}</option>
																@endforeach
															@endif
														</select>
												</span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<input type="text" name="suburb" id="suburb_recommendation" class="form-control" placeholder="Suburb (Optional)" value="{{ !empty($getBusinessListing->business_city) ? $getBusinessListing->business_city : $suburb   }}" />
												<span class="loader loader-suburb d-none">
													<i class="fa fa-spin fa-spinner"></i>
												</span>
											</div>
											</div>
									</div>
									<div class="row">
								     	<div class="col-md-6">
											<div class="form-group">
												<input type="text" name="postcode" id="postcode_recommendation" class="form-control" placeholder="Post Code (Optional)" value="{{ !empty($getBusinessListing->business_zipcode) ? $getBusinessListing->business_zipcode : $postcode  }}"{{ !empty($getBusinessListing->business_zipcode) ? 'disabled' : '' }} />
												<span class="loader loader-postcode d-none">
													<i class="fa fa-spin fa-spinner"></i>
												</span>
											</div>
										</div>
									</div>
									<input type="hidden" name="hid_demo_review_id" id="hid_demo_review_id" value="{{ !empty($get['r']) ? $get['r'] : '' }}">
                                </div>
								   <a style="width:100px;display: inline-block;" href="{{ url('leave-recommendation?step=1&r='.$getQuery) }}" class="previous action-button-previous">Previous</a>
								   <input type="submit" name="next" class="next action-button" value="Next Step" />
								 </form>
                            </fieldset>
                            <fieldset style="{{  (!empty($get['step']) && ($get['step'] == 3)) ? 'display: block; opacity: 1;' : 'display: none; position: relative; opacity: 0;'}}">
							<form class="form" action="{{ url('business/review/user/save')}}" method="post" enctype="multipart/form-data" id="form_user">
							 {{ csrf_field() }}
                                <div class="form-card">
                                    <h2 class="fs-title">Submit recommendation</h2>
									<p>To submit this review, please continue to sign in via the following.</p>
									<div class="row">
                                        <div class="col-md-5 pr-md-0">
											<ul class="list-unstyled social-btn-group text-center clearfix">
											<li><a href="{{ url('auth/fb') }}" class="btn btn-primary facebook"><span class="icon"><i class="fab fa-facebook-f"></i></span><span>Sign in with Facebook</span></a></li>
											<li><a href="{{ url('auth/google') }}" class="btn btn-primary google-plus"><span class="icon"><img src="data:image/png;base64,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"/></span><span>Sign in with Google</span></a></li>
											<li><a href="{{ url('auth/outlook') }}" class="btn btn-primary outlook"><span class="icon"><img class="img-fluid"
													src="{{ ('/public') }}/front-assets/images/icon/outlook-blue.png" alt="Outlook"></span><span>Sign in with Outlook</span></a></li>
											</ul>
								    	</div>
										<div class="col-md-2">
										    <p class="section-divider two-dimensional text-center"><span>OR</span></p>
										</div>
										<div class="col-md-5 pl-md-0">
										    <div class="form-group">
											   <input type="text" name="name" id="fullname" class="form-control @error('name') is-invalid @enderror" placeholder="{{ __('First Name') }}" value="{{ old('name') }}" required autocomplete="name" autofocus pattern="/^[a-zA-Z0-9]+$/" data-parsley-pattern-message="First Name can have only alphabets and numbers.">
											</div>
										    <div class="form-group">
											   <input type="text" name="lastname" id="lastname" class="form-control @error('lastname') is-invalid @enderror" placeholder="{{ __('Last Name') }}" value="{{ old('lastname') }}" required autocomplete="lastname" pattern="/^[a-zA-Z0-9]+$/" data-parsley-pattern-message="Last Name can have only alphabets and numbers.">
											</div>
										    <div class="form-group">
										    	<input type="email" name="email" id="email" class="form-control" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" required autocomplete="email" pattern="^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$">
											</div>
										    <div class="form-group mb-0">
												<input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror"
						placeholder="{{ __('Password') }}" required autocomplete="new-password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" data-parsley-pattern-message="Should be combination between characters, upper case, lower case, numbers and minimum 8 characters">
						                    <small id="passwordHelp" class="form-text">Should be combination between characters, upper case, lower case, numbers and minimum 8 characters</small>
											</div>
											<input type="hidden" name="hid_review_id" value="{{ !empty($get['r']) ? $get['r'] : '' }}">
										</div>
							         </div>

                     			</div>
								    <a style="width:100px;display: inline-block;" href="{{ url('leave-recommendation?step=2&r='.$getQuery) }}" class="previous action-button-previous">Previous</a>
									<input type="submit" name="make_payment" class="next action-button" value="Submit" />
									</form>

									<p id="normal_signup" class="text-center">Already a member?<button type="button" class="btn btn-link btn-login" data-toggle="modal" data-target="#loginModal">Log In</button></p>
                            </fieldset>
                            <fieldset style="{{  (!empty($get['step']) && ($get['step'] == 4)) ? 'display: block; opacity: 1;' : 'display: none; position: relative; opacity: 0;'}}">
                                <div class="form-card">
                                    <h2 class="fs-title text-center">All done, thank you. We appreciate your time leaving this recommendation.</h2> <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-3 text-center"> <img src="{{ ('/public') }}/front-assets/images/ok-success.png" class="img-fluid"> </div>
                                    </div> <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-12 text-center">
                                            <h5>
											 @if(session()->get('success'))
                                               {{ session()->get('success') }}
										      @else
												  You Have Successfully Signed Up
											 @endif

											</h5>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
							</form>

                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
@section('extracontent')
<script src="{{ ('/public') }}/front-assets/lib/parsleyjs/parsley.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){

var current_fs, next_fs, previous_fs; //fieldsets
var opacity;


// $(".next").click(function(){
// current_fs = $(this).parent();
// next_fs = $(this).parent().next();
// var form = $("#frontreview");
  // form.validate({
    // rules: {
      // business_name_recommend: {
        // required: true,

      // }
    // },
    // messages: {
      // business_name_recommend: {
        // required: "This is required.",
       // }
    // }
  // });
  // if (form.valid() === true) {
	  // console.log(current_fs);
// console.log(next_fs);
	  //show the next fieldset
		// next_fs.show();
		//hide the current fieldset with style
		// current_fs.animate({opacity: 0}, {
		// step: function(now) {
		//for making fielset appear animation
		// opacity = 1 - now;

		// current_fs.css({
		// 'display': 'none',
		// 'position': 'relative'
		// });
		// next_fs.css({'opacity': opacity});
		// },
		// duration: 600
		// });

  // }
 // });


// $(".previous").click(function(){

// current_fs = $(this).parent();
// previous_fs = $(this).parent().prev();

//Remove class active
// $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

//show the previous fieldset
// previous_fs.show();

//hide the current fieldset with style
// current_fs.animate({opacity: 0}, {
// step: function(now) {
//for making fielset appear animation
// opacity = 1 - now;

// current_fs.css({
// 'display': 'none',
// 'position': 'relative'
// });
// previous_fs.css({'opacity': opacity});
// },
// duration: 600
// });
// });

// $('.radio-group .radio').click(function(){
// $(this).parent().find('.radio').removeClass('selected');
// $(this).addClass('selected');
// });

// $(".submit").click(function(){
// return false;
// })

});
//$('#trade').addClass('d-none');
//$('#hid_rating').val(0);
//$('#hid_like').val(0);
//$('#hid_unlike').val(0);
$('.select2-show-search').select2({
	  minimumResultsForSearch: ''
	});
$(".button_submit").on('click', function(){
 if ($('#frontreview').parsley().validate() == true) {
	 var stars = $("#hid_rating").val();
	 if(stars == 0){
		 $('#error-star').removeClass('d-none');
		 return false;
	}else{
		//$(".button_submit").html('Loading...');
		 $('#frontreview').attr('onsubmit','return true');
	 }
 }
 });
 $('#form_user').parsley();
$('#rating a').on('click', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently selected
	var stars = $(this).parent().children('a.star');
	$("#hid_rating").val(onStar);
	$(".review_count").html('('+onStar+')');
    for (i = 0; i < stars.length; i++) {
      $(stars[i]).html('<i class="far fa-star text-gray"></i>');
    }
    for (i = 0; i < onStar; i++) {
      $(stars[i]).html('<i class="fa fa-star"></i>');
    }

 });
 $('.thumbs_up').on('click',function(){
	    var testLikeVal = $("#hid_like").val();
		if(testLikeVal == 0){
			var likeVal = 1;
			$(".thumbs_up").html('<i class="far fa-thumbs-up mr-2" style="font-size:1.7rem!important"></i> '+likeVal);
			$("#hid_like").val(1);
			$(".thumbs_down").html('<i class="far fa-thumbs-down mr-2"  style="font-size:1.7rem!important"></i> 0');
			$("#hid_unlike").val(0);
		}else{
			$(".thumbs_up").html('<i class="far fa-thumbs-up mr-2" style="font-size:1.7rem!important"></i> 0');
			$("#hid_like").val(0);
		}
	});
  $('.thumbs_down').on('click',function(){
	   var testUnLikeVal = $("#hid_unlike").val();
	   if(testUnLikeVal == 0){
			var unlikeVal = 1;
			$(".thumbs_down").html('<i class="far fa-thumbs-down mr-2"  style="font-size:1.7rem!important"></i> '+unlikeVal);
			$("#hid_unlike").val(1);
			$(".thumbs_up").html('<i class="far fa-thumbs-up mr-2" style="font-size:1.7rem!important"></i> 0');
			$("#hid_like").val(0);
	   }else{
		   $(".thumbs_down").html('<i class="far fa-thumbs-down mr-2"  style="font-size:1.7rem!important"></i> 0');
		   $("#hid_unlike").val(0);
	   }
	});


</script>
@endsection
