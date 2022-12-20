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
                            <li class="breadcrumb-item active">Outlook Api Settings</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Outlook Api Settings</h4>
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
		<form action="{{ url('/admin/api-settings/outlook/add') }}" method="post" enctype="multipart/form-data">
           {{ csrf_field()}}                 
        <div class="row">
            <div class="col-lg-9">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Outlook Api</h4>
                         <div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                        <label>OAUTH App Id: </label>
                                        <input class="form-control" type="text" name="oauth_app_id"  placeholder="Enter OAUTH App Id" value="{{ !empty($objApiOauthIdCredential->api_value) ? $objApiOauthIdCredential->api_value : '' }}" required>
                                        
                                    </div>
                                </div>
                            </div>
							<div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>OAUTH App Password : </label>
                                        <input class="form-control" type="text" name="oauth_app_password"  placeholder="Enter OAUTH App Password" value="{{ !empty($objApiOauthAppPasswordCredential->api_value) ? $objApiOauthAppPasswordCredential->api_value : '' }}" required>
                                        
                                    </div>
                                </div>
								
                            </div>
							<div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>OAUTH Redirect Url: </label>
                                        <input class="form-control" type="url" name="oauth_redirect_url"  placeholder="Enter OAUTH Redirect Url" value="{{ !empty($objApiOauthRedirectUrlCredential->api_value) ? $objApiOauthRedirectUrlCredential->api_value : '' }}" required>
                                        
                                    </div>
                                </div>
								
                            </div>
							<div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>OAUTH Scopes: </label>
                                        <input class="form-control" type="text" name="oauth_scopes"  placeholder="Enter OAUTH Scopes" value="{{ !empty($objApiOauthScopesCredential->api_value) ? $objApiOauthScopesCredential->api_value : '' }}" required>
                                        
                                    </div>
                                </div>
								
                            </div>
							<div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>OAUTH Authority: </label>
                                        <input class="form-control" type="url" name="oauth_authority"  placeholder="Enter OAUTH Authority" value="{{ !empty($objApiOauthAuthorityCredential->api_value) ? $objApiOauthAuthorityCredential->api_value : '' }}" required>
                                        
                                    </div>
                                </div>
								
                            </div>
							<div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>OAUTH Authorize Endpoint: </label>
                                        <input class="form-control" type="text" name="oauth_authorize_endpoint"  placeholder="Enter OAUTH Authorize Endpoint" value="{{ !empty($objApiOauthAuthorizeEndpointCredential->api_value) ? $objApiOauthAuthorizeEndpointCredential->api_value : '' }}" required>
                                        
                                    </div>
                                </div>
								
                            </div>
							<div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>OAUTH Token Endpoint: </label>
                                        <input class="form-control" type="text" name="oauth_token_endpoint"  placeholder="Enter OAUTH Token Endpoint" value="{{ !empty($objApiOauthTokenEndpointCredential->api_value) ? $objApiOauthTokenEndpointCredential->api_value : '' }}"  required>
                                        
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