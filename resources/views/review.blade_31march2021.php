@extends('layouts.front-end.app')
@section('content')
<section class="section signup-content clearfix">
<form action="{{ url('business/saveReview')}}" method="post" enctype="multipart/form-data" id="frontreview" onsubmit="return false">
     {{ csrf_field() }}
<div class="container">
	<div class="row clearfix">
	  <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<h2 class="heading-style">Leave a Recommendation</h2>
			<h4>We’re here to help each other. We’d love to hear about your experience.</h4>
			<p></p>
			<p></p>
			<p>Please enter the business name you are looking to recommend.</p>
			<div class="mb30">
				<input class="form-control" name="business_name_recommend" id="business_name_recommend" placeholder="Start typing business name" type="text" required >
			</div>
			<div class="mb30 d-none" id="trade">
			<p>Select the trade: </p>
			<span class="styled-select">
				<select class="form-control select2-show-search" name="trade" data-placeholder="Search for an Electrician, a Plumber, etc.">
					<option value="">Search for an Electrician, a Plumber, etc.</option>
					@if(!empty($trades[0]))
						@foreach($trades as $tr)
						  <option value="{{ $tr->alias}}">{{ $tr->name}}</option>
						 @endforeach
					@endif
				</select>
			</span>
			</div>
			<p>What rating do you give this business?</p>
			<div class="mb30">
				<div class="rating-leave d-flex justify-content-start align-items-md-center mb-2 font-1rem" id="rating">
					  <a style="font-size:1.7rem !important" href="javascript:;" class="star" title="Poor" data-value="1"><i class="far fa-star text-gray"></i></a>
					  <a style="font-size:1.7rem !important" href="javascript:;" class="star" title="Fair" data-value="2"><i class="far fa-star text-gray"></i></a>
					  <a  style="font-size:1.7rem !important" href="javascript:;" class="star" title="Good" data-value="3"><i class="far fa-star text-gray"></i></a>
					  <a style="font-size:1.7rem !important" href="javascript:;" class="star" title="Excellent" data-value="4"><i class="far fa-star text-gray"></i></a>
					  <a style="font-size:1.7rem !important" href="javascript:;" class="star" title="WOW!!!" data-value="5"><i class="far fa-star text-gray"></i></a>
					<div class="reviews rating ml-2">
					   <span style="font-size:1.2rem !important; color:#f8c323;" href="#" class="review_count">(0)</span>
					</div>
				</div>
				<p style="color:#B94A48;" class="d-none" id="error-star">This value is required.</p>
			</div>
			<p>Do you give this business a thumbs up, or thumbs down?</p>
			<div class="mb30">
				<div class="user-block text-left font-1rem">
					<a href="javascript:;"  class="btn btn-link btn-like thumbs_up" data-like="0"><i style="font-size:1.7rem !important" class="far fa-thumbs-up mr-2"></i>0</a>
					<a href="javascript:;" class="btn btn-link btn-dislike thumbs_down" data-unlike="0"><i style="font-size:1.7rem !important" class="far fa-thumbs-down mr-2"></i>0</a>
				  </div>
			</div>
			<p>Any comments you wish to leave</p>
			<div class="mb30">
				<textarea class="form-control" name="comments" id="comments" placeholder="Start typing..." rows="3" required></textarea>
			</div>
			<input type="hidden" name="rating" id="hid_rating" value="0">
		    <input type="hidden" name="user_id" id="user_id" value="{{ !empty($user) ? $user->id : ''}}">
			<input type="hidden" name="hid_business_id" id="hid_business_id" value="">
			<input type="hidden" name="hid_like" id="hid_like" value="">
			<input type="hidden" name="hid_unlike" id="hid_unlike" value="">
			<input type="hidden" name="hid_trade" id="hid_trade" value="">
		    <button type="submit" class="btn btn-primary button_submit">Submit</button>
		</div>

	</div>
</div>
</form>
</section>
@endsection
@section('extracontent')
<script src="{{ ('/public') }}/front-assets/lib/parsleyjs/parsley.min.js"></script>
<script type="text/javascript">
$('#trade').addClass('d-none');
$('#hid_rating').val(0);
$('#hid_like').val(0);
$('#hid_unlike').val(0);
$(".button_submit").on('click', function(){
 if ($('#frontreview').parsley().validate() == true) {
	 var stars = $("#hid_rating").val();
	 if(stars == 0){
		 $('#error-star').removeClass('d-none');
		 return false;
	}else{
		$(".button_submit").html('Loading...');
		 $('#frontreview').attr('onsubmit','return true');
	 }
 }
 });
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
