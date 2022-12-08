@extends('layouts.front-end.app')
@section('content')
<!-- Content -->
    <div class="slide-bg clearfix">
            <h1>Affiliates</h1>
            <p>Spread the word about Pluckit with our affiliate program.<br />Refer Tradies & earn lifetime commission. Simple!</p>
        </div>

        <section>
            <div class="container">
                <div class="row clearfix">
                    <div class="col-12">
                        <div class="head-title clearfix">Become an affiliate and start lining                           your pocket</div>
                    </div>
                    <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                        <div class="features clearfix">
                            <img src="{{ url('public/front-assets') }}/images/pay-outs.png" alt="Images goes here" />
                            <p>
                                <span>Up to 30% Pay-Outs</span>
                                Get up to 30% of lifetime fees for any Tradie business that you refer onto Pluckit.
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                        <div class="features clearfix">
                            <img src="{{ url('public/front-assets') }}/images/simple-reporting.png" alt="Images goes here" />
                            <p>
                                <span>Simple Reporting</span>
                                Easy reporting. Login to view your successfully referred Tradies & track all of your commissions.
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                        <div class="features clearfix">
                            <img src="{{ url('public/front-assets') }}/images/superfast-payouts.png" alt="Images goes here" />
                            <p>
                                <span>Fast Pay-Outs</span>
                                Payouts are quickly deposited into your bank account at the start of each quarter.
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                      <center><a href="https://dev.pluckit.com.au/user/signup?type=t" class="btn btn-primary btn-lg br-13 mt-4">Join Today</a></center>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-f9f8f8 clearfix">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-12">
                        <div class="head-title clearfix">How to Earn<span>Become an affiliate and start earning</span></div>
                    </div>
                    <div class="col-12">
                        <ul class="steps clearfix">
                            <li>
                                <img src="{{ url('public/front-assets') }}/images/sign-up.jpg" alt="Image goes here" />
                                <p>
                                    <span>Sign-Up</span>
                                    Fill out some simple details to create a Pluckit account.
                                </p>
                            </li>
                            <li>
                                <img src="{{ url('public/front-assets') }}/images/activate.jpg" alt="Image goes here" />
                                <p>
                                    <span>Confirm Identity</span>
                                    We will contact you to verify your profile.
                                </p>
                            </li>
                            <li>
                                <img src="{{ url('public/front-assets') }}/images/share.jpg" alt="Image goes here" />
                                <p>
                                    <span>Share</span>
                                    Promote and share Pluckit material and earn commission on each new business who signs up.
                                </p>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12">
                        <div class="note clearfix"><span>*Bonus</span> - As an affiliate, you unlock 50% off for Tradies to sign up on Pluckit. It’s hard for them to say no to that!</div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="row clearfix">
                    <div class="col-12">
                        <div class="theme-bg clearfix">
                            <h2>Breakdown of Commission Tier Earnings</h2>
                            <div class="row clearfix">
                                <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                    <div class="white-bg clearfix">
                                        <img src="{{ url('public/front-assets') }}/images/bronze.png" alt="Image goes here" />
                                        <span>Bronze</span>
                                        1-15 Tradies Signed up <br/><span class="bold">20%</span> Commission.
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                    <div class="white-bg clearfix">
                                        <img src="{{ url('public/front-assets') }}/images/silver.png" alt="Image goes here" />
                                        <span>Silver</span>
                                        15-30 Tradies Signed up <br/><span class="bold">25%</span> Commission.
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                    <div class="white-bg clearfix">
                                        <img src="{{ url('public/front-assets') }}/images/gold.png" alt="Image goes here" />
                                        <span>Gold</span>
                                        30+ Tradies Signed up<br/><span class="bold">30%</span> Commission.
                                    </div>
                                </div>
                            </div>
                            <p>Join today and don’t miss out on Australia’s most exciting affiliate program</p>
                            <center><div class="theme-btn mt-4 clearfix"><a href="https://dev.pluckit.com.au/user/signup?type=e">Start Earning Lifetime Commission</a></div></center>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="row clearfix">
                    <div class="col-12">
                        <div class="head-title clearfix">Frequently Asked Questions</div>
                    </div>
                    <div class="col-12">
                        <div id="accordionExample" class="accordion shadow">
                            <!-- Accordion item 1 -->
                            <div class="card">
                                <div id="headingOne" class="card-header bg-white shadow-sm border-0">
                                    <h4 class="mb-0">
                                        <button type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="btn btn-link collapsible-link br-0">How do I learn more about Pluckit to refer it to Tradie businesses?</button>
                                    </h4>
                                </div>
                                <div id="collapseOne" aria-labelledby="headingOne" data-parent="#accordionExample" class="collapse show">
                                    <div class="card-body p-5">
                                        <p class="font-weight-light m-0">You’ll be sent some material to help you become more confident in referring Pluckit and how it works in more depth. Super easy. You’ll also be contacted by our team to talk through any questions you may have.</p>
                                    </div>
                                </div>
                            </div><!-- End -->
                            <!-- Accordion item 2 -->
                            <div class="card">
                                <div id="headingTwo" class="card-header bg-white shadow-sm border-0">
                                    <h4 class="mb-0">
                                        <button type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="btn btn-link collapsed collapsible-link br-0">How often will my commission be paid?</button>
                                    </h4>
                                </div>
                                <div id="collapseTwo" aria-labelledby="headingTwo" data-parent="#accordionExample" class="collapse">
                                    <div class="card-body p-5">
                                        <p class="font-weight-light m-0">At the start of every quarter, this will be paid into your allocated bank account.</p>
                                    </div>
                                </div>
                            </div><!-- End -->
                            <!-- Accordion item 3 -->
                            <div class="card">
                                <div id="headingThree" class="card-header bg-white shadow-sm border-0">
                                    <h4 class="mb-0">
                                        <button type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" class="btn btn-link collapsed collapsible-link br-0">When I refer someone, for how long will I receive commission for?</button>
                                    </h4>
                                </div>
                                <div id="collapseThree" aria-labelledby="headingThree" data-parent="#accordionExample" class="collapse">
                                    <div class="card-body p-5">
                                        <p class="font-weight-light m-0">As a Pluckit affiliate, you will receive commission for as long as the business you referred is using Pluckit.</p>
                                    </div>
                                </div>
                            </div><!-- End -->
                            <div class="card">
                                <div id="headingFour" class="card-header bg-white shadow-sm border-0">
                                    <h4 class="mb-0">
                                        <button type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour" class="btn btn-link collapsed collapsible-link br-0">How is the commission calculated?</button>
                                    </h4>
                                </div>
                                <div id="collapseFour" aria-labelledby="headingFour" data-parent="#accordionExample" class="collapse">
                                    <div class="card-body p-5">
                                        <p class="font-weight-light m-0">The lifetime commission that you earn on a reoccurring basis is based on the very first subscription payment that the Tradie registers for. This includes promotional and discounted prices. You’ll then be paid commission every time the Tradie renews their subscription based on that original sign up price.</p>
                                    </div>
                                </div>
                            </div><!-- End -->
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-f9f8f8 clearfix">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-12">
                        <div class="head-title clearfix">Testimonials<span class="line"></span></div>
                    </div>
                    <div class="col-12">
                        <div id="testimonial" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#testimonial" data-slide-to="0" class="active"></li>
                                <li data-target="#testimonial" data-slide-to="1"></li>
                                <li data-target="#testimonial" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <p>Pluckits affiliate program has been a great fit for my lifestyle. It’s flexible, easy to refer tradies and the commissions are great!</p>
                                    <h4>Monique</h4>
                                </div>
                                <div class="carousel-item">
                                    <p>All Tradie business owners that I know, I have referred onto Pluckit. Great platform!</p>
                                    <h4>Luke</h4>
                                </div>
                                <div class="carousel-item">
                                    <p>Super easy to use. Great online platform which Tradies seem to love. Referring is easy and commissions have been a great extra source of income.</p>
                                    <h4>Mike</h4>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#testimonial" role="button" data-slide="prev">
                                <span class="fa fa-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#testimonial" role="button" data-slide="next">
                                <span class="fa fa-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-eb503e clearfix">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-12">
                        <h3>Looking to get a job done?</h3>
                        <center><div class="theme-btn mt-4 clearfix chk_friend_suggest" data-user-id="{{ ($getUser==0) ? 0 : $getUser }}">
                            @if($getUser)
                            <a href="{{ url('/') }}">Check who your friends suggest <i class="fa fa-arrow-circle-right"></i></a>
                            @else
                            <a href="javascript:;">Check who your friends suggest <i class="fa fa-arrow-circle-right"></i></a>
                            @endif
                        </div></center>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /content -->
@endsection
@section('extracontent')
<link rel="stylesheet" type="text/css" href="{{ ('/public') }}/front-assets/stylesheets/style.css" />
<script>
     $("body").on('click', '.chk_friend_suggest', function () {
	 var data_user_id = $(this).attr('data-user-id');
	 if(data_user_id == 0){
	    $('.btn-login').click();
	 }else{
	    $('html, body').animate({
			scrollTop: $("#banner").offset().top
		}, 2000);
	}
 });
</script>
@endsection
