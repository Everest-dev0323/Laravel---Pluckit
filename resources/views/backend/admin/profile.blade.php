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
                            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Edit Profile</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Edit Profile</h4>
                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Edit Profile</h4>
                        <form class="form" action="{{ url('/admin/staff/adminprofile/update') }}" method="post" id="profile" enctype="multipart/form-data">
                            {{ csrf_field()}}
                             @if(session()->get('success'))
                             <div class="alert alert-success">
                                 {{ session()->get('success') }}  
                             </div><br />
                             @endif
                             @if(session()->has('error'))
                             <div class=" col-sm-6 alert alert-success">
                                 <ul>
                                     <li>{{ session()->get('error') }}</li>
                                 </ul>
                             </div>@endif
                            <div class="row">        
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Name:</label>
                                        <input  name="name" type="text" value="{{ $objUser->name }}"  class="form-control @error('mobile_no') is-invalid @enderror" required placeholder="Enter name"/>
										@error('name')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email:</label>
                                        <input  name="email" id="email" type="text" class="form-control" disabled value="{{ $objUser->email }}"  required placeholder="Enter Email"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
							<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mobile No: <span class="tx-danger">*</span></label>
                                        <input class="form-control @error('mobile_no') is-invalid @enderror" type="text" name="mobile_no" data-parsley-type="number" maxlength="10"  placeholder="Enter Mobile No" required value="{{ !empty($objUser->mobile_no) ? $objUser->mobile_no : ''}}">
                                        @error('mobile_no')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Admin Image: </label>
                                        <input class="form-control" type="file" name="admin_image"  onChange="preview_image(event,'display_category_image')" data-parsley-fileextension="jpeg,png,jpg,gif,svg" data-parsley-max-file-size="20480">
										<small id="fileHelpBlock" class="form-text text-muted">
											 Attach file jpeg,png,jpg,gif,svg and image size is less than 20 mb only.
										</small>
										@if(!empty($objUser->admin_image))
										<img class="img-thumbnail" src="{{ $objUser->admin_image }}" id="display_category_image">
									    @else
                                        <img class="img-thumbnail" src="{{ url('/public/assets/images/default-410X150.jpg') }}" id="display_category_image">
									    @endif
									 </div>
									 
                                </div>
								
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" name="usertype" id="usertype" value="{{ $objUser->usertype }}">
                                    <a href="{{ url('/admin/dashboard') }}" class="btn btn-secondary wd-100">Back</a>
                                    <button class="btn btn-success wd-100" type="submit">Update</button>
                                </div><!-- col-4 -->
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
</div>
@endsection
@section('extracontent')
<script type="text/javascript">
    $(document).ready(function () {
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
        $('#profile').parsley();
    });
</script>
@endsection