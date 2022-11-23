@extends('layouts.front-end.app')
@section('content')
@php $input['step'] = !empty($input['step']) ? $input['step'] : '';@endphp
<!-- Content -->
<div id="content">
  <section class="section">
	   <div class="container">
	      <!-- Client Profile -->
	       <div class="row client-profile d-md-flex justify-content-between">
		         <div class="col-12 col-sm-4 col-lg-4 pr-lg-5">
			            <div class="column">
			                 <div class="media mb-3">
				                     <div class="profile-pic position-relative">
					                          <input id="profileimage" type="file" name="profile_image" class="inputfile"  style="display:none">
					                          <a href="javascript:;" data-id="{{ $getUser->id }}" class="btn btn-dark btn-edit position-absolute edit_picture" title="Edit Profile Image"><i class="fas fa-pencil-alt"></i></a>
					                          <img class="img-fluid" src="{{ !empty($getUser->user_image) ? $getUser->user_image : asset('public/front-assets/images/default-profile.jpg') }}" alt="{{ !empty(Auth::user()->name) ? Auth::user()->name : 'Avatar' }}" id="profile_image">
					                          <div class="title"><small id="fileHelpBlock" class="form-text">Upload only jpeg, png, jpg, gif, svg file.</small></div>
					                          <div class="overlay-img horizontal-center profile_loader" style="display:none;"><i class="fas fa-sync-alt fa-spin position-relative"></i></div>
				                     </div>
				                     <div class="media-body ml-3">
				                           <h4 class="mb-1">{{ Auth::user()->name }}</h4>
				                           <ul class="list-unstyled">
					                                <li>{{ Auth::user()->email }}</li>
					                                <li>{{ !empty(Auth::user()->state) ? Auth::user()->state : '' }}</li>
					                                <li>{{ !empty($getUser->profile_text) ? $getUser->profile_text : '' }}</li>
				                           </ul>
				                     </div>
			                 </div>
			             </div>
		           </div>
               <div class="col-12 col-sm-4 col-md-4 col-lg-4">
                 <div class="commissionToggle"><a href="#" class="btn btn-success btn-lg br-13">Earn Lifetime Commission</a></div>
               </div>
		           <div class="col-12 col-sm-4 col-lg-4 pl-lg-5 text-sm-right">
		               <div class="column box2 text-left">
			                  <div class="media">
				                      <div class="media-body">
				                            <h5>No of Reviews</h5>
				                            <span class="total-count">{{ $userReviewCount }}</span>
				                      </div>
				                      <i class="fa fa-star"></i>
			                  </div>
		               </div>
		           </div>
	       </div>
	  <!-- /Client Profile -->
	  <div class="row">
	  <div class="col-md-12">
	      <div class="alert alert-success d-none" id="alert-success">

			</div><br />
		  @if(session()->get('success'))
			<div class="alert alert-success">
				{{ session()->get('success') }}
			</div><br />
			@endif
			@if(session()->get('warning'))
			<div class="alert alert-danger">
				{{ session()->get('warning') }}
			</div><br />
			@endif
      </div>
		<aside id="sidebar" class="col-lg-4 pl-lg-5 order-lg-2">
		  <div class="box2">
			<div class="media">
			  <div class="media-body">
				<h5 class="mb-2">No. of Contacts</h5>
				<span class="total-count">{{ $contactCount }}</span>
			  </div>
			  <i class="fa fa-user"></i>
			</div>
		  </div>
		  <hr class="my-4" />
		  <h5>Import Your Contacts</h5>
		  <div class="box bg-gray-light box-shadow">
			<ul class="list-unstyled import-contacts mb-3">
			  <li><a href="{{ route('fb.import') }}" class="facebook"><span class="icon2"><i class="fab fa-facebook-f"></i></span>Import your contacts
				  from Facebook</a></li>
			@php
			$configs = config('services.google');
			@endphp
			@if((!empty($configs['client_id'])) && (!empty($configs['client_secret'])))
			  <li><a href="{{ route('google.import') }}" class="google"><span class="icon2"><i class="fas fa-envelope"></i></span>Import your contacts from
				  Google</a>
			  </li>
			@endif
			  <li><a href="{{ route('outlook.import') }}" class="outlook"><span class="icon2"><img class="img-fluid"
					  src="{{ ('/public') }}/front-assets/images/icon/outlook.png" alt="Outlook"></span>Import your contacts from
				  Outlook</a>
			  </li>


			</ul>
			<p class="text-black">Import your friend list and find top <br class="d-none d-lg-block" /> Tradies recommended by your friends</p>
		  </div>
		</aside>
	  <main id="main" class="col-lg-8 pr-lg-5 order-lg-1">
		  <!--Tabs-->
		  <div class="nav-wrap my-4">
			<ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
			<li class="nav-item" {{ (!empty($input['step']) && $input['step']==1)?"id=current":'' }}>
				<a class="nav-link {{ (!empty($input['step']) && $input['step']==1) ? 'active' : '' }}" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
				  role="tab" aria-controls="pills-profile" aria-selected="true">Profile</a>
			  </li>
			  <li class="nav-item" {{ (!empty($input['step']) && $input['step']==2)?"id=current":'' }}>
				<a class="nav-link {{ (!empty($input['step']) && $input['step']==2) ? 'active' : '' }}" id="pills-contacts-tab" data-toggle="pill" href="#pills-contacts"
				  role="tab" aria-controls="pills-profile" aria-selected="true">Contacts</a>
			  </li>
			  <li class="nav-item" {{ (!empty($input['step']) && $input['step']==3)?"id=current":'' }}>
				<a class="nav-link {{ (!empty($input['step']) && $input['step']==3) ? 'active' : '' }}" id="pills-change-password-tab" data-toggle="pill" href="#pills-change-password"
				  role="tab" aria-controls="pills-change-password" aria-selected="false">Password</a>
			  </li>
			  <li class="nav-item" {{ (!empty($input['step']) && $input['step']==4)?"id=current":'' }}>
				<a class="nav-link {{ (!empty($input['step']) && $input['step']==4) ? 'active' : '' }}" id="pills-my-reviews-tab" data-toggle="pill" href="#pills-my-reviews" role="tab"
				  aria-controls="pills-my-reviews" aria-selected="false">Reviews</a>
			  </li>
			  <li class="nav-item" {{ (!empty($input['step']) && $input['step']==6)?"id=current":'' }}>
				<a class="nav-link {{ (!empty($input['step']) && $input['step']==6) ? 'active' : '' }}" id="pills-my-refferals-tab" data-toggle="pill" href="#pills-my-refferals" role="tab"
				  aria-controls="pills-my-refferals" aria-selected="false">Referral</a>
			  </li>
			  <li class="nav-item" {{ (!empty($input['step']) && $input['step']==5)?"id=current":'' }}>
				<a class="nav-link {{ (!empty($input['step']) && $input['step']==5) ? 'active' : '' }}" id="pills-help-tab" data-toggle="pill" href="#pills-help" role="tab"
				  aria-controls="pills-help" aria-selected="false">Help</a>
			  </li>
			</ul>
			<div class="tab-content" id="pills-tabContent">
			<div class="tab-pane fade {{ (empty($input['step']) || $input['step']==1) ? 'show' : '' }} {{ (empty($input['step']) || $input['step']==1) ? 'active' : '' }}" id="pills-profile" role="tabpanel"
				aria-labelledby="pills-profile-tab">
				<h5>Personal Information</h5>
				  <form action="{{ url('user/profile/update') }}" method="post" class="form form-layout2" id="personal_inform" enctype="multipart/form-data">
				  <div class="box bg-gray-light box-shadow p-md-4 my-4">
				  {{ csrf_field()}}
					<div class="upload-profile-image d-none">
					  <h6>Your profile picture</h6>
					  <div class="profile-image position-relative">
					  @if(!empty($getUser->user_image))
						   <img class="img-fluid remove-profile" src="{{ $getUser->user_image }}" alt="{{ !empty($getUser->name) ? $getUser->name : ''}}" id="profile_image">
					  @else
						  <img class="img-fluid" src="{{ ('/public') }}/front-assets/images/default-profile.jpg" alt="Avatar" id="profile_image">
					  @endif
					   <a href="javascript:;" data-business-id="{{ $getUser->id }}" class="btn-remove position-absolute edit_picture"><i class="fas fa-pencil-alt"></i></a>
					  </div>
					  <!-- <div class="file-upload mr-sm-2">-->

						<!--  <label class="btn btn-primary" for="upload">Upload a new profile picture</label>
					   </div> -->
					  @if(!empty($getUser->user_image))
					   <button type="button" class="btn btn-outline-secondary rounded remove_picture" data-id="{{ $getUser->id }}">Remove my picture for now</button>
				      @endif
					</div>
					<div class="form-group">
					  <label for="fullname">Full Name<span>*</span></label>
					  <input type="text" name="firstname" id="fullname" class="form-control @error('firstname') is-invalid @enderror"
						placeholder="Enter Full Name" value="{{ !empty($getUser->name) ? $getUser->name : ''}}" required>
					@error('firstname')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
					</div>
					<div class="form-group">
					  <label for="profile-text">Tagline</label>
					  <textarea name="profile_text" id="profile-text" class="form-control" placeholder="">{{ !empty($getUser->profile_text) ? $getUser->profile_text : ''}}</textarea>
					</div>
					<div class="form-group">
					  <label for="tel">Phone no.</label>
					  <div class="row">
					    <div class="col-2">
					        <input type="text" class="form-control" placeholder="+61" value="+61" disabled>
					    </div>
					    <div class="col-10">
					        <input type="text" name="phone_no" class="form-control" placeholder="Enter Mobile No" data-parsley-type="number" maxlength="10" value="{{ !empty($getUser->mobile_no) ? $getUser->mobile_no : ''}}">
					     </div>
					  </div>
					</div>
					<div class="form-group">
					  <label for="email">Email<span>*</span></label>
					  <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email Id" value="{{ !empty($getUser->email) ? $getUser->email : ''}}" disabled>
					</div>
					</div>
				    <h5>Address</h5>
					<div class="box bg-gray-light box-shadow p-md-4 my-4">
					<div class="form-group">
					  <label for="country">Country</label>
					  <span class="selectbox">
						<select name="country" id="country" class="form-control">
						  <option value="">Select Country</option>
						     <option value="14" selected>Australia</option>
						  </select>
					  </span>
					</div>
					<div class="form-group">
					  <label for="street-address">Street</label>
					  <input type="text" name="address" id="street-address" class="form-control"
						placeholder="Enter Your Street" value="{{ !empty($getUser->address) ? $getUser->address : ''}}">
					</div>
					<div class="form-group">
					  <label for="suburb">Suburb</label>
					  <input type="text" name="suburb" id="suburb" class="form-control"
						placeholder="Enter Your Suburb" value="{{ !empty($getUser->suburb) ? $getUser->suburb : ''}}">
					</div>
					<div class="form-group">
						<label for="state">State<span>*</span></label>
						<span class="selectbox2">
						<select class="form-control select2-show-search"  name="state" id="state" data-placeholder="Select State" required>
							@if(!empty($allstates))
								@foreach($allstates as $state)
								<option value="{{ $state->short_code }}" {{ (!empty($getUser->state) && ($getUser->state == $state->short_code)) ? 'selected' : ''}}>{{ $state->name }}</option>
								@endforeach
							@endif
						</select>
						</span>
					</div>
					<div class="form-group">
					  <label for="postcode">Post code</label>
					  <input type="text" name="postcode" id="postcode" class="form-control" placeholder="2445" data-parsley-type="number" minlength="4" maxlength="4" value="{{ !empty($getUser->postcode) ? $getUser->postcode : ''}}">
					</div>
					<button type="submit" class="btn btn-primary rounded">Save information</button>
				  </form>
				</div>
				</div>
			  <div class="tab-pane fade {{ (!empty($input['step']) || $input['step']==2) ? 'show' : '' }} {{ (!empty($input['step']) || $input['step']==2) ? 'active' : '' }}" id="pills-contacts" role="tabpanel"
				aria-labelledby="pills-contacts-tab">
				<form class="form" action="{{ url('dashboard') }}" method="get" id="get-form-contact">
					<div class="row">
						<div class="col-md-6">
						  <h5>My Contacts</h5>
						</div>
						<div class="col-md-6 text-right">
						   <label class="custom-control-label">Display All</label>
						   <input type="hidden" name="step" value="2">
						   <input type="checkbox" name="select_checkbox" id="select_checkbox" {{ !empty($input['select_checkbox']) ? 'checked' : '' }}>
						</div>
					</div>
				</form>
				<div class="box bg-gray-light box-shadow p-md-4 mt-4">
				 <div class="table-responsive">
					<table class="table display" id="datatable1" style="width:100%;">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Email Id</th>
							<th>Phone No</th>
							<th>Source </th>
						</tr>
					</thead>
					    <tbody>
						@if(!empty($getObjContact[0]))
					     @foreach($getObjContact as $contact)
							 @if($contact->is_google ==1)
								 @php $source = 'Google';@endphp
							 @elseif($contact->is_facebook ==1)
								 @php $source = 'Facebook';@endphp
							 @elseif($contact->is_outlook ==1)
								 @php $source = 'Outlook';@endphp
							 @else
								 @php $source = 'Pluckit';@endphp
							 @endif
						 <tr>
							 <td>{{ $loop->iteration}}</td>
							 <td>{{ $contact->name }}</td>
							 <td>{{ $contact->email }}</td>
							 <td>{{ $contact->number }}</td>
							 <td>{{ $source }}</td>
						 </tr>
						 @endforeach
						 @else
							<tr>
							 <td colspan="5" class="text-center">No Contact Found</td>

						 </tr>
						@endif
						</tbody>
					</table>
					<div class="ht-80 bd d-flex align-items-center justify-content-end">
						<ul class="pagination pagination-basic pagination-primary mg-r-10">
						@if(!empty($input['select_checkbox']))
							{{ $getObjContact->appends(['step' => 2,'select_checkbox' => 'on'])->links() }}
						@else
							{{ $getObjContact->appends(['step' => 2])->links() }}
						@endif
						</ul>
					</div>
			  </div>

				</div>
			  </div>
			  <div class="tab-pane fade {{ (!empty($input['step']) || $input['step']==3) ? 'show' : '' }} {{ (!empty($input['step']) || $input['step']==3) ? 'active' : '' }}" id="pills-change-password" role="tabpanel"
				aria-labelledby="pills-change-password-tab">
				<h5 class="mb-md-4">Change Password</h5>
				<div class="box bg-gray-light box-shadow p-md-4 mt-4">
				  <form action="{{ url('user/change-password')}}" class="form form-layout2" method="post" id="business_user_password">
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
			  <div class="tab-pane fade {{ (!empty($input['step']) || $input['step']==4) ? 'show' : '' }} {{ (!empty($input['step']) || $input['step']==4) ? 'active' : '' }}" id="pills-my-reviews" role="tabpanel"
				aria-labelledby="pills-my-reviews-tab">
				<!-- review-list -->
				<h5>Recent Reviews</h5>
				<div class="review-list mt-lg-4">
				@if(!empty($userReview[0]))
				@foreach($userReview as $review)
			       @php $getObjUser = \App\User::where('id',$review->user_id)->first(); @endphp
					  <div class="box bg-gray-light box-shadow">
						<div class="media">
						  <figure class="figure2 mr-3">
						 <img class="img-fluid" src="{{ (!empty($review->business_image))? $review->business_image: url('/public/front-assets/images/default-image.jpg') }}" alt="{{ $review->user_name }}">
						 </figure>
						  <div class="media-body">
							<h6>{{ $review->business_name }} <span class="review-date">{{ date("M d, Y",strtotime($review->review_time_created)) }}</span></h6>
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
						<div class="review-content">
						  <p>“{{ $review->review_text }}”</p>
						</div>
					  </div>
				  @endforeach
				  @else
					  <div class="text-center">No Review Found</div>
				 @endif

				</div>
				    <div class="ht-80 bd d-flex align-items-center justify-content-end">
						<ul class="pagination pagination-basic pagination-primary mg-r-10">
							{{ $userReview->appends(['step' => 4])->links() }}
						</ul>
					</div>
				<!-- /review-list -->
			  </div>
			  <div class="tab-pane fade {{ (!empty($input['step']) || $input['step']==6) ? 'show' : '' }} {{ (!empty($input['step']) || $input['step']==6) ? 'active' : '' }}" id="pills-my-refferals" role="tabpanel"
				aria-labelledby="pills-my-refferals-tab">
					<h5>My Referral</h5>
					<div class="row mt-5 clearfix">
						<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
								<div class="input-group fixWidth">
									@if(!empty(Auth::user()->referral_code))
										<input type="text" name="refferalCode" id="refferalCode" class="form-control" value="{{ url('business/user/signup/') }}?referral={{ Auth::user()->referral_code }}">
										<div class="input-group-append">
											<button class="btn btn-secondary copy-referall" id="copy-referall" type="button" data-href="{{ url('business/user/signup/') }}?referral={{ Auth::user()->referral_code }}" data-clipboard-text="{{ url('business/user/signup/') }}?referral={{ Auth::user()->referral_code }}">Copy Link</button>&nbsp;
											<button class="btn btn-danger social-share-referall" type="button" data-href="{{ url('business/user/signup/') }}?referral={{ Auth::user()->referral_code }}" data-business-id="{{ Auth::user()->referral_code }}">Share Link</button>
										</div>
									@else
										<a class="btn btn-success" href="{{ url('/dashboard?type=g') }}">Generate Referral Link</a>
									@endif
								</div>
							</div>
					</div>
					<div class="row mt-5 clearfix">
						<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
							<div class="refferal-box clearfix">
								Total Commission Earned
								<span>{{ (!empty($commission['totalCommision']))?$commission['totalCommision']:0 }}  AUD</span>
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
								<h5 class="mb-2" style="font-size: 1rem;">Business signed up using your referral [ {{ $commission['totalCount'] }} ]</h5>
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
{{ $commission['refferedUsers']->appends(array('step'=>'1'))->links() }}
							@endif
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
                    <input type="text" class="form-control" id="business_name" name="business_name" placeholder="Enter Your Business Name"  value="{{ (!empty($bankDetail->business_name))?$bankDetail->business_name:'' }}"/>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="abnNumber" class="col-sm-3 col-form-label">ABN Number <small>(If any)</small></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="abn_number" placeholder="Enter Your ABN Number"  value="{{ (!empty($bankDetail->abn_number))?$bankDetail->abn_number:'' }}"/>
                  </div>
                </div>
                <input type="submit" id="submit" name="submit" class="btn btn-danger btn-lg" value="SAVE" />
              </form>
            </div>
          </div>
				</div>
			  <div class="tab-pane fade {{ (!empty($input['step']) || $input['step']==5) ? 'show' : '' }} {{ (!empty($input['step']) || $input['step']==5) ? 'active' : '' }}" id="pills-help" role="tabpanel" aria-labelledby="pills-help-tab">
				<h5>Please Send Us Your Query</h5>
				<div class="box bg-gray-light box-shadow p-md-4 mt-4">
				  <form action="{{ url('user/sendquery') }}" method="post" class="form form-layout2 " id="form-user-query" enctype="multipart/form-data">
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
						<input type="file" id="file" name="attach_file" aria-label="File browser example" onChange="preview_file(event,'normal_help')" data-parsley-fileextension='doc,docx,pdf,txt'>
						<span class="file-custom"></span>

					  </label>
					  <small id="fileHelpBlock" class="form-text text-muted">
						Attach file doc,docx,pdf and txt only.
						</small>
					  <div class="text-info" id="normal_help">

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
		  <!--/Tabs-->
		</main>

	  </div>
	</div>
  </section>
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

								<div class="form-group">
								<div id="social-links">
									<ul>
										<li class="list-inline-item">
											<a id="facebook_share" data-href="https://www.facebook.com/sharer/sharer.php?u=" class="social-button btn btn-primary " title="Refer a business and earn 30% on each signup">
											<svg class="svg-inline--fa fa-facebook-f fa-w-9" aria-hidden="true" data-prefix="fab" data-icon="facebook-f" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 264 512" data-fa-i2svg=""><path fill="currentColor" d="M76.7 512V283H0v-91h76.7v-71.7C76.7 42.4 124.3 0 193.8 0c33.3 0 61.9 2.5 70.2 3.6V85h-48.2c-37.8 0-45.1 18-45.1 44.3V192H256l-11.7 91h-73.6v229"></path></svg><!-- <i class="fab fa-facebook-f"></i> -->
											</a>
										</li>
										<li class="list-inline-item">
											<a id="twitter_share" data-href="https://twitter.com/intent/tweet?text=Refer+a+business+and+earn+30%25+on+each+signup&url=" class="social-button btn btn-primary " title="Refer a business and earn 30% on each signup"><svg class="svg-inline--fa fa-twitter fa-w-16" aria-hidden="true" data-prefix="fab" data-icon="twitter" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path></svg><!-- <i class="fab fa-twitter"></i> -->
											</a>
										</li>
										<li class="list-inline-item">
											<a id="linkedin_share" data-href="http://www.linkedin.com/shareArticle?mini=true&title=Refer+a+business+and+earn+30%25+on+each+signup&url=" class="social-button btn btn-primary " title="Refer a business and earn 30% on each signup"><svg class="svg-inline--fa fa-linkedin fa-w-14" aria-hidden="true" data-prefix="fab" data-icon="linkedin" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z"></path></svg><!-- <i class="fab fa-linkedin"></i> -->
											</a>
										</li>
										<li class="list-inline-item">
											<a id="whatsApp_share" target="_blank" data-href="https://wa.me/?text=" class="social-button btn btn-primary " title="Refer a business and earn 30% on each signup"><svg class="svg-inline--fa fa-whatsapp fa-w-14" aria-hidden="true" data-prefix="fab" data-icon="whatsapp" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"></path></svg><!-- <i class="fab fa-whatsapp"></i> -->
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
</div>
  <div class="modal fade d-none" id="import-contact-view">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-wrap">
          <div class="modal-header border-0 align-items-center">
            <h2 class="modal-title">Import Contact? </h2>
            <a href="{{ route('ignore-google-import') }}"><button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button></a>
          </div>
          <div class="modal-body">
            <p class="lead">See who your contacts recommend</p>
		  </div>
		<div class="modal-footer">
		  <a href="{{ route('google.import') }}" class="btn btn-primary float-right">Continue</a>
		</div>

        </div>
      </div>
    </div>
  </div>
  <!---   First Step ---------->
  <div class="modal fade" id="new-user-first-step" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-wrap">
          <!-- Modal body -->
          <div class="modal-body">
              <h4>So we can find your relevant recommendations, complete the details below</h4>
              <div class="step-counter">
                <div class="step selected">1</div>
                <div class="step">2</div>
                <div class="step">3</div>
              </div>
			  <hr/>
			  @php $getUser = \App\User::where('id', auth()->user()->id)->first(); @endphp
			  @if(!empty($getUser) && ($getUser->fb_id != NULL) || ($getUser->google_id != NULL) || ($getUser->outlook_id != NULL))
				 @if(!empty($getUser) && !empty($getUser->fb_id))
					  <h5>Import your contacts from Facebook</h5>
				 @endif
				 @php
				  $configs = config('services.google');
				@endphp

				@if(!empty($getUser) && !empty($getUser->google_id))
				  @if((!empty($configs['client_id'])) && (!empty($configs['client_secret'])))
					  <h5> Import your contacts from Google</h5>
				  @endif
				@endif
				@if(!empty($getUser) && !empty($getUser->outlook_id))
					 <h5>Import your contacts from Outlook</h5>
				@endif

			  @else
		      <h5>Import Your Contacts</h5>
			  @endif
              <!-- Step first -->
              <div class="steps step-first">
                <ul class="list-unstyled import-contacts mb-3">

				@if(!empty($getUser) && ($getUser->fb_id != NULL) || ($getUser->google_id != NULL) || ($getUser->outlook_id != NULL))

				@if(!empty($getUser) && !empty($getUser->fb_id))
				  <li><a href="{{ route('fb.import') }}" class="facebook d-none"><span class="icon2">
				     <i class="fab fa-facebook-f"></i></span>
					 Import your contacts from Facebook</a>
				  </li>

				 @endif
				@php
				  $configs = config('services.google');
				@endphp

				@if(!empty($getUser) && !empty($getUser->google_id))
				@if((!empty($configs['client_id'])) && (!empty($configs['client_secret'])))
				  <li><a href="{{ route('google.import') }}" class="google d-none"><span class="icon2"><i class="fas fa-envelope"></i></span>Import your contacts from
						  Google</a>
			      </li>
				@endif
				@endif
				@if(!empty($getUser) && !empty($getUser->outlook_id))
				  <li><a href="{{ route('outlook.import') }}" class="outlook d-none"><span class="icon2"><img class="img-fluid"
							  src="{{ ('/public') }}/front-assets/images/icon/outlook.png" alt="Outlook"></span>Import your contacts from
						  Outlook</a>
				  </li>
				@endif
			@else
				<li><a href="{{ route('fb.import') }}" class="facebook"><span class="icon2">
				     <i class="fab fa-facebook-f"></i></span>
					 Import From Facebook</a>
				  </li>
				 @php
				  $configs = config('services.google');
				@endphp
				@if((!empty($configs['client_id'])) && (!empty($configs['client_secret'])))
				  <li><a href="{{ route('google.import') }}" class="google"><span class="icon2"><i class="fas fa-envelope"></i></span>Import From
						  Google</a>
			      </li>
				@endif
				<li><a href="{{ route('outlook.import') }}" class="outlook"><span class="icon2"><img class="img-fluid"
							  src="{{ ('/public') }}/front-assets/images/icon/outlook.png" alt="Outlook"></span>Import From
						  Outlook</a>
				  </li>

			@endif


			</ul>
                <form action="" class="form">
                  <div class="row mt-5">
				  <div class="col-6">
				  @if(!empty($getUser) && ($getUser->fb_id != NULL) || ($getUser->google_id != NULL) || ($getUser->outlook_id != NULL))
				       @if(!empty($getUser) && ((!empty($getUser->fb_id) || !empty($getUser->google_id) || !empty($getUser->outlook_id))))
				        <button type="button" class="btn btn-secondary latter_step_click">Later</button>
					   @endif
					  @else
                      <button type="button" class="btn btn-secondary first_step_click">Later</button>
				  @endif
                    </div>
                    <div class="col-6 text-right">
					 @if(!empty($getUser) && ($getUser->fb_id != NULL) || ($getUser->google_id != NULL) || ($getUser->outlook_id != NULL))
						 @if(!empty($getUser) && !empty($getUser->fb_id))
							 <a href="{{ route('fb.import') }}" class="btn btn-primary">Continue</a>
						 @endif
						 @php
						  $configs = config('services.google');
						 @endphp
						@if(!empty($getUser) && !empty($getUser->google_id))
				         @if((!empty($configs['client_id'])) && (!empty($configs['client_secret'])))
							  <a href="{{ route('google.import') }}" class="btn btn-primary">Continue</a>
						 @endif
						@endif
						@if(!empty($getUser) && !empty($getUser->outlook_id))
							<a href="{{ route('outlook.import') }}" class="btn btn-primary">Continue</a>
						@endif

				     @endif
                    </div>
                  </div>
                </form>
              </div>
              <!-- /Step first -->

           </div>
        <!-- /Modal body -->
        </div>
      </div>
    </div>
  </div>

  <!---   End First Step ------>
  <!---   Second Step ---------->
  <div class="modal fade" id="new-user-second-step" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-wrap">
          <!-- Modal body -->
          <div class="modal-body">
              <h4>So we can find your relevant recommendations, complete the details below</h4>
              <div class="step-counter">
                <div class="step selected">1</div>
                <div class="step selected">2</div>
                <div class="step">3</div>
              </div>
			  <hr/>
              <!-- Step second -->
              <div class="steps step-second">
                <h3>Update your profile <span>(Full name and Postcode)</span></h3>
                <form action="" class="form" id="get-form-second-step">
                  <div class="row">
                    <div class="col-sm-6 col-md-4 pr-sm-0">
                      <div class="form-group mb-md-0">
                        <input type="text" name="full_name" id="full_name" class="form-control" placeholder="Full name" value="{{ !empty($getUser->name) ? $getUser->name : ''  }}" required>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-4 pr-md-0">
                      <div class="form-group mb-md-0">
                        <input type="text" name="post_code" id="post_code" class="form-control" placeholder="Postcode" data-parsley-type="number" minlength="4" maxlength="4" value="{{ !empty($getUser->postcode) ? $getUser->postcode : ''  }}" required>
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-4 text-right">
                      <button type="button" class="btn btn-primary second_step_click">Continue</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- Step second -->

           </div>
        <!-- /Modal body -->
        </div>
      </div>
    </div>
  </div>

  <!---   End Second Step ------>
  <!---   Third Step ---------->
  <div class="modal fade" id="new-user-third-step" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-wrap">
		   <div class="modal-header border-0 align-items-right">
		   <h2></h2>
               <button type="button" class="btn btn-primary skip_servey">Skip</button>
           </div>
          <!-- Modal body -->
          <div class="modal-body">
              <h4>So we can find your relevant recommendations, complete the details below</h4>
              <div class="step-counter">
                <div class="step selected">1</div>
                <div class="step selected">2</div>
                <div class="step selected">3</div>
              </div>
			  <hr/>
              <!-- Step third -->
              <div class="steps step-third">
                <p>See who your friends recommend</p>
                <form action="{{ url('/search')}}" class="form"  method="get" id="get-form-third-step">
                  <div class="row">
                    <div class="col-md-9">
                      <div class="form-group mb-md-0">
                        <input type="text" name="cat" id="categories" class="form-control" placeholder="Search for an Electrician, a plumber, etc." required>
                      </div>
                    </div>
                    <div class="col-md-3 text-right">
					 <input type="hidden" name="near_postcode" id="near_postcode" value="50">
					  <input type="hidden" name="hid_type" id="hid_type_dash" value="{{ !empty($get['hid_type']) ? $get['hid_type'] : '' }}">
                      <input type="hidden" name="servey_type" id="servey_type" value="3">
					  <input type="hidden" name="parent_cat" id="parent_cat_dash" value="{{ !empty($get['parent_cat']) ? $get['parent_cat'] : '' }}">
			           <input type="hidden" name="catval" id="catval_dash" value="{{ !empty($get['catval']) ? $get['catval'] : '' }}">
					  <button type="submit" class="btn btn-primary submitFirstTimeLogin">Find</button>
                    </div>
                  </div>
                    <section class="search-waiting mt-1 d-none">
                        <div class="">
                            <p class=""><i class="fa fa-spinner fa-spin"></i>  Hold your horses, we’re just fetching the recommendations for you...
                            </p>
                        </div>
                    </section>
                </form>
              </div>
              <!-- Step third -->
           </div>
        <!-- /Modal body -->
        </div>
      </div>
    </div>
  </div>

  <!---   End Third Step ------>
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
<!--
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js" ></script>
-->
<script type="text/javascript">
	$(".commissionToggle").on('click', function(e){
    $('#pills-my-refferals-tab').trigger('click');
      $('html, body').animate({
        scrollTop: $("#pills-my-refferals").offset().top
      }, 500);
  });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.10/clipboard.min.js"></script>
<script type="text/javascript">
  // Tooltip
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
    <?php //$getNewUser = \App\User::where('new_user',0)->where('id', auth()->user()->id)->first();?>
	<?php
	  $getFirstStepServey = \App\User::where('servey_step',1)->where('id', auth()->user()->id)->first();
	  $getSecondStepServey = \App\User::where('servey_step',2)->where('id', auth()->user()->id)->first();
	  $getThirdStepServey = \App\User::where('servey_step',3)->where('id', auth()->user()->id)->first();
	?>
	$(".want_commision").click(function(){
		if($(this).prop('checked')){
			$(".wantComissionModal").click();
			$("#cm_id").val($(this).attr('data-id'));
			$(this).removeProp('checked');
		}
	});
$(document).ready(function() {
	$('#get-form-image').parsley();
	$('#get-form-second-step').parsley();
	$('#get-form-third-step').parsley();
	$('#get-form-image').parsley();
	$('.select2-show-search').select2({
	  minimumResultsForSearch: ''
	});

	$("#new-user-first-step,#new-user-second-step,#new-user-third-step").modal({
		show:false,
		backdrop:'static'
		});
	<?php if(!empty($getNewUser)) { ?>
	   $('#import-contact-view').modal('show', {backdrop: 'static', keyboard: false});
    <?php } ?>
	<?php if(!empty($getFirstStepServey)) { ?>
	   $('#new-user-first-step').modal('show', {backdrop: 'static', keyboard: false});
    <?php } ?>
	<?php if(!empty($getSecondStepServey)) { ?>
	   $('#new-user-second-step').modal('show', {backdrop: 'static', keyboard: false});
    <?php } ?>
	<?php if(!empty($getThirdStepServey)) { ?>
	   $('#new-user-third-step').modal('show', {backdrop: 'static', keyboard: false});
    <?php } ?>
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
		window.Parsley.addValidator('maxFileSize', {
		  validateString: function(_value, maxSize, parsleyInstance) {
			if (!window.FormData) {
			  alert('You are making all developpers in the world cringe. Upgrade your browser!');
			  return true;
			}
			var files = parsleyInstance.$element[0].files;
			return files.length != 1  || files[0].size <= maxSize * 1024;
		  },
		  requirementType: 'integer',
		  messages: {
			en: 'This file should not be larger than %s Kb'}
		});
   $('#personal_inform').parsley();
   $('#business_user_password').parsley();
   $('#form-user-query').parsley();
   $("#pills-tabContent .tab-pane").hide(); // Initially hide all content
   @if(empty($input['step']))
       $("#pills-tab li:first a").addClass("active"); // Activate first tab
       $("#pills-tabContent div:first").fadeIn(); // Show first tab content
   @else
       setTimeout(function(){
           $("#current a").click();
       },100);

   @endif
   $('#pills-tab li a').click(function(e) {
       e.preventDefault();
       if ($(this).attr("id") == "current"){ //detection for current tab
        return
       }
       else{
           $("#pills-tabContent .tab-pane").hide(); //Hide all content
           $("#pills-tab li").attr("id",""); //Reset id's
           $(this).parent().attr("id","current"); // Activate this
           $($(this).attr('href')).fadeIn(); // Show content for current tab
       }
   });
});
 $('.remove_picture').click(function(e) {
    e.preventDefault();
	var data_user_id = $(this).attr('data-id');
	var serviceUrl = BASE_URL + '/user/remove-picture';
	if(data_user_id != undefined){
		$('.remove_picture').attr('disabled','disabled');
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
				//$("#alert-success").removeClass('d-none');
				toastr.success(callback.message);
				location.reload();
				return false;
			  }
			 });
	}else{

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
		var imazeSize=(this.files[0].size);
        var img_ex = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        //alert(imazeSize);
        //validate file type
        if(!img_ex.exec(image)){
			toastr.error('Please upload only .jpg/.jpeg/.png/.gif file.');
            //alert('Please upload only .jpg/.jpeg/.png/.gif file.');
            $('#profileimage').val('');
            return false;
        }else if(Math.round(imazeSize / (1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024)) > 20){
			toastr.error('This file should not be larger than 20 Mb.');
			$('#profileimage').val('');
			return false;
		}else{
            $('.uploadProcess').show();
            $('#uploadForm').hide();
			var serviceUrl = BASE_URL + '/user/profile/image/update';
			var fd = new FormData();
			var files = $('#profileimage')[0].files[0];
			fd.append('profile_image',files);
			//var fileName = e.target.files[0].name;
			console.log(files);
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
            success: function(response){
				if(response != 0){
					$(".profile_loader").hide();
                    $("#profile_image").attr("src",response);
                }else{
                    toastr.error('file not uploaded');
                }
            },
        });
             //$("#get-form-image").submit();
        }
	   //$("#get-form-image").submit();
	 });
	 //After completion of image upload process
	function completeUpload(success, fileName) {
		if(success == 1){
			$('#profile_image').attr("src", "");
			$('#profile_image').attr("src", fileName);
			$('#profileimage').attr("value", fileName);
			$('.uploadProcess').hide();
		}else{
			$('.uploadProcess').hide();
			toastr.error('There was an error during file upload!');
		}
		return true;
	}


   $("#select_checkbox").change(function(){
	  $("#get-form-contact").submit();
	});
	function preview_file(event,id)
	{
	var fileName = event.target.files[0].name;
	var output = id;
	  output.html = fileName;
	  $('#'+output).html(fileName);
	}
	$(".latter_step_click").click(function(){
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}
		});
		var first_step = 1;
		var serviceDashboardUrl = BASE_URL + '/user/first-servey/update';
		var objData = {};
		var sendData = {};
		sendData = {
			first_step: first_step,
			};
			objData = {
		      url: serviceDashboardUrl,
			  type: 'post',
			  sendData: sendData
			 };
			send_ajax_request(objData, function (callback) {
			  if (callback.status == "200") {
				$('#new-user-first-step').modal('hide');
	            $('#new-user-second-step').modal('show', {backdrop: 'static', keyboard: false});
				return false;
			  }
			 });

	});
	$(".first_step_click").click(function(){
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}
		});
		var first_step = 1;
		var serviceDashboardUrl = BASE_URL + '/user/first-servey/update';
		var objData = {};
		var sendData = {};
		sendData = {
			first_step: first_step,
			};
			objData = {
		      url: serviceDashboardUrl,
			  type: 'post',
			  sendData: sendData
			 };
			send_ajax_request(objData, function (callback) {
			  if (callback.status == "200") {
				$('#new-user-first-step').modal('hide');
	            $('#new-user-second-step').modal('show', {backdrop: 'static', keyboard: false});
				return false;
			  }
			 });

	});
	$(".second_step_click").click(function(event){
		event.preventDefault();
		$('#new-user-first-step').modal('hide');
		var isValid = true;
		var serviceDashboardUrl = BASE_URL + '/user/second-servey/update';
		if($('#full_name').parsley().validate() !== true){
			return false;
		}else if($('#post_code').parsley().validate() !== true){
			return false;
		}else{
			$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}
		});
		var full_name = $('#full_name').val();
		var post_code = $('#post_code').val();
		var objData = {};
		var sendData = {};
		sendData = {
			full_name: full_name,
			post_code: post_code,
			};
			objData = {
		      url: serviceDashboardUrl,
			  type: 'post',
			  sendData: sendData
			 };
			send_ajax_request(objData, function (callback) {
			  if (callback.status == "200") {
				$('#new-user-second-step').modal('hide');
	            $('#new-user-third-step').modal('show', {backdrop: 'static', keyboard: false});
				return false;
			  }
			 });

      //$('#new-user-second-step').modal('hide');
	 //$('#new-user-third-step').modal('show', {backdrop: 'static'});
		}
	});
	$(".skip_servey").click(function(event){
		event.preventDefault();
		$(".skip_servey").html('Loading...');
		var serviceDashboardUrl = BASE_URL + '/user/skip-servey';
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}
		 });
		var objData = {};
		var sendData = {};
		sendData = {
			survey_step: 4,
			};
			objData = {
		      url: serviceDashboardUrl,
			  type: 'post',
			  sendData: sendData
			 };
			send_ajax_request(objData, function (callback) {
			  if (callback.status == "200") {
				$(".skip_servey").html('Skip');
				$('#new-user-third-step').modal('hide');
				 location.reload();
	            return false;
			  }else{
				  $(".skip_servey").html('Skip');
				  $('#new-user-third-step').modal('show', {backdrop: 'static', keyboard: false});
			  }
			 });

      });
	$(".submitFirstTimeLogin").click(function(){
        $(".search-waiting").removeClass('d-none');
    })
	$('.social-share-referall').on('click', function(){
		var dataHref = $(this).data('href');
		var facebook_share = $("#facebook_share").data('href');
		var twitter_share = $("#twitter_share").data('href');
		var linkedin_share = $("#linkedin_share").data('href');
		var whatsApp_share = $("#whatsApp_share").data('href');
		$("#facebook_share").attr('href',facebook_share+dataHref);
		$("#twitter_share").attr('href',twitter_share+dataHref);
		$("#linkedin_share").attr('href',linkedin_share+dataHref);
		$("#whatsApp_share").attr('href',whatsApp_share+dataHref);
		$('#shareReferralPopup').modal('show', {backdrop: 'static'});
        addReferralStat('share');
	});
    if(document.querySelector("#copy-referall")!==null){
        document.querySelector("#copy-referall").addEventListener("click",copyToClipboard);
    }
    function copyToClipboard(elem) {
        var copyText = document.getElementById("refferalCode");
        copyText.select();
        document.execCommand("copy");
        addReferralStat('copy');
        //alert('Link Copied');
    }
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
                user_type:'Normal'
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
<?php if(!empty($get['step'])) { ?>
            setTimeout(()=>{
                       console.log('ddd');
                $("#pills-my-refferals-tab").click();
            },500);
        <?php } ?>
</script>
@endsection
