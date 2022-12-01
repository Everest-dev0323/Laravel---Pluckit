@extends('layouts.front-end.app')
@section('content')

<div id="content" class="pt-0">
  <!-- Signup -->
	<section class="section checkout border-top">
		<div class="container">
		<h3>Pay for plan</h3>
			<div class="row">
				<div class="col-md-12">
				  @if(session()->get('success'))
					<div class="alert alert-success">
						{{ session()->get('success') }}
					</div>
				  <br />
					@endif
					@if ($errors->any())
						<div class="alert alert-danger">
						<ul>
						@foreach ($errors->all() as $error)
						 <li>{{ $error }}</li>
						@endforeach
						</ul>
					</div>
					@endif
				</div>
			</div>
			<div class="row">

			@php
			$permonth= "";
			if($allPlans['recurring']['interval_count'] == 1){
				$permonth =$allPlans['recurring']['interval_count'].'month';
			}else{
				$permonth =$allPlans['recurring']['interval_count'].'months';
			}

			@endphp

				<div class="col-lg-6">
					<div class="payments-container">
						<input type="hidden" name="user_id" value="{{ $user_id }}">
						<label class="plan-field bg-gray-light">
						<span class="checkmark">
							<input type="radio" name="pricing" value="price_1HEUyjH2CH1zy3TlJWJy2888" checked="">
							<span class="plan-radio-button"></span>
						</span>
							<span class="planInfo">
							  <span class="plan-title">{{ $productDetails->name }}</span>
							  <span class="plan-desc">{{ $productDetails->description }}</span>
							</span>
							@php $price_value = number_format($allPlans->unit_amount/100,2);  @endphp
							<span class="plan-price">${{ (!empty($userData['refer_referral_code']))?$price_value/2:$price_value }} /{{ $permonth }}</span>
						</label>
					</div>

				</div>
				<div class="col-lg-6 form">
						<div class="cell example example1" id="example-1">
							<fieldset class="p-3">
								<div class="form-group">
									<label for="example1-name">Name</label>
									<input class="form-control" id="card-holder-name" value="{{ $userData->name }} {{ $userData->lastname }}" type="text" >
								</div>
								<div class="form-group">
								  <label for="example1-email" data-tid="elements_examples.form.email_label">Email</label>
								  <input class="form-control" id="user_email" value="{{ $userData->email }}" data-tid="elements_examples.form.email_placeholder" type="email" placeholder="janedoe@gmail.com" required>
								</div>
							</fieldset>
							<input id="subscription_plans" value="{{ $availablePlan }}" type="hidden">
							<fieldset class="p-3">
								<div class="form-group mb-0">
								  <div id="example1-card"></div>
								</div>
							</fieldset>
							  <button id="card-button" class="btn btn-primary rounded mt-3" data-secret="{{ $intent->client_secret }}">
								  @if(!empty($userData['refer_referral_code']))
									Pay ${{ $price_value/2 }} {{ strtoupper($allPlans['currency']) }}/{{ $permonth }}
								  @else
								  	Pay ${{ $price_value }} {{ strtoupper($allPlans['currency']) }}/{{ $permonth }}
								  @endif
							</button>
						</div>
				</div>
			</div>
		</div>
	</section>

</div>

<div class="modal fade" id="successfully_sub">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content bg-white p-3">
				<div class="modal-body text-center">
				   <i class="icon-checkmark"><img class="img-fluid" src="{{ url('public/')}}/front-assets/images/icon/checkmark.png" alt="Checkmark"></i>
				   <h3 class="modal-title mt-5">Awesome!</h3>
				   <p>Thanks for the payment.</p>
				</div>
				<div class="modal-footer border-0 flex-column align-items-stretch">
				<form action="{{ url('redirect-dashboard')}}" class="form" method="POST">
					@csrf
					<input type="hidden" name="user_id" value="{{ !empty($userData) ? $userData->id : ''}}">
					<button type="submit" class="btn btn-primary btn-block">Go to dashboard</button>
				</form>
				</div>
		</div>
	</div>
</div>

<!-- /content -->
@endsection
@section('extracontent')
<script type="text/javascript" src="{{ ('/public') }}/front-assets/lib/parsleyjs/parsley.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>

 <script>


 $( "#close_popup" ).click(function() {
  window.location.href = "{{ url('/home')}}";
	});

	const stripe = Stripe("{{ env('STRIPE_KEY') }}");
	const elements = stripe.elements();
    const cardElement = elements.create('card', {
	    hidePostalCode: true,
	  });

	cardElement.mount('#example1-card');
    const cardHolderName = document.getElementById('card-holder-name');
	console.log(cardHolderName.value);
    const cardButton = document.getElementById('card-button');

	const clientSecret = cardButton.dataset.secret;

    cardButton.addEventListener('click', async (e) => {

        const { setupIntent, error } = await stripe.confirmCardSetup(
            clientSecret, {
                payment_method: {
                    card: cardElement,
                    billing_details: { name: cardHolderName.value}
                }
            }
        );
    if (error) {
        // Display "error.message" to the user...
    } else {
        console.log('handling success',setupIntent.payment_method)
		var subplan = document.getElementById('subscription_plans').value;


		var user_email = document.getElementById('user_email').value;

		var user_id = '<?php echo $user_id; ?>';
            var pamentmethod=setupIntent.payment_method
			 $.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				}
			});

			$('#card-button').html('<i class="fa fa-spinner fa-spin"></i>Loading..');

			document.getElementById("card-button").onclick = function() {
				this.disabled = true;
			}

				$.ajax({
				url: "{{ url('subscribe') }}",
				type: 'POST',
				data: {payment_method:pamentmethod ,plan:subplan,userid:user_id,email:user_email},
				success: function (data) {
					if(data.success==201){
						$('#successfully_sub').modal({
							show: true,
							keyboard: false,
							backdrop: 'static'
						  });



					}
					if(data.success==200){
						toastr.success(data.message);
						setTimeout(function () {
							window.location.href = "{{ url('/home')}}";
						}, 3000);

					}



				}
                });
           // The card has been verified successfully...
    }
});

</script>
@endsection
