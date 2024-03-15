@extends('web.layouts.app')
@section('content')
<style>
    .alert {
        color: #721c24;
        padding: .75rem 1.25rem;
        margin-bottom: 1rem;
        background-color: #f8d7da;
        border-color: #f5c6cb;
        border: 1px solid transparent;
        border-radius: .25rem;
        text-align: left;
    }

    .stripcardpayment{
        padding: 20px 10px;
        border: 1px solid #ced4da;
        border-radius: 0.375rem;
    }
</style>

@if(session('error'))
    <script>
        $(document).ready(function() {
			toastr.options = {
				'closeButton': true,
				'debug': true,
				'newestOnTop': true,
				'progressBar': true,
				'positionClass': 'toast-top-right',
				'preventDuplicates': false,
				'showDuration': '1000',
				'hideDuration': '1000',
				'timeOut': '5000',
				'extendedTimeOut': '1000',
				'showEasing': 'swing',
				'hideEasing': 'linear',
				'showMethod': 'fadeIn',
				'hideMethod': 'fadeOut',
			}
		});
        toastr.error('{{ session('error') }}');
    </script>
@endif
<!-- Video Publisher Section Start-->
<section class="publisher-section themeix-ptb-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 align-self-center">
                <h2 class="text-white">Top Popular Video Publisher</h2>
                <p class="lh-lg text-white py-3">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Praesentium corrupti veniam consequuntur nihil ad? Voluptates aliquid cupiditate numquam dolore, earum quidem non. Provident illum cumque rem quo deleniti! Qui,
                    adipisci!
                </p>
            </div>
            <div class="col-lg-6 align-self-center">
                <div class="from-box p-5">
                    <div class="pb-3 text-center">
                        <h2 class="fw-bold">Add Card</h2>
                        <p class="fw-bold pt-3"></p>
                    </div>
                    <form id="payment-form" action="{{ route('web.subscription.create') }}" method="POST">
                        @csrf
                        <input type="hidden" name="plan" id="plan" value="{{ $PlanId }}">

                        <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" name="name" id="card-holder-name" class="form-control py-3 mb-4" value="" placeholder="Name on the card">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-12 col-lg-12 mt-2">
                                <div class="form-group">
                                    <label class="mb-2">Card details</label>
                                    <div id="card-element" class="stripcardpayment"></div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 mt-3">
                                <button type="submit" class="btn btn-primary py-3 w-100 fw-bold login-btn" id="card-button" data-secret="{{ $inttentId }}">Purchase</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Video Publisher Section End-->
@include('web.layouts.elements.newsletter')
<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('{{ env('STRIPE_KEY') }}')

    const elements = stripe.elements()
    const cardElement = elements.create('card')

    cardElement.mount('#card-element')

    const form = document.getElementById('payment-form')
    const cardBtn = document.getElementById('card-button')
    const cardHolderName = document.getElementById('card-holder-name')

    form.addEventListener('submit', async (e) => {
        e.preventDefault()

        cardBtn.disabled = true
        const { setupIntent, error } = await stripe.confirmCardSetup(
            cardBtn.dataset.secret, {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        name: cardHolderName.value
                    }
                }
            }
        )

        if(error) {
            cardBtn.disable = false
            $('#card-button').prop('disabled', false);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: error.message
            })
        } else {
            let token = document.createElement('input')
            token.setAttribute('type', 'hidden')
            token.setAttribute('name', 'token')
            token.setAttribute('value', setupIntent.payment_method)
            form.appendChild(token)
            form.submit();
        }
    })
</script>
<script>
    let overlay = document.getElementsByClassName('loading-overlay')[0]

    //overlay.addEventListener('click', e => overlay.classList.toggle('is-active'))

    document.getElementById('load-button')
    .addEventListener('click', e => overlay.classList.toggle('is-active'))
</script>

@endsection
@section('script')

@endsection
