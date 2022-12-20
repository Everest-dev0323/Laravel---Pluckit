@extends('layouts.app')
@section('content')
<div class="wrapper">
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group pull-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Google Api Settings</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Google Api Settings</h4>
                </div>
            </div>
        </div>
		<div class="row">
			<div class="col-md-12">
			     @if(session()->get('success'))
					<div class="alert alert-success">
						{{ session()->get('success') }}  
					</div><br />
					@endif
					@if(session()->has('error'))
					<div class=" col-sm-6 alert alert-danger">
						<ul>
							<li>{{ session()->get('error') }}</li>
						</ul>
					</div>
					@endif
		 
			</div><!-- col-4 -->
		</div>
        <!-- end page title end breadcrumb -->
		<form action="{{ url('/admin/api-settings/google/add') }}" method="post" enctype="multipart/form-data">
           {{ csrf_field()}}                 
        <div class="row">
            <div class="col-lg-9">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Google Api</h4>
                        <div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Google Client Id: </label>
                                        <input class="form-control" type="text" name="google_client_id"  placeholder="Enter Google Client Id" value="{{ !empty($objApiGoogleClientIdCredential->api_value) ? $objApiGoogleClientIdCredential->api_value : '' }}" required>
                                        
                                    </div>
                                </div>
                            </div>
							<div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Google Client Secret : </label>
                                        <input class="form-control" type="text" name="google_client_secret"  placeholder="Enter Google Client Secret" value="{{ !empty($objApiGoogleClientSecretCredential->api_value) ? $objApiGoogleClientSecretCredential->api_value : '' }}" required>
                                        
                                    </div>
                                </div>
								
                            </div>
							<div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Google Redirect Url: </label>
                                        <input class="form-control" type="url" name="google_redirect_url"  placeholder="Enter Google Redirect Url" value="{{ !empty($objApiGoogleRedirectCredential->api_value) ? $objApiGoogleRedirectCredential->api_value : '' }}" required>
                                        
                                    </div>
                                </div>
								
                            </div>
							<div class="row">
								<div class="col-md-12">
								   <button class="btn btn-success wd-100" type="submit">Submit</button>
								</div>
						    </div>
                            
                       
                    </div>
                </div>
            </div> <!-- end col -->
			    
			
        </div>
		
			
			
			 
        </div>
		
		</form>
		<div class="clearfix">&nbsp;</div>
    </div>
</div>
@endsection
@section('extracontent')
<script>
$(document).ready(function () {
	$('form').parsley();
});
</script>
@endsection