<!-- Footer -->
<footer id="footer" class="overlay dark-1">
    <div class="container">
      <div class="row mb-md-3">
        <div class="col-lg-6">
          <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-7 column1">
             <h4>We are here to help!</h4>
             <p>Recommended Tradies from people you know.</p>
             <p>We’ve removed all the fluff, hassle, time and money wastage.</p>
             <p>Pluck the right Tradie from the start with a platform that promotes full user control, transparency and ease-of-use to bring people together and make better informed decisions.</p>            </div>
            <div class="col-sm-6 col-md-6 col-lg-5 column1">
              <h4>TRADIES</h4>
              <ul class="footer-nav">
                <li><a href="{{ url('/business/user/signup') }}">REGISTER MY BUSINESS</a></li>
                <li><a href="#" data-toggle="modal" data-target="#loginModal">BUSINESS LOGIN</a></li>
                <li><a href="{{ url('/help') }}">HELP</a></li>
              </ul>
            </div>
          </div>
        </div>
		@php
		 $getFooterPages = \App\Page::where('show_on_footer',1)->get();
		@endphp
        <div class="col-lg-6 column1">
          <div class="row">
            <div class="col-sm-6">
              <h4>IMPORTANT LINKS</h4>
			  @if(!empty($getFooterPages[0]))
              <ul class="footer-nav">
				  @foreach($getFooterPages as $footerPage)
					<li><a href="{{ url('page').'/'.$footerPage->alias}}">{{ $footerPage->page_name }}</a></li>
				  @endforeach

              </ul>
			  @endif
            </div>
            <div class="col-sm-6 column1">
              <h4>FOLLOW US</h4>
              <ul class="social-links mb-3">
                <!-- <li><a href="https://twitter.com/" title="twitter" target="_blank">
                    <img src="{{ ('/public') }}/front-assets/images/icon/twitter.png" alt="Twitter">
                  </a>
                </li> -->
                <li>
                  <a href="https://www.facebook.com/" title="facebook" target="_blank">
                    <img src="{{ ('/public') }}/front-assets/images/icon/facebook.png" alt="Facebook">
                  </a>
                </li>
                <li>
                  <a href="mailto:pluckit20@gmail.com" title="Gmail" target="_blank">
                    <img src="{{ ('/public') }}/front-assets/images/icon/gmail.png" alt="Gmail">
                  </a>
                </li>
                <li>
                  <a href="https://www.instagram.com/" title="Instagram" target="_blank">
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
            <p data-toggle="modal" data-target="#new-user">Copyright &copy;{{ date('Y') }} Pluckit</p>
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
   <a href="{{ url('business/user/signup') }}" class="btn btn-primary btn-animate">Claim Your Business</a>
</div>

  <!-- Modal -->
  <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-wrap">
          <div class="modal-header border-0">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-center pb-0">
            <div class="logo mb-3">
              <img class="img-fluid" src="{{ ('/public') }}/front-assets/images/logo.png" alt="Pluckit">
            </div>
            <h3>LOG IN</h3>
            <!-- Choose Login type -->
            <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                <li class="nav-item">
                <a class="nav-link active" id="customer-tab" data-toggle="tab" href="#customer" role="tab" aria-controls="customer" aria-selected="true"><i class="fal fa-user-circle mr-2"></i>Customer Login</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" id="business-tab" data-toggle="tab" href="#business" role="tab" aria-controls="business" aria-selected="false"> <i class="fal fa-user-crown mr-2"></i>Business Login</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <!-- Customer Login -->
              <div class="tab-pane fade show active" id="customer" role="tabpanel" aria-labelledby="customer-tab">
              <p>with your social network</p>
                <ul class="list-unstyled social-btn-group text-center my-sm-3">
                  <li><a href="{{ url('auth/fb') }}" class="btn btn-primary facebook"><i class="fab fa-facebook-square"></i><span>Continue with
                  Facebook</span></a></li>
                  <li><a href="{{ url('auth/google') }}" class="btn btn-primary google-plus"><i class="fab fa-google"></i><span>Continue with
                        Google</span></a></li>
                  <li><a href="{{ url('auth/outlook') }}" class="btn btn-primary outlook"><img class="img-fluid"
                        src="{{ ('/public') }}/front-assets/images/icon/outlook.png" alt="Outlook"><span>Continue with Outlook</span></a></li>
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
					  <div class="form-group">
						<input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('E-Mail Address') }}" required autocomplete="email" autofocus/>
						@error('email')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					  </div>
					  <div class="form-group">
						<input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}" required autocomplete="current-password"/>
						@error('password')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					  </div>
					  <div class="form-group">
						<button type="submit" class="btn btn-primary d-block w-100 button_login">LOG IN</button>
					  </div>
					  <div class="row form-footer">
						<div class="col-sm-6 text-sm-left">
						  <p>Not a member?<a href="{{ url('signup')}}" class="btn btn-link p-0 ml-1">SIGN UP</a></p>
						  <p>Business Member?<a href="{{ url('/business/user/signup')}}" class="btn btn-link p-0 ml-1">SIGN UP</a></p>
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
				     <i class="fas fa-long-arrow-alt-left mr-2"></i>Go to back</button>
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
						   if(response.userType == 1){
							   var url = BASE_URL+'/dashboard';
						   }else{
							   var url = BASE_URL+'/business/user/dashboard';
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
				$('.newsletter_subscribe').html('<i class="fa fa-spinner fa-spin"></i> Loading..');
			  $.ajax({
					url: "{{ url('newsletter/subscribe') }}",
					type: 'post',
					data: $(form).serialize(),
					dataType:"json",
					success: function(response) {
						console.log(response)
					  if(response.status==201){
						   $('.newsletter_subscribe').html('SUBSCRIBE');
						   $('#newsletter_email').val('');
						   toastr.error(response.message);
	                       return false;
						  }
					   if(response.status==200){
						   //location.reload();
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
				$(".error-message").html(callback.message);
			  }
			  if (callback.status == "201") {
				$('.error-message').html('');
				$(".error-message").html(callback.message);
			  }
			 });
	}
});
$("body").on("click",'.forgot_back',function(){
    $('#user_forgot').addClass('d-none');
	$('#login_user').removeClass('d-none');
});
</script>
