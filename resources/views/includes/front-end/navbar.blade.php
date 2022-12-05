<!-- header -->
@guest
@php
$getCustomerReview = \App\BusinessListReview::where('status',1)->count();
$getFooterPages = \App\Page::where('show_on_footer',1)->get();
@endphp

<header id="header">
    <div class="container-fluid py-3">
      <div class="row justify-content-center align-items-center">
        <div class="logo col-5 col-sm-4 col-md-2">
          <a href="{{ url('/') }}"><img class="img-fluid" src="{{ ('/public') }}/front-assets/images/logo.png" alt="Pluckit"></a>
        </div>
        <div class="col-7 col-sm-8 col-md-10 header-right">
		  @if (session('status'))
        <div class="alert alert-success">
        {{ session('status') }}
        </div>
    @endif
        <!-- Mobile content -->
        <div class="mobile-content">
              <!-- Customer Recommendations -->
              <div class="customer-recommendations text-center">
                  <p><i class="fas fa-star mr-1"></i> {{ number_format($getCustomerReview) }} <br />Recommendations</p>
              </div>
              <!-- /Customer Recommendations -->
          </div>
          <!-- /Mobile content -->
        <!-- Search form -->
        <form class="form style2 mr-lg-2 mr-xl-3" method="get" action="{{ url('/search')}}" id="search_form_before_login" onsubmit="return false">
          <ul class="list-unstyled clearfix">
            <li class="categories"><input type="text" class="form-control" name="cat" id="categories-top" placeholder="Search for an Electrician, a Plumber, etc." value="{{ !empty($get['cat']) ? $get['cat'] : '' }}"></li>
            <li class="location"><input type="text" class="form-control" name="loc" id="locations-top" placeholder="Suburb or postcode" value="{{ !empty($get['loc']) ? $get['loc'] : '' }}"></li>
           <li  class="location-radius icon d-none">
                <select name="near_postcodes" id="near_postcode" class="form-control">
                  <option value="0" {{ (!empty($_GET['near_postcode']) && $_GET['near_postcode']==0) ? 'selected' : ''  }} >0 Km</option>
                  <option value="2" {{ (!empty($_GET['near_postcode']) && $_GET['near_postcode']==2) ? 'selected' : ''  }}>2 Km</option>
                  <option value="5" {{ (!empty($_GET['near_postcode']) && $_GET['near_postcode']==5) ? 'selected' : ''  }}>5 Km</option>
                  <option value="10" {{ (!empty($_GET['near_postcode']) && $_GET['near_postcode']==10) ? 'selected' : ''  }}>10 Km</option>
                  <option value="25" {{ (!empty($_GET['near_postcode']) && $_GET['near_postcode']==25) ? 'selected' : ''  }}>25 Km</option>
                  <option value="50" {{ (!empty($_GET['near_postcode']) && $_GET['near_postcode']==50) ? 'selected' : ''  }}>50 Km</option>
                  <option value="200" {{ (!empty($_GET['near_postcode']) && $_GET['near_postcode']==200) ? 'selected' : ''  }}>200 Km</option>
                </select>
            </li>
			<input type="hidden" name="near_postcode" id="near_postcode" value="50">

            <li>
              <input type="hidden" name="hid_type" id="hid_type_top" value="{{ !empty($get['hid_type']) ? $get['hid_type'] : '' }}">
              <input type="hidden" name="parent_cat" id="parent_cat_top" value="{{ !empty($get['parent_cat']) ? $get['parent_cat'] : '' }}">
			  <input type="hidden" name="catval" id="catval_top" value="{{ !empty($get['catval']) ? $get['catval'] : '' }}">
			  <button type="submit" class="btn btn-primary search_button_before_login">Recommendations</button>
            </li>
          </ul>
        </form>
        <!-- /Search form -->
        <a href="{{ url('leave-recommendation') }}" class="btn btn-primary btn-animate">Leave a Recommendation</a>
		&nbsp;
        <a href="{{ url('business/user/signup') }}" class="btn btn-primary btn-animate">Claim Your Business</a>
        <!-- Authentication Links -->
        <button type="button" class="btn btn-link btn-login" data-toggle="modal" data-target="#loginModal">My Account</button>
        @if (Route::has('register'))
            <!--<li class="nav-item">
                <a href="#" class="btn btn-link" data-toggle="modal" data-target="#loginModal">Register</a>
            </li>-->
        @endif
        <!-- /Authentication Links -->
        <!-- Customer Recommendations -->
          <div class="media text-sm-center text-primary">
            <i class="fas fa-star mr-2 align-self-center"></i>
            <div class="media-body">
              <p>{{ number_format($getCustomerReview) }} <br /> Customer <br />Recommendations</p>
            </div>
          </div>
        <!-- /Customer Recommendations -->
        <!-- Navigation on mobile -->
        <nav id="main-menu" class="ml-2 d-md-none">
          <button type="button" class="menu-btn">
              <span class="line"></span>
              <span class="line"></span>
              <span class="line"></span>
          </button>
          <ul>
		   @if(!empty($getFooterPages[0]))
              @foreach($getFooterPages as $footerPage)
					<li class="{{ (!empty($content['route'])&& ($content['route'] == $footerPage->alias)) ? 'current-page-item': '' }}"><a href="{{ ($footerPage->alias == 'home')? url('/'):url('page').'/'.$footerPage->alias}}">{{ $footerPage->page_name }}</a></li>
			  @endforeach
        <li class="{{ (!empty($content['route'])&& ($content['route'] == 'referral-program')) ? 'current-page-item': '' }}"><a href="{{ url('referral-program') }}">Referral Program</a></li>
        <li><a href="{{ url('business/user/signup') }}" >Claim Your Business</a></li>
		  @endif
              <li><a class="login-popup" data-toggle="modal" data-target="#loginModal" href="#">Create Account or Log In</a></li>
          </ul>
        </nav>
        <!-- /Navigation -->
    </div>
</div>
    </div>
  </header>
@else
@php
$getCustomerReview = \App\BusinessListReview::where('status',1)->count();
$getFooterPages = \App\Page::where('show_on_footer',1)->get();
@endphp
@if(Auth::user()->user_type == 1)
	@php $addClass = "style2";@endphp
@else
	@php $addClass = "";@endphp
@endif
    <header id="header" class="layout2">
      <div id="top-bar">
        <div class="container-fluid">
          <ul class="user-block text-md-right {{ $addClass }}">
            <li class="position-relative mr-md-5">
			  <button tupe="button" id="btnGroupDrop1"
                class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
				@if(Auth::user()->user_type == 1)
					@if(!empty(Auth::user()->user_image))
					<img class="img-fluid mr-2 icon" src="{{ Auth::user()->user_image }}" alt="{{ Auth::user()->name }}">
					@else
					<img class="img-fluid mr-2 icon" src="{{ ('/public') }}/front-assets/images/default-profile.jpg" alt="Avatar">
					@endif
					{{ Auth::user()->name }}
				@else
					@php $getBusiness = \App\BusinessListing::where('user_id',Auth::user()->id)->first();@endphp
				     @if(!empty($getBusiness->business_image))
						<img class="img-fluid mr-2 icon" src="{{ $getBusiness->business_image }}" alt="{{ $getBusiness->business_name }}">
						@else
						<img class="img-fluid mr-2 icon" src="{{ ('/public') }}/front-assets/images/default-profile.jpg" alt="Avatar">
						@endif
					{{ substr($getBusiness->business_name,0,20) }}

				@endif
				</button>
              <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
			  @if(Auth::user()->user_type == 1)
			   <a class="dropdown-item d-none" href="{{ url('/dashboard?step=4') }}">My Reviews</a>
		      @else
                <a class="dropdown-item d-none" href="{{ url('/business/user/dashboard?step=3') }}">My Reviews</a>
			   @endif
			    @if(Auth::user()->user_type == 1)
			   <a class="dropdown-item" href="{{ url('/dashboard') }}">Dashboard</a>
		      @else
				<a class="dropdown-item" href="{{ url('/business/user/dashboard') }}">Dashboard</a>
			  @endif
               @if(Auth::user()->user_type == 1)
			    <a class="dropdown-item" href="{{ url('/dashboard?step=5') }}">Help</a>
		      @else
                <a class="dropdown-item" href="{{ url('/business/user/dashboard?step=6') }}">Help</a>
			  @endif
			   @if(Auth::user()->user_type == 2)
			    <a class="dropdown-item" href="{{ url('/faq') }}">Faq</a>
		      @endif
			  <a class="dropdown-item" href="{{ url('logout') }}" >{{ __('Logout') }}</a>
			 </div>
            </li>
			 @if(Auth::user()->user_type == 1)
             <li><a href="{{ url('/business/user/signup') }}" class="btn btn-outline-primary">FOR BUSINESS</a></li>
		     @endif
          </ul>
        </div>
      </div>
      <div class="container-fluid py-3">
        <div class="row justify-content-center align-items-center">
          <div class="logo col-5 col-sm-4 col-md-2">
            <a href="{{ url('/') }}"><img class="img-fluid" src="{{ ('/public') }}/front-assets/images/logo.png" alt="Pluckit"></a>
          </div>
          <div class="col-7 col-sm-8 col-md-10 header-right">
          <!-- Mobile content -->
          <div class="mobile-content">
            <!-- Customer Recommendations -->
            <div class="customer-recommendations text-center">
                <p><i class="fas fa-star mr-1"></i> {{ number_format($getCustomerReview) }}<br /> Recommendations</p>
            </div>
            <!-- /Customer Recommendations -->
          </div>
          <!-- /Mobile content -->
          <!-- Search form -->
            <form class="form style2 mr-lg-2 mr-xl-3" method="get" action="{{ url('/search')}}" id="search_form_after_login" onsubmit="return false">
              <ul class="list-unstyled clearfix">
                <li class="categories"><input type="text" class="form-control" name="cat" id="categories-top" placeholder="Search for an Electrician, a Plumber, etc." value="{{ !empty($get['cat']) ? $get['cat'] : '' }}"></li>
                <li class="location"><input type="text" class="form-control" name="loc" id="locations-top" placeholder="Suburb or postcode" value="{{ !empty($get['loc']) ? $get['loc'] : '' }}">
                </li>

                <li>
				 <input type="hidden" name="near_postcode" id="near_postcode" value="50">
				<input type="hidden" name="hid_type" id="hid_type_top" value="{{ !empty($get['hid_type']) ? $get['hid_type'] : '' }}">
				<input type="hidden" name="parent_cat" id="parent_cat_top" value="{{ !empty($get['parent_cat']) ? $get['parent_cat'] : '' }}">
				<input type="hidden" name="catval" id="catval_top" value="{{ !empty($get['catval']) ? $get['catval'] : '' }}">
				<button type="submit" class="btn btn-primary search_button_after_login">Recommendations</button></li>
              </ul>
            </form>
            <!-- /Search form -->
			<a href="{{ url('leave-recommendation') }}" class="btn btn-primary btn-animate">Leave a Recommendation</a>
		&nbsp;
            <a href="{{ url('business/user/signup') }}" class="btn btn-primary btn-animate">Claim Your Business</a>
            <!-- Customer Recommendations -->
              <div class="media text-sm-center text-primary">
                <i class="fas fa-star mr-2 align-self-center"></i>
                <div class="media-body">
                  <p>{{ number_format($getCustomerReview) }} <br /> Customer <br />Recommendations</p>
                </div>
              </div>
            <!-- /Customer Recommendations -->
            <!-- Navigation on mobile -->
        <nav id="main-menu" class="ml-3 d-md-none">
          <button type="button" class="menu-btn">
              <span class="line"></span>
              <span class="line"></span>
              <span class="line"></span>
          </button>
          <ul>
		   @if(!empty($getFooterPages[0]))
              @foreach($getFooterPages as $footerPage)
					<li class="{{ (!empty($content['route'])&& ($content['route'] == $footerPage->alias)) ? 'current-page-item': '' }}"><a href="{{ ($footerPage->alias == 'home')? url('/'):url('page').'/'.$footerPage->alias}}">{{ $footerPage->page_name }}</a></li>
			  @endforeach
        <li class="{{ (!empty($content['route'])&& ($content['route'] == 'referral-program')) ? 'current-page-item': '' }}"><a href="{{ url('referral-program') }}">Referral Program</a></li>
		  @endif
              <li><a class="login-popup"  href="{{ url('logout') }}">{{ __('Logout') }}</a></li>
          </ul>
        </nav>
        <!-- /Navigation -->
          </div>
        </div>
      </div>
    </header>
	@endguest
    <!-- /header -->

