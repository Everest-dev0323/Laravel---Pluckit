<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="_token" content="{{csrf_token()}}">
         <script>
             var BASE_URL="{{ url('/') }}";
         </script>
         @include('includes.header')
    </head>

    <body>

        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>
        @if(!empty(Auth::guard('admin')->user()))
	     <header id="topnav">
			<!-- Navigation Bar-->
			@include('includes.header_loggedin')
			 <!-- End Navigation Bar-->
			@include('includes.sidebar')
		</header>
		@endif
        @yield('content')



        @include('includes.footer')
        @yield('extracontent')


    </body>
</html>