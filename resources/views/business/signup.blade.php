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
         </div>
	  </div>
	  <div class="row">
		<div class="col-lg-6">
		  <h1 class="h2 mb-3">The Mother Plucker of Tradies</h1>
			<p>People are 4 times more likely to pluck a business when referred by friends.</p>
			<!-- <p><strong>We are currently offering a one-off 14-day free trial to get you started</strong></p> -->
			  <!-- <div class="text-hightlight">
			  	<p class="mb-0"><i>"Consumers believe testimonials from friends and family over all forms of advertising" - Microsoft</i></p>
		  </div> -->

		  <ul class="list-unstyled list-check">
			<li>Word of mouth marketing brings in 5 times more sales than paid media (Source: Invesp)</li>
			<li>Users select Tradies based on 200,000+ recommendations and growing.</li>
			<li>No manual job bidding or paying for quotes. Easy one-off setup, unlimited leads.</li>
			<li>Find & import already-discovered client recommendations from Pluckits integrated database.</li>
			<li>Clients contact YOU first. No time wasting like the others.</li>
			<li>Control & personalise your services, certificates, photos, promo's & more.</li>
			<li>24/7 reporting dashboard access. View profile clicks, leads & more.</li>

		  </ul>
		  <div class="image text-center text-lg-left">
			<img class="img-fluid" src="{{ ('/public') }}/front-assets/images/personal-details.png" alt="Image">
		  </div>
		</div>
		<div class="col-lg-6">
		  <form action="{{ url('business/user/signup') }}" class="signup-form" id="signup-form" method="POST">
		   @csrf
			<div class="form-group mb-md-4 d-none">
			  <label class="sr-only" for="inlineFormInputGroup">Username</label>
			  <div class="input-group mb-2">
				<div class="input-group-prepend">
				  <div class="input-group-text">Select your trade</div>
				</div>
				<input type="text" class="form-control rounded-right" id="inlineFormInputGroup"
				  placeholder="Plumber">
				<div class="input-group-prepend btn-wrap">
				  <div class="input-group-text bg-white">
					<button type="button" class="btn btn-link p-0"><i class="far fa-pencil"></i></button>
				  </div>
				</div>
			  </div>
			</div>
			<div class="box bg-gray-light box-shadow">
			@if(!empty($get['referral']) && empty($validRef))
					<h4 class="text-danger p-0 mb-1 text-center">Invalid Referral Code.</h4>
				@endif
			  <h4>Personal Details</h4>
			  <div class="row">
				<div class="col-md-6">
				  <div class="field">
					  <input type="hidden" value="{{ (!empty($get['referral']))?$get['referral']:'' }}" name="referral">
					<input type="text" name="name" id="fullname" class="form-control @error('name') is-invalid @enderror" placeholder="{{ __('First Name') }}" value="{{ old('name') }}" pattern="/^[a-zA-Z0-9]+$/" required autocomplete="name" autofocus data-parsley-pattern-message="First Name can have only alphabets and numbers.">
					@error('name')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
					<label for="fullname">{{ __('First Name') }}<span>*</span></label>
			      </div>
				</div>
				<div class="col-md-6">
				  <div class="field">
					<input type="text" name="lastname" id="lastname" class="form-control @error('lastname') is-invalid @enderror" placeholder="{{ __('Last Name') }}" value="{{ old('lastname') }}" pattern="/^[a-zA-Z0-9]+$/" required autocomplete="lastname" data-parsley-pattern-message="Last Name can have only alphabets and numbers.">
					@error('lastname')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
					<label for="lastname">{{ __('Last Name') }}<span>*</span></label>
				  </div>
				</div>
			  </div>
			  <div class="row">
				<div class="col-md-6">
				  <div class="field">
					<input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" pattern="^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" required autocomplete="email">
					 @error('email')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
					<label for="email">{{ __('E-Mail Address') }}<span>*</span></label>
				  </div>
				</div>
				<div class="col-2 col-sm-1 col-md-1 pr-0">
				  <div class="field">
					<input type="tel" id="pre-fix" class="form-control pb-1" placeholder="+61" value="+61" disabled>
					<label for="pre-fix">Prefix<span></span></label>
				  </div>
				</div>
				<div class="col-10 col-sm-11 col-md-5 pl-0">
				  <div class="field">
					<input type="tel" name="mobile_no" id="tel" class="form-control @error('mobile_no') is-invalid @enderror" placeholder="Phone number" value="{{ old('mobile_no') }}" required autocomplete="mobile_no" maxlength="10">
					@error('mobile_no')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
					<label for="tel" class="pl-lg-1">Phone number<span>*</span></label>
				  </div>
				</div>
			  </div>
			  <div class="row">
				<div class="col-md-6">
				  <div class="field mb-2">
					<input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror"
					  placeholder="{{ __('Password') }}" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"  required autocomplete="new-password" data-parsley-pattern-message="Should be combination between characters, upper case, lower case and numbers, minimum 8 characters">
					   @error('password')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					<label for="password">{{ __('Password') }}<span>*</span></label>
				  </div>
				  <small id="password" class="form-text">Should be combination between characters, upper case, lower case, numbers and minimum 8 characters</small>
				</div>
				<div class="col-md-6">
				  <div class="field">
					<input type="password" name="password_confirmation" id="password-confirm" class="form-control"
					  placeholder="{{ __('Confirm Password') }}" required autocomplete="new-password">
					<label for="password-confirm">{{ __('Confirm Password') }}<span>*</span></label>
				  </div>
				</div>
			  </div>
			  <button type="submit" class="btn btn-primary btn-block rounded mt-4 mb-2">Continue</button>
			  <p class="text-center">Or already have an account?<a href="#" class="btn btn-link p-0 ml-1" data-toggle="modal" data-target="#loginModal">LOG IN</a>
			  </p>
			  <p class="text-center">By registering with us you agree to our</p>
			  <p class="text-center"><a href="{{ url('/privacy-policy') }}" class="btn btn-link p-0 ml-1">
			   Privacy Policy </a> and<a href="
			   {{ url('/terms-of-service') }}" class="btn btn-link p-0 ml-1">Terms & Conditions</a>
			  </p>
			</div>
			 <br/><p>Every 20 seconds, there is a customer searching for a Tradie on Pluckit. One of Australia's fastest growing platforms with new and engaged customers every day. Be where the people are going.</p>
			<!-- Step third | Choose plan -->

			<!-- Step third -->
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


<script type="text/javascript" src="{{ ('/public') }}/front-assets/lib/parsleyjs/parsley.min.js"></script>
<script type="text/javascript">

    $(document).ready(function () {
        $('#signup-form').parsley();
    });

</script>
@endsection
