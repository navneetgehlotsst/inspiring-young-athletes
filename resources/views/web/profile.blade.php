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
            <div class="col-lg-6 align-self-center">
                <div class="from-box p-5">
                    <div class="pb-3 text-center">
                        <h2 class="fw-bold">Profile Update</h2>
                    </div>
                    <form role="form" action="{{ route('web.user.profileupdate') }}" method="post">
                        @csrf
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" value="{{$UserDetail->email}}" class="form-control py-3 mb-4 " placeholder="Enter your email">
                        @error('email')
                            <div class="alert">{{ $message }}</div>
                        @enderror
                        <label for="email">Name</label>
                        <input type="text" name="name" id="name" value="{{$UserDetail->name}}" class="form-control py-3 mb-4" placeholder="Full Name" />
                        @error('name')
                            <div class="alert">{{ $message }}</div>
                        @enderror
                        <label for="email">Phone</label>
                        <input type="number" name="phone" id="phone" value="{{$UserDetail->phone}}" class="form-control py-3 mb-4" placeholder="Mobile Number" />
                        @error('phone')
                            <div class="alert">{{ $message }}</div>
                        @enderror
                        <button type="submit" class="btn btn-primary py-3 w-100 fw-bold login-btn">Update Profile</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 align-self-center">
                <div class="from-box p-5">
                    <div class="pb-3 text-center">
                        <h2 class="fw-bold">Change Password</h2>
                        <p class="fw-bold pt-3">Enter to continue and explore within your grasp</p>
                    </div>
                    <form role="form" action="{{ route('web.user.passwordupdate') }}" method="post">
                        @csrf
                        <label for="email">Password </label>
                        <input name="password" type="password" value="" class="form-control py-3 mb-4" id="password" placeholder="Password" required="true" aria-label="password" aria-describedby="basic-addon1">
                        <div class="input-group-append position-relative">
                            <span onclick="password_show_hide();">
                              <i class="fas fa-eye" id="show_eye"></i>
                              <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                            </span>
                        </div>
                        @error('password')
                            <div class="alert">{{ $message }}</div>
                        @enderror
                        <label for="email">Confirmation Password</label>
                        <input name="password_confirmation" type="password" value="" class="form-control py-3 mb-4" id="password" placeholder="Confirm Password" required="true" aria-label="password" aria-describedby="basic-addon1">
                        <div class="input-group-append position-relative">
                            <span onclick="password_show_hide();">
                              <i class="fas fa-eye" id="show_eye"></i>
                              <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                            </span>
                        </div>
                        @error('password_confirmation')
                            <div class="alert">{{ $message }}</div>
                        @enderror
                        <button type="submit" class="btn btn-primary py-3 w-100 fw-bold login-btn">Update Password</button>
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
    