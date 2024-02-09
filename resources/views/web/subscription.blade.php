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
                            <div class="col-xl-12 col-lg-12">
                                <div class="form-group">
                                    <label for="">Card details</label>
                                    <div id="card-element"></div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12">
                            <hr>
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
<!-- Start Call To Action Area -->
<div class="call-to-action-area py-5">
    <div class="container">
        <div class="row py-5">
            <div class="col-md-12">
                <div class="action-content text-center pb-5">
                    <h2 class="text-dark fw-bold lh-base">Don't miss out on the latest updates, promotions, and exclusive content. Sign up for our newsletters by entering your email address below.</h2>
                </div>
            </div>
            <div class="col-md-6 m-auto">
                <div class="subscribe-section">
                    <input type="email" placeholder="Enter your email">
                    <button class="px-2 px-lg-5">Subscribe</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Call To Action Area -->


@endsection 
@section('script')

@endsection
    