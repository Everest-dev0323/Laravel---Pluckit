@extends('layouts.front-end.app')
@section('content')
<div id="content">
    <section class="section">
        <div class="container pl-xl-0">
            <input id="subscription_plans" value="{{ $availablePlan }}" type="hidden">
            <input id="card-holder-name" class="mb-4" type="text">
            <div id="card-element"></div>
            <button id="card-button" class="btn btn-primary mt-3" data-secret="{{ $intent->client_secret }}">
                Pay $1.00 AUD/ month
            </button>
        </div>
    </section>
</div>
@endsection
@section('extracontent')
<script src="https://js.stripe.com/v3/"></script>

 <script>
 
    const stripe = Stripe("{{ env('STRIPE_KEY') }}");
	
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    cardElement.mount('#card-element');
    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');


    const clientSecret = cardButton.dataset.secret;

    cardButton.addEventListener('click', async (e) => {
        const { setupIntent, error } = await stripe.confirmCardSetup(
            clientSecret, {
                payment_method: {
                    card: cardElement,
                    billing_details: { name: cardHolderName.value }
                }
            }
        );
    if (error) {
        // Display "error.message" to the user...
    } else {
        console.log('handling success',setupIntent.payment_method)

    var subplan = document.getElementById('subscription_plans').value;
            var pamentmethod=setupIntent.payment_method
			
            $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
                    $.ajax({
                    url: "{{ url('subscribe') }}",
                    type: 'POST',
                    data: {payment_method:pamentmethod ,plan:subplan},
                    success: function (data) { 
					window.location.href = "{{ url('/business/user/dashboard?step=4')}}";
					
                    }
                }); 
           // The card has been verified successfully...
    }
});
</script>
@endsection
 
                                    
                                    