@extends('web.layouts.app')
@section('content')
<div class=" osahan-pricing">
    <div class="container">
       <div class="row py-lg-4">
          <div class="col-md-6 mx-auto mb-md-2">
            <div class="col-sm-4"></div>
            <aside class="">
                <article class="card">
                    <div class="card-body p-3">
                        <div class="col-md-12 text-center">
                            <img src="{{asset('assets/web/images/Stripe_Logo.png')}}" height="100">
                        </div>
                    </div>
                    <div class="card-body p-5">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="nav-tab-card">
                                <form id="payment-form" method="post" action="{{route('my.plan.post')}}" class="cardForm">
                                    @csrf
                                    <input type="hidden" name="business_id" value="{{$business->id}}">
                                    <input type="hidden" name="stripe_id" value="{{$business->stripe_id}}">
                                    <input type="hidden" name="name" value="{{$business->full_name}}">
                                    <input type="hidden" name="business_name" value="{{$business->business_name}}">
                                    <input type="hidden" name="email" value="{{$business->email}}">
                                    <input type="hidden" name="phone_number" value="{{$business->phone}}">
                                    <input type="hidden" name="address" value="{{$business->address ?? ''}}">
                                    <input type="hidden" name="plan_id" value="{{$plan->id}}">
                                    <input type="hidden" name="amount" value="{{$plan->total_amount}}">
                                    <input type="hidden" name="valid_days" value="{{$plan->valid_days}}">
                                    <input type="hidden" name="total_offer" value="{{$plan->total_offer}}">
                                    <input type="hidden" name="plan" value="{{$plan->name}}">

                                    <input type="hidden" name="card_token" id="card_token" value="">
                                    <!-- Your form fields for card details, e.g., card number, expiration date, CVC -->
                                    <div id="card-element"></div>
                                    <!-- Used to display card errors -->
                                    <div id="card-errors" role="alert" class="text-danger mt-2"></div>
                                    <div class="mt-5"></div>
                                    <input class="subscribe btn btn-primary btn-block cardButton" type="button" value="Pay&nbsp;${{ $plan->total_amount}}">
                                </form>
                            </div>
                        </div>
                    </div>
                </article>
            </aside>
            <div class="col-sm-3"></div>

        </div>
        </div>
        </div>
        </div>
  @endsection
  @section('script')
<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe_key = @json(env('STRIPE_KEY'));

    const stripe = Stripe(stripe_key);

    // Create an instance of the Stripe elements
    const elements = stripe.elements();
    const cardElement = elements.create('card');

    // Add the card element to the DOM
    cardElement.mount('#card-element');

    //const form = document.getElementById('payment-form');

    //form.addEventListener('submit', async function (event) {
    $('.cardButton').click( async function(event){    
        event.preventDefault();
        
        // Create a token from the card element
        const { token, error } = await stripe.createToken(cardElement);

        if (error) {
            // Display errors to the user
            const errorElement = document.getElementById('card-errors');
            errorElement.textContent = error.message;
            Swal.close();
        } else {
                let card_token = token.id;
                $('#card_token').val(card_token);
                //return false;
                $('#payment-form').submit();
                //form.submit();
            
            // sendTokenToServer(token);
        }
    });

    function sendTokenToServer(token) {
        // Send the token to your Laravel backend using an AJAX request or another method
        // Example AJAX request using fetch:
        fetch('/payment', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({
                token: token.id,
            }),
        })
        .then(response => {
            // Handle the response from your server
            console.log(response);
        })
        .catch(error => {
            // Handle errors
            console.error(error);
        });
    }
</script>


@endsection