@extends('layouts.front-end.app')
@section('content')
<!-- Content -->
    <div id="content" class="pt-0">
      <!-- Signup -->
      <section class="section signup-content">
        <div class="container">
		<div class="row justify-content-center align-items-center">
		  <div class="col-lg-8">
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
		  </div>
          <div class="row justify-content-center align-items-center">
            <div class="col-lg-8">
              <div class="box bg-gray-light box-shadow p-md-4">
                <h3 class="mb-md-4">Reset Password</h3>
				  <form action="{{ url('user/reset-password/update') }}" method="post" class="form" id="reset-passord-form">
				   @csrf
					<div class="form-group">
					  <input type="email" name="email" class="form-control" placeholder="Email" value="{{ !empty($verifyUser->email) ? $verifyUser->email : ''}}" required disabled>
					</div>
					<div class="form-group">
					  <input type="password" name="password" id="password" class="form-control" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" placeholder="New Password" data-parsley-pattern-message="Should be combination between characters, upercase, lower case and numbers, minimum 8 characters" required>
					</div>
					<div class="form-group">
					  <input type="password" name="confirm_password" data-parsley-equalto="#password" class="form-control" placeholder="Re-type New Password" required>
					</div>
					<div class="form-group text-right">
					  <input type="hidden" name="hid_user_id" id="hid_user_id" value="{{ !empty($verifyUser->id) ? $verifyUser->id : ''}}">
					  <button type="submit" class="btn btn-primary">Save</button>
					</div>
				  </form>
            </div>
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
<script>
$(document).ready(function() {
   $('#reset-passord-form').parsley();
 });
</script>
@endsection
