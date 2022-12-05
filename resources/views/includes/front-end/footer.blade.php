<!-- Footer -->
<footer id="footer" class="overlay dark-1">
    <div class="container">
      <div class="row mb-md-3">
        <div class="col-lg-6">
          <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-7 column1">
             <h4>We are here to help!</h4>
             <p>Recommended Tradies from people you know.</p>
             <p>Save on time, money, and the hassle when finding the right Tradie.</p>
             <p>Pluck the right Tradie from the start with a platform that promotes full user control, transparency and ease-of-use to bring people together and make better informed decisions.</p>            </div>
            <div class="col-sm-6 col-md-6 col-lg-5 column1">
              <h4>TRADIES</h4>
              <ul class="footer-nav">
                <li><a href="{{ url('/business/user/signup') }}">REGISTER MY BUSINESS</a></li>
                <li><a href="#" data-toggle="modal" data-target="#loginModal">BUSINESS LOGIN</a></li>
                <li><a href="{{ url('/help') }}">Tradies FAQ</a></li>
<li><a href="{{ url('/referral-program') }}">Referral Program</a></li>
              </ul>
            </div>
          </div>
        </div>
		@php

     $getWhyPluckit = \App\Page::where('alias','why-pluckit')->first();
     $getPluckitDifferent = \App\Page::where('alias','how-pluckit-is-different')->first();
     $getForcustomer = \App\Page::where('alias','for-the-customer')->first();
     $getPrivacy = \App\Page::where('alias','privacy-policy')->first();
     $gettermsofservice = \App\Page::where('alias','terms-of-service')->first();
     $getCountactus = \App\Page::where('alias','contact-us')->first();


		@endphp
        <div class="col-lg-6 column1">
          <div class="row">
            <div class="col-sm-6">
              <h4>IMPORTANT LINKS</h4>
			    <ul class="footer-nav">
         <!-- @if(!empty($getCategories->page_name))
				  <li><a href="{{ url('page').'/'.$getCategories->alias}}">{{ $getCategories->page_name }}</a></li>
			    @endif -->
				@if(!empty($getWhyPluckit->page_name))
				  <li><a href="{{ url('page').'/'.$getWhyPluckit->alias}}">{{ $getWhyPluckit->page_name }}</a></li>
			    @endif
				@if(!empty($getPluckitDifferent->page_name))
				  <li><a href="{{ url('page').'/'.$getPluckitDifferent->alias}}">{{ $getPluckitDifferent->page_name }}</a></li>
			    @endif
				@if(!empty($getForcustomer->page_name))
				  <li><a href="{{ url('page').'/'.$getForcustomer->alias}}">{{ $getForcustomer->page_name }}</a></li>
			    @endif
				@if(!empty($getPrivacy->page_name))
				  <li><a href="{{ url('page').'/'.$getPrivacy->alias}}">{{ $getPrivacy->page_name }}</a></li>
			    @endif
				@if(!empty($gettermsofservice->page_name))
				  <li><a href="{{ url('page').'/'.$gettermsofservice->alias}}">{{ $gettermsofservice->page_name }}</a></li>
			    @endif
				@if(!empty($getCountactus->page_name))
				  <li><a href="{{ url('page/contact-us')}}">{{ $getCountactus->page_name }}</a></li>
			    @endif
				  <li><a href="{{ url('/faq')}}">Faq</a></li>

          </ul>
			  </div>
            <div class="col-sm-6 column1">
              <h4>FOLLOW US</h4>
              <ul class="social-links mb-3">
                <!-- <li><a href="https://twitter.com/" title="twitter" target="_blank">
                    <img src="{{ ('/public') }}/front-assets/images/icon/twitter.png" alt="Twitter">
                  </a>
                </li> -->
                <li>
                  <a href="https://www.facebook.com/pluckit.au" title="facebook" target="_blank">
                    <img src="{{ ('/public') }}/front-assets/images/icon/facebook.png" alt="Facebook">
                  </a>
                </li>
                <li>
                  <a href="mailto:info@pluckit.com.au" title="Site Email" target="_blank">
                    <img src="{{ ('/public') }}/front-assets/images/icon/gmail.png" alt="Gmail">
                  </a>
                </li>
                <li>
                  <a href="https://www.instagram.com/pluckit.au/" title="Instagram" target="_blank">
                    <img src="{{ ('/public') }}/front-assets/images/icon/instagram.png" alt="Instagram">
                  </a>
                </li>
                <!-- <li>
                  <a href="https://www.pinterest.com/" title="Pinterest" target="_blank">
                    <img src="{{ ('/public') }}/front-assets/images/icon/pinterest.png" alt="Pinterest">
                  </a>
                </li> -->
              </ul>
              <form class="form newsletter-form" action="" method="post" id="newsletter-form" onsubmit="return false">
			  @csrf
                <div class="form-group">
                  <input type="email" name="newsletter_email" id="newsletter_email" class="form-control" placeholder="Enter your Email.." data-validation="required">
                </div>
                <div class="form-group">
				  <button type="submit" class="btn btn-primary rounded w-100 newsletter_subscribe">SUBSCRIBE</button>
                  <input type="submit" class="btn btn-primary rounded w-100 d-none" value="SUBSCRIBE">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-bar">
      <div class="container text-center">
        <ul>
          <li>
            <p>Copyright &copy;{{ date('Y') }} Pluckit</p>
          </li>
          <li>
            <p>Powered by : <a href="http://www.fusionwebdesign.com.au/">Fusion Web Design</a></p>
          </li>
        </ul>
      </div>
    </div>
  </footer>
  <!-- Footer -->

  <!-- Javascript -->
  <script src="{{ ('/public') }}/front-assets/javascripts/vendor/jquery-ui.js"></script>
  <script src="{{ ('/public') }}/front-assets/javascripts/vendor/popper.js"></script>
  <!-- <script src="{{ ('/public') }}/front-assets/javascripts/vendor/bootstrap.bundle.js"></script> -->
  <script src="{{ ('/public') }}/front-assets/javascripts/vendor/bootstrap.js"></script>
  <script src="{{ ('/public') }}/front-assets/javascripts/vendor/jquery-touch-events.js"></script>
  <script src="{{ ('/public') }}/front-assets/javascripts/vendor/ofi.browser.js"></script>
  <script src="{{ ('/public') }}/front-assets/javascripts/vendor/owl.carousel.js"></script>
  <script src="{{ ('/public') }}/front-assets/javascripts/vendor/wow.min.js"></script>
  <script src="{{ ('/public') }}/front-assets/javascripts/vendor/all.js"></script>
  <script src="{{ ('/public') }}/front-assets/javascripts/vendor/meanmenu.js"></script>
  <!-- Fancybox js -->
  <script src="{{ ('/public') }}/front-assets/javascripts/vendor/jquery.fancybox.min.js"></script>
  <script src="{{ ('/public') }}/front-assets/javascripts/vendor/thumbs.js"></script>
    <!-- Easy Autocomplete JS Code  -->
  <script src="{{ ('/public') }}/front-assets/dist/jquery.easy-autocomplete.min.js"></script>

<script src="{{ ('/public') }}/front-assets/javascripts/vendor/jquery.matchHeight.js"></script>
<script src="{{ ('/public') }}/front-assets/lib/jquery.filer/js/jquery.filer.js"/></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="{{ ('/public') }}/front-assets/lib/select2/select2.min.js"></script>
  <!-- Custom JS Code for this page -->
  <script src="{{ ('/public') }}/front-assets/javascripts/main.js"></script>
  <script>
    new WOW().init();
  </script>

<div class="fixed-bottom footer-bottom bg-light box-shadow3 text-center">
   <a href="{{ url('leave-recommendation') }}" class="btn btn-primary btn-animate">Leave a Recommendation</a>&nbsp;
   <a href="{{ url('business/user/signup') }}" class="btn btn-primary btn-animate">Claim Your Business</a>
</div>

  <!-- Modal -->
  <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalTitle" data-backdrop="static" data-keyboard="false"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
      <div class="modal-wrap py-0">
          <div class="modal-header p-0 justify-content-center border-0">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-center">
            <div class="logo mb-4">
              <img class="img-fluid" src="{{ ('/public') }}/front-assets/images/logo.png" alt="Pluckit">
            </div>
            <h4 class="login_textchange">Create Account or Log In</h4>
            <!-- Choose Login type -->
            <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                <li class="nav-item">
                <a class="nav-link active" id="customer-tab" data-toggle="tab" href="#customer" role="tab" aria-controls="customer" aria-selected="true"><i class="fal fa-user-circle mr-2"></i>For Customer</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" id="business-tab" data-toggle="tab" href="#business" role="tab" aria-controls="business" aria-selected="false"> <i class="fal fa-user-crown mr-2"></i>For Businesses</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <!-- Customer Login -->
              <div class="tab-pane fade show active" id="customer" role="tabpanel" aria-labelledby="customer-tab">
              <p>To discover your friend recommendations, we strongly encourage to proceed via Facebook, Google or Outlook and kindly permit Pluckit to import your contacts. It’s safe & secure.</p>
                <ul class="list-unstyled social-btn-group text-center my-sm-3">
                  <li><a href="{{ url('auth/fb') }}" class="btn btn-primary facebook"><span class="icon"><i class="fab fa-facebook-f"></i></span><span>Sign in with Facebook</span></a></li>
                  <li><a href="{{ url('auth/google') }}" class="btn btn-primary google-plus"><span class="icon"><img src="data:image/png;base64,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"/></span><span>Sign in with Google</span></a></li>
                  <li><a href="{{ url('auth/outlook') }}" class="btn btn-primary outlook"><span class="icon"><img class="img-fluid"
                        src="{{ ('/public') }}/front-assets/images/icon/outlook-blue.png" alt="Outlook"></span><span>Sign in with Outlook</span></a></li>
                   <li><a style=" background: #e87163;" href="https://dev.pluckit.com.au/signup" class="btn btn-primary "><span>Prefer to sign up with an email address? </span></a></li>
                </ul>
                <p class="section-divider mb-0"><span>or</span></p>
              </div>
              <!-- /Customer Login -->
              <!-- Business Login -->
              <div class="tab-pane fade" id="business" role="tabpanel" aria-labelledby="business-tab">

              </div>
              <!-- /Business Login -->
            </div>
            <!-- /Choose Login type-->
			<div class="alert alert-danger error-message d-none">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div id="login_user">
					<form action="#" class="form mt-3" method="POST" id="frontlogin" onsubmit="return false">
					@csrf
					<input type="hidden" name="type_user" id="type_user_value" value="1" >
					  <div class="form-group">
						<input type="email" name="email" class="form-control" placeholder="{{ __('Already a member? Enter Email Address') }}" required autocomplete="email" autofocus/>
					  </div>
					  <div class="form-group">
						<input type="password" name="password" class="form-control" placeholder="{{ __('Password') }}" required autocomplete="current-password"/>
					  </div>
					  <div class="form-group">
						<button type="submit" class="btn btn-primary d-block w-100 button_login">LOG IN</button>
					  </div>
					  <div class="row form-footer">
						<div class="col-sm-6 text-sm-left">
<!-- 						  <p id="normal_signup" class="">Not a member?<a href="{{ url('user/signup')}}" class="btn btn-link p-0 ml-1">SIGN UP</a></p> -->
						  <p id="business_signup" class="d-none">Business Member?<a href="{{ url('/business/user/signup')}}" class="btn btn-link p-0 ml-1">SIGN UP</a></p>
						</div>
						<div class="col-sm-6 text-sm-right">
						 <a href="javascript:;" class="btn btn-link p-0 user_forgot_click">Forgot password?</a>
						</div>
					  </div>
					</form>
			    </div>
				<div id="user_forgot" class="d-none">
				  <form action="#" class="form mt-4" method="POST" id="frontforgot" onsubmit="return false">
					@csrf
					 <div class="form-group">
						<input type="email" name="forgot_email" id="forgot_email" class="form-control" placeholder="{{ __('E-Mail Address') }}" required autocomplete="forgot_email" autofocus/>
			     </div>
					  <div class="form-group">
                <button type="submit" class="btn btn-primary d-block w-100 button_forgot">Send</button>
            </div>
                <div class="form-group">
                <button type="button" class="btn btn-info d-block w-100 forgot_back">
				     <i class="fas fa-long-arrow-alt-left mr-2"></i>Go Back To Login</button>
					  </div>
					</form>
				</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /Modal -->
  <!-- viewWorkingHoursModals -->
 <div class="modal fade viewWorkingHoursModals" id="viewWorkingHoursModals" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-wrap">
          <div class="modal-header border-0">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-center working-hours-display" id="working-hours-display">

          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /viewWorkingHoursModals -->
<script src="{{ ('/public') }}/front-assets/javascripts/jquery.form-validator.js"></script>
<script>
var currentURL=location.protocol + '//' + location.host + location.pathname;
var fullUrl = "{{ url()->full() }}";
fullUrl = fullUrl.replace(/&amp;/gi, '&');
  $.validate({
			form:'#frontlogin',
			onSuccess : function(form) {
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
					}
				});
				$('.button_login').html('<i class="fa fa-spinner fa-spin"></i>Loading..');
			  $.ajax({
					url: "{{ url('login') }}",
					type: 'post',
					data: $(form).serialize(),
					dataType:"json",
					success: function(response) {
						console.log(response);
					  if(response.status==201){
						   $('.button_login').html('LOG IN');
						   $(".error-message").html('');
						   $(".error-message").removeClass('d-none');
						   $(".error-message").html(response.message);
						   setTimeout(function(){
						     $(".error-message").addClass('d-none');
						   },3000);

					   }
					   if(response.status==200){
						   //location.reload();
						   $('.button_login').html('LOG IN');
						   if(currentURL.indexOf('search') != -1 || currentURL.indexOf('business') != -1){
                var url = fullUrl;
                } else if(response.userType == 1){
                 var url = BASE_URL+'/dashboard';
               }else{
                 var url = BASE_URL+'/business/user/dashboard';
               }

							 window.location.replace(url);
					   }

					    if(response.status==202){

						   if(response.url != ''){
							  var url = response.url;
						   }
							 window.location.replace(url);
					   }

					},

				});

			}
		});
		$(".user_forgot_click").click(function(){
				  $('#user_forgot').removeClass('d-none');
				  $('#login_user').addClass('d-none');
				});
				$.validate({
                    form:'#frontforgot',
                    onSuccess : function(form) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            }
                        });
					  $('.button_forgot').html('<i class="fa fa-spinner fa-spin"></i> Loading..');
                      $.ajax({
                            url: "{{ url('user/forgot-password') }}",
                            type: 'post',
                            data: $(form).serialize(),
                            dataType:"json",
                            success: function(response) {
                                console.log(response)
                              if(response.status==201){
								   $('.button_forgot').html('Send');
                                   $(".error-message").html('');
                                   $(".error-message").removeClass('d-none');
                                   $(".error-message").html(response.message);
								   $("#forgot_email").val('');
								   setTimeout(function(){
									 $(".error-message").addClass('d-none');
								   },3000);
                               }
                               if(response.status==200){
								  $('.button_forgot').html('Send');
                                   $(".error-message").html('');
                                   $(".error-message").removeClass('d-none');
                                   $(".error-message").html(response.message);
								   $("#forgot_email").val('');
								   setTimeout(function(){
									 $(".error-message").addClass('d-none');
								   },4000);
                               }
                            },

                        });

                    }
                });
		$.validate({
			form:'#newsletter-form',
			onSuccess : function(form) {
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
					}
				});
				$('.newsletter_subscribe').prop('disabled', true);
				$('.newsletter_subscribe').html('<i class="fa fa-spinner fa-spin"></i> Loading..');
			  $.ajax({
					url: "{{ url('newsletter/subscribe') }}",
					type: 'post',
					data: $(form).serialize(),
					dataType:"json",
					success: function(response) {
						console.log(response)
					  if(response.status==201){
						   $('.newsletter_subscribe').prop('disabled', false);
						   $('.newsletter_subscribe').html('SUBSCRIBE');
						   $('#newsletter_email').val('');
						   toastr.error(response.message);
	                       return false;
						  }
					   if(response.status==200){
						   //location.reload();
						   $('.newsletter_subscribe').prop('disabled', false);
						   $('.newsletter_subscribe').html('SUBSCRIBE');
						   $('#newsletter_email').val('');
						   toastr.success(response.message);
	                       return false;
					   }
					},

				});

			}
		});
$("body").on("click",'.verify-user',function(){
      var data_user_id = $(this).attr('data-user-id');
    var serviceUrl = BASE_URL + '/user/sendverification';
	if(data_user_id != ''){
		$('.error-message').html('<i class="fa fa-spinner fa-spin"></i> Loading..');
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
				$('.error-message').html('');
				$(".error-message").removeClass('d-none');
				$(".error-message").html(callback.message);
				setTimeout(function(){
					 $(".error-message").addClass('d-none');
				   },5000);
			  }
			  if (callback.status == "201") {
				$('.error-message').html('');
				$(".error-message").removeClass('d-none');
				$(".error-message").html(callback.message);
				setTimeout(function(){
					 $(".error-message").addClass('d-none');
				   },4000);
			  }
			 });
	}
});
$("body").on("click",'.forgot_back',function(){
    $('#user_forgot').addClass('d-none');
	$('#login_user').removeClass('d-none');
});

$("#customer-tab").click(function(){
	$('#type_user_value').val('1');
	$('#normal_signup').removeClass('d-none');
	$('#business_signup').addClass('d-none');

});
$("#business-tab").click(function(){
	$('#type_user_value').val('2');
	$('#business_signup').removeClass('d-none');
	$('#normal_signup').addClass('d-none');

});
</script>
