@extends('layouts.front-end.app')
@section('content')
<!-- Content -->
<div id="content" class="pt-0">
  <!-- Signup -->
  <section class="section signup-content">
	<div class="container">
	  <div class="row">
	  <div class="col-md-12">
		  @if(session()->get('success'))
			<div class="alert alert-success">
				{{ session()->get('success') }}
			</div><br />
			@endif
			@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
         </div>
	  </div>
	  <div class="row">
		<div class="col-lg-6">
		  <h1 class="h2 mb-3">Registered vs non-registered Pluckit Tradies</h1>
		  <p>Do the maths. Weigh up the cost for advertising with other major marketing publishers and Tradie platforms (thousands per month) compared to Pluckit. Our mission is simple. Affordable, effective marketing to help recognise our valuable Tradies without money being the only determinant</p>
		  <ul class="list-unstyled list-check">
<!-- 			<li>Free 14 day trial, cancel any time</li>
 -->			<li>Qualified, ready-to-go leads who contact you.</li>
			<li>Integrate the recommendations that Pluckit has already found for your business.</li>
		  </ul>
		  <div class="image text-center text-lg-left">
			<img class="img-fluid" src="{{ ('/public') }}/front-assets/images/choose-plan.png" alt="Image">
		  </div>
		</div>
		<div class="col-lg-6">
		  <form action="{{ url('checkout') }}" method="post" class="signup-form">
		  @csrf
		  <div class="payments-container">
				<h3>Pluck your plan</h3>
				<input type="hidden" name="user_id" value="{{ $user_id }}">
				@if((!empty($user['refer_referral_code'])))
				<div class="alert alert-primary" role="alert">50% off on your referral code {{ $user['refer_referral_code'] }}</div>
				@endif

				<label class="plan-field bg-gray-light">
					<span class="checkmark">
                        <input type="radio" name="pricing" value="{{ config('services.stripe.free') }}" checked="">
						<span class="plan-radio-button"></span>
					</span>
					<span class="planInfo">
					<span class="plan-title">Free Plan</span>
					<span class="plan-desc"> List your business for free and start gaining reputations -  limited plan.</span>
					</span>
					<span class="plan-price">$0</span>
				</label>

				<label class="plan-field bg-gray-light">
					<!-- <span class="badge badge-primary horizontal-center">Most popular and recommended</span> -->
					<span class="checkmark">
						<input type="radio" name="pricing" value="{{ config('services.stripe.six_monthly') }}" checked="">

						<span class="plan-radio-button"></span>
					</span>
					<span class="planInfo">
					<span class="plan-title">6 Months</span>
					<span class="plan-desc"> Safe bet. Get a feel on how it works.</span>
					</span>
					<span class="plan-price">
						@if(!empty($user['refer_referral_code']))
							<strike>$500</strike>
						@else
							$500
						@endif
						<br/>
						@if(!empty($user['refer_referral_code']))
							<span class="save-price">{{ (!empty($user['refer_referral_code']))?"$250":"$500" }}</span>
						@endif
					</span>
				</label>

				<label class="plan-field bg-gray-light">
					<span class="badge badge-primary horizontal-center">*Special Offer*</span>
					<span class="checkmark">
						<input type="radio" name="pricing" value="{{ config('services.stripe.twelve_monthly') }}" >
						<span class="plan-radio-button"></span>
					</span>
					<span class="planInfo">
					<span class="plan-title">12 Months</span>
					<span class="plan-desc"> Serious about getting more work. Receive 12 months for the price of 9 months</span>
					</span>
					<span class="plan-price">
						@if(!empty($user['refer_referral_code']))
							<strike>$750</strike>
						@else
							$750
						@endif
						<br/>
						@if(!empty($user['refer_referral_code']))
							<span class="save-price">{{ (!empty($user['refer_referral_code']))?"$375":"$500" }}</span>
						@endif
					</span>
				</label>
				<div class="row">
					<div class="col-12 text-center">
						<div class="row">
								<div class="{{ (empty($user['refer_referral_code']))?'col-md-9 pr-0':'col-md-12'  }} col-sm-12">
									<input type="text" id="referral-code" name="referral" value="{{ (!empty($user['refer_referral_code']))?$user['refer_referral_code']:'' }}" class="form-control" placeholder="Have a referral code?">
								</div>
								@if(empty($user['refer_referral_code']))
								<div class="col-md-3 col-sm-12 pl-0">
									<button class="btn btn-primary btn-block rounded btn-sm verify-referral" type="button">Verify</button>
								</div>
								@endif
						</div>
						<p>Enter Your Referral Code Here</p>
					</div>
				</div>
				<div class="row">
					<div class="col-12 text-center">
					    <button type="submit" class="btn btn-primary btn-block rounded mb-2">Start my plan</button>
					</div>
				</div>
			</div>
            </form>
		</div>
	  </div>
	</div>
  </section>
  <!-- /Signup-->
</div>
<!-- /content -->
@endsection
@section('extracontent')
<script src="{{ ('/public') }}/front-assets/lib/parsleyjs/parsley.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('form').parsley();
		$(".verify-referral").click(function(){
			$(this).attr('disabled',true);
			$(this).html('Loading...');
			if($("#referral-code").val()){
				var objData = {};
				var sendData = {};
					sendData = { referral: $("#referral-code").val()}
					 objData = {
						      url: window.location.href,
						      type: 'post',
							  dataType:"json",
						      sendData: sendData
					 };
					send_ajax_request(objData, function (callback) {
						if (callback.status == "200") {
							window.location.reload();
						} else {
							$(".verify-referral").removeAttr('disabled');
							$(".verify-referral").html('Verify');
							alert('Invalid referral Code');
						}
					 });
				} else {
					$(".verify-referral").removeAttr('disabled');
					$(".verify-referral").html('Verify');
					alert('Please enter referral code first');
				}
		});
    });
	 $("body").on("keyup","#business_abn",function(){
	 $("#abn-error").addClass('d-none');
     var business_abn = $("#business_abn").val();
	 var hid_business_abn = $("#hid_business_abn").val();
	// alert(business_abn);

    if(business_abn != ''){
		if(business_abn != hid_business_abn){
			 var objData = {};
			 var sendData = {};
				sendData = {
					business_abn: business_abn,
				};
				 objData = {
					      url: BASE_URL + '/business/user/chkDuplicateAbn',
					      type: 'post',
					      sendData: sendData
				 };
				send_ajax_request(objData, function (callback) {
					console.log(callback);
					if (callback.status == "200") {
						$("#abn-error").removeClass('d-none');
						$("#abn-error").html(callback.result);
						$('#btnSubmit').attr("disabled",true);
					}else{
						$("#abn-error").addClass('d-none');
						$('#btnSubmit').attr("disabled",false);
					}
				 });
	}
	}else{
		$("#abn-error").addClass('d-none');
	}


 });


</script>
@endsection
