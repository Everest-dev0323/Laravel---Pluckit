@extends('layouts.front-end.app')
@section('content')
 <!-- Content -->
  <div id="content">

    <!-- Section -->
    <section class="section text-section border-top pt-3">
      <div class="container">
       <h2>Contact Us</h2>
       <p>Drop us a line if you have any questions or suggestions regarding this site, then a member of our team will respond.</p>

       <div class="row justify-content-center align-items-center mt-5">
            <div class="col-md-8">
                <div class="box bg-gray-light box-shadow">
                  <form action="{{ url('contact-us/save')}}" class="form form-layout2" id="form-contact" method="post" onsubmit="return false">
				  {{ csrf_field()}}
                    <div class="form-group">
                      <input type="text" name="name" id="name" class="form-control" placeholder="Name" data-validation="required">
                    </div>
                    <div class="form-group">
                      <input type="email" name="email" id="email" class="form-control" placeholder="Email" data-validation="required">
                    </div>
                    <div class="form-group">
                      <input type="tel" name="phone" id="phone" class="form-control" placeholder="Number" data-validation-message="Only number">
                    </div>
                    <div class="form-group">
					  <textarea name="message" id="message" class="form-control" placeholder="Enquiry details" data-validation="required" ></textarea>
                    </div>
					<div class="form-group">
						<div id="dvCaptcha" class="g-recaptcha brochure__form__captcha" data-sitekey="6LfIzd0cAAAAANP-EFxYePjAUT25wyvrw6vYaFFF" ></div>

					</div>
                    <div class="text-right">
                      <button type="submit" class="btn btn-primary rounded contactus-submit" >Submit</button>
                    </div>
                  </form>
                </div>
            </div>
          </div>
		  <?php //echo !empty($getObjSeoSetting[0]->content) ? $getObjSeoSetting[0]->content : '';?>
      </div>
    </section>

  </div>
  <!-- /content -->
@endsection
@section('extracontent')
<script src="{{ ('/public') }}/front-assets/javascripts/jquery.form-validator.js"></script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"></script>
<script type="text/javascript">
var gCaptcha = false;
var onloadCallback = function () {
        grecaptcha.render('dvCaptcha', {
            'sitekey': '6LfIzd0cAAAAANP-EFxYePjAUT25wyvrw6vYaFFF',
            'callback': function (response) {
				gCaptcha = true;
				console.log(gCaptcha);
                console.log(response);
            }
        });
    };
    $.validate({
			form:'#form-contact',
			onSuccess : function(form) {
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
					}
				});
				if(gCaptcha){
					$('.contactus-submit').prop('disabled', true);
					$('.contactus-submit').html('<i class="fa fa-spinner fa-spin"></i> Loading..');
					$.ajax({
						url: "{{ url('contact-us/save') }}",
						type: 'post',
						data: $(form).serialize(),
						dataType:"json",
						success: function(response) {
							console.log(response)
						if(response.status==201){
							$('.contactus-submit').prop('disabled', false);
							$('.contactus-submit').html('Submit');
							$('#name').val('');
							$('#email').val('');
							$('#phone').val('');
							$('#message').val('');
							toastr.error(response.message);
							return false;
							}
						if(response.status==200){
							//location.reload();
							$('.contactus-submit').prop('disabled', false);
							$('.contactus-submit').html('Submit');
							$('#name').val('');
							$('#email').val('');
							$('#phone').val('');
							$('#message').val('');
							toastr.success(response.message);
							return false;
						}
						},

					});
				} else {
						alert('Please complete the human varification');
					}

			}
		});

</script>
@endsection
