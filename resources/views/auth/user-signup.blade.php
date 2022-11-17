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
		   <h5 class="text-center"><strong>Create Account or Log in</strong> </h5>
		   <p class="text-center">via Facebook, Gmail, or Outlook to get started</p> <br/>
			<ul class="list-unstyled social-btn-group text-center my-sm-3">
			  <li><a href="{{ url('auth/fb') }}" class="btn btn-primary facebook"><span class="icon"><i class="fab fa-facebook-f"></i></span><span>Sign in with
			  Facebook</span></a></li>
			  <li><a href="{{ url('auth/google') }}" class="btn btn-primary google-plus"><span class="icon"><img src="data:image/png;base64,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"/></span><span>Sign in with
					Google</span></a></li>
			  <li><a href="{{ url('auth/outlook') }}" class="btn btn-primary outlook"><span class="icon"><img class="img-fluid"
					src="{{ ('/public') }}/front-assets/images/icon/outlook-blue.png" alt="Outlook"></span><span>Sign in with Outlook</span></a></li>
			</ul>
			<p class="section-divider text-center"><span>or</span></p>

			 <div style="text-align:center">
			  <a href="{{ url('signup') }}">Create Your Pluckit Account</a>​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​
			</div>
			<br/>
			<br/>
			<p> If that still hasn't got you across the line…</p>
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
