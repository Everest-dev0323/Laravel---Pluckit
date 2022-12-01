@extends('layouts.front-end.app')
@section('content')
<!-- Content -->
<?php
$userTable = Auth::user();
$arrReturnImage = array();
$arrImage = array();
$arrReturnCertificateImage = array();
$arrCertificateImage = array();
$arrReturnInsuranceImage = array();
$arrInsuranceImage = array();
if (!empty($getObjBusinessImage)) {
	foreach ($getObjBusinessImage as $businessImage) {
		$arrImage['name'] = $businessImage->business_photo_name;
		$arrImage['size'] = ($businessImage->business_photo_size != 0) ? $businessImage->business_photo_size : '145';
		$arrImage['rid'] = $businessImage->id;
		$arrImage['type'] = 'image/jpg';
		$arrImage['file'] = $businessImage->business_photo;
		$arrReturnImage[] = $arrImage;
	}
}
if (!empty($getObjBusinessCertificate)) {
	foreach ($getObjBusinessCertificate as $businessCertificateImage) {
		$arrCertificateImage['name'] = $businessCertificateImage->business_certificate_name;
		$arrCertificateImage['size'] = ($businessCertificateImage->business_certificate_size != 0) ? $businessCertificateImage->business_certificate_size : '145';
		$arrCertificateImage['rid'] = $businessCertificateImage->id;
		$arrCertificateImage['type'] = 'image/jpg';
		$arrCertificateImage['file'] = $businessCertificateImage->business_cerificate;
		$arrReturnCertificateImage[] = $arrCertificateImage;
	}
}
if (!empty($getObjBusinessInsurance)) {
	foreach ($getObjBusinessInsurance as $businessInsuranceImage) {
		$arrInsuranceImage['name'] = $businessInsuranceImage->business_insurance_name;
		$arrInsuranceImage['size'] = ($businessInsuranceImage->business_insurance_size != 0) ? $businessInsuranceImage->business_insurance_size : '145';
		$arrInsuranceImage['rid'] = $businessInsuranceImage->id;
		$arrInsuranceImage['type'] = 'image/jpg';
		$arrInsuranceImage['file'] = $businessInsuranceImage->business_insurance;
		$arrReturnInsuranceImage[] = $arrInsuranceImage;
	}
}
//echo "<pre>";var_dump($arrReturnInsuranceImage);exit;
?>
<div id="content">
	<section class="section">
		<div class="container pl-xl-0">
			<!-- business-card-info -->
			<div class="row client-profile business-card-info pb-4 d-md-flex justify-content-md-between align-items-md-start">
				<div class=" col-12 col-sm-4 col-md-4 col-lg-4">
					<div class="column2">
						<div class="service-box align-items-start">
							<div class="service-img profile-pic position-relative d-inline-block">
								<input id="profileimage" type="file" name="profile_image" class="inputfile" style="display:none">
								<a href="javascript:;" class="btn btn-dark btn-edit position-absolute edit_picture" title="Edit Profile"><i class="fas fa-pencil-alt"></i></a>
								<img class="img-fluid" src="{{ !empty($getUser->business_image) ? $getUser->business_image : asset('public/front-assets/images/default-profile.jpg') }}" alt="{{ !empty($getUser->business_name) ? $getUser->business_name : '-' }}" id="profile_image">
								<!-- <progress id="progressBar" max="100" value="{{ $getTotalPercentageVal[0]->count }}"></progress> -->
								<div class="progress">
									<div id="progressBar" class="progress-bar" role="progressbar" style="width: {{ $getTotalPercentageVal[0]->count }}%" aria-valuenow="{{ $getTotalPercentageVal[0]->count }}" aria-valuemin="0" aria-valuemax="100"></div>
									<div class="progress-value"> {{ $getTotalPercentageVal[0]->count }}%</div>
								</div>
								<div class="overlay-img horizontal-center profile_loader" style="display:none;"><i class="fas fa-sync-alt fa-spin position-relative"></i></div>
							</div>
							<div class="service-content d-inline-block">
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
				<div class="col-12 col-sm-4 col-md-4 col-lg-4">
					<div class="d-inline-flex">
						<a class="btn btn-outline-secondary btn-share social-share br-13" href="{{ url('/business').'/'.$getUser->business_slug }}" style="margin-bottom: 10px;margin-right: 10px;">View Public Page</a>
						<a class="btn btn-primary br-13" id="referr" href="?step=7" style="background: #28a745 !important; margin-bottom: 10px;border-color: #f8c323 !important;">Earn Lifetime Commission</a>
					</div>
					<a href="javascript:;" class="btn btn-outline-secondary btn-share social-share br-13" data-href="{{ url('/business').'/'.$getUser->business_slug }}" data-business-id="{{$getUser->id}}"><i class="fas fa-share-square mr-2"></i>Share My Page</a>
				</div>
				<div class="col-12 col-sm-4 col-md-4 col-lg-4 text-sm-right">
					<div class="column box2 bg-gray text-center">
						<div class="media">
							<div class="media-body">
								<h5>No of Reviews</h5>
								<span class="total-count">{{ $userReviewCount }}</span>
							</div>
							<!-- <i class="fa fa-star"></i> -->
						</div>
					</div>
					<div class="showMobile mt-4">
						<h5 class="mb-0">Import Reviews</h5>
						<p>Build your audiences trust</p>
						<div class="box bg-gray-light box-shadow mt-4">
							<ul class="list-unstyled import-contacts">
								<li><a href="{{ isset(Auth::user()->stripe_id)?route('fb.import.review'):'#' }}" class="facebook social-check"><span class="icon2"><i class="fab fa-facebook-f"></i></span>Import
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
												<option value="{{ $list['access_token'] }}_{{ $list['id'] }}">{{ $list['name'] }}</option>
												@endforeach
											</select>
										</span>
									</div>
									<button type="submit" class="btn btn-primary">Import reviews</button>
								</form>
								@endif
								<li class="mt-2"><a href="{{ isset(Auth::user()->stripe_id)?route('glogin'):'#' }}" class="google social-check"><span class="icon2"><i class="fas fa-envelope"></i></span>Import From
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
											<option value="{{ $location['name'] }}">{{ $location['locationName'] }}</option>
											@endforeach
										</select>
									</span>
								</div>
								<button type="submit" class="btn btn-primary">Import reviews</button>
							</form>
							@endif
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
							<button type="button" class="btn btn-primary rounded mb-3" id="tabMenu"><i class="fas fa-bars fa-lg"></i></button>
							<ul class="nav nav-tabs flex-column border-0 d-md-block" id="myTab" role="tablist" style="display:none">
								<li class="nav-item">
									<a class="nav-link {{ (empty($input['step']) || $input['step']==1) ? 'active' : '' }}" id="manage-business-tab" data-toggle="tab" href="#manage-business" role="tab" aria-controls="manage-business" aria-selected="true"><i class="far fa-handshake"></i>MANAGE YOUR BUSINESS</a>
								</li>
								<li class="nav-item">
									<a class="nav-link {{ (!empty($input['step']) && $input['step']==2) ? 'active' : '' }}" id="manage-account-tab" data-toggle="tab" href="#manage-account" role="tab" aria-controls="manage-account" aria-selected="false"><i class="fas fa-user"></i>MANAGE MY PASSWORD</a>
								</li>
								<li class="nav-item">
									<a class="list-check nav-link {{ (!empty($input['step']) && $input['step']==3) ? 'active' : '' }}" id="manage-reviews-tab" data-toggle="tab" href="#manage-reviews" role="tab" aria-controls="manage-reviews" aria-selected="false"><i class="fa fa-star"></i>MANAGE REVIEWS</a>
								</li>
								<li class="nav-item">
									<a class="nav-link {{ (!empty($input['step']) && $input['step']==4) ? 'active' : '' }}" id="manage-payment-tab" data-toggle="tab" href="#manage-payment" role="tab" aria-controls="manage-payment" aria-selected="true"><i class="fas fa-hand-holding-usd"></i>MANAGE PAYMENT</a>
								</li>
								<li class="nav-item">
									<a class="list-check nav-link {{ (!empty($input['step']) && $input['step']==5) ? 'active' : '' }}" id="statistics-tab" data-toggle="tab" href="#statistics" role="tab" aria-controls="statistics" aria-selected="false"><i class="fas fa-chart-line"></i>STATISTICS</a>
								</li>
								<li class="nav-item">
									<a class="nav-link {{ (!empty($input['step']) && $input['step']==7) ? 'active' : '' }}" id="referral-tab" data-toggle="tab" href="#referral" role="tab" aria-controls="referral" aria-selected="false"><i class="fas fa-chart-line"></i>My Referral</a>
								</li>
								<li class="nav-item">
									<a class="nav-link {{ (!empty($input['step']) && $input['step']==6) ? 'active' : '' }}" id="help-tab" data-toggle="tab" href="#help" role="tab" aria-controls="help" aria-selected="false"><i class="fas fa-question-circle"></i>HELP</a>
								</li>
							</ul>
						</div>
						<div class="col-md-9 pl-md-0">
							<div class="tab-content" id="myTabContent">
								<div class="tab-pane fade {{ (empty($input['step'])  || $input['step']==1) ? 'show' : '' }} {{ (empty($input['step']) || $input['step']==1) ? 'active' : '' }}" id="manage-business" role="tabpanel" aria-labelledby="manage-business-tab">
									<!--Tabs-->
									<div class="nav-wrap mb-4">
										<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
											<li class="nav-item">
												<a class="nav-link {{ (empty($input['step']) || ($input['step'] != 1) || ($input['step']==1 &&  $input['t'] ==1)) ? 'active' : '' }}" id="pills-general-tab" data-toggle="pill" href="#pills-general" role="tab" aria-controls="pills-general" aria-selected="true">GENERAL</a>
											</li>
											<li class="nav-item">
												<a class="user-check nav-link {{ (!empty($input['step']) && ($input['step']==1 &&  $input['t'] ==2)) ? 'active' : '' }}" id="pills-about-tab" data-toggle="pill" href="#pills-about" role="tab" aria-controls="pills-about" aria-selected="false">ABOUT</a>
											</li>
											<li class="nav-item">
												<a class="user-check nav-link {{ (!empty($input['step']) && ($input['step']==1 &&  $input['t'] ==3)) ? 'active' : '' }}" id="pills-services-tab" data-toggle="pill" href="#pills-services" role="tab" aria-controls="pills-services" aria-selected="false">SERVICES</a>
											</li>
											<li class="nav-item">
												<a class="user-check nav-link {{ (!empty($input['step']) && ($input['step']==1 &&  $input['t'] ==4)) ? 'active' : '' }}" id="pills-photos-tab" data-toggle="pill" href="#pills-photos" role="tab" aria-controls="pills-photos" aria-selected="false">PHOTOS</a>
											</li>
											<li class="nav-item">
												<a class="user-check nav-link {{ (!empty($input['step']) && ($input['step']==1 &&  $input['t'] ==5)) ? 'active' : '' }}" id="pills-certificates-tab" data-toggle="pill" href="#pills-certificates" role="tab" aria-controls="pills-certificates" aria-selected="false">CERTIFICATES</a>
											</li>
											<li class="nav-item">
												<a class="user-check nav-link {{ (!empty($input['step']) && ($input['step']==1 &&  $input['t'] ==6)) ? 'active' : '' }}" id="pills-insurances-tab" data-toggle="pill" href="#pills-insurances" role="tab" aria-controls="pills-insurances" aria-selected="false">Insurance</a>
											</li>
										</ul>
										<div class="tab-content" id="pills-tabContent">
											<div class="tab-pane fade {{ (empty($input['step']) || ($input['step'] != 1) || ($input['step']==1 &&  $input['t'] ==1)) ? 'show' : '' }} {{ (empty($input['step']) || ($input['step'] != 1) || ($input['step']==1 &&  $input['t'] ==1)) ? 'active' : '' }}" id="pills-general" role="tabpanel" aria-labelledby="pills-general-tab">
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
																		<a href="javascript:;" data-business-id="{{ $getUser->id }}" class="btn-remove position-absolute remove_business_picture"><i class="fas fa-times"></i></a>
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
																	<label for="trade" class="label-trade">Select your trade<span>*</span></label>
																	<br />
																	<span class="selectbox">
																		<select name="category_id[]" id="trade" class="form-control select2-show-search" data-placeholder="Search Trade" required multiple>
																			<option value="">Search Category</option>
																			@if(!empty($allCatgories[0]))
																			@foreach($allCatgories as $category)
																			<option value="{{ $category->alias }}" {{ (!empty($arrbusinessCategory ) && in_array($category->alias, $arrbusinessCategory)) ? 'selected' : '' }}>{{ $category->name }}</option>
																			@endforeach
																			@endif
																		</select>
																	</span>
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-xl-6">
																<!-- <div class="form-group">
                                      <label for="business_default_hours">Working hours</label>
                                      <input type="text" name="business_default_hours" id="business_default_hours" class="form-control" placeholder="10AM - 5PM" value="{{ !empty($getUser->business_default_hours) ? $getUser->business_default_hours : '' }}">
																</div> -->
																<label for="business_default_hours">Working hours</label>
																<div class="input-group mb-3">
																	<input type="text" name="business_default_hours" id="business_default_hours" class="form-control" placeholder="10AM - 5PM" value="{{ !empty($getUser->business_default_hours) ? $getUser->business_default_hours : '' }}" aria-label="{{ !empty($getUser->business_default_hours) ? $getUser->business_default_hours : '' }}" aria-describedby="basic-addon">
																	<div class="input-group-append">
																		<button class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#addWorkingHours">More</button>
																	</div>
																</div>
															</div>
															<div class="col-xl-6">
																<div class="form-group">
																	<label for="abn">ABN<span>*</span></label><br />
																	<input type="text" name="abn" id="abn" class="form-control" placeholder="ABN" disabled value="{{ !empty($getUser->business_abn) ? $getUser->business_abn : '' }}">
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-xl-6">
																<div class="form-group">
																	<label for="tel">Phone no.</label>
																	<div class="row">
																		<div class="col-3">
																			<input type="text" class="form-control" placeholder="+61" value="+61" disabled>
																		</div>
																		<div class="col-9">
																			<input type="text" data-parsley-type="number" maxlength="10" name="business_phone" id="tel" class="form-control" placeholder="" value="{{ !empty($getUser->business_phone) ? $getUser->business_phone : '' }}">
																		</div>
																	</div>

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
												<!-- /Business Information -->
												<!-- Business Address -->
												<h5>Business Address</h5>
												<div class="box bg-gray-light box-shadow p-md-4 my-4">
													<form class="form form-layout2" action="{{ url('business/user/address/update') }}" method="post" id="business_address">
														{{ csrf_field()}}
														<div class="row">
															<div class="col-xl-6">
																<div class="form-group">
																	<label for="address">Address<span>*</span></label>
																	<input type="text" name="business_address_1" id="address" class="form-control" placeholder="Address" required value="{{ !empty($getUser->business_address_1) ? $getUser->business_address_1 : '' }}">
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
																	<label for="country">Country</label>
																	<span class="selectbox">
																		<select name="business_country" id="country" class="form-control">
																			<option value="">Select Country</option>
																			<option value="AU" {{ (!empty($getUser->business_country) && ($getUser->business_country == 'AU')) ? 'selected' : ''}}>Australia</option>
																		</select>
																	</span>
																</div>
															</div>
															<div class="col-xl-6">
																<div class="form-group">
																	<label for="business_cityy">State<span>*</span></label>
																	<span class="selectbox2">
																		<select class="form-control select2-show-search" name="business_state" id="business_city" data-placeholder="Select State" required>
																			<option value="">Select State<span>*</span></option>
																			@if(!empty($allstates))
																			@foreach($allstates as $state)
																			<option value="{{ $state->short_code }}" {{ (!empty($getUser->business_state) && ($getUser->business_state == $state->short_code)) ? 'selected' : ''}}>{{ $state->name }}</option>
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
																	<input type="text" name="business_city" id="city" class="form-control" placeholder="City" required value="{{ !empty($getUser->business_city) ? $getUser->business_city : '' }}">
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
												<form action="{{ url('business/user/about/update') }}" class="{{isset(Auth::user()->stripe_id)?'d-block':'d-none'}}" method="post" id="business_about">
													{{ csrf_field()}}
													<div class="row">
														<div class="col-xl-12">
															<div class="form-group">
																<textarea class="form-control" name="business_about" id="summernote" required><?php echo !empty($getUser->business_about) ? $getUser->business_about : ''; ?>
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
											<div class="tab-pane fade {{ (!empty($input['step']) && ($input['step']==1 &&  $input['t'] ==3)) ? 'show' : '' }} {{ (!empty($input['step']) && ($input['step']==1 &&  $input['t'] ==3)) ? 'active' : '' }}" id="pills-services" role="tabpanel" aria-labelledby="pills-services-tab">

												<h5>SERVICES</h5>
												<form action="{{ url('business/user/service/update') }}" class="{{isset(Auth::user()->stripe_id)?'d-block':'d-none'}}" method="post" id="business_service">
													{{ csrf_field()}}
													<div class="row">
														<div class="col-xl-12">
															<div class="form-group">
																<textarea class="form-control" name="business_service" id="summernote1" required><?php echo !empty($getUser->business_services) ? $getUser->business_services : ''; ?>
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
											<div class="tab-pane fade {{ (!empty($input['step']) && ($input['step']==1 &&  $input['t'] ==4)) ? 'show' : '' }} {{ (!empty($input['step']) && ($input['step']==1 &&  $input['t'] ==4)) ? 'active' : '' }}" id="pills-photos" role="tabpanel" aria-labelledby="pills-photos-tab">
												<h5>PHOTOS</h5>
												<div class="row d-none">
													@if(!empty($getObjBusinessImage[0]))
													@foreach($getObjBusinessImage as $image)
													<div class="col-xl-3">
														<img src="{{ $image->business_photo }}" style="height:100px; width:150px;" />
														<a href="javascript:;" data-id="{{ $image->id }}" class="remove_business_photo">Remove</a>
													</div>
													@endforeach
													@endif
												</div>
												<div class="clearfix">&nbsp;</div>
												<form action="{{ url('business/user/photo/update') }}" class="{{isset(Auth::user()->stripe_id)?'d-block':'d-none'}}" method="post" id="business_photo_form" enctype="multipart/form-data">
													{{ csrf_field()}}
													<div class="row">
														<div class="col-md-12">
															<div class="form-group">
																<label class="form-control-label">Upload Photo (Attach file jpeg, png, jpg, gif, svg and image size is less than 20 mb only.)</label>
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
											<div class="tab-pane fade {{ (!empty($input['step']) && ($input['step']==1 &&  $input['t'] ==5)) ? 'show' : '' }} {{ (!empty($input['step']) && ($input['step']==1 &&  $input['t'] ==5)) ? 'active' : '' }}" id="pills-certificates" role="tabpanel" aria-labelledby="pills-certificates-tab">
												<h5>CERTIFICATES</h5>
												<div class="row d-none">
													@if(!empty($getObjBusinessCertificate[0]))
													@foreach($getObjBusinessCertificate as $certificate)
													<div class="col-xl-3">
														<img src="{{ $certificate->business_cerificate }}" style="height:100px; width:150px;" />
														<a href="javascript:;" data-id="{{ $certificate->id }}" class="remove_business_certificate">Remove</a>
													</div>
													@endforeach
													@endif
												</div>
												<div class="clearfix">&nbsp;</div>
												<form action="{{ url('business/user/certificates/update') }}" class="{{isset(Auth::user()->stripe_id)?'d-block':'d-none'}}" method="post" id="business_certificates_form" enctype="multipart/form-data">
													{{ csrf_field()}}
													<div class="row">
														<div class="col-md-12">
															<div class="form-group">
																<label class="form-control-label">Upload Certificate (Attach file jpeg, png, jpg, gif, svg, pdf and image size is less than 20 mb only.)</label>
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
											<div class="tab-pane fade {{ (!empty($input['step']) && ($input['step']==1 &&  $input['t'] ==6)) ? 'show' : '' }} {{ (!empty($input['step']) && ($input['step']==1 &&  $input['t'] ==6)) ? 'active' : '' }}" id="pills-insurances" role="tabpanel" aria-labelledby="pills-insurances-tab">
												<h5>Insurance</h5>
												<div class="row d-none">
													@if(!empty($getObjBusinessInsurance[0]))
													@foreach($getObjBusinessInsurance as $insurance)
													<div class="col-xl-3">
														<img src="{{ $insurance->business_cerificate }}" style="height:100px; width:150px;" />
														<a href="javascript:;" data-id="{{ $insurance->id }}" class="remove_business_insurance">Remove</a>
													</div>
													@endforeach
													@endif
												</div>
												<div class="clearfix">&nbsp;</div>
												<form action="{{ url('business/user/insurances/update') }}" class="{{isset(Auth::user()->stripe_id)?'d-block':'d-none'}}" method="post" id="business_insurances_form" enctype="multipart/form-data">
													{{ csrf_field()}}
													<div class="row">
														<div class="col-md-12">
															<div class="form-group">
																<label class="form-control-label">Upload Insurance (Attach file jpeg, png, jpg, gif, svg, pdf and image size is less than 20 mb only.)</label>
																<input type="file" name="insurances[]" id="filer_input3" class="form-control" multiple="multiple">
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
												<input id="current-password" type="password" name="current_password" class="form-control  @error('current_password') is-invalid @enderror" value="{{ old('current_password') }}" required autocomplete="password" autofocus />
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
												<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" />
											</div>
											<button type="submit" class="btn btn-primary rounded">Change password</button>
										</form>
									</div>
								</div>
								<div class="tab-pane fade {{ (!empty($input['step']) && $input['step']==3) ? 'show' : '' }} {{ (!empty($input['step']) && $input['step']==3) ? 'active' : '' }}" id="manage-reviews" role="tabpanel" aria-labelledby="manage-reviews-tab">
									<h5>Recent Reviews</h5>
									<div class="review-list mt-lg-4 {{isset(Auth::user()->stripe_id)?'d-block':'d-none'}}">
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
											if ($review->rating == 0) {
												echo 'fa fa-star text-gray';
											} else {
												if ($review->rating > 0 && $review->rating < 1) {
													echo 'fa fa-star-half-alt';
												} else {
													echo 'fa fa-star';
												}
											}
											?>
										"></i></a></li>
															<li><a href="#"><i class="
										 <?php
											if ($review->rating > 1 && $review->rating < 2) {
												echo 'fa fa-star-half-alt';
											} else {
												if ($review->rating >= 2) {
													echo 'fa fa-star';
												} else {
													echo 'fa fa-star text-gray';
												}
											}
											?>
										 "></i></a></li>
															<li><a href="#"><i class="
										  <?php
											if ($review->rating > 2 && $review->rating < 3) {
												echo 'fas fa-star-half-alt';
											} else {
												if ($review->rating >= 3) {
													echo 'fa fa-star';
												} else {
													echo 'fa fa-star text-gray';
												}
											}
											?>"></i></a></li>
															<li><a href="#"><i class="
										  <?php
											if ($review->rating > 3 && $review->rating < 4) {
												echo 'fa fa-star-half-alt';
											} else {
												if ($review->rating >= 4) {
													echo 'fa fa-star';
												} else {
													echo 'fa fa-star text-gray';
												}
											}
											?>"></i></a></li>
															<li><a href="#"><i class="
										  <?php if ($review->rating > 4 && $review->rating < 5) {
												echo 'fa fa-star-half-alt';
											} else {
												if ($review->rating >= 5) {
													echo 'fa fa-star';
												} else {
													echo 'fa fa-star text-gray';
												}
											}; ?>"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="review-content row">
												<div class="col pr-md-0">
													@php $str = "The user didn't write a review, and has left just a rating."; @endphp
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
								<div class="tab-pane fade {{ (!empty($input['step']) && $input['step']==4) ? 'show' : '' }} {{ (!empty($input['step']) && $input['step']==4) ? 'active' : '' }}" id="manage-payment" role="tabpanel" aria-labelledby="manage-payment-tab">
									<!-- business-card -->
									<div class="row business-card my-3 justify-content-center">
										<div class="col-lg-12">
											<form class="signup-form">
												@csrf
												<div class="payments-container">
													<h3>Pluck your plan</h3>
													<input type="hidden" name="user_id" value="{{ $user_id }}">

													<label class="plan-field bg-gray-light">
														<span class="checkmark">
															<input type="radio" name="pricing" value="" {{empty($user_id['stripe_plan']) ? 'checked':''}}>
															<span class="plan-radio-button"></span>
														</span>
														<span class="planInfo">
														<span class="plan-title">Free Plan</span>
														<span class="plan-desc"> List your business for free and start gaining reputations -  limited plan.</span>
														</span>
														<span class="plan-price">$0</span>
													</label>


													<label class="plan-field bg-gray-light">
														<span class="checkmark">
															<input type="radio" name="pricing" value="{{ config('services.stripe.six_monthly') }}" {{ (!empty($user_id['stripe_plan']) && ($user_id['stripe_plan'] == config('services.stripe.six_monthly')) && !empty($user_id['stripe_status']) && ($user_id['stripe_status'] != 'canceled') ) ? 'checked' : '' }}>

															<span class="plan-radio-button"></span>
														</span>
														<span class="planInfo">
															<span class="plan-title">6 Months</span>
															<span class="plan-desc"> Safe bet. Get a feel on how it works.</span>
														</span>
														<span class="plan-price">$500 <br /></span>
													</label>

													<label class="plan-field bg-gray-light">
														<span class="checkmark">
															<input type="radio" name="pricing" value="{{ config('services.stripe.twelve_monthly') }}" {{ (!empty($user_id['stripe_plan']) && ($user_id['stripe_plan'] == config('services.stripe.twelve_monthly')) && !empty($user_id['stripe_status']) && ($user_id['stripe_status'] != 'canceled')) ? 'checked' : '' }}>
															<span class="plan-radio-button"></span>
														</span>
														<span class="planInfo">
															<span class="plan-title">12 Months</span>
															<span class="plan-desc"> Serious about getting more work. Receive 12 months for the price of 9 months</span>
														</span>
														<span class="plan-price">$750 <br /></span>
													</label>
													<div class="row">
														<div class="col-12 text-center">
															@if(!empty($user_id['stripe_status']) && ($user_id['stripe_status'] != 'canceled'))
															<button type="button" class="btn btn-primary btn-block rounded mb-2 cancel_subs">Cancel Subscription</button>
															@endif

															<button type="button" class="btn btn-primary btn-block rounded mb-2 update_subs d-none">Update Plan</button>

															@if($userTable->still_in_trail==1)
															<p>Your Plan will be renew at {{ $subDetail }}</p>
															@else
															<p>Payment will only be taken after trial expires</p>
															@endif
														</div>
													</div>
												</div>
											</form>
										</div>
										<div class="col-sm-4 d-none">
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

													@if(!empty($monthlySubscriptionPlanid) && ($monthlySubscriptionPlan->stripe_status !='canceled'))
													<!--<a href="javascript:;" id="cancel_subscription" class="btn btn-sm">CANCEL PLAN</a>-->

													@else
													<button class="btn btn-sm">Choose this plan<i class="fas fa-arrow-right"></i></button>
													@endif


												</div>
											</form>
										</div>


										<div class="col-sm-4 d-none">
											<form action="{{ url('subscribe-addon')}}" method="post">
												@csrf
												<input type="hidden" name="price_id" value="{{ config('services.stripe.six_monthly') }}">
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

													@if(!empty($threeMonthssubscriptionPlanid) && ($threeMonthssubscriptionPlan->stripe_status !='canceled'))
													<!--<a href="javascript:;" id="cancel_subscription" class="btn btn-sm">CANCEL PLAN</a>-->

													@else
													<button class="btn btn-sm">Choose this plan<i class="fas fa-arrow-right"></i></button>
													@endif


												</div>
											</form>
										</div>

										<div class="col-sm-4 d-none">
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
													@if(!empty($twelveMonthssubscriptionPlanid) && ($twelveMonthssubscriptionPlan->stripe_status !='canceled'))
													<!--<a href="javascript:;" id="cancel_subscription" class="btn btn-sm">CANCEL PLAN</a>-->

													@else
													<button class="btn btn-sm">Choose this plan<i class="fas fa-arrow-right"></i></button>
													@endif

												</div>
											</form>
										</div>

									</div>

									<!-- business-card -->
								</div>


								<div class="tab-pane fade {{ (!empty($input['step']) && $input['step']==5) ? 'show' : '' }} {{ (!empty($input['step']) && $input['step']==5) ? 'active' : '' }}" id="statistics" role="tabpanel" aria-labelledby="statistics-tab">
									<h5>STATISTICS</h5>
									<div class="box bg-gray-light box-shadow p-md-4 mt-4 {{isset(Auth::user()->stripe_id)?'d-block':'d-none'}}">
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
														<th>Clicks Onto Your Profile</th>
														<td> {{ $noOfBusiness }}</td>
													</tr>
													<tr>
														<th>Number Of Times Seen In Search Results</th>
														<td>{{ $noOfSearchBusiness }}</td>
													</tr>
													<tr>
														<th>Clicks On 'Call' Button</th>
														<td>{{ $noOfCallButton }}</td>
													</tr>
													<tr>
														<th>Clicks On 'Message' Button</th>
														<td>0</td>
													</tr>
													<tr>
														<th>Clicks On 'Website' Button</th>
														<td>{{ $noOfWebsiteButton }}</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<div class="tab-pane fade {{ (!empty($input['step']) && $input['step']==7) ? 'show' : '' }} {{ (!empty($input['step']) && $input['step']==7) ? 'active' : '' }}" id="referral" role="tabpanel" aria-labelledby="referral-tab">
									<div class="">
										<h5>My Refferals</h5>
										<div class="row mt-5 clearfix">
											<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
												<div class="input-group">
													@if(!empty(Auth::user()->referral_code))
													<input type="text" name="refferalCode" id="refferalCode" class="form-control" value="{{ url('business/user/signup/') }}?referral={{ Auth::user()->referral_code }}">
													<div class="input-group-append">
														<button class="btn btn-secondary copy-referall" id="copy-referall" type="button" data-href="{{ url('business/user/signup/') }}?referral={{ Auth::user()->referral_code }}" data-clipboard-text="{{ url('business/user/signup/') }}?referral={{ Auth::user()->referral_code }}">Copy Link</button>&nbsp;
														<button class="btn btn-danger social-share-referall" type="button" data-href="{{ url('business/user/signup/') }}/{{ Auth::user()->referral_code }}" data-business-id="{{ Auth::user()->referral_code }}">Share Link</button>
													</div>
													@else
													<a class="btn btn-success" href="{{ url('business/user/dashboard?type=g') }}">Generate Referral Link</a>
													@endif
												</div>
											</div>
										</div>
										<div class="row mt-5 clearfix">
											<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
												<div class="refferal-box clearfix">
													Total Commission Earned
													<span>{{ (!empty($commission['totalCommision']))?$commission['totalCommision']:0 }} AUD</span>
												</div>
											</div>
											<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
												<div class="refferal-box clearfix">
													Commission Pending
													<span>{{ (!empty($commission['totalPenddingCommision']))?$commission['totalPenddingCommision']:0 }} AUD</span>
												</div>
												<p>Note: Commission will be paid quarterly </p>
											</div>
										</div>
										<div class="row mt-3 clearfix">
											<div class="col-12">
												@if(!empty($commission['refferedUsers']))
												<div class="refferal-box clearfix">
													<h5 class="mb-2" style="font-size: 1rem;">Business signed up using your refferals [ {{ $commission['totalCount'] }} ]</h5>
													<table cellspacing="0" cellpadding="0" class="table table-bordered table-condensed">
														<thead>
															<tr>
																<th>#</th>
																<th>Bussiness Name</th>
																<th>Registration date</th>
																<th>Amount (AUD)</th>
																<th>Paid</th>
																<th>No Commission</th>
															</tr>
														</thead>
														<tbody>
															@foreach($commission['refferedUsers'] as $cUsers)
															<tr>
																<td>{{ $loop->index+1 }}</td>
																<td><a href="{{ url('/business/'.$cUsers->referredTo->bussiness->business_slug) }}">{{ (!empty($cUsers->referredTo->bussiness->business_name))?$cUsers->referredTo->bussiness->business_name:'-' }}</a></td>
																<td>{{ date("d-m-Y",strtotime($cUsers->created_at)) }}</td>
																<td>{{ $cUsers->commission }}</td>
																<td>{{ (!empty($cUsers->is_paid))?'Yes':'No' }}</td>
																<td>
																	@if(!empty($cUsers->want_commision))
																	No
																	@else
																	<input type="checkbox" class="form-control want_commision" value="1" data-id="{{ $cUsers->id }}">
																	@endif
																</td>
															</tr>
															@endforeach
														</tbody>
													</table>
												</div>
												{{ $commission['refferedUsers']->appends(array('step'=>'7'))->links() }}
												@endif
											</div>
										</div>
									</div>
									<div class="row mt-3 clearfix">

										<div class="col-12">
											<h5>Payout Bank Details</h5>
											<p>(Commission will be paid quarterly)</p>
											<form method="post" action="{{ route('user-update') }}" class="mt-3 clearfix" role="form">
												@csrf()
												<div class="form-group row">
													<label for="accountName" class="col-sm-3 col-form-label">Account Name</label>
													<div class="col-sm-9">
														<input type="text" class="form-control" name="account_name" placeholder="Enter Your Account Name" value="{{ (!empty($bankDetail->account_name))?$bankDetail->account_name:'' }}">
													</div>
												</div>
												<div class="form-group row">
													<label for="accountNumber" class="col-sm-3 col-form-label">Account Number</label>
													<div class="col-sm-9">
														<input type="text" class="form-control" name="account_number" placeholder="Enter Your Account Number" value="{{ (!empty($bankDetail->account_number))?$bankDetail->account_number:'' }}">
													</div>
												</div>
												<div class="form-group row">
													<label for="bsb" class="col-sm-3 col-form-label">BSB</label>
													<div class="col-sm-9">
														<input type="text" class="form-control" name="bsb" placeholder="Enter Your BSB" value="{{ (!empty($bankDetail->bsb))?$bankDetail->bsb:'' }}">
													</div>
												</div>
												<div class="form-group row">
													<label for="businessName" class="col-sm-3 col-form-label">Business Name <small>(If any)</small></label>
													<div class="col-sm-9">
														<input type="text" class="form-control" id="business_name" name="business_name" placeholder="Enter Your Business Name" value="{{ (!empty($bankDetail->business_name))?$bankDetail->business_name:'' }}" />
													</div>
												</div>
												<div class="form-group row">
													<label for="abnNumber" class="col-sm-3 col-form-label">ABN Number <small>(If any)</small></label>
													<div class="col-sm-9">
														<input type="text" class="form-control" name="abn_number" placeholder="Enter Your ABN Number" value="{{ (!empty($bankDetail->abn_number))?$bankDetail->abn_number:'' }}" />
													</div>
												</div>
												<input type="submit" id="submit" name="submit" class="btn btn-danger btn-lg" value="SAVE" />
											</form>
										</div>
									</div>
								</div>
								<div class="tab-pane fade {{ (!empty($input['step']) && $input['step']==6) ? 'show' : '' }} {{ (!empty($input['step']) && $input['step']==6) ? 'active' : '' }}" id="help" role="tabpanel" aria-labelledby="help-tab">
									<h5>HELP</h5>
									<div class="box bg-gray-light box-shadow p-md-4 mt-4">
										<form action="{{ url('business/user/sendquery') }}" method="post" class="form form-layout2 " id="form-user-query" enctype="multipart/form-data">
											@csrf
											<div class="form-group">
												<input id="subject" type="text" name="subject" class="form-control @error('subject') is-invalid @enderror" placeholder="Subject" required />
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
						<div class="showDesktop">
							<h5 class="mb-0">Import Reviews</h5>
							<p>Build your audiences trust</p>
							<div class="box bg-gray-light box-shadow mt-4">
								<ul class="list-unstyled import-contacts">
									<li><a href="{{ isset(Auth::user()->stripe_id)?route('fb.import.review'):'#' }}" class="facebook social-check"><span class="icon2"><i class="fab fa-facebook-f"></i></span>Import
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
														<option value="{{ $list['access_token'] }}_{{ $list['id'] }}">{{ $list['name'] }}</option>
														@endforeach
													</select>
												</span>
											</div>
											<button type="submit" class="btn btn-primary">Import reviews</button>
										</form>
										@endif
										<li class="mt-2"><a href="{{ isset(Auth::user()->stripe_id)?route('glogin'):'#' }}" class="google social-check"><span class="icon2"><i class="fas fa-envelope"></i></span>Import From
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
													<option value="{{ $location['name'] }}">{{ $location['locationName'] }}</option>
													@endforeach
												</select>
											</span>
										</div>
										<button type="submit" class="btn btn-primary">Import reviews</button>
									</form>
									@endif
							</div>
						</div>
						<!-- Rating summary -->
						<div class="box bg-gray-light box-shadow rating-summary">
							<div class="box-header">
								<h3>{{ $getTotalPercentageVal[0]->count }}/100</h3>
								<h6>PROFILE RATING</h6>
							</div>
							<ul class="list-unstyled px-3 list-summary">
								<li class="row">
									<div class="col">Logo</div>
									<div class="col"><span class="points">{{ $getPercentageLogo }}/10 points</span></div>
								</li>
								<li class="row">
									<div class="col">ABN</div>
									<div class="col">
										<span class="points">{{ $getPercentageAbn }}/10 points</span>
									</div>
								</li>
								<li class="row">
									<div class="col">Insurance <br />
										<small>Verified</small>
									</div>
									<div class="col">
										<span class="points">{{ $getPercentageInsurance }}/10 points</span>
									</div>
								</li>
								<li class="row">
									<div class="col">Image gallery <br />
										<small>{{ $getTotalImage }} images uploaded</small>
									</div>
									<div class="col">
										<span class="points">{{ $getPercentageGalary }}/20 points</span>
									</div>
								</li>
								<li class="row">
									<div class="col">Contact details</div>
									<div class="col">
										<span class="points">{{ $getPercentageContact }}/10 points</span>
									</div>
								</li>
								<li class="row">
									<div class="col">Description<br />
										<small>At least 30 words</small>
									</div>
									<div class="col">
										<span class="points">{{ $getPercentageAbout }}/10 points</span>
									</div>
								</li>
								<li class="row">
									<div class="col">Services <br />
										<small>Verified</small>
									</div>
									<div class="col">
										<span class="points">{{ $getPercentageServices}}/10 points</span>
									</div>
								</li>
								<li class="row">
									<div class="col">Reviews<br />
										<small>{{ $getTotalReview }} reviews</small>
									</div>
									<div class="col">
										<small>{{ $getPercentageReview }}/20 points</small>
									</div>
								</li>

							</ul>
						</div>
						<!-- /Rating summary -->
						<!-- Business summary
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
				</div>-->
						<!-- /Business summary -->
					</div>
				</aside>
			</div>
		</div>
		<div class="modal fade" id="sharepopup">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-wrap">
						<div class="modal-header border-0 align-items-center">
							<h4 class="modal-title d-none">Share</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body pt-0 text-center" id="show_share">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="shareReferralPopup">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-wrap">
						<div class="modal-header border-0 align-items-center">
							<h4 class="modal-title d-none">Share Referral Code</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body pt-0 text-center" id="show_share_referral">
							<div class="share-page-content pt-3">
								<!-- <div class="logo mb-4">
									<img class="img-fluid" src="https://pluckit.com.au/public/uploads/business/1624636753-square FWD logo.png" alt="Fusion Web">
								</div> -->
								<div class="form-group">
									<div id="social-links">
										<ul>
											<li class="list-inline-item">
												<a id="facebook_share" data-href="https://www.facebook.com/sharer/sharer.php?u=" class="social-button btn btn-primary " title="Refer a business and earn 30% on each signup">
													<svg class="svg-inline--fa fa-facebook-f fa-w-9" aria-hidden="true" data-prefix="fab" data-icon="facebook-f" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 264 512" data-fa-i2svg="">
														<path fill="currentColor" d="M76.7 512V283H0v-91h76.7v-71.7C76.7 42.4 124.3 0 193.8 0c33.3 0 61.9 2.5 70.2 3.6V85h-48.2c-37.8 0-45.1 18-45.1 44.3V192H256l-11.7 91h-73.6v229"></path>
													</svg><!-- <i class="fab fa-facebook-f"></i> -->
												</a>
											</li>
											<li class="list-inline-item">
												<a id="twitter_share" data-href="https://twitter.com/intent/tweet?text=Refer+a+business+and+earn+30%25+on+each+signup&url=" class="social-button btn btn-primary " title="Refer a business and earn 30% on each signup"><svg class="svg-inline--fa fa-twitter fa-w-16" aria-hidden="true" data-prefix="fab" data-icon="twitter" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
														<path fill="currentColor" d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path>
													</svg><!-- <i class="fab fa-twitter"></i> -->
												</a>
											</li>
											<li class="list-inline-item">
												<a id="linkedin_share" data-href="http://www.linkedin.com/shareArticle?mini=true&title=Refer+a+business+and+earn+30%25+on+each+signup&url=" class="social-button btn btn-primary " title="Refer a business and earn 30% on each signup"><svg class="svg-inline--fa fa-linkedin fa-w-14" aria-hidden="true" data-prefix="fab" data-icon="linkedin" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
														<path fill="currentColor" d="M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z"></path>
													</svg><!-- <i class="fab fa-linkedin"></i> -->
												</a>
											</li>
											<li class="list-inline-item">
												<a id="whatsApp_share" target="_blank" data-href="https://wa.me/?text=" class="social-button btn btn-primary " title="Refer a business and earn 30% on each signup"><svg class="svg-inline--fa fa-whatsapp fa-w-14" aria-hidden="true" data-prefix="fab" data-icon="whatsapp" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
														<path fill="currentColor" d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"></path>
													</svg><!-- <i class="fab fa-whatsapp"></i> -->
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /Modal -->
			<div class="modal fade" id="cancel_sub">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-wrap">
							<div class="modal-header border-0 align-items-center">
								<h2 class="modal-title">Cancel Subscription</h2>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<h5 class="lh-3 mg-b-20"><a href="" class="tx-inverse">Are you sure you want to cancel your subscription?</a></h5>
							</div>
							<div class="modal-footer">
								@if(!empty($user_id->stripe_status) && ($user_id->stripe_status=='trialing'))
								<a href="{{ url('cancel-sub-not-trail') }}" class="btn btn-primary float-right d-none">Cancel and Continue with trial period</a>
								@endif
								<a href="{{ url('cancel-sub-and-trail') }}" type="button" class="iam-sure-cat btn btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium d-none">Yes Sure</a>
								<a href="javascript:;" type="button" class="iam-sure-sub btn btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">Yes Sure</a>
								<button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">Cancel</button>
							</div>

						</div>
					</div>
				</div>
			</div>


	</section>
</div>

<!-- /content -->

<!-- Modal -->
<div class="modal fade" id="wantComissionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form method="post" action="{{ url('business/commission/remove') }}">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					Are you Sure you don't want commission ?
					<div>
						@csrf
						<input type="hidden" name="cm_id" id="cm_id">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Yes</button>
				</div>
			</div>
		</form>
	</div>
</div>

<button type="button" class="btn btn-primary d-none wantComissionModal" data-toggle="modal" data-target="#wantComissionModal">
	Launch demo modal
</button>
@endsection
@section('extracontent')
<script type="text/javascript" src="{{ ('/public') }}/front-assets/lib/parsleyjs/parsley.min.js"></script>
<script type="text/javascript" src="{{ ('/public') }}/front-assets/lib/jquery.filer/js/custom.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.10/clipboard.min.js"></script>
<script type="text/javascript">
	$("input[name='pricing']+.plan-radio-button").css('background', 'transparent');

	$($("input[name='pricing']+.plan-radio-button")[0]).css('background', '#686868');

	$('.user-check, .list-check, .social-check').click(function() {
		if({{!Auth::user()->stripe_id}}) {
			toastr.error("Upgrade your account to access the section");
		}
	});
	$('.copy-referall').tooltip({
		trigger: 'click',
		placement: 'bottom'
	});
	function setTooltip(message) {
		$('.copy-referall').tooltip('hide')
		.attr('data-original-title', message)
		.tooltip('show');
	}
	function hideTooltip() {
		setTimeout(function() {
			$('.copy-referall').tooltip('hide');
		}, 1000);
	}
	// Clipboard
	var clipboard = new Clipboard('.copy-referall');
	clipboard.on('success', function(e) {
		setTooltip('Copied!');
		hideTooltip();
	});
	clipboard.on('error', function(e) {
		setTooltip('Failed!');
		hideTooltip();
	});
</script>
<script>
	$(".want_commision").click(function() {
		if ($(this).prop('checked')) {
			$(".wantComissionModal").click();
			$("#cm_id").val($(this).attr('data-id'));
			$(this).removeProp('checked');
		}
	});
	document.querySelector("#copy-referall").addEventListener("click", copyToClipboard)

	function copyToClipboard(elem) {
		var copyText = document.getElementById("refferalCode");
		copyText.select();
		document.execCommand("copy");
        addReferralStat('copy');
		//alert('Link Copied');
	}
	$("#cancel_subscription").click(function(e) {
		e.preventDefault();
		$('#cancel_sub').modal('show', {
			backdrop: 'static'
		});
	});
function addReferralStat(type){
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            var objData = {};
            var sendData = {};
            sendData = {
                id: "{{ Auth::user()->id }}",
                type:type,
                user_type:'Business'
            };
            objData = {
                url: "{{ route('referral.stat') }}",
                type: 'post',
                sendData: sendData
            };
            send_ajax_request(objData, function(callback) {
                if (callback.status == "200") {
                    toastr.error(callback.message);
                    location.reload();
                    return false;
                }
            });
    }


	$(function() {
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
		$('.select2-show-search').select2({
			minimumResultsForSearch: ''
		});
	});
	$(document).ready(function() {
		window.ParsleyValidator
			.addValidator('fileextension', function(value, requirement) {
				var tagslistarr = requirement.split(',');
				var fileExtension = value.split('.').pop();
				var arr = [];
				$.each(tagslistarr, function(i, val) {
					arr.push(val);
				});
				if (jQuery.inArray(fileExtension, arr) != '-1') {
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
		$('#form-add-working-hours').parsley();


	});
	$('.remove_business_picture').click(function(e) {
		e.preventDefault();
		var data_business_id = $(this).attr('data-business-id');
		var serviceUrl = BASE_URL + '/business/user/remove-picture';
		if (data_business_id != undefined) {
			$('.remove_picture').attr('disabled', 'disabled');
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
			send_ajax_request(objData, function(callback) {
				if (callback.status == "200") {
					toastr.error(callback.message);
					location.reload();
					return false;
				}
			});
		} else {

		}

	});
	$('.remove_business_photo').click(function(e) {
		e.preventDefault();
		var data_id = $(this).attr('data-id');
		var serviceUrl = BASE_URL + '/business/user/remove-business-photo';
		if (data_id != undefined) {
			$('.remove_picture').attr('disabled', 'disabled');
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
			send_ajax_request(objData, function(callback) {
				if (callback.status == "200") {
					alert(callback.message);
					location.reload();
					return false;
				}
			});
		} else {

		}

	});
	$(".edit_picture").click(function(e) {
		e.preventDefault();
		//$("input[id='profileimage']").click();
		$("#profileimage:hidden").trigger('click');
		// $(this).addClass('d-none');
		//$('#save_profile_image').removeClass('d-none');
	});
	$("#profileimage").change(function(e) {
		e.preventDefault();
		var image = $('#profileimage').val();
		var imazeSize = (this.files[0].size);
		var img_ex = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
		//validate file type
		if (!img_ex.exec(image)) {
			toastr.error('Please upload only .jpg/.jpeg/.png/.gif file.');
			//alert('Please upload only .jpg/.jpeg/.png/.gif file.');
			$('#profileimage').val('');
			return false;
		} else if (Math.round(imazeSize / (1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024)) > 20) {
			toastr.error('This file should not be larger than 20 Mb.');
			$('#profileimage').val('');
			return false;
		} else {
			$('.uploadProcess').show();
			$('#uploadForm').hide();
			var serviceUrl = BASE_URL + '/business/user/profile/image/update';
			var fd = new FormData();
			var files = $('#profileimage')[0].files[0];
			fd.append('profile_image', files);
			//var fileName = e.target.files[0].name;
			console.log(fd);
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				}
			});
			$(".profile_loader").show();
			$.ajax({
				url: serviceUrl,
				type: 'post',
				data: fd,
				contentType: false,
				processData: false,
				success: function(response) {
					if (response != 0) {
						$(".profile_loader").hide();
						$("#profile_image").attr("src", response);

					} else {
						toastr.error('file not uploaded');
					}
				},
			});
			//$("#get-form-image").submit();
		}
		//$("#get-form-image").submit();
	});
	$('.remove_business_certificate').click(function(e) {
		e.preventDefault();
		var data_id = $(this).attr('data-id');
		var serviceUrl = BASE_URL + '/business/user/remove-business-certificate';
		if (data_id != undefined) {
			$('.remove_picture').attr('disabled', 'disabled');
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
			send_ajax_request(objData, function(callback) {
				if (callback.status == "200") {
					alert(callback.message);
					location.reload();
					return false;
				}
			});
		} else {

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
	var filetoUploadInsurance = "{{ url('/business/user/insuranceUpload')}}";
	var fileToRemoveInsurance = "{{ url('/business/user/imageInsuranceRemove')}}";
	var fileToEditImgInsurance = <?php echo json_encode($arrReturnInsuranceImage) ?>;
	$("#select_filter").on("change", function() {
		$("#form-select-filter").submit();
	});

	function preview_file(event, id) {
		var fileName = event.target.files[0].name;
		var output = id;
		output.html = fileName;
		$('#' + output).html(fileName);
	}
	$("body").on("change", "#country", function() {
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
		send_ajax_request(objData, function(callback) {
			if (callback.status == "200") {
				$('.select2-show-search').select2({
					minimumResultsForSearch: ''
				});
				//$("#states").val('Semester '+callback.result);
				$("#business_city").html(callback.result);
			}
		});

	});
	$("body").on("click", "input[name='pricing']", function() {
		$("input[name='pricing']+.plan-radio-button").css('background', 'transparent');
		$(this).siblings('.plan-radio-button').css('background', '#686868');
		var catRadio = $(this).val();
		var getsubs = "{{ isset($user_id['stripe_plan'])?$user_id['stripe_plan']:'free' }}";
		var getstatus = "{{ isset($user_id['stripe_status'])?$user_id['stripe_status']:'' }}";

		if ((catRadio != getsubs)) {
			if(getsubs=='free' && catRadio=='') {
				$('.cancel_subs').removeClass('d-none');
				$('.update_subs').addClass('d-none');
			}else {
				$('.cancel_subs').addClass('d-none');
				$('.update_subs').removeClass('d-none');
			}
		} else {
			if (getstatus != 'canceled') {
				$('.cancel_subs').removeClass('d-none');
				$('.update_subs').addClass('d-none');
			} else {
				$('.cancel_subs').addClass('d-none');
				$('.update_subs').removeClass('d-none');
			}
		}
	});
	$('.social-share-referall').on('click', function() {
		var dataHref = $(this).data('href');
		var facebook_share = $("#facebook_share").data('href');
		var twitter_share = $("#twitter_share").data('href');
		var linkedin_share = $("#linkedin_share").data('href');
		var whatsApp_share = $("#whatsApp_share").data('href');
		$("#facebook_share").attr('href', facebook_share + dataHref);
		$("#twitter_share").attr('href', twitter_share + dataHref);
		$("#linkedin_share").attr('href', linkedin_share + dataHref);
		$("#whatsApp_share").attr('href', whatsApp_share + dataHref);
                                   addReferralStat('share');
		$('#shareReferralPopup').modal('show', {
			backdrop: 'static'
		});
	});
	$('.social-share').on('click', function() {
		var data_href = $(this).attr('data-href');
		var data_business_id = $(this).attr('data-business-id');
		if (data_href != '') {
			$('#sharepopup').modal('show', {
				backdrop: 'static'
			});
			$("#show_share").html('Loading ..');
			var serviceUrl = BASE_URL + '/business/user/share';
			var objData = {};
			var sendData = {};
			sendData = {
				data_href: data_href,
				data_business_id: data_business_id
			};
			objData = {
				url: serviceUrl,
				type: 'post',
				sendData: sendData
			};
			send_ajax_request(objData, function(callback) {
				if (callback.status == "200") {
					$("#show_share").html('');
					$("#show_share").html(callback.result);
				}
			});
		}
	});
	$("body").on("click", ".cancel_subs", function() {
		var catRadio = $("input[name='pricing']:checked").val();
		if (catRadio != '') {
			$('#cancel_sub').modal('show', {
				backdrop: 'static'
			});
			return false;
		}
	});
	$("body").on("click", ".iam-sure-sub", function() {
		var catRadio = $("input[name='pricing']:checked").val();
		if (catRadio != '') {
			var serviceUrl = BASE_URL + '/cancel-sub-and-trail';
			$('.iam-sure-sub').html('Loading...');
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				}
			});
			var objData = {};
			var sendData = {};
			sendData = {
				catRadio: catRadio,
			};
			objData = {
				url: serviceUrl,
				type: 'post',
				sendData: sendData
			};
			send_ajax_request(objData, function(callback) {
				if (callback.status == "200") {
					$('.iam-sure-sub').html('Cancel Subscription');
					$('#cancel_sub').modal('hide');
					toastr.success(callback.message);
					window.location.href = callback.href_url;
					return false;
				} else {
					$('.iam-sure-sub').html('Cancel Subscription');
					toastr.error(callback.message);
					$('#cancel_sub').modal('hide');
					window.location.href = callback.href_url;
					return false;
				}
			});

		}
	});
	$("body").on("click", ".cancel_subs", function() {
		var catRadio = $("input[name='pricing']:checked").val();
		if (catRadio != '') {
			$('#cancel_sub').modal('show', {
				backdrop: 'static'
			});
			return false;
		}
	});
	$("body").on("click", ".update_subs", function() {
		var catRadio = $("input[name='pricing']:checked").val();
		if (catRadio != '') {
			var serviceUrl = BASE_URL + '/subscribe-addon';
			$('.update_subs').html('Loading...');
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				}
			});
			var objData = {};
			var sendData = {};
			sendData = {
				catRadio: catRadio,
			};
			objData = {
				url: serviceUrl,
				type: 'post',
				sendData: sendData
			};
			// $.post(serviceUrl, sendData, function(res, status){
			// 	console.log(res);
			// })
			send_ajax_request(objData, function(callback) {
				if (callback.status == "200") {
					$('.update_subs').html('Update Plan');
					toastr.success(callback.message);
					window.location.href = callback.href_url;
					return false;
				}
				if (callback.status == "201") {
					$('.update_subs').html('Update Plan');
					window.location.href = callback.href_url;
					return false;
				} else {
					$('.update_subs').html('Update Plan');
					toastr.error(callback.message);
					window.location.href = callback.href_url;
					return false;
				}
			});
		}
	});
</script>
<!-- Add working hours -->
<form action="{{ url('business/user/working-hours') }}" method="post" class="form form-layout2 " id="form-add-working-hours" enctype="multipart/form-data">
	@csrf
	<div class="modal fade add-working-hours" id="addWorkingHours" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-wrap">
					<div class="modal-header align-items-center pl-0">
						<h4 class="mb-0">Add working hours</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row text-right">
							<div class="col-sm-2">&nbsp;</div>
							<div class="col col-sm-5">
								<h6><strong>Open</strong></h6>
							</div>
							<div class="col col-sm-5">
								<h6><strong>Close</strong></h6>
							</div>
						</div>
						<div class="form-group row">
							<label for="monday" class="col-sm-2 mt-md-2">Sunday</label>
							<div class="col-sm-10">
								<div class="row">
									<input type="hidden" name="week_first" value="Sunday">
									<input type="hidden" name="business_week_first" value="{{ !empty($businessWorkingHoursFirst->id) ? $businessWorkingHoursFirst->id : '' }}">
									<div class="col pr-0"><input type="text" name="open_sun" class="form-control" placeholder="10 AM" value="{{ !empty($businessWorkingHoursFirst->open_time) ? $businessWorkingHoursFirst->open_time : '10 AM' }}" required /></div>
									<div class="col"><input type="text" name="close_sun" class="form-control" placeholder="5 PM" value="{{ !empty($businessWorkingHoursFirst->close_time) ? $businessWorkingHoursFirst->close_time : '5 PM' }}" required /></div>
								</div>
								<!-- <small class="form-text">Must be fill with AM/PM.</small> -->
							</div>
						</div>
						<div class="form-group row">
							<label for="monday" class="col-sm-2 mt-md-2">Monday</label>
							<div class="col-sm-10">
								<div class="row">
									<input type="hidden" name="week_second" value="Monday">
									<input type="hidden" name="business_week_second" value="{{ !empty($businessWorkingHoursSecond->id) ? $businessWorkingHoursSecond->id : '' }}">
									<div class="col pr-0"><input type="text" name="open_mon" class="form-control" placeholder="10 AM" value="{{ !empty($businessWorkingHoursSecond->open_time) ? $businessWorkingHoursSecond->open_time : '10 AM' }}" required /></div>
									<div class="col"><input type="text" name="close_mon" class="form-control" placeholder="5 PM" value="{{ !empty($businessWorkingHoursSecond->close_time) ? $businessWorkingHoursSecond->close_time : '5 PM' }}" required /></div>
								</div>
								<!-- <small class="form-text">Must be fill with AM/PM.</small> -->
							</div>
						</div>
						<div class="form-group row">
							<label for="monday" class="col-sm-2 mt-md-2">Tuesday</label>
							<div class="col-sm-10">
								<div class="row">
									<input type="hidden" name="week_third" value="Tuesday">
									<input type="hidden" name="business_week_third" value="{{ !empty($businessWorkingHoursThird->id) ? $businessWorkingHoursThird->id : '' }}">
									<div class="col pr-0"><input type="text" name="open_tues" class="form-control" placeholder="10 AM" value="{{ !empty($businessWorkingHoursThird->open_time) ? $businessWorkingHoursThird->open_time : '10 AM' }}" required /></div>
									<div class="col"><input type="text" name="close_tues" class="form-control" placeholder="5 PM" value="{{ !empty($businessWorkingHoursThird->close_time) ? $businessWorkingHoursThird->close_time : '5 PM' }}" required /></div>
								</div>
								<!-- <small class="form-text">Must be fill with AM/PM.</small> -->
							</div>
						</div>
						<div class="form-group row">
							<label for="monday" class="col-sm-2 mt-md-2">Wednesday</label>
							<div class="col-sm-10">
								<div class="row">
									<input type="hidden" name="week_fourth" value="Wednesday">
									<input type="hidden" name="business_week_fourth" value="{{ !empty($businessWorkingHoursFourth->id) ? $businessWorkingHoursFourth->id : '' }}">
									<div class="col pr-0"><input type="text" name="open_wed" class="form-control" placeholder="10 AM" value="{{ !empty($businessWorkingHoursFourth->open_time) ? $businessWorkingHoursFourth->open_time : '10 AM' }}" required /></div>
									<div class="col"><input type="text" name="close_wed" class="form-control" placeholder="5 PM" value="{{ !empty($businessWorkingHoursFourth->close_time) ? $businessWorkingHoursFourth->close_time : '5 PM' }}" required /></div>
								</div>
								<!-- <small class="form-text">Must be fill with AM/PM.</small> -->
							</div>
						</div>
						<div class="form-group row">
							<label for="monday" class="col-sm-2 mt-md-2">Thursday</label>
							<div class="col-sm-10">
								<div class="row">
									<input type="hidden" name="week_fifth" value="Thursday">
									<input type="hidden" name="business_week_fifth" value="{{ !empty($businessWorkingHoursFifth->id) ? $businessWorkingHoursFifth->id : '' }}">
									<div class="col pr-0"><input type="text" name="open_thu" class="form-control" placeholder="10 AM" value="{{ !empty($businessWorkingHoursFifth->open_time) ? $businessWorkingHoursFifth->open_time : '10 AM' }}" required /></div>
									<div class="col"><input type="text" name="close_thu" class="form-control" placeholder="5 PM" value="{{ !empty($businessWorkingHoursFifth->close_time) ? $businessWorkingHoursFifth->close_time : '5 PM' }}" required /></div>
								</div>
								<!-- <small class="form-text">Must be fill with AM/PM.</small> -->
							</div>
						</div>
						<div class="form-group row">
							<label for="monday" class="col-sm-2 mt-md-2">Friday</label>
							<div class="col-sm-10">
								<div class="row">
									<input type="hidden" name="week_sixth" value="Friday">
									<input type="hidden" name="business_week_sixth" value="{{ !empty($businessWorkingHoursSixth->id) ? $businessWorkingHoursSixth->id : '' }}">
									<div class="col pr-0"><input type="text" name="open_fri" class="form-control" placeholder="10 AM" value="{{ !empty($businessWorkingHoursSixth->open_time) ? $businessWorkingHoursSixth->open_time : '10 AM' }}" required /></div>
									<div class="col"><input type="text" name="close_fri" class="form-control" placeholder="5 PM" value="{{ !empty($businessWorkingHoursSixth->close_time) ? $businessWorkingHoursSixth->close_time : '5 PM' }}" required /></div>
								</div>
								<!-- <small class="form-text">Must be fill with AM/PM.</small> -->
							</div>
						</div>
						<div class="form-group row">
							<label for="monday" class="col-sm-2 mt-md-2">Saturday</label>
							<div class="col-sm-10">
								<div class="row">
									<input type="hidden" name="week_seventh" value="Saturday">
									<input type="hidden" name="business_week_seventh" value="{{ !empty($businessWorkingHoursSeventh->id) ? $businessWorkingHoursSeventh->id : '' }}">
									<div class="col pr-0"><input type="text" name="open_sat" class="form-control" placeholder="10 AM" value="{{ !empty($businessWorkingHoursSeventh->open_time) ? $businessWorkingHoursSeventh->open_time : '10 AM' }}" required /></div>
									<div class="col"><input type="text" name="close_sat" class="form-control" placeholder="5 PM" value="{{ !empty($businessWorkingHoursSeventh->close_time) ? $businessWorkingHoursSeventh->close_time : '5 PM' }}" required /></div>
								</div>
								<!-- <small class="form-text">Must be fill with AM/PM.</small> -->
							</div>
						</div>
					</div>
					<div class="form-group mb-0 text-right">
						<input type="hidden" name="hid_working_business_id" value="{{ $getUser->id }}">
						<div class="col-12"><button class="btn btn-primary" type="submit">Save</button></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
</div>
<!-- /Add working hours -->

<script>
	$(window).load(function() {
		$('#import-contact-view').modal('show');
	});
</script>
@if(empty($userFbReviewCount) && empty($userGoogleReviewCount) && $first_time == 1)
<!-- FaceBook import modal -->
<div class="modal fade" role="dialog" id="import-facebook" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-wrap">
				<div class="modal-header border-0 align-items-center">
					<h2 class="modal-title">Import Reviews </h2>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<!-- Modal body -->
				<div class="modal-body">
					<h5 class="mb-0">Import Reviews</h5>
					<p>Build your audiences trust</p>
					<div class="box bg-gray-light box-shadow mt-4">
						<ul class="list-unstyled import-contacts">
							<li><a href="{{ isset(Auth::user()->stripe_id)?route('fb.import.review'):'#' }}" class="facebook social-check"><span class="icon2"><i class="fab fa-facebook-f"></i></span>Import
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
											<option value="{{ $list['access_token'] }}_{{ $list['id'] }}">{{ $list['name'] }}</option>
											@endforeach
										</select>
									</span>
								</div>
								<button type="submit" class="btn btn-primary">Import reviews</button>
							</form>
							@endif
							<li class="mt-2"><a href="{{ isset(Auth::user()->stripe_id)?route('glogin'):'#' }}" class="google social-check"><span class="icon2"><i class="fas fa-envelope"></i></span>Import From
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
										<option value="{{ $location['name'] }}">{{ $location['locationName'] }}</option>
										@endforeach
									</select>
								</span>
							</div>
							<button type="submit" class="btn btn-primary">Import reviews</button>
						</form>
						@endif
					</div>

				</div>
				<!-- /Modal body -->
			</div>
		</div>
	</div>
</div>
<script>
	$(window).load(function() {
		$('#import-facebook').modal('show');
	});
</script>
@endif
@endsection
