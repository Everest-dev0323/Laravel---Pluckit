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
                            <li class="breadcrumb-item active">Api Settings</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Api Settings</h4>
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
		<form action="{{ url('/admin/api-settings/add') }}" method="post" enctype="multipart/form-data">
           {{ csrf_field()}}                 
        <div class="row">
            <div class="col-lg-6">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Google Api</h4>
                        <div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Google Client Id: </label>
                                        <input class="form-control" type="text" name="google_client_id"  placeholder="Enter Google Client Id" value="{{ !empty($objApiGoogleClientIdCredential->api_value) ? $objApiGoogleClientIdCredential->api_value : '' }}">
                                        
                                    </div>
                                </div>
                            </div>
							<div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Google Client Secret : </label>
                                        <input class="form-control" type="text" name="google_client_secret"  placeholder="Enter Google Client Secret	" value="{{ !empty($objApiGoogleClientSecretCredential->api_value) ? $objApiGoogleClientSecretCredential->api_value : '' }}" >
                                        
                                    </div>
                                </div>
								
                            </div>
							<div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Google Redirect Url: </label>
                                        <input class="form-control" type="url" name="google_redirect_url"  placeholder="Enter Google Redirect Url" value="{{ !empty($objApiGoogleRedirectCredential->api_value) ? $objApiGoogleRedirectCredential->api_value : '' }}">
                                        
                                    </div>
                                </div>
								
                            </div>
                            
                       
                    </div>
                </div>
            </div> <!-- end col -->
			<div class="col-lg-6">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Face Book Api</h4>
                      
                            <div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Facebook Client Id: </label>
                                        <input class="form-control" type="text" name="facebook_client_id"  placeholder="Enter Facebook Client Id" value="{{ !empty($objApiFacebookClientIdCredential->api_value) ? $objApiFacebookClientIdCredential->api_value : '' }}">
                                        
                                    </div>
                                </div>
                            </div>
							<div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Facebook Client Secret : </label>
                                        <input class="form-control" type="text" name="facebook_client_secret"  placeholder="Enter Facebook Client Secret	" value="{{ !empty($objApiFacebookClientSecretCredential->api_value) ? $objApiFacebookClientSecretCredential->api_value : '' }}" >
                                        
                                    </div>
                                </div>
								
                            </div>
							<div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Facebook Callback Url: </label>
                                        <input class="form-control" type="url" name="facebook_callback_url"  placeholder="Enter Facebook Callback Url" value="{{ !empty($objApiFacebookCallbackUrlCredential->api_value) ? $objApiFacebookCallbackUrlCredential->api_value : '' }}" >
                                        
                                    </div>
                                </div>
								
                            </div>
                            
                      
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
		<div class="row">
            <div class="col-lg-6">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Outlook Api</h4>
                         <div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                        <label>OAUTH App Id: </label>
                                        <input class="form-control" type="text" name="oauth_app_id"  placeholder="Enter OAUTH App Id" value="{{ !empty($objApiOauthIdCredential->api_value) ? $objApiOauthIdCredential->api_value : '' }}" >
                                        
                                    </div>
                                </div>
                            </div>
							<div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>OAUTH App Password : </label>
                                        <input class="form-control" type="text" name="oauth_app_password"  placeholder="Enter OAUTH App Password" value="{{ !empty($objApiOauthAppPasswordCredential->api_value) ? $objApiOauthAppPasswordCredential->api_value : '' }}" >
                                        
                                    </div>
                                </div>
								
                            </div>
							<div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>OAUTH Redirect Url: </label>
                                        <input class="form-control" type="url" name="oauth_redirect_url"  placeholder="Enter OAUTH Redirect Url" value="{{ !empty($objApiOauthRedirectUrlCredential->api_value) ? $objApiOauthRedirectUrlCredential->api_value : '' }}" >
                                        
                                    </div>
                                </div>
								
                            </div>
							<div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>OAUTH Scopes: </label>
                                        <input class="form-control" type="text" name="oauth_scopes"  placeholder="Enter OAUTH Scopes" value="{{ !empty($objApiOauthScopesCredential->api_value) ? $objApiOauthScopesCredential->api_value : '' }}" >
                                        
                                    </div>
                                </div>
								
                            </div>
							<div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>OAUTH Authority: </label>
                                        <input class="form-control" type="url" name="oauth_authority"  placeholder="Enter OAUTH Authority" value="{{ !empty($objApiOauthAuthorityCredential->api_value) ? $objApiOauthAuthorityCredential->api_value : '' }}" >
                                        
                                    </div>
                                </div>
								
                            </div>
							<div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>OAUTH Authorize Endpoint: </label>
                                        <input class="form-control" type="text" name="oauth_authorize_endpoint"  placeholder="Enter OAUTH Authorize Endpoint" value="{{ !empty($objApiOauthAuthorizeEndpointCredential->api_value) ? $objApiOauthAuthorizeEndpointCredential->api_value : '' }}">
                                        
                                    </div>
                                </div>
								
                            </div>
							<div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>OAUTH Token Endpoint: </label>
                                        <input class="form-control" type="text" name="oauth_token_endpoint"  placeholder="Enter OAUTH Token Endpoint" value="{{ !empty($objApiOauthTokenEndpointCredential->api_value) ? $objApiOauthTokenEndpointCredential->api_value : '' }}"  >
                                        
                                    </div>
                                </div>
								
                            </div>
                           
                        
                    </div>
                </div>
            </div> <!-- end col -->
			<div class="col-lg-6">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Yelp Api</h4>
                      
                            <div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Yelp Api Key: </label>
                                        <input class="form-control" type="text" name="yelp_api_key"  placeholder="Enter Yelp Api Key" value="{{ !empty($objApiYelpCredential->api_value) ? $objApiYelpCredential->api_value : '' }}">
                                        
                                    </div>
                                </div>
                            </div>
						
                            
                      
                    </div>
                </div>
				<div class="card m-b-30">
				  <div class="card-body">
                        <h4 class="mt-0 header-title">Stripe Api</h4>	
						   <div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Stripe Key: </label>
                                        <input class="form-control" type="text" name="stripe_key"  placeholder="Enter Stripe Key" value="{{ !empty($objApiStripeKeyCredential->api_value) ? $objApiStripeKeyCredential->api_value : '' }}">
                                        
                                    </div>
                                </div>
                            </div>
							<div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Stripe Secret: </label>
                                        <input class="form-control" type="text" name="stripe_secret"  placeholder="Enter Stripe Secret" value="{{ !empty($objApiStripeSecretCredential->api_value) ? $objApiStripeSecretCredential->api_value : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
                </div>
            </div> <!-- end col -->
			<div class="row">
				<div class="col-md-12">
				   <button class="btn btn-success wd-100" type="submit">Submit</button>
				</div><!-- col-4 -->
			</div>
			
			 
        </div>
		
		</form>
		<div class="clearfix">&nbsp;</div>
    </div>
</div>
@endsection
@section('extracontent')

@endsection