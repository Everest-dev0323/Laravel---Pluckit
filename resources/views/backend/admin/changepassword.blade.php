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
                            <li class="breadcrumb-item"><a href="{{url('restaurant/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Change Password</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Change Password</h4>
                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Change Password</h4>
 

                        <form action="{{ url('/admin/changepassword') }}" method="post" id="ticket">
                            {{ csrf_field()}}
                            @if(session()->get('success'))
                             <div class="alert alert-success">
                                 {{ session()->get('success') }}  
                             </div><br />
                             @endif
                             @if(session()->has('error'))
                             <div class="alert alert-danger">
                                 <ul>
                                     <li>{{ session()->get('error') }}</li>
                                 </ul>
                             </div>@endif
                             @if ($errors->any())
                                <div class="alert alert-danger">
                                   @foreach ($errors->all() as $error)
                                           {{ $error }}
                                    @endforeach
                                   
                                </div>
                            @endif
                            <div class="row">                             
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Password: <span class="tx-danger">*</span></label>
                                        <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="password"  placeholder="Enter Password" required autocomplete="new-password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" data-parsley-pattern-message="Should be combination between characters, upercase, lower case and numbers, minimum 8 characters">
                                        <small id="fileHelpBlock" class="form-text text-muted">
                                            Should be combination between characters, upercase, lower case and numbers, minimum 8 characters
										</small>
                                        @error('password')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
                                    </div>
                                </div>
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Confirm Password: <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="password" name="password_confirmation" id="password-confirm" data-parsley-equalto="#password"  placeholder="Enter Confirm Password" required autocomplete="new-password">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
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
        $('form').parsley();
    });
</script>
@endsection