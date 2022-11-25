@extends('layouts.front-end.app')
@section('content')
@php $input['step'] = !empty($input['step']) ? $input['step'] : '';@endphp
<!-- Content -->
<div id="content">
  <section class="section">
	<div class="container">
	  <!-- Client Profile -->
	  <div class="row client-profile pb-4 d-md-flex justify-content-between align-items-center">
		  <div class="col-sm-6 col-lg-8 pr-lg-5">
			<div class="column">
			<div class="media mb-3">
				<div class="profile-pic position-relative">
					 <input id="profileimage" type="file" name="profile_image" class="inputfile"  style="display:none">
					 <a href="javascript:;" data-id="{{ $getUser->id }}" class="btn btn-dark btn-edit position-absolute edit_picture" title="Edit Profile Image"><i class="fas fa-pencil-alt"></i></a>
					<img class="img-fluid" src="{{ !empty($getUser->user_image) ? $getUser->user_image : asset('public/front-assets/images/default-profile.jpg') }}" alt="{{ !empty(Auth::user()->name) ? Auth::user()->name : 'Avatar' }}" id="profile_image">
					<div class="title">
					<small id="fileHelpBlock" class="form-text">
						  Upload only jpeg, png, jpg, gif, svg file.
						</small>
					</div>
					<div class="overlay-img horizontal-center profile_loader" style="display:none;">
					   <i class="fas fa-sync-alt fa-spin position-relative"></i>
					</div>
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
		<div class="col-sm-6 col-lg-4 pl-lg-5 text-sm-right">
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
				  role="tab" aria-controls="pills-profile" aria-selected="true">My Profile</a>
			  </li>
			  <li class="nav-item" {{ (!empty($input['step']) && $input['step']==2)?"id=current":'' }}>
				<a class="nav-link {{ (!empty($input['step']) && $input['step']==2) ? 'active' : '' }}" id="pills-contacts-tab" data-toggle="pill" href="#pills-contacts"
				  role="tab" aria-controls="pills-profile" aria-selected="true">My Contacts</a>
			  </li>
			  <li class="nav-item" {{ (!empty($input['step']) && $input['step']==3)?"id=current":'' }}>
				<a class="nav-link {{ (!empty($input['step']) && $input['step']==3) ? 'active' : '' }}" id="pills-change-password-tab" data-toggle="pill" href="#pills-change-password"
				  role="tab" aria-controls="pills-change-password" aria-selected="false">Change Password</a>
			  </li>
			  <li class="nav-item" {{ (!empty($input['step']) && $input['step']==4)?"id=current":'' }}>
				<a class="nav-link {{ (!empty($input['step']) && $input['step']==4) ? 'active' : '' }}" id="pills-my-reviews-tab" data-toggle="pill" href="#pills-my-reviews" role="tab"
				  aria-controls="pills-my-reviews" aria-selected="false">My Reviews</a>
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
						  @if(!empty($allCountries[0]))
							  @foreach($allCountries as $country)
						       @if(!empty($getUser->country) &&($getUser->country == $country->id))
								   @php $selected = 'selected';@endphp
							   @else
								   @if($country->id == 14)
									   @php $selected = 'selected';@endphp
								   @else
									   @php $selected = '';@endphp
								   @endif
							   @endif

						        <option value="{{ $country->id }}" {{ $selected  }}>{{ $country->name }}</option>
							  @endforeach
					      @endif
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
					  <label for="suburb">State</label>
					  <input type="text" name="state" id="state" class="form-control"
						placeholder="Enter Your State" value="{{ !empty($getUser->state) ? $getUser->state : ''}}">
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
@endsection
@section('extracontent')
<script type="text/javascript" src="{{ ('/public') }}/front-assets/lib/parsleyjs/parsley.min.js"></script>
<!--
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js" ></script>
-->
<script>
    <?php //$getNewUser = \App\User::where('new_user',0)->where('id', auth()->user()->id)->first();?>
	<?php
	  $getFirstStepServey = \App\User::where('servey_step',1)->where('id', auth()->user()->id)->first();
	  $getSecondStepServey = \App\User::where('servey_step',2)->where('id', auth()->user()->id)->first();
	  $getThirdStepServey = \App\User::where('servey_step',3)->where('id', auth()->user()->id)->first();
	?>
$(document).ready(function() {
	$('#get-form-image').parsley();
	$('#get-form-second-step').parsley();
	$('#get-form-third-step').parsley();
	$('#get-form-image').parsley();

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

</script>
@endsection
