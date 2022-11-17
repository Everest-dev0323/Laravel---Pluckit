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
		<div class="col-lg-6 col-xl-5">
		<h1 class="h2 mb-3">	G’day Pluckers.</h1>
		 <!-- <div class="text-hightlight">
			<p>92% of consumers trust recommendations from friends.</p>
			<p class="mb-0">We're here to make that process a whole lot easier for you, rather than shouting over the fence to ask that neighbour of yours.</p>
		  </div> -->
<!--		  <p>$200 up for grabs just for recommending your favourite tradies. Register, follow the 2 simple steps, and you're automatically entered.</p>
		  <p>Why Pluckit? Something to think about:</p> -->
		  <ul class="list-unstyled list-check">
<!-- 			<li>Anything from a recommendation you trust, goes a lot further. Agree?</li>
 -->			<li>Find recommended tradies, literally from people you know. No posting involved.</li>
<!-- 			<li>Search a tradie, discover recommendations, enquire. Easy.</li>
 -->			<li>Base your decision off known, trusted recommendations. Not on companies who have bid their way to the top. </li>
			<li>You contact tradies who you like based on recommendations from people you know. For free.</li>
		  </ul>

		  <div class="image">
			<img class="img-fluid" src="{{ ('/public') }}/front-assets/images/cartoon.png" alt="Image">
		  </div>
		</div>
		<div class="col-lg-6 col-xl-6 offset-xl-1">
		  <form action="{{ url('signup') }}" class="signup-form" method="POST">
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
			  <h4>DETAILS</h4>
			  <div class="row">
				<div class="col-md-6">
				  <div class="field">
					<input type="text" name="name" id="fullname" class="form-control @error('name') is-invalid @enderror" placeholder="{{ __('First Name') }}" value="{{ old('name') }}" required autocomplete="name" autofocus pattern="/^[a-zA-Z0-9]+$/" data-parsley-pattern-message="First Name can have only alphabets and numbers.">
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
					<input type="text" name="lastname" id="lastname" class="form-control @error('lastname') is-invalid @enderror" placeholder="{{ __('Last Name') }}" value="{{ old('lastname') }}" required autocomplete="lastname" pattern="/^[a-zA-Z0-9]+$/" data-parsley-pattern-message="Last Name can have only alphabets and numbers.">
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
					<input type="email" name="email" id="email" class="form-control" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" required autocomplete="email" pattern="^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$">
					<label for="email">{{ __('E-Mail Address') }}<span>*</span></label>
				  </div>
				</div>
				<div class="col-2 col-sm-1 col-md-1 pr-0">
				  <div class="field">
					<input type="tel" id="pre-fix" class="form-control form-control pb-1" placeholder="+61" value="+61" disabled>
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
				  <div class="field">
					<input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror"
					  placeholder="{{ __('Password') }}" required autocomplete="new-password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" data-parsley-pattern-message="Should be combination between characters, upercase, lower case and numbers, minimum 8 characters">
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
			  <button type="submit" class="btn btn-primary btn-block rounded mt-4 mb-2">REGISTER NOW</button>
			   <p class="text-center">Or Already have an account?<a href="#" class="btn btn-link p-0 ml-1" data-toggle="modal" data-target="#loginModal">LOG IN</a>
			  </p>
			  <p class="text-center">By registering with us you agree to our<a href="{{ url('/privacy-policy') }}" class="btn btn-link p-0 ml-1">
			   Privacy Policy</a> <br>and <a href="{{ url('/terms-of-service') }}" class="btn btn-link p-0 ml-1">Terms & Conditions</a>
			  </p>
			</div>
		  </form>
		  <br/><p> If that still hasn't got you across the line…</p>
		<p>It’s time to change the traditional consumer behaviour where we tend to select Tradies who have bought and bid their way to the top of a listing and get sucked into thinking that these are the Tradies we should select. Where is the trust in that? Start making more educated decisions through the help of people we trust and utilise their recommendations.</p>
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
        $('form').parsley();
    });

</script>
@endsection
