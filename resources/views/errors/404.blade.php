@extends('layouts.front-end.app')
@section('content')
<div id="content">
  <section class="section box-shadow border-top">
  <div class="container text-center">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-8">
                <div class="wrap-error">
                    <div class="header-error">
                    <figure class="figure">
                       <img class="img-fluid" src="{{ ('/public') }}/front-assets/images/oops-error.png" alt="404 Error">
                    </figure>
                    <h1><strong>404 Page Not Found</strong></h1>
                    <!-- <h4>Sorry we can't find the page you're looking for.</h4>                      -->
                   <h4>This is not the page you were looking for.</h4>
                    <p>Sorry we've led you astry, now let's get you back on course.</p>
                    </div><!-- /.header-error -->
                    <br>
                    <div class="content-error">
                        <h5>The page you requested can not be found. It may have expired or been removed.</h5>
                        <p>If you reached this error page by typing and address into your web browser, <br />please verify that the spelling and capitalization are correct and try search again.</p>

<p>You may wish to go back to the <a href="{{ url('/') }}">Home</a></p>
                    </div><!-- /.content-error -->
                </div><!-- /.wrap-error -->
            </div><!-- /.col-md-8 -->
       </div><!-- /.row -->
    </div>
  </section>
</div>
@endsection
