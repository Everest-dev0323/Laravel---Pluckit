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
		  <ul class="list-unstyled list-check">
			<li>Greater visibility in search rankings. More clicks, more enquiries.</li>
			<li>Update & control relevant business information. </li>
			<li>Activate clickable call-to-actions and promotions.</li>
			<li>Monitor performance with 24/7 reporting dashboard access.</li>
			<li>Greater web presence. Your Pluckit profile url will be visible in Google’s organic search results</li>
		  </ul>
		  <div class="image text-center text-lg-left">
			<img class="img-fluid" src="{{ ('/public') }}/front-assets/images/business-details.png" alt="Image">
		  </div>
		</div>
		<div class="col-lg-6">
		  <form action="{{ url('/business/user/signup').'/'.$user_id }}" method="post" class="signup-form" id="signup-second">
		  @csrf
                <div class="box bg-gray-light box-shadow">
                  <h4 class="mb-3">Business Details</h4>
                  <div class="form-group mb-md-4">
                  <label class="sr-only" for="signup_category">Username</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Select your trade <span>*</span></div>
                    </div>
                    <input type="text" class="form-control rounded-right" id="signup_category" placeholder="Search for an Electrician, a Plumber, etc." name="category_id" required>
                  </div>
                </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="field">
                        <input type="text" name="business_name" value="{{ old('business_name') }}" id="business_name" class="form-control" placeholder="Business Name" required>
                        <label for="business-name">Business Name<span>*</span></label>
                      </div>
                    </div>
                    <div class="col-md-6 justify-content-end align-self-end">
                      <div class="field">
                        <span class="selectbox">
                          <select name="business_country" id="country" class="form-control" required>
                            <option value="">Select Country<span>*</span></option>
							@if(!empty($allCountries))
							  @foreach($allCountries as $country)
								<option value="{{ $country->srt_code }}" {{ (!empty($country->srt_code) && ($country->srt_code == 'AU')) ? "selected" : "" }}>{{ $country->name }}</option>
							  @endforeach
						   @endif
                          </select>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 d-flex justify-content-end">
                      <div class="field w-100">
                          <select class="form-control select2-show-search"  name="business_city" id="business_city" data-placeholder="Select City" required>
                            <option value="">Select City<span>*</span></option>
                          </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="field">
                        <input type="text" name="business_zipcode" id="zip-code" value="{{ old('business_zipcode') }}" class="form-control" placeholder="Zip code" data-parsley-type="number" minlength="4" maxlength="4" required>
                        <label for="zip-code">Post code<span>*</span></label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="field">
                        <input type="text" name="business_abn" value="{{ old('business_abn') }}" id="business_abn" class="form-control" placeholder="ABN" data-parsley-pattern="/^[0-9\s]*$/" data-parsley-pattern-message="Only number or number with space" required>
						<label for="business_abn">ABN<span>*</span></label>

					  @error('business_abn')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
					  </div>

					  <span style="color:red ;" class="d-none" id="abn-error"></span>

                    </div>
                    <div class="col-md-6">
                      <div class="field">
                        <input type="url" data-parsley-type="url" name="business_website_url" id="url" value="{{ old('business_website_url') }}" class="form-control" placeholder="Website url">
                        <label for="url">Website url</label>
                      </div>
                    </div>
                  </div>
				  <input type="hidden" name="hid_category_alias" id="hid_category_alias">
                  <button type="submit" class="btn btn-primary btn-block rounded mt-4 mb-3">Continue</button>
                  <p class="text-center">Or already have an account?<button type="button" data-toggle="modal" data-target="#loginModal" class="btn btn-link p-0 ml-1">LOG IN</button>
                  </p>
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
//         $('#signup-second').parsley();
		var business_country_code = $("#country").val();

    var objData = {};
    var sendData = {};
    sendData = {
        business_country_code: business_country_code,
    };
    objData = {
      url: BASE_URL + '/business-listing/chkStates',
      type: 'post',
      sendData: sendData
    };

    send_ajax_request(objData, function (callback) {
      if (callback.status == "200") {
        // $('.select2-show-search').select2({
        //   minimumResultsForSearch: ''
        // });
        // $("#states").val('Semester '+callback.result);
        $("#business_city").html(callback.result);
      }
    });
	$("body").on("keyup","#business_abn",function(){
    $("#abn-error").addClass('d-none');
      var business_abn = $("#business_abn").val();
      var hid_business_abn = $("#hid_business_abn").val();

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

  $("body").on("change","#country",function(){
    var business_country_code = $("#country").val();

    var objData = {};
    var sendData = {};
    sendData = {
        business_country_code: business_country_code,
    };
    objData = {
      url: BASE_URL + '/business-listing/chkStates',
      type: 'post',
      sendData: sendData
    };
    send_ajax_request(objData, function (callback) {
      if (callback.status == "200") {
        // $('.select2-show-search').select2({
        //   minimumResultsForSearch: ''
        // });
          //$("#states").val('Semester '+callback.result);
        $("#business_city").html(callback.result);
      }
    });
  });
});


</script>
@endsection
