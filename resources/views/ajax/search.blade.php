@if(!empty($objBusinessList[0]))
@foreach($objBusinessList as $business)
@php
   $businessSlug = !empty($business['business_slug']) ? url('business').'/'.$business['business_slug'] : '';
   $userId = !empty($user) ? $user->id : 0;
   $userType = !empty($user) ? $user->user_type : 1;
   $userLikeCount = \App\UserLike::where('business_id',$business['business_review_count'])->get([DB::raw('count(*) as total')]);
   $userLikeCont = $userLikeCount[0]['total'];
   $likeCount = $userLikeCont;
   $userUnLikeCount = \App\UserUnlike::where('business_id',$business['business_review_count'])->get([DB::raw('count(*) as total')]);
   $userUnLikeCont = $userUnLikeCount[0]['total'];
   $unlikeCount = $userUnLikeCont;
   $getObjBusinessListReview = \App\BusinessListReview::where('business_id',$business['business_review_count'])->where('user_id',$userId)->first();
   if(!empty($getObjBusinessListReview)){
	   $userReviewCount = 1;
   }else{
	   $userReviewCount = 0;
   }
   $pluckitType = array('pluckit','pluckitrecommendation');
  // $objFriendRecommendationList = \App\BusinessListReview::where('user_id','!=',$userId)->where('status',1)->where('business_id',$business['id'])->whereIn('user_id',$arrFriendRecommendation)->whereIn('review_type',$pluckitType)->orderBy('review_time_created','desc')->groupBy('user_id')->get();
   $objFriendRecommendationList = \App\BusinessListReview::where(function($query) use  ($arrFriendRecommendationEmail,$arrFriendRecommendationName,$arrFriendRecommendationMobile){
					$query->whereIn('user_email_id',$arrFriendRecommendationEmail)
					->orWhereIn('user_name',$arrFriendRecommendationName)
					->orWhereIn('user_mobile_no',$arrFriendRecommendationMobile);
					})->where('user_id','!=',$userId)->where('status',1)->where('business_id',$business['id'])->orderBy('review_time_created','desc')->get();
   $objFriendRecommendationCount = $objFriendRecommendationList->count();
   $objBusinessEmail = \App\User::where('id',$business['user_id'])->where('user_type',2)->first();
   $getMainCategory = \App\Category::where('id',$get['catval'])->where('category_list_type','pluckit')->where('pluckit_parent_id',0)->first();
   $frientReviewText = "";
 @endphp
  <!-- Filter Item -->
  <div class="filter-item">
	<div class="service-box">
	  <div class="service-img">
	  <a href="{{ !empty($business['business_slug']) ? url('business').'/'.$business['business_slug'] : '#' }}">
		  @if(!empty($business['business_image']))
			<img class="img-fluid" src="{{ $business['business_image'] }}" alt="{{ $business['business_name'] }}">
		  @else
			<img class="img-fluid" src="{{ url('public/')}}/front-assets/images/trade-icon.png" alt="butterfield">
		  @endif
	  </a>
	  </div>
	  <div class="service-content">
                    <div class="left mr-sm-3">
                      <h4><a href="{{ url('business').'/'.$business['business_slug'] }}">{{ $business['business_name'] }}  @if(!empty($business['callout'])) - <span class="status text-warning">{{ $business['callout'] }}</span><i class="fas fa-check-circle ml-1"></i>@endif</a></h4>
                      <div class="rating d-flex justify-content-start align-items-md-center mb-2">
                        <ul class="list-unstyled">
                          <li><a href="#"><i class="
						  <?php
						  if($business['business_rating'] == 0) {
							  echo 'fa fa-star text-gray';
						  }else	{
							 if($business['business_rating'] > 0 && $business['business_rating'] < 1){
								 echo 'fa fa-star-half-alt';
							 }else{
								 echo 'fa fa-star';
							 }
						  }
						?>
						"></i></a></li>
                         <li><a href="#"><i class="
						 <?php
						 if($business['business_rating'] > 1 && $business['business_rating'] < 2){
							 echo 'fa fa-star-half-alt';
						 }else{
							 if($business['business_rating'] >= 2){
								echo 'fa fa-star';
							 }else{
								 echo 'fa fa-star text-gray';
							 }
						 }
						 ?>
						 "></i></a></li>
						  <li><a href="#"><i class="
						  <?php
						  if($business['business_rating'] > 2 && $business['business_rating'] < 3){
							  echo 'fas fa-star-half-alt';
						  }else{
							  if($business['business_rating'] >= 3){
							  echo 'fa fa-star';
							  }else{
								  echo 'fa fa-star text-gray';
							  }
						  }
						  ?>"></i></a></li>
						  <li><a href="#"><i class="
						  <?php
						  if($business['business_rating'] > 3 && $business['business_rating'] < 4){
							  echo 'fa fa-star-half-alt';
						  }else{
							  if($business['business_rating'] >= 4){
							  echo 'fa fa-star';
							  }else{
							  echo 'fa fa-star text-gray';
							  }
						  }
						  ?>"></i></a></li>
						  <li><a href="#"><i class="
						  <?php if($business['business_rating'] > 4 && $business['business_rating'] < 5){
							  echo 'fa fa-star-half-alt';
						  }else{
							  if($business['business_rating'] >= 5){
								echo 'fa fa-star';
							  }else{
								echo 'fa fa-star text-gray' ;
							  }
						  };?>"></i></a></li>
                        </ul>
						<div class="reviews ml-2">
						  <?php


								$point2= ["lat"=> $business['business_lattitude'], "long"=> $business['business_longitude']];

								if($point1['lat'] != '' && $point1['lat'] != '') {
									$lat1 = $point1['lat'];
									$lon1 = $point1['long'];
									$lat2 = $point2['lat'];
									$lon2 = $point2['long'];
									$R = 6371; // km
									$φ1 = $lon1 * PI()/180; // φ, λ in radians
									$φ2 = $lon2 * PI()/180;
									$Δφ = ($lon2-$lon1) * PI()/180;
									$Δλ = ($lat2-$lat1) * PI()/180;

									$a = SIN($Δφ/2) * SIN($Δφ/2) +
											COS($φ1) * COS($φ2) *
											SIN($Δλ/2) * SIN($Δλ/2);
									$c = 2 * atan2(sqrt($a), sqrt(1-$a));

									$distance =  round($R * $c, 1);
								}
								else $distance = '';

						  ?>
						  <a href="#">({{ $business['business_review_count'] }})</a>

                        </div>
                      </div>
                      <div class="service-provider">
                        @if(!empty($getMainCategory))
						   <p>{{ $getMainCategory->name }}</p>
					    @else
							@if(!empty($business['catName']))
								<p>{{ $business['catName'] }}</p>
								@else
								<p>{{ (!empty($business['listingCat']->catgory->name))?$business['listingCat']->catgory->name:'' }}</p>
							@endif
						 @endif
                      </div>
					  <ul class="contact-info mb-1">
                        <li><i class="fas fa-map-marker-alt"></i> {{ !empty($business['business_city']) ? $business['business_city'] : '-' }}
							<a target="_blank" href="https://www.google.com/maps?z=12&t=m&q=loc:{{ $business['business_lattitude'] }}+{{ $business['business_longitude'] }}">Location<i
								class="fas fa-directions ml-1"></i>
							</a>
							@if($distance)
							<a href="#">({{ $distance }}Km)</a>
							@endif
						</li>
                        <li><i class="far fa-clock mr-1"></i>{{ !empty($business['business_default_hours']) ? $business['business_default_hours'] : '7AM - 5PM' }}
						<a href="javascript:;" data-id="{{$business['id']  }}" class="viewWorkingHoursModal">View working hours</a>
						</li>
                      </ul>
					  <p>
                      @if($userId == 0)
					  <a><b><span class="btn btn-link btn-login" data-toggle="modal" data-target="#loginModal">See who</span> your friends have recommended?</b></a>

					  @else
						  @if($objFriendRecommendationCount != 0)
							 @if($objFriendRecommendationCount == 1)
								@php $frientReviewText = "Person"; @endphp
							@else
								@php $frientReviewText = "people"; @endphp
							@endif
							<a href="javascript:;"  onClick="clickFriendRecommendation({{ $business['id'] }})"><u>{{ $objFriendRecommendationCount.' '.$frientReviewText }}</u> you might know refer or recommend this business</a>
						  @endif
					  @endif
					  </p>
                      <div class="user-block text-left">
                         <a href="javascript:;" class="btn btn-outline-success mr-2" onClick="clickRecommendation({{ $business['id'] }},{{ $userId }},{{ $userType }},{{ $userReviewCount }})"><i class="far fa-edit mr-2"></i>Leave a
                          Recommendation</a>
                        <a href="javascript:;" class="btn btn-outline-secondary btn-share social-share" data-href="{{$businessSlug }}" data-business-id="{{ $business['id'] }}"><i class="fas fa-share-square mr-2"></i>Share</a>
						<!--<a href="#" class="btn btn-outline-secondary btn-share" data-href="{{$businessSlug }}" data-business-id="{{ $business['business_review_count'] }}"><i class="fas fa-share-square mr-2"></i>Share</a>-->
                        <a href="javascript:;" class="btn btn-link btn-like thumbs_up" id="thumbs_up_{{ $business['id'] }}"  onClick="clickUserLike({{ $business['id'] }},{{ $userId }},{{ $userType }},{{ $likeCount }})"><i class="far fa-thumbs-up mr-2"></i>{{ $likeCount }}</a>
                        <a href="javascript:;" class="btn btn-link btn-dislike thumbs_down" id="thumbs_down_{{ $business['id'] }}" onClick="clickUserUnLike({{ $business['id'] }},{{ $userId }},{{ $userType }},{{ $unlikeCount }})"><i class="far fa-thumbs-down mr-2"></i>{{ $unlikeCount }}</a>
                      </div>
                    </div>
                    <div class="right">
                      <ul class="list-unstyled user-links mb-sm-3">
                        @if(!empty($business['business_phone']))
						<li>
						 <a href="javascript:;" class="tel callusButton" id="callusButton-{{ $business['id'] }}" data_business_id="{{ $business['id'] }}" data_phone="{{ $business['business_phone'] }}">
						   <span><i class="fas fa-phone fa-rotate-90"></i></span>
							Call
						 </a>
						 @endif

						 <a href="tel:{{ $business['business_phone'] }}" class="tel " id="hidcallusButton_{{ $business['id'] }}"></a>
						</li>
						@if(!empty($business['business_phone']))
							@if(strpos($business['business_phone'],'04')!==false || strpos($business['business_phone'],'+614')!==false)
								<li><a href="javascript:;" onClick="clickMessage({{ $business['id'] }},{{ $userId }},{{ preg_replace('/\s+/', '', $business['business_phone']) }})"  class="email"><span><i class="far fa-comment-dots"></i></span>Message</a></li>
							@endif
            @endif
						@if(!empty($business['email']))
					   <li>
						  <a href="javascript:;" class="comment emailusButton" data_business_id="{{ $business['id'] }}" data_email="{{ !empty($business['email']) ? $business['email'] : 'pluckit20@gmail.com' }}" target="_blank"><span><i class="fas fa-envelope"></i></span>Email
						  </a>
						   <a href="mailto:{{ !empty($objBusinessEmail->email) ? $objBusinessEmail->email : 'pluckit20@gmail.com' }}" class="comment " id="hidEmailUsButton_{{ $business['id'] }}" target="_blank"></a>

						</li>
						@endif
						@if(!empty($business['business_website_url']))
                        <li>
						@if(!empty($business['business_website_url']))
						<a href="https://{{ $business['business_website_url'] }}" data_business_id="{{ $business['id'] }}" data_website="{{ !empty($business['business_website_url']) ? $business['business_website_url'] : '' }}" class="globe websiteButton" target="_blank">
						<span><i class="fas fa-globe"></i></span>Website
						</a>
						@endif
						<a href="https://{{ $business['business_website_url'] }}" class="globe " id="hidWebsiteButton_{{ $business['id'] }}" target="_blank"></a>
						</li>
						@endif
                      </ul>
					  @if(!empty($business['business_review_url']))
						  <div class="rating rating-trustpilot">
							<a href="{{ $business['business_review_url'] }}" target="_blank">
							<img class="img-fluid" src="{{ ('/public') }}/front-assets/images/trustpilot.svg" alt="Trustpilot">
							</a>
							<ul class="list-unstyled ml-1">
								<li><a href="#"><i class="
						  <?php
						  if($business['business_rating'] == 0) {
							  echo 'fa fa-star text-gray';
						  }else	{
							 if($business['business_rating'] > 0 && $business['business_rating'] < 1){
								 echo 'fa fa-star-half-alt';
							 }else{
								 echo 'fa fa-star';
							 }
						  }
						?>
						"></i></a></li>
                         <li><a href="#"><i class="
						 <?php
						 if($business['business_rating'] > 1 && $business['business_rating'] < 2){
							 echo 'fa fa-star-half-alt';
						 }else{
							 if($business['business_rating'] >= 2){
								echo 'fa fa-star';
							 }else{
								 echo 'fa fa-star text-gray';
							 }
						 }
						 ?>
						 "></i></a></li>
						  <li><a href="#"><i class="
						  <?php
						  if($business['business_rating'] > 2 && $business['business_rating'] < 3){
							  echo 'fas fa-star-half-alt';
						  }else{
							  if($business['business_rating'] >= 3){
							  echo 'fa fa-star';
							  }else{
								  echo 'fa fa-star text-gray';
							  }
						  }
						  ?>"></i></a></li>
						  <li><a href="#"><i class="
						  <?php
						  if($business['business_rating'] > 3 && $business['business_rating'] < 4){
							  echo 'fa fa-star-half-alt';
						  }else{
							  if($business['business_rating'] >= 4){
							  echo 'fa fa-star';
							  }else{
							  echo 'fa fa-star text-gray';
							  }
						  }
						  ?>"></i></a></li>
						  <li><a href="#"><i class="
						  <?php if($business['business_rating'] > 4 && $business['business_rating'] < 5){
							  echo 'fa fa-star-half-alt';
						  }else{
							  if($business['business_rating'] >= 5){
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
	<div class="top-search d-none" id="friend-recommendation-{{ $business['id'] }}" data-status=''>
	  <!-- review-list -->
	  <p class="lead">{{ $objFriendRecommendationCount.' '.$frientReviewText }} you might know refer or recommend this business</p>
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
  </div>

  <!-- /Filter Item -->
@endforeach
@endif
<script>

$.validate({
    form : '#user_message_form'
  });



$(".viewWorkingHoursModal").click(function(){
	$('.viewWorkingHoursModals').modal('show', {backdrop: 'static'});
		$id = $(this).attr('data-id');
		var objData = {};
		var sendData = {};
		sendData = {
		id: $(this).attr('data-id'),
		};
		 objData = {
		      url: BASE_URL + '/view-workinghours',
				      type: 'post',
				      sendData: sendData
		 };
		$(".working-hours-display").html('Loading...');
		send_ajax_request(objData, function (callback) {
		  if (callback.status == "200") {
			$(".working-hours-display").html('');
		    $(".working-hours-display").html(callback.result);
		  }
		 });
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
					 if(windowWidth <= 767){
						 $('#hidcallusButton_'+data_business_id)[0].click();
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
					// $('#hidWebsiteButton_'+data_business_id)[0].click();
				  }
				 });
	 }
 });


</script>
