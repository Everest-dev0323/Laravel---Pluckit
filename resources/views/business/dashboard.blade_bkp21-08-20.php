@extends('layouts.front-end.app')
@section('content')
<!-- Content -->
<?php
$arrReturnImage = array();
$arrImage = array();
$arrReturnCertificateImage = array();
$arrCertificateImage = array();
if (!empty($getObjBusinessImage)) {
    foreach ($getObjBusinessImage as $businessImage) {
        $arrImage['name'] = $businessImage->business_photo_name;
        $arrImage['size'] = '145';
        $arrImage['rid'] = $businessImage->id;
        $arrImage['type'] = 'image/jpg';
        $arrImage['file'] = $businessImage->business_photo;
        $arrReturnImage[] = $arrImage;
    }
}
if (!empty($getObjBusinessCertificate)) {
    foreach ($getObjBusinessCertificate as $businessCertificateImage) {
        $arrCertificateImage['name'] = $businessCertificateImage->business_certificate_name;
        $arrCertificateImage['size'] = '145';
        $arrCertificateImage['rid'] = $businessCertificateImage->id;
        $arrCertificateImage['type'] = 'image/jpg';
        $arrCertificateImage['file'] = $businessCertificateImage->business_cerificate;
        $arrReturnCertificateImage[] = $arrCertificateImage;
    }
}
//echo "<pre>";var_dump($arrReturnCertificateImage);exit;?>
    <div id="content">
      <section class="section">
        <div class="container pl-xl-0">
          <!-- business-card-info -->
          <div class="row client-profile business-card-info pb-4 d-md-flex justify-content-md-between align-items-md-start">
		  <div class="col-sm-6 col-lg-8 pr-lg-5">
			<div class="column">
				<div class="service-box align-items-start">
					<div class="service-img profile-pic position-relative">
					<a href="javascript:;" class="btn btn-dark btn-edit position-absolute" title="Edit Profile"><i class="fas fa-pencil-alt"></i></a>
					@if(!empty($getUser->business_image))
					<a href="{{ url('/business').'/'.$getUser->business_slug }}"><img class="img-fluid" src="{{ $getUser->business_image }}" alt="{{ !empty($getUser->business_name) ? $getUser->business_name : '-' }}"></a>
					@else
					<img class="img-fluid" src="{{ ('/public') }}/front-assets/images/default-image.jpg" alt="butterfield">
					@endif
					<progress id="progressBar" max="100" value="{{ $getTotalPercentageVal[0]->count }}"></progress>
					</div>
					<div class="service-content mt-2">
					<div class="left">
						<h3><a href="{{ url('/business').'/'.$getUser->business_slug }}">{{ !empty($getUser->business_name) ? $getUser->business_name : '-' }}</a></h3>
						<ul class="list-unstyled">
						<li>{{ Auth::user()->email }}</li>
						<li>{{ !empty($getUser->business_city) ? $getUser->business_city : '-' }}</li>
						</ul>
					</div>
					</div>
				</div>
				</div>
			</div>
			<div class="col-sm-6 col-lg-4 pl-xl-5 text-sm-right">
				<div class="column box2 bg-gray text-center">
					<div class="media">
						<div class="media-body">
						<h5>No of Reviews</h5>
						<span class="total-count">{{ $userReviewCount }}</span>
						</div>
						<!-- <i class="fa fa-star"></i> -->
					</div>
				</div>
			</div>
		  </div>
          <!-- / business-card-info -->
        </div>
        <div class="container custom-container">
          <div class="row">
			  <div class="col-md-12">
				  <div class="alert alert-success d-none" id="alert-success">

					</div><br />
				  @if(session()->get('success'))
					<div class="alert alert-success d-none">
						{{ session()->get('success') }}
					</div><br />
					@endif
					@if(session()->get('warning'))
					<div class="alert alert-danger d-none">
						{{ session()->get('warning') }}
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
            <main id="main" class="col-lg-8 pr-lg-4">
              <div class="row">
                <div class="col-md-3 pl-xl-4">
                  <button type="button" class="btn btn-primary rounded mb-3" id="tabMenu"><i
                      class="fas fa-bars fa-lg"></i></button>
                  <ul class="nav nav-tabs flex-column border-0 d-md-block" id="myTab" role="tablist"
                    style="display:none">
                    <li class="nav-item">
                      <a class="nav-link {{ (empty($input['step']) || $input['step']==1) ? 'active' : '' }}" id="manage-business-tab" data-toggle="tab" href="#manage-business"
                        role="tab" aria-controls="manage-business" aria-selected="true"><i
                          class="far fa-handshake"></i>MANAGE YOUR BUSINESS</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link {{ (!empty($input['step']) && $input['step']==2) ? 'active' : '' }}" id="manage-account-tab" data-toggle="tab" href="#manage-account" role="tab"
                        aria-controls="manage-account" aria-selected="false"><i class="fas fa-user"></i>MANAGE MY PASSWORD</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link {{ (!empty($input['step']) && $input['step']==3) ? 'active' : '' }}" id="manage-reviews-tab" data-toggle="tab" href="#manage-reviews" role="tab"
                        aria-controls="manage-reviews" aria-selected="false"><i class="fa fa-star"></i>MANAGE
                        REVIEWS</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link {{ (!empty($input['step']) && $input['step']==4) ? 'active' : '' }}" id="manage-payment-tab" data-toggle="tab" href="#manage-payment" role="tab"
                        aria-controls="manage-payment" aria-selected="true"><i
                          class="fas fa-hand-holding-usd"></i>MANAGE PAYMENT</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link {{ (!empty($input['step']) && $input['step']==5) ? 'active' : '' }}" id="statistics-tab" data-toggle="tab" href="#statistics" role="tab"
                        aria-controls="statistics" aria-selected="false"><i class="fas fa-chart-line"></i>STATISTICS</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link {{ (!empty($input['step']) && $input['step']==6) ? 'active' : '' }}" id="help-tab" data-toggle="tab" href="#help" role="tab" aria-controls="help"
                        aria-selected="false"><i class="fas fa-question-circle"></i>HELP</a>
                    </li>
                  </ul>
                </div>
                <div class="col-md-9 pl-md-0">
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade {{ (empty($input['step'])  || $input['step']==1) ? 'show' : '' }} {{ (empty($input['step']) || $input['step']==1) ? 'active' : '' }}" id="manage-business" role="tabpanel"
                      aria-labelledby="manage-business-tab">
                      <!--Tabs-->
                      <div class="nav-wrap mb-4">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link {{ (empty($input['step']) || ($input['step'] != 1) || ($input['step']==1 &&  $input['t'] ==1)) ? 'active' : '' }}" id="pills-general-tab" data-toggle="pill" href="#pills-general"
                              role="tab" aria-controls="pills-general" aria-selected="true">GENERAL</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link {{ (!empty($input['step']) && ($input['step']==1 &&  $input['t'] ==2)) ? 'active' : '' }}" id="pills-about-tab" data-toggle="pill" href="#pills-about" role="tab"
                              aria-controls="pills-about" aria-selected="false">ABOUT</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link {{ (!empty($input['step']) && ($input['step']==1 &&  $input['t'] ==3)) ? 'active' : '' }}" id="pills-services-tab" data-toggle="pill" href="#pills-services"
                              role="tab" aria-controls="pills-services" aria-selected="false">SERVICES</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link {{ (!empty($input['step']) && ($input['step']==1 &&  $input['t'] ==4)) ? 'active' : '' }}" id="pills-photos-tab" data-toggle="pill" href="#pills-photos" role="tab"
                              aria-controls="pills-photos" aria-selected="false">PHOTOS</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link {{ (!empty($input['step']) && ($input['step']==1 &&  $input['t'] ==5)) ? 'active' : '' }}" id="pills-certificates-tab" data-toggle="pill"
                              href="#pills-certificates" role="tab" aria-controls="pills-certificates"
                              aria-selected="false">CERTIFICATES</a>
                          </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                          <div class="tab-pane fade {{ (empty($input['step']) || ($input['step'] != 1) || ($input['step']==1 &&  $input['t'] ==1)) ? 'show' : '' }} {{ (empty($input['step']) || ($input['step'] != 1) || ($input['step']==1 &&  $input['t'] ==1)) ? 'active' : '' }}" id="pills-general" role="tabpanel"
                            aria-labelledby="pills-general-tab">
                            <!-- Business Information -->
                            <h5>Business Information</h5>
                            <div class="box bg-gray-light box-shadow p-md-4 my-4">
                              <form action="{{ url('business/user/info/update') }}" class="form form-layout2" method="post" id="business_information" enctype="multipart/form-data">
							  {{ csrf_field()}}
                                <div class="row mb-3 d-none">
                                  <div class="col-xl-6 p-md-0">
                                    <div class="upload-profile-image mb-0">
                                      <label>Your business Logo ( jpeg, png, jpg, gif, svg, max: 2 mb )</label><br />
                                      <div class="profile-image position-relative mr-2">
									  @if(!empty($getUser->business_image))
                                        <img class="img-fluid" src="{{ $getUser->business_image }}" alt="{{ !empty($getUser->business_name) ? $getUser->business_name : '' }}" id="business_image">
									  @else
										  <img class="img-fluid" src="{{ ('/public') }}/front-assets/images/default-profile.jpg" alt="Avatar" id="business_image">
									  @endif
                                        <a href="javascript:;" data-business-id="{{ $getUser->id }}" class="btn-remove position-absolute remove_business_picture"><i
                                            class="fas fa-times"></i></a>
                                      </div>
									  <div class="file-upload mr-sm-2">
										  <input id="upload" type="file" name="business_image" class="inputfile" onChange="preview_image(event,'business_image')">
										  <label class="btn btn-primary" for="upload">Upload a new profile picture</label>
									   </div>

                                    </div>
                                  </div>

                                  <div class="col-xl-6">
                                    <div class="form-group">
                                      <label for="email">Email<span>*</span></label>
                                      <input type="email" name="email" id="email" class="form-control" placeholder="Email" disabled value="{{ !empty($getUser->email) ? $getUser->email : '' }} ">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-xl-6">
                                    <div class="form-group">
                                      <label for="owner-name">Business owner name<span>*</span></label>
                                      <input type="text" name="name" id="owner-name" class="form-control" placeholder="Business owner name" value="{{ !empty($getUser->name) ? $getUser->name : '' }}" required>
                                    </div>
                                  </div>
                                  <div class="col-xl-6">
                                    <div class="form-group">
                                      <label for="business-name">Business name<span>*</span></label>
                                      <input type="text" name="business_name" id="business-name" class="form-control" placeholder="Business name" value="{{ !empty($getUser->business_name) ? $getUser->business_name : '' }}" required>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-xl-6">
                                    <div class="form-group">
                                      <label for="call-out">Title call out<br />
                                        <small>Attract potential customers with a call-to-action in
                                          your ad.
                                        </small></label>
                                      <input type="text" name="callout" id="call-out" class="form-control" placeholder="e.g. Mention Pluckit for 10% off" value="{{ !empty($getUser->callout) ? $getUser->callout : '' }}">
                                    </div>
                                  </div>
                                  <div class="col-xl-6">
                                    <div class="form-group">
                                      <label for="trade">Select your trade<span>*</span></label>
                                      <span class="selectbox">
                                        <select name="category_id" id="trade" class="form-control" required>
										  <option value="" selected>Plumber</option>
										  @if(!empty($allCatgories[0]))
											  @foreach($allCatgories as $category)
										          <option value="{{ $category->alias }}" {{ (!empty($getUser->business_category_alias) && ($getUser->business_category_alias == $category->alias)) ? 'selected' : ''}}>{{ $category->name }}</option>
										      @endforeach
										  @endif
                                        </select>
                                      </span>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-xl-6">
                                    <div class="form-group">
                                      <label for="business_default_hours">Working hours</label>
                                     <input type="text" name="business_default_hours" id="business_default_hours" class="form-control" placeholder="10AM - 5PM" value="{{ !empty($getUser->business_default_hours) ? $getUser->business_default_hours : '' }}">
                                    </div>
                                  </div>
                                  <div class="col-xl-6">
                                    <div class="form-group">
                                      <label for="abn">ABN<span>*</span></label><br />
                                      <input type="text" name="abn" id="abn" class="form-control" placeholder="ABN" disabled value="{{ !empty($getUser->business_abn) ? $getUser->business_abn : '' }}">
                                    </div>
                                  </div>
                                </div>
								<input type="hidden" name="business_id" id="business_id" value="{{ !empty($getUser->id) ? $getUser->id : '' }}">
                                <button type="submit" class="btn btn-primary rounded">Save information</button>
                              </form>
                            </div>
                            <!-- /Business Information -->
                            <!-- Business Address -->
                            <h5>Business Address</h5>
                            <div class="box bg-gray-light box-shadow p-md-4 my-4">
                              <form class="form form-layout2" action="{{ url('business/user/address/update') }}"  method="post" id="business_address">
							  {{ csrf_field()}}
                                <div class="row">
                                  <div class="col-xl-6">
                                    <div class="form-group">
                                      <label for="address">Address<span>*</span></label>
                                      <input type="text" name="business_address_1" id="address" class="form-control"
                                        placeholder="Address" required value="{{ !empty($getUser->business_address_1) ? $getUser->business_address_1 : '' }}">
                                    </div>
                                  </div>
                                  <div class="col-xl-6">
                                    <div class="form-group">
                                      <label for="country">Country</label>
                                      <span class="selectbox">
                                        <select name="business_country" id="country" class="form-control">
										 <option value="">Select Country</option>
                                          @if(!empty($allCountries))
												  @foreach($allCountries as $country)
													<option value="{{ $country->srt_code }}" {{ (!empty($getUser->business_country) && ($getUser->business_country == $country->srt_code)) ? 'selected' : ''}}>{{ $country->name }}</option>
												  @endforeach
											   @endif
                                        </select>
                                      </span>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-xl-6">
                                    <div class="form-group">
                                      <label for="city">City<span>*</span></label>
									  <span class="selectbox2">
										<select class="form-control select2-show-search"  name="business_city" id="business_city" data-placeholder="Select City" required>
											<option value="">Select City<span>*</span></option>
										</select>
									  </span>
                                    </div>
                                  </div>
                                  <div class="col-xl-6">
                                    <div class="form-group">
                                      <label for="postcode">Post code<span>*</span></label>
                                      <input type="text" data-parsley-type="number" minlength="4" maxlength="4" name="business_zipcode" id="postcode" class="form-control" placeholder="Post code" required value="{{ !empty($getUser->business_zipcode) ? $getUser->business_zipcode : '' }}">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-xl-6">
                                    <div class="form-group">
                                      <label for="tel">Phone no.</label>
                                      <input type="text" data-parsley-type="number" maxlength="10" name="business_phone" id="tel" class="form-control" placeholder="+61" value="{{ !empty($getUser->business_phone) ? $getUser->business_phone : '' }}">
                                    </div>
                                  </div>
                                  <div class="col-xl-6">
                                    <div class="form-group">
                                      <label for="url">Website URL</label>
                                      <input type="url" class="form-control" id="url" data-parsley-type="url" name="business_website_url" value="{{ !empty($getUser->business_website_url) ? $getUser->business_website_url : '' }}">
                                    </div>
                                  </div>
                                </div>
								<input type="hidden" name="business_id" id="business_id" value="{{ !empty($getUser->id) ? $getUser->id : '' }}">
                                <button type="submit" class="btn btn-primary rounded">Save information</button>
                              </form>
                            </div>
                            <!-- /Business Address -->
                          </div>
                          <div class="tab-pane fade {{ (!empty($input['step']) && ($input['step']==1 &&  $input['t'] ==2)) ? 'show' : '' }} {{ (!empty($input['step']) && ($input['step']==1 &&  $input['t'] ==2)) ? 'active' : '' }}" id="pills-about" role="tabpanel" aria-labelledby="pills-about-tab">
                            <h5>About</h5>
							  <form action="{{ url('business/user/about/update') }}"  method="post" id="business_about">
							  {{ csrf_field()}}
							  <div class="row">
								  <div class="col-xl-12">
									<div class="form-group">
									  <textarea class="form-control" name="business_about" id="summernote" required><?php echo !empty($getUser->business_about) ? $getUser->business_about : '';?>
							</textarea>
									</div>
								  </div>
							  </div>
							  <div class="row">
                                <div class="col-md-12">
								<input type="hidden" name="business_id" id="business_id" value="{{ !empty($getUser->id) ? $getUser->id : '' }}">
                                    <button class="btn btn-primary wd-100" type="submit" id="btnSubmit">Submit</button>
                                </div><!-- col-4 -->
                            </div>
							</form>
                          </div>
                          <div class="tab-pane fade {{ (!empty($input['step']) && ($input['step']==1 &&  $input['t'] ==3)) ? 'show' : '' }} {{ (!empty($input['step']) && ($input['step']==1 &&  $input['t'] ==3)) ? 'active' : '' }}" id="pills-services" role="tabpanel"
                            aria-labelledby="pills-services-tab">

							<h5>SERVICES</h5>
						<form action="{{ url('business/user/service/update') }}"  method="post" id="business_service">
						{{ csrf_field()}}
							<div class="row">
							  <div class="col-xl-12">
								<div class="form-group">
								  <textarea class="form-control" name="business_service" id="summernote1" required><?php echo !empty($getUser->business_services) ? $getUser->business_services : '';?>
							</textarea>
								</div>
							  </div>
						  </div>
						   <div class="row">
                                <div class="col-md-12">
								    <input type="hidden" name="business_id" id="business_id" value="{{ !empty($getUser->id) ? $getUser->id : '' }}">
                                    <button class="btn btn-primary wd-100" type="submit" id="btnSubmit">Submit</button>
                                </div><!-- col-4 -->
                            </div>
							</form>
                          </div>
                          <div class="tab-pane fade {{ (!empty($input['step']) && ($input['step']==1 &&  $input['t'] ==4)) ? 'show' : '' }} {{ (!empty($input['step']) && ($input['step']==1 &&  $input['t'] ==4)) ? 'active' : '' }}" id="pills-photos" role="tabpanel"
                            aria-labelledby="pills-photos-tab">
                            <h5>PHOTOS</h5>
							<div class="row d-none">
							@if(!empty($getObjBusinessImage[0]))
								@foreach($getObjBusinessImage as $image)
								   <div class="col-xl-3">
									  <img src="{{ $image->business_photo }}" style="height:100px; width:150px;"/>
									   <a href="javascript:;" data-id="{{ $image->id }}" class="remove_business_photo">Remove</a>
									  </div>
								@endforeach
							@endif
							</div>
							<div class="clearfix">&nbsp;</div>
							<form action="{{ url('business/user/photo/update') }}"  method="post" id="business_photo_form" enctype="multipart/form-data">
						   {{ csrf_field()}}
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="form-control-label">Upload Photo</label>
							             <input type="file" name="images[]" id="filer_input2" class="form-control" multiple="multiple">
									</div>
								</div>
							</div>
						   <div class="row">
                                <div class="col-md-12 text-right">
								    <input type="hidden" name="business_id" id="business_id" value="{{ !empty($getUser->id) ? $getUser->id : '' }}">
                                    <button class="btn btn-primary wd-100" type="submit" id="btnSubmit">Submit</button>
                                </div><!-- col-4 -->
                            </div>
							</form>
                          </div>
                          <div class="tab-pane fade {{ (!empty($input['step']) && ($input['step']==1 &&  $input['t'] ==5)) ? 'show' : '' }} {{ (!empty($input['step']) && ($input['step']==1 &&  $input['t'] ==5)) ? 'active' : '' }}" id="pills-certificates" role="tabpanel"
                            aria-labelledby="pills-certificates-tab">
                            <h5>CERTIFICATES</h5>
							<div class="row d-none">
							@if(!empty($getObjBusinessCertificate[0]))
								@foreach($getObjBusinessCertificate as $certificate)
								   <div class="col-xl-3">
									  <img src="{{ $certificate->business_cerificate }}" style="height:100px; width:150px;"/>
									   <a href="javascript:;" data-id="{{ $certificate->id }}" class="remove_business_certificate">Remove</a>
									  </div>
								@endforeach
							@endif
							</div>
							<div class="clearfix">&nbsp;</div>
							<form action="{{ url('business/user/certificates/update') }}"  method="post" id="business_certificates_form" enctype="multipart/form-data">
						   {{ csrf_field()}}
							<div class="row">
								<div class="col-md-12 text-right">
									<div class="form-group">
										<label class="form-control-label">Upload Cerificate</label>
							             <input type="file" name="cerificates[]" id="filer_input1" class="form-control" multiple="multiple">
									</div>
								</div>
							</div>
						   <div class="row">
                                <div class="col-md-12">
								    <input type="hidden" name="business_id" id="business_id" value="{{ !empty($getUser->id) ? $getUser->id : '' }}">
                                    <button class="btn btn-primary wd-100" type="submit" id="btnSubmit">Submit</button>
                                </div><!-- col-4 -->
                            </div>
							</form>
                          </div>
                        </div>
                      </div>
                      <!--/Tabs-->
                    </div>
                    <div class="tab-pane fade {{ (!empty($input['step']) && $input['step']==2) ? 'show' : '' }} {{ (!empty($input['step']) && $input['step']==2) ? 'active' : '' }}" id="manage-account" role="tabpanel" aria-labelledby="manage-account-tab">
                      <h5>Change Password</h5>
                      <div class="box bg-gray-light box-shadow p-md-4 mt-lg-4">
                        <form action="{{ url('business/user/change-password')}}" class="form form-layout2" method="post" id="business_user_password">
							@csrf
							<div class="form-group">
							  <label for="current-password">Current Password<span>*</span></label>
							  <input id="current-password" type="password" name="current_password" class="form-control  @error('current_password') is-invalid @enderror" value="{{ old('current_password') }}" required autocomplete="password" autofocus/>
							  @error('current_password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
							</div>
							<div class="form-group">
							  <label for="password">New Password<span>*</span></label>
							  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" data-parsley-pattern-message="Should be combination between characters, upercase, lower case and numbers, minimum 8 characters">

								@error('password')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
							<div class="form-group">
							  <label for="password-confirm">Confirm New Password<span>*</span></label>
							  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password"/>
							</div>
							<button type="submit" class="btn btn-primary rounded">Change password</button>
						  </form>
                      </div>
                    </div>
                    <div class="tab-pane fade {{ (!empty($input['step']) && $input['step']==3) ? 'show' : '' }} {{ (!empty($input['step']) && $input['step']==3) ? 'active' : '' }}" id="manage-reviews" role="tabpanel" aria-labelledby="manage-reviews-tab">
                      <h5>Recent Reviews</h5>
                      <div class="review-list mt-lg-4">
					  @if(!empty($userReview[0]))
				       @foreach($userReview as $review)
				        @php
						$getObjBusiness = \App\BusinessListing::where('id',$review->business_id)->first();
						$getObjUser = \App\User::where('id',$review->user_id)->first();
						@endphp
                        <div class="box bg-gray-light box-shadow">
                          <div class="media">
                            <figure class="figure2 mr-3">
							@if(!empty($review->user_image))
                              <img class="img-fluid" src="{{ $review->user_image }}" alt="{{ $review->user_name }}">
						    @elseif(!empty($getObjUser->user_image))
							<img class="img-fluid" src="{{ $getObjUser->user_image }}" alt="{{ $review->user_name }}">
							@else
								<img class="img-fluid" src="{{ url('/public/front-assets/images/default-profile.jpg') }}" alt="{{ $review->user_name }}">
							@endif

                            </figure>
                            <div class="media-body">
                              <h6>{{ $review->user_name }} <span class="review-date">{{ date("M d, Y",strtotime($review->review_time_created)) }}</span></h6>
                              <div class="rating">
                                <ul class="list-unstyled">
                                  <li><a href="#"><i class="
										  <?php
										  if($review->rating == 0) {
											  echo 'fa fa-star text-gray';
										  }else	{
											 if($review->rating > 0 && $review->rating < 1){
												 echo 'fa fa-star-half-alt';
											 }else{
												 echo 'fa fa-star';
											 }
										  }
										?>
										"></i></a></li>
										 <li><a href="#"><i class="
										 <?php
										 if($review->rating > 1 && $review->rating < 2){
											 echo 'fa fa-star-half-alt';
										 }else{
											 if($review->rating >= 2){
												echo 'fa fa-star';
											 }else{
												 echo 'fa fa-star text-gray';
											 }
										 }
										 ?>
										 "></i></a></li>
										  <li><a href="#"><i class="
										  <?php
										  if($review->rating > 2 && $review->rating < 3){
											  echo 'fas fa-star-half-alt';
										  }else{
											  if($review->rating >= 3){
											  echo 'fa fa-star';
											  }else{
												  echo 'fa fa-star text-gray';
											  }
										  }
										  ?>"></i></a></li>
										  <li><a href="#"><i class="
										  <?php
										  if($review->rating > 3 && $review->rating < 4){
											  echo 'fa fa-star-half-alt';
										  }else{
											  if($review->rating >= 4){
											  echo 'fa fa-star';
											  }else{
											  echo 'fa fa-star text-gray';
											  }
										  }
										  ?>"></i></a></li>
										  <li><a href="#"><i class="
										  <?php if($review->rating > 4 && $review->rating < 5){
											  echo 'fa fa-star-half-alt';
										  }else{
											  if($review->rating >= 5){
												echo 'fa fa-star';
											  }else{
												echo 'fa fa-star text-gray' ;
											  }
										  };?>"></i></a></li>
                                </ul>
                              </div>
                            </div>
                          </div>
                          <div class="review-content row">
                            <div class="col pr-md-0">
							@php $str =  "The user didn't write a review, and has left just a rating."; @endphp
                              <p>{{ !empty($review->review_text) ? '“'.$review->review_text.'”': '“'.htmlspecialchars_decode($str, ENT_QUOTES).'”' }}</p>
                            </div>
                            <div class="col column2 text-right">
							@if(!empty($getObjBusiness->business_image))
                              <a href="{{ url('business').'/'.$getObjBusiness->business_slug }}"><img class="img-fluid" src="{{ $getObjBusiness->business_image }}" alt="{{ $getObjBusiness->business_name }}"></a>
						    @else
								<a href="#"><img class="img-fluid" src="{{ ('/public') }}/front-assets/images/default-image.jpg" alt="Pluckit"></a>
							@endif
                            </div>
                          </div>
                        </div>
						@endforeach
					  @else
						  <div class="text-center">No Review Found</div>
					 @endif

                      </div>
					   <div class="ht-80 bd d-flex align-items-center justify-content-end">
							<ul class="pagination pagination-basic pagination-primary mg-r-10">
								{{ $userReview->appends(['step' => 3])->links() }}
							</ul>
						</div>
                    </div>


					<div class="tab-pane fade {{ (!empty($input['step']) && $input['step']==4) ? 'show' : '' }} {{ (!empty($input['step']) && $input['step']==4) ? 'active' : '' }}" id="manage-payment" role="tabpanel"
                      aria-labelledby="manage-payment-tab">
                       <!-- business-card -->
					   <div class="row business-card my-3 justify-content-center">
							<div class="col-sm-4">
								<form action="{{ url('subscribe-addon')}}" method="post">
								@csrf

								<input type="hidden" name="price_id" value="{{ config('services.stripe.monthly') }}">
								<div class="card text-center">
									<div class="card-header text-center border-bottom-0 bg-transparent text-success pt-4">
									  <h5>1-Monthly Plan</h5>
									</div>
									<div class="card-body">
									  <h1>$99</h1>
									  <h5 class="text-muted"><small>/1 Month</small></h5>
									</div>
									<ul class="list-group list-group-flush">
									@if(!empty($monthlySubscriptionPlan->stripe_status) && ($monthlySubscriptionPlan->stripe_status=='trialing'))
										<li class="list-group-item"><i class="fas fa-male text-success mx-2"></i>Trial End At {{ date('j F, Y', strtotime($monthlySubscriptionPlan->trial_ends_at)) }}</li>
										<li class="list-group-item"><i class="fas fa-venus text-success mx-2"></i>Remainning Time {{ !empty($monthlydays) ? $monthlydays :'0' }}Days: {{ !empty($monthlyhours) ? $monthlyhours :'0' }} Hours:{{ !empty($monthlyminutes) ? $monthlyminutes :'0' }} Minutes</li>
										@endif
										@if(!empty($monthlySubscriptionPlan->stripe_status) && ($monthlySubscriptionPlan->stripe_status=='active'))
										<li class="list-group-item">PlAN ACTIVE NOW</li>
										@endif
									  </ul>

									@if(empty($monthlySubscriptionPlanid))
									<button type="submit" class="btn btn-sm">Choose this plan<i class="fas fa-arrow-right"></i></button>
									@else
									<a href="javascript:;" id="cancel_subscription" class="btn btn-sm">CANCEL PLAN</a>
									@endif


								</div>
								</form>
							</div>


							<div class="col-sm-4">
							<form action="{{ url('subscribe-addon')}}" method="post">
							@csrf
							<input type="hidden" name="price_id" value="{{ config('services.stripe.three_monthly') }}">
								<div class="card text-center">
									<div class="card-header text-center border-bottom-0 bg-transparent text-success pt-4">
									  <h5>3-Months Plan</h5>
									</div>
									<div class="card-body">
									  <h1>$249</h1>
									  <h5 class="text-muted"><small>/3 Month</small></h5>
									</div>
									<ul class="list-group list-group-flush">
									  @if(!empty($threeMonthssubscriptionPlan->stripe_status) && ($threeMonthssubscriptionPlan->stripe_status=='trialing'))
										<li class="list-group-item"><i class="fas fa-male text-success mx-2"></i>Trial End At {{ date('j F, Y', strtotime($threeMonthssubscriptionPlan->trial_ends_at)) }}</li>
										<li class="list-group-item"><i class="fas fa-venus text-success mx-2"></i>Remainning Time {{ !empty($threeMonthsdays) ? $threeMonthsdays :'0' }}Days: {{ !empty($threeMonthshours) ? $threeMonthshours :'0' }} Hours:{{ !empty($threeMonthsminutes) ? $threeMonthsminutes :'0' }} Minutes</li>
										@endif

										@if(!empty($threeMonthssubscriptionPlan->stripe_status) && ($threeMonthssubscriptionPlan->stripe_status=='active'))
										<li class="list-group-item">PlAN ACTIVE NOW</li>
										@endif

									</ul>

									@if(empty($threeMonthssubscriptionPlanid))
									<button class="btn btn-sm">Choose this plan<i class="fas fa-arrow-right"></i></button>
									@else
									<a href="javascript:;" id="cancel_subscription" class="btn btn-sm">CANCEL PLAN</a>
									@endif

								</div>
								</form>
							</div>

							<div class="col-sm-4">
								<form action="{{ url('subscribe-addon')}}" method="post">
								@csrf
								<input type="hidden" name="price_id" value="{{ config('services.stripe.twelve_monthly') }}">
								<div class="card text-center">
									<div class="card-header text-center border-bottom-0 bg-transparent text-success pt-4">
									  <h5>12-Months Plan</h5>
									</div>
									<div class="card-body">
									  <h1>$891</h1>
									  <h5 class="text-muted"><small>/12 Month</small></h5>
									</div>
									<ul class="list-group list-group-flush">
										@if(!empty($twelveMonthssubscriptionPlan->stripe_status) && ($twelveMonthssubscriptionPlan->stripe_status=='trialing'))
										<li class="list-group-item"><i class="fas fa-male text-success mx-2"></i>Trial End At {{ date('j F, Y', strtotime($twelveMonthssubscriptionPlan->trial_ends_at)) }}</li>
										<li class="list-group-item"><i class="fas fa-venus text-success mx-2"></i>Remainning Time {{ !empty($twelveMonthsdays) ? $twelveMonthsdays :'0' }}Days: {{ !empty($twelveMonthshours) ? $twelveMonthshours :'0' }} Hours:{{ !empty($twelveMonthsminutes) ? $twelveMonthsminutes :'0' }} Minutes</li>
										@endif
										@if(!empty($twelveMonthssubscriptionPlan->stripe_status) && ($twelveMonthssubscriptionPlan->stripe_status=='active'))
										<li class="list-group-item">PlAN ACTIVE NOW</li>
										@endif

									</ul>
										@if(empty($twelveMonthssubscriptionPlanid))
									<button class="btn btn-sm">Choose this plan<i class="fas fa-arrow-right"></i></button>
									@else
									<a href="javascript:;" id="cancel_subscription" class="btn btn-sm">CANCEL PLAN</a>
									@endif

								</div>
								</form>
							</div>

						</div>

						  <!-- business-card -->
                    </div>


					<!--
                    <div class="tab-pane fade {{ (!empty($input['step']) && $input['step']==4) ? 'show' : '' }} {{ (!empty($input['step']) && $input['step']==4) ? 'active' : '' }}" id="manage-payment" role="tabpanel"
                      aria-labelledby="manage-payment-tab">

                       <div class="row business-card my-3 justify-content-center">

                       <div class="col-sm-6">
                        <div class="card border-0 box-shadow text-center">
                              <div class="plan-info">
                                  <h2 class="display-4">
                                  <span>Free Trial</span>
                                  30<small>days</small>
                                  </h2>
                              </div>
                              <div class="card-body">
                                <div class="inner">
                                  <h4>Basic</h4>
                                  <p>Get your business up and running</p>
                                  <ul class="list-unstyled text-left">

									@if(!empty($subscriptionPlan->stripe_status) && ($subscriptionPlan->stripe_status=='trialing'))

									<li>Trial End At {{ date('j F, Y', strtotime($subscriptionPlan->trial_ends_at)) }}</li>
									<li>Remainning Time {{ !empty($days) ? $days :'0' }}Days: {{ !empty($hours) ? $hours :'0' }} Hours:{{ !empty($minutes) ? $minutes :'0' }} Minutes</li>

                                  @endif

								  </ul>
								  @if(empty(auth()->user()->subscription('default')))
                                  <a href="{{ url('checkout') }}" class="btn btn-primary d-inline-flex justify-content-center align-items-center">SUBSCRIBE<i class="fas fa-angle-right ml-2"></i></a>
							  @else
								  <button class="btn btn-primary d-inline-flex justify-content-center align-items-center">PlAN ACTIVE NOW</button>

							<a href="{{ url('cancel_subs') }}" class="btn btn-danger d-inline-flex justify-content-center align-items-center">CANCEL PLAN</a>

								  @endif
                                </div>
                              </div>
                          </div>
                         </div>-->
                         <!-- /Card -->
                         <!-- Card
                         <div class="col-sm-6 d-none">
                            <div class="card border-0 box-shadow text-center">
                                <div class="plan-info advanced">
                                    <h2 class="display-4"><span>AUD</span><br/>250</h2>
                                </div>
                                <div class="card-body">
                                    <div class="inner">
                                      <h4>Advanced</h4>
                                      <p>Get your business up and running</p>
                                      <ul class="list-unstyled text-left">
                                          <li>Lorem ipsum dorem sit met</li>
                                          <li>Lorem ipsum dorem sit met</li>
                                          <li>Lorem ipsum dorem sit met</li>
                                          <li>Lorem ipsum dorem sit met</li>
                                      </ul>
                                      <button type="button" class="btn btn-primary d-inline-flex justify-content-center align-items-center">GET STARTED<i class="fas fa-angle-right ml-2"></i></button>
                                    </div>
                                </div>
                            </div>
                         </div>
                        </div>-->


                         <!-- /Card -->
                      <!-- business-card -->

                    <div class="tab-pane fade {{ (!empty($input['step']) && $input['step']==5) ? 'show' : '' }} {{ (!empty($input['step']) && $input['step']==5) ? 'active' : '' }}" id="statistics" role="tabpanel" aria-labelledby="statistics-tab">
                      <h5>STATISTICS</h5>
					  <div class="box bg-gray-light box-shadow p-md-4 mt-4">
					  <form class="form" action="" method="get" id="form-select-filter">
					  <input type="hidden" name="step" value="5">
					   <div class="form-group row mb-4">
							  <label class="col-12 col-sm-12" for="country">Filter</label>
							  <div class="col-12 col-sm-6">
								  <span class="selectbox d-block">
									<select name="select_filter" id="select_filter" class="form-control">
									<option value="">Select Filter</option>
									 <option value="1" {{ (!empty($input['select_filter']) && ($input['select_filter'] == 1)) ? 'selected' : '' }}>Today</option>
									 <option value="7" {{ (!empty($input['select_filter']) && ($input['select_filter'] == 7)) ? 'selected' : '' }}>1 Week</option>
									 <option value="15" {{ (!empty($input['select_filter']) && ($input['select_filter'] == 15)) ? 'selected' : '' }}>15 Days</option>
									 <option value="30" {{ ((!empty($input['select_filter']) && ($input['select_filter'] == 30)) || (empty($input['select_filter']))) ? 'selected' : '' }}>1 Month</option>
									 <option value="180" {{ (!empty($input['select_filter']) && ($input['select_filter'] == 180)) ? 'selected' : '' }}>6 Month</option>
									 <option value="365" {{ (!empty($input['select_filter']) && ($input['select_filter'] == 365)) ? 'selected' : '' }}>1 Year</option>
									</select>
								  </span>
							  </div>
							</div>

						</form>
					  <div class="table-responsive">
						<table class="table display" id="datatable1" style="width:100%;">
						<tbody>
							<tr>
								<th>Last Login</th>
								<td> {{ $lastLogin }}</td>
							</tr>
							<tr>
							<tr>
								<th>No. Of Visitor</th>
								<td> {{ $noOfBusiness }}</td>
							</tr>
							<tr>
								<th>Search Result Appearance</th>
								<td>{{ $noOfSearchBusiness }}</td>
							</tr>
							<tr>
								<th>Hit On Call Button</th>
								 <td>{{ $noOfCallButton }}</td>
							</tr>
							<tr>
								<th>Hit On Email Button</th>
								 <td>{{ $noOfEmailButton }}</td>
							</tr>
							<tr>
								<th>Hit On Chat Button</th>
								<td>0</td>
							</tr>
							<tr>
								<th>Hit On Website Url</th>
								<td>{{ $noOfWebsiteButton }}</td>

							</tr>
							</tr>
						 </tbody>
						</table>

						</div>
				  </div>
                    </div>
                    <div class="tab-pane fade {{ (!empty($input['step']) && $input['step']==6) ? 'show' : '' }} {{ (!empty($input['step']) && $input['step']==6) ? 'active' : '' }}" id="help" role="tabpanel" aria-labelledby="help-tab">
                      <h5>HELP</h5>
					  <div class="box bg-gray-light box-shadow p-md-4 mt-4">
						  <form action="{{ url('business/user/sendquery') }}" method="post" class="form form-layout2 " id="form-user-query" enctype="multipart/form-data">
						  @csrf
							<div class="form-group">
							  <input id="subject" type="text" name="subject" class="form-control @error('subject') is-invalid @enderror" placeholder="Subject" required/>
							  @error('subject')
								<span class="invalid-feedback" role="alert" style="display:block;">
									<strong>{{ $message }}</strong>
								</span>
							  @enderror
							</div>
							<div class="form-group">
							  <textarea name="message" id="message" class="form-control @error('message') is-invalid @enderror" placeholder="Message" required></textarea>
							  @error('message')
								<span class="invalid-feedback" role="alert" style="display:block;">
									<strong>{{ $message }}</strong>
								</span>
							  @enderror
							</div>
							<div class="form-group">
							  <label class="file">
								<input type="file" id="file" name="attach_file" aria-label="File browser example" onChange="preview_file(event,'business_help')" data-parsley-fileextension='doc,docx,pdf,txt'>
								<span class="file-custom"></span>

							  </label>
							  <small id="fileHelpBlock" class="form-text text-muted">
								Attach file doc,docx,pdf and txt only.
								</small>
							  <div class="text-info" id="business_help">

								</div>
							  @error('attach_file')
								<span class="invalid-feedback" role="alert" style="display:block;">
									<strong>{{ $message }}</strong>
								</span>
							  @enderror
							</div>
							<input type="Submit" class="btn btn-primary rounded" />
						  </form>
						</div>
                    </div>
                  </div>
                </div>
              </div>
            </main>
            <aside id="sidebar" class="col-lg-4 pl-lg-4">
              <div class="sidebar-wrap">
                <h5 class="mb-0">Import Reviews</h5>
                <p>Build your audiences trust</p>
                <div class="box bg-gray-light box-shadow mt-4">
                  <ul class="list-unstyled import-contacts">
                    <li><a href="{{ route('fb.import.review') }}" class="facebook"><span class="icon2"><i class="fab fa-facebook-f"></i></span>Import
                        From Facebook</a></li>
						@if(!empty($pageList[0]))
                    <form action="{{ route('save_facebook_review') }}" method="post" id="form-review-google">
                        {{ csrf_field()}}
                    <div class="form-group">
                        <label for="trade">Get Review<span>*</span></label>
                        <span class="selectbox">
                            <select name="access_token" id="access_token" class="form-control" required>
                                <option value="" selected>Select Page</option>
                                @foreach($pageList as $list)
                                <option value="{{ $list['access_token'] }}_{{ $list['id'] }}"  >{{ $list['name'] }}</option>
                                @endforeach
                            </select>
                        </span>
                    </div>
                    <button type="submit" class="btn btn-primary">Save review</button>
                    </form>
                    @endif
                    <li><a href="{{ route('glogin') }}" class="google"><span class="icon2"><i class="fas fa-envelope"></i></span>Import From
                        Google</a></li>
                  </ul>
				   @if(!empty($bussniessList[0]))
                    <form action="{{ route('save_review') }}" method="post" id="form-review-google">
                        {{ csrf_field()}}
                    <div class="form-group">
                        <label for="trade">Get Review<span>*</span></label>
                        <span class="selectbox">
                            <select name="company_id" id="trade" class="form-control" required>
                                <option value="" selected>Select Company</option>
                                @foreach($bussniessList as $location)
                                <option value="{{ $location['name'] }}"  >{{ $location['locationName'] }}</option>
                                @endforeach
                            </select>
                        </span>
                    </div>
                    <button type="submit" class="btn btn-primary">Save review</button>
                    </form>
                    @endif
				</div>
				<!-- Rating summary -->
				<div class="box bg-gray-light box-shadow rating-summary">
				   <div class="box-header">
					<h3>96/100</h3>
					<h6>PROFILE RATING</h6>
				   </div>
				   <ul class="list-unstyled px-3 list-summary">
					    <li class="row">
					      <div class="col">Logo</div>
						  <div class="col"><span class="points">10/10 points</span></div>
						</li>
						<li class="row">
					      <div class="col">ABN</div>
							<div class="col">
							<span class="points">10/10 points</span>
							</div>
						</li>
						<li class="row">
					      <div class="col">Insurance <br />
						   <small>Verified</small></div>
							<div class="col">
							<span class="points">10/10 points</span>
							</div>
						</li>
						<li class="row">
					      <div class="col">Image gallery <br />
						   <small>5/5 images uploaded</small></div>
							<div class="col">
							<span class="points">10/10 points</span>
							</div>
						</li>
						<li class="row">
					      <div class="col">Contact details</div>
							<div class="col">
							<span class="points">10/10 points</span>
							</div>
						</li>
						<li class="row">
					      <div class="col">Description<br />
						   <small>At least 30 words</small></div>
							<div class="col">
							<span class="points">10/10 points</span>
							</div>
						</li>
						<li class="row">
					      <div class="col">Reviews<br />
						   <small>9/10 reviews</small></div>
							<div class="col">
							<small>36/40 points</small>
							</div>
						</li>
				   </ul>
				</div>
				<!-- /Rating summary -->
				<!-- Business summary -->
				<div class="box bg-gray-light box-shadow business-summary">
				    <div class="row mb-3">
					    <div class="col d-flex justify-center align-items-center">
						  <h6 class="mb-0">Qualifications</h6>
						</div>
						<div class="col">
					  	   <a href="#" class="btn btn-outline-secondary rounded float-right">Edit</a>
						</div>
					</div>
						<ul class="list-unstyled list-summary px-3">
							<li class="row">
								<div class="col">ABN</br />
								<a href="#">99 376 211 946</a></div>
							</li>
							<li class="row">
								<div class="col-8 pl-0 pr-3">
									Insurance<br />
									<small>● Public Liability Insurance</small>
								</div>
								<div class="col-4 text-right p-0">
								  <a href="#" class="btn btn-sm btn-outline-success">View info</a>
								</div>
							</li>
							<li class="row">
								<div class="col">Tradie Licence</br />
								<a href="#">89 466 211 936</a></div>
							</li>
						</ul>
				</div>
				<!-- /Business summary -->
              </div>
            </aside>
          </div>
        </div>

		<div class="modal fade" id="cancel_sub">
			<div class="modal-dialog modal-dialog-centered" role="document">
			  <div class="modal-content">
				<div class="modal-wrap">
				  <div class="modal-header border-0 align-items-center">
					<h2 class="modal-title">Cancel Subscription? </h2>
					<a href="{{ route('ignore-google-import') }}"><button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button></a>
				  </div>
				  <div class="modal-body">
				  </div>
				<div class="modal-footer">
				<a href="{{ url('cancel-sub-not-trail') }}" class="btn btn-primary float-right">Cancel and Continue with trial period</a>
				  <a href="{{ url('cancel-sub-and-trail') }}" class="btn btn-primary float-right">Cancel Now</a>
				</div>

				</div>
			  </div>
			</div>
		</div>

      </section>
    </div>
    <!-- /content -->
@endsection
@section('extracontent')
<script type="text/javascript" src="{{ ('/public') }}/front-assets/lib/parsleyjs/parsley.min.js"></script>
<script src="{{ ('/public') }}/front-assets/lib/jquery.filer/js/custom.js"></script>
<script>

	$("#cancel_subscription").click(function(e) {
		 e.preventDefault();
		 $('#cancel_sub').modal('show', {backdrop: 'static'});
	});


$(function(){
	'use strict';
// Summernote editor
 $('#summernote').summernote({
	  height: 150,
	  tooltip: false
	});
	 $('#summernote1').summernote({
	  height: 150,
	  tooltip: false
	});
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
				$('.select2-show-search').select2({
				  minimumResultsForSearch: ''
				});
                //$("#states").val('Semester '+callback.result);
                $("#business_city").html(callback.result);
            }
         });
});
 $(document).ready(function() {
	 window.ParsleyValidator
        .addValidator('fileextension', function (value, requirement) {
        		var tagslistarr = requirement.split(',');
            var fileExtension = value.split('.').pop();
						var arr=[];
						$.each(tagslistarr,function(i,val){
   						 arr.push(val);
						});
            if(jQuery.inArray(fileExtension, arr)!='-1') {
              console.log("is in array");
              return true;
            } else {
              console.log("is NOT in array");
              return false;
            }
        }, 32)
        .addMessage('en', 'fileextension', 'The extension doesn\'t match the required');
   $('#business_information').parsley();
   $('#business_address').parsley();
   $('#business_about').parsley();
   $('#business_service').parsley();
   $('#business_user_password').parsley();
   $('#form-user-query').parsley();
   $('#form-review-google').parsley();

});
  $('.remove_business_picture').click(function(e) {
    e.preventDefault();
	var data_business_id = $(this).attr('data-business-id');
	var serviceUrl = BASE_URL + '/business/user/remove-picture';
	if(data_business_id != undefined){
		$('.remove_picture').attr('disabled','disabled');
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}
		});
		var objData = {};
		var sendData = {};
		sendData = {
			data_business_id: data_business_id,
			};
			objData = {
		      url: serviceUrl,
			  type: 'post',
			  sendData: sendData
			 };
			send_ajax_request(objData, function (callback) {
			  if (callback.status == "200") {
				toastr.error(callback.message);
				location.reload();
				return false;
			  }
			 });
	}else{

	}

   });
   $('.remove_business_photo').click(function(e) {
    e.preventDefault();
	var data_id = $(this).attr('data-id');
	var serviceUrl = BASE_URL + '/business/user/remove-business-photo';
	if(data_id != undefined){
		$('.remove_picture').attr('disabled','disabled');
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}
		});
		var objData = {};
		var sendData = {};
		sendData = {
			data_id: data_id,
			};
			objData = {
		      url: serviceUrl,
			  type: 'post',
			  sendData: sendData
			 };
			send_ajax_request(objData, function (callback) {
			  if (callback.status == "200") {
				alert(callback.message);
				location.reload();
				return false;
			  }
			 });
	}else{

	}

   });
   $('.remove_business_certificate').click(function(e) {
    e.preventDefault();
	var data_id = $(this).attr('data-id');
	var serviceUrl = BASE_URL + '/business/user/remove-business-certificate';
	if(data_id != undefined){
		$('.remove_picture').attr('disabled','disabled');
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}
		});
		var objData = {};
		var sendData = {};
		sendData = {
			data_id: data_id,
			};
			objData = {
		      url: serviceUrl,
			  type: 'post',
			  sendData: sendData
			 };
			send_ajax_request(objData, function (callback) {
			  if (callback.status == "200") {
				alert(callback.message);
				location.reload();
				return false;
			  }
			 });
	}else{

	}

   });
   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    var filetoUpload = "{{ url('/business/user/imageUpload')}}";
	var fileToRemove = "{{ url('/business/user/imageRemove')}}";
    var filetoEditImg = <?php echo json_encode($arrReturnImage) ?>;
	var filetoUploadCerificate = "{{ url('/business/user/certificateUpload')}}";
	var fileToRemoveCerificate = "{{ url('/business/user/imageCertificateRemove')}}";
    var fileToEditImgCertificate = <?php echo json_encode($arrReturnCertificateImage) ?>;
	$("#select_filter").on("change",function(){
		$("#form-select-filter").submit();
	});
	function preview_file(event,id)
	{
	var fileName = event.target.files[0].name;
	var output = id;
	  output.html = fileName;
	  $('#'+output).html(fileName);
	}
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
				$('.select2-show-search').select2({
				  minimumResultsForSearch: ''
				});
                //$("#states").val('Semester '+callback.result);
                $("#business_city").html(callback.result);
            }
         });

 });
</script>
@endsection
