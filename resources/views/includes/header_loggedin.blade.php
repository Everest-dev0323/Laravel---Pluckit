<div class="topbar-main">
    <div class="container-fluid">
        <!-- Logo container-->
        <div class="logo">
            <!-- Text Logo -->
            <!--<a href="index.html" class="logo">-->
            <!--Annex-->
            <!--</a>-->
            <!-- Image Logo -->
            <a href="{{ url('admin/dashboard') }}" class="logo">
                <img src="{{ ('/public') }}/assets/images/logo.png" alt="" height="50" class="logo-large">
            </a>

        </div>
        <!-- End Logo container-->
        <div class="menu-extras topbar-custom">
            <ul class="list-inline float-right mb-0">

                <!-- User-->
                <li class="list-inline-item dropdown notification-list">
                    <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="false" aria-expanded="false">
					   @if(!empty((Auth::guard('admin')->user()->admin_image)))
                          <img src="{{ Auth::guard('admin')->user()->admin_image }}" alt="admin" class="rounded-circle">
					   @else
						  <img src="{{ ('/public') }}/assets/images/admin.jpg" alt="admin" class="rounded-circle">
					   @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h5>Welcome {{ (!empty(Auth::guard('admin')->user()->name) && (strlen(Auth::guard('admin')->user()->name) > 7)) ? substr(Auth::guard('admin')->user()->name,0,7).'...' : Auth::guard('admin')->user()->name }}
							</h5>
                        </div>

                        <!-- <div class="dropdown-divider"></div>-->
						@if(Auth::guard('admin')->user()->user_type !=1)
						  <a class="dropdown-item" href="{{ url('/admin/staff/profile') }}"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>
                          <a class="dropdown-item" href="{{ url('/admin/staff/change-password') }}"><i class="mdi mdi-lock-open-outline m-r-5 text-muted"></i> Password</a>
						@else
						  <a class="dropdown-item" href="{{ url('/admin/staff/adminprofile') }}"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>
                          <a class="dropdown-item" href="{{ url('/admin/change-password') }}"><i class="mdi mdi-lock-open-outline m-r-5 text-muted"></i> Password</a>
						@endif
                          <a class="dropdown-item" href="{{ url('/admin/logout') }}"><i class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>
                    </div>
                </li>
                <li class="menu-item list-inline-item">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle nav-link">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </li>

            </ul>
        </div>
        <!-- end menu-extras -->

        <div class="clearfix"></div>

    </div> <!-- end container -->
</div>
