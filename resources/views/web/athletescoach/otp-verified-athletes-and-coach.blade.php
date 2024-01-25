@extends('web.layouts.app')
@section('content')
@if(session('error'))
    <script>
        $(document).ready(function() {
			toastr.options = {
				'closeButton': true,
				'debug': false,
				'newestOnTop': false,
				'progressBar': false,
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


@if(session('success'))
    <script>
        $(document).ready(function() {
			toastr.options = {
				'closeButton': true,
				'debug': false,
				'newestOnTop': false,
				'progressBar': false,
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
        toastr.success('{{ session('success') }}');
    </script>
@endif
<!-- Video Publisher Section Start-->
<section class="publisher-section themeix-ptb-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="from-box p-5">
                    <div class="pb-3 text-center">
                        <h2 class="fw-bold">OTP Verified</h2>
                        <p class="fw-bold pt-3">Please enter the verification code sent</p>
                        <p class="fw-bold">to <a href="#" class="text-blue">{{$email}}</a></p>
                    </div>
                    {{-- @if(session('error'))
                        <p>
                            {{ session('error') }}
                        </p>
                    @endif --}}

                    <form role="form" action="{{ route('web.athletes.coach.verifyotp') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-8 m-auto">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <input type="number" name="otp1" class="form-control py-3 mb-4 text-center otp-input" placeholder="" required>
                                    </div>
                                    <div class="col-lg-3">
                                        <input type="number" name="otp2" class="form-control py-3 mb-4 text-center otp-input" placeholder="" required>
                                    </div>
                                    <div class="col-lg-3">
                                        <input type="number" name="otp3" class="form-control py-3 mb-4 text-center otp-input" placeholder="" required>
                                    </div>
                                    <div class="col-lg-3">
                                        <input type="number" name="otp4" class="form-control py-3 mb-4 text-center otp-input" placeholder="" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="py-4 text-center">Didn't receive an OTP? <a href="{{ route('web.athletes.coach.RsendOtp') }}" class="primary-color fw-bold text-blue fw-bold">Resend OTP?</a></p>
                        <button type="submit" class="btn btn-primary py-3 w-100 fw-bold login-btn">Submit</button>
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
