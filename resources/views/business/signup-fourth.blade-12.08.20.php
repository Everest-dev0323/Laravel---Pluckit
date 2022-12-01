@extends('layouts.front-end.app')
@section('content')
<!-- Content -->
<style>
.example.example1 {
  background-color: #6772e5;
}

.example.example1 * {
  font-family: Roboto, Open Sans, Segoe UI, sans-serif;
  font-size: 16px;
  font-weight: 500;
}

.example.example1 fieldset {
  margin: 0 15px 20px;
  padding: 0;
  border-style: none;
  background-color: #7795f8;
  box-shadow: 0 6px 9px rgba(50, 50, 93, 0.06), 0 2px 5px rgba(0, 0, 0, 0.08),
    inset 0 1px 0 #829fff;
  border-radius: 4px;
}

.example.example1 .row {
  display: -ms-flexbox;
  display: flex;
  -ms-flex-align: center;
  align-items: center;
  margin-left: 15px;
}

.example.example1 .row + .row {
  border-top: 1px solid #819efc;
}

.example.example1 label {
  width: 15%;
  min-width: 70px;
  padding: 11px 0;
  color: #c4f0ff;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.example.example1 input, .example.example1 button {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  outline: none;
  border-style: none;
}

.example.example1 input:-webkit-autofill {
  -webkit-text-fill-color: #fce883;
  transition: background-color 100000000s;
  -webkit-animation: 1ms void-animation-out;
}

.example.example1 .StripeElement--webkit-autofill {
  background: transparent !important;
}

.example.example1 .StripeElement {
  width: 100%;
  padding: 11px 15px 11px 0;
}

.example.example1 input {
  width: 100%;
  padding: 11px 15px 11px 0;
  color: #fff;
  background-color: transparent;
  -webkit-animation: 1ms void-animation-out;
}

.example.example1 input::-webkit-input-placeholder {
  color: #87bbfd;
}

.example.example1 input::-moz-placeholder {
  color: #87bbfd;
}

.example.example1 input:-ms-input-placeholder {
  color: #87bbfd;
}

.example.example1 button {
  display: block;
  width: calc(100% - 30px);
  height: 40px;
  margin: 40px 15px 0;
  background-color: #f6a4eb;
  box-shadow: 0 6px 9px rgba(50, 50, 93, 0.06), 0 2px 5px rgba(0, 0, 0, 0.08),
    inset 0 1px 0 #ffb9f6;
  border-radius: 4px;
  color: #fff;
  font-weight: 600;
  cursor: pointer;
}

.example.example1 button:active {
  background-color: #d782d9;
  box-shadow: 0 6px 9px rgba(50, 50, 93, 0.06), 0 2px 5px rgba(0, 0, 0, 0.08),
    inset 0 1px 0 #e298d8;
}

.example.example1 .error svg .base {
  fill: #fff;
}

.example.example1 .error svg .glyph {
  fill: #6772e5;
}

.example.example1 .error .message {
  color: #fff;
}

.example.example1 .success .icon .border {
  stroke: #87bbfd;
}

.example.example1 .success .icon .checkmark {
  stroke: #fff;
}

.example.example1 .success .title {
  color: #fff;
}

.example.example1 .success .message {
  color: #9cdbff;
}

.example.example1 .success .reset path {
  fill: #fff;
}
</style>
<div id="content" class="pt-0">
  <!-- Signup -->
	<section class="section signup-content">
		<div class="container">
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
				<div class="col-lg-6 col-xl-6 offset-xl-1">
					<div class="payments-container">
						<h4 class="text-success mb-4">Pay For Plan</h4>
						<input type="hidden" name="user_id" value="{{ $user_id }}">
						<label class="plan-field bg-gray-light">
							<span class=""></span>
							<!-- <span class="planInfo">
							  <span class="plan-title">{{ $productDetails->name }}</span>
							  <span class="plan-desc">• {{ $productDetails->description }}</span>
							</span> -->
							@php $price_value = number_format($allPlans->unit_amount/100,2);  @endphp
							<span class="plan-price">${{ $price_value }} / {{ $allPlans['recurring']['interval'] }}</span>
						</label>
					</div>
				</div>
				<div class="col-lg-6 col-xl-5">
					<div id="content">
						<section class="section">
							<div class="container  cell example example1" id="example-1">
							
								<fieldset>
									<div class="row">
										<label for="example1-name" data-tid="elements_examples.form.name_label">Name</label>
										<input id="card-holder-name" data-tid="elements_examples.form.name_placeholder" type="text" placeholder="Jane Doe" required>
									</div>
									<div class="row">
									  <label for="example1-email" data-tid="elements_examples.form.email_label">Email</label>
									  <input id="user_email" data-tid="elements_examples.form.email_placeholder" type="email" placeholder="janedoe@gmail.com" required>
									</div>
									
								</fieldset>
								<input id="subscription_plans" value="{{ $availablePlan }}" type="hidden">
								<fieldset>
									<div class="row">
									  <div id="example1-card"></div>
									</div>
								</fieldset>
								  <button id="card-button" class="btn btn-primary mt-3" data-secret="{{ $intent->client_secret }}">
							Pay ${{ $price_value }} {{ $allPlans['currency'] }}/{{ $allPlans['recurring']['interval'] }}
								</button>
							
							</div>
						</section>  
					</div>
				</div>
			</div>
		</div>
	</section> 
</div>	
<!-- /content -->
@endsection
@section('extracontent')
<script src="https://js.stripe.com/v3/"></script>

 <script>
	const stripe = Stripe("{{ env('STRIPE_KEY') }}");
	const elements = stripe.elements();
    const cardElement = elements.create('card');
	console.log(cardElement);
	cardElement.mount('#example1-card');
    const cardHolderName = document.getElementById('card-holder-name');
	console.log(cardHolderName);
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
				$.ajax({
				url: "{{ url('subscribe') }}",
				type: 'POST',
				data: {payment_method:pamentmethod ,plan:subplan,userid:user_id,email:user_email},
				success: function (data) { 
					window.location.href = "{{ url('/business/user/dashboard?step=4')}}";
				
				}
                }); 
           // The card has been verified successfully...
    }
});

</script>
@endsection