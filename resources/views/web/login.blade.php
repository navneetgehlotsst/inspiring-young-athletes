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
            <div class="col-lg-6 m-auto align-self-center">
                <div class="from-box p-5">
                    <div class="pb-3 text-center">
                        <h2 class="fw-bold">Login to your Account</h2>
                        <p class="fw-bold pt-3">Enter to continue and explore within your grasp</p>
                    </div>
                    <form role="form" action="{{ route('web.login.post') }}" method="post">
                        @csrf
                        <input type="email" name="email" class="form-control py-3 mb-4" id="email" placeholder="Enter your email">
                        @error('email')
                            <div class="alert">{{ $message }}</div>
                        @enderror
                        <input name="password" name="password" type="password" class="form-control py-3 mb-4" id="password" placeholder="Password">
                        <div class="input-group-append position-relative">
                            <span onclick="password_show_hide();">
                              <i class="fas fa-eye" id="show_eye"></i>
                              <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                            </span>
                        </div>
                        @error('password')
                            <div class="alert">{{ $message }}</div>
                        @enderror
                        <div class="row my-4">
                            <div class="col-md-6">
                                <div class="form-check form-switch ps-0">
                                    <input type="checkbox" checked="">
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
                                </div>
                            </div>
                            <div class="col-md-6 text-end fw-bold"> <a href="forgot-password.html" class="secondary-color">Forgot Password ?</a></div>
                        </div>
                        <button type="submit" class="btn btn-primary py-3 w-100 fw-bold login-btn">Login to Continue</button>
                        <p class="pt-4 text-center">Don’t have an account ? <a href="{{ route('web.user.register') }}" class="primary-color fw-bold">Sign up For Users</a> | <a href="{{ route('web.athletes.coach.register') }}" class="primary-color fw-bold">Sign up for Athletes & Coach</a></p>
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
    