@extends('layouts.front-end.app')
@section('content')
<section class="section signup-content clearfix">
<div class="container">
	<div class="row clearfix">
		<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<h2 class="heading-style">Before you leave please add the business details</h2>
			<form method="post" action="{{ url('business/review/submission/save')}}" role="form">
			{{ csrf_field() }}   
				<div class="row clearfix">
					<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
						<div class="form-group">
							<input type="text" name="contactName" id="contactName" class="form-control" placeholder="Contact Name (Optional)" />
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-1">
						<div class="form-group">
							<input type="tel" class="form-control" placeholder="+61" value="+61" disabled/>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-5">
						<div class="form-group">
							<input type="tel" name="contactPhone" id="contactPhone" maxlength="10" class="form-control" placeholder="Phone (Optional)" value="{{ !empty($getBusinessListing->business_phone) ? $getBusinessListing->business_phone : '' }}"{{ !empty($getBusinessListing->business_phone) ? 'disabled' : '' }} />
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
						<div class="form-group">
							<input type="email" name="contactEmail" id="contactEmail" class="form-control" placeholder="Email (Optional)" value="{{ !empty($getBusinessListing->business_email) ? $getBusinessListing->business_email : '' }}"{{ !empty($getBusinessListing->business_email) ? 'disabled' : '' }}/>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
						<div class="form-group">
							<input type="text" name="contactWebsite" id="contactWebsite" class="form-control" placeholder="Website (Optional)" value="{{ !empty($getBusinessListing->business_website_url) ? $getBusinessListing->business_website_url : '' }}"{{ !empty($getBusinessListing->business_website_url) ? 'disabled' : '' }} />
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
						<div class="form-group">
							<select class="form-control" name="city" id="city">
								<option value="">State (Optional)</option>
								@if(!empty($states[0]))
									@foreach($states as $st)
								      <option value="{{ $st->name}}" {{ (!empty($getBusinessListing->business_state) && ($getBusinessListing->business_state == $st->name)) ? 'selected' : '' }} {{ (!empty($getBusinessListing->business_state) && ($getBusinessListing->business_state == $st->name)) ? 'disabled' : '' }}>{{ $st->name}}</option>
									 @endforeach
								@endif
							</select>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
						<div class="form-group">
							<input type="text" name="suburb" id="suburb_recommendation" class="form-control" placeholder="Suburb (Optional)" value="{{ !empty($getBusinessListing->business_city) ? $getBusinessListing->business_city : '' }}" />
							<span class="loader loader-suburb d-none">
								<i class="fa fa-spin fa-spinner"></i>
							</span>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
						<div class="form-group">
							<input type="text" name="postcode" id="postcode_recommendation" class="form-control" placeholder="Post Code (Optional)" value="{{ !empty($getBusinessListing->business_zipcode) ? $getBusinessListing->business_zipcode : '' }}"{{ !empty($getBusinessListing->business_zipcode) ? 'disabled' : '' }} />
							<span class="loader loader-postcode d-none">
								<i class="fa fa-spin fa-spinner"></i>
							</span>
						</div>
					</div>
					<div class="col-12">
					    <input type="hidden" name="hid_demo_review_id" id="hid_demo_review_id" value="{{ $demoReviewId }}">
						<input type="submit" name="submit" id="submit" value="SUBMIT" class="btn btn-primary" />
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
</section>
@endsection
@section('extracontent')
<script type="text/javascript">
var getData ="{{ !empty($get['user']) ? $get['user'] : 0 }}";
if((getData == 1)){
	$('.btn-login').click();
	$('.login_textchange').html('Final Step<br><span class="h5">To submit your recommendation, please log in via the following</span>');
}
$(".btn-login").click(function(){
	$('.login_textchange').html('LOG IN');
});

</script>
@endsection
