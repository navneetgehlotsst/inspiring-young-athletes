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
                <p class="lh-lg text-white py-3">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Praesentium corrupti veniam consequuntur nihil ad? Voluptates aliquid cupiditate numquam dolore, earum quidem non. Provident illum cumque rem quo deleniti! Qui, adipisci!</p>
            </div>
            <div class="col-lg-6 align-self-center">
                <div class="from-box p-5">
                    <div class="pb-3 text-center">
                        <h2 class="fw-bold">Set Password</h2>
                        <p class="fw-bold pt-3">Enter to continue and explore within your grasp</p>
                    </div>
                    <form role="form" action="{{ route('web.submitResetPasswordForm') }}" method="post">
                        @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">
                        <input name="new_password" type="password" value="" class="form-control py-3 mb-4" id="password" placeholder="Password" required="true" aria-label="password" aria-describedby="basic-addon1">
                        <div class="input-group-append position-relative">
                            <span onclick="password_show_hide();">
                              <i class="fas fa-eye" id="show_eye"></i>
                              <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                            </span>
                        </div>
                        @error('new_password')
                            <div class="alert">{{ $message }}</div>
                        @enderror
                        <input name="new_password_confirmation" type="password" value="" class="form-control py-3 mb-4" id="newpassword" placeholder="Confirm Password" required="true" aria-label="password" aria-describedby="basic-addon1">
                        <div class="input-group-append position-relative">
                            <span onclick="password_show_hidenew();">
                              <i class="fas fa-eye" id="show_eyenew"></i>
                              <i class="fas fa-eye-slash d-none" id="hide_eyenew"></i>
                            </span>
                        </div>
                        <button type="submit" class="btn btn-primary py-3 w-100 fw-bold login-btn">Update Password</button>
                        <p class="pt-4 text-center">Back to ? <a href="login.html" class="primary-color fw-bold">Sign in</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Video Publisher Section End-->
@include('web.layouts.elements.newsletter')


@endsection 
@section('script') 
@endsection
    