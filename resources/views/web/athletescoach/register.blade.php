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
<!-- Video Publisher Section Start-->
<section class="publisher-section themeix-ptb-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 align-self-center">
                <h2 class="text-white">Inspire the Next Champions and Generate passive income!</h2>
                <h6 class="text-white mt-3 fw-bold"><span>🏆</span>Join the 'Inspiring Young Athletes' Movement<span>🏆</span></h6>
                <p class="lh-lg text-white py-3">Inspiring Young Athletes isn't just a platform—it's a community where experience meets ambition, and where your journey inspires the next generation. As a seasoned athlete or coach, you possess invaluable insights that can light the way for youngsters eager to follow in your footsteps.</p>
                <h6 class="text-white mt-3 fw-bold">Make an Impact, Earn Effortlessly :</h6>
                <ul class="top-list-icon">
                    <li class="text-white"><i class="far fa-check-circle me-2 text-white"></i> Share your unique story and professional wisdom with young aspirants (ages 10-16).</li>
                    <li class="text-white"><i class="far fa-check-circle me-2 text-white"></i> Benefit from a user-friendly, mobile-optimized platform to reach a wide audience.</li>
                    <li class="text-white"><i class="far fa-check-circle me-2 text-white"></i> Enjoy a steady passive income from a subscription model that rewards your contribution.</li>
                </ul>
            </div>
            <div class="col-lg-6 align-self-center">
                <div class="from-box text-center p-5">
                    <div class="pb-3">
                        <h3 class="fw-bold">Enter to continue and explore within your grasp</h3>
                    </div>
                    <form role="form" action="{{ route('web.athletes.coach.register.post') }}" method="post" id="coachAtheliticsRegister">
                        @csrf
                        <input type="hidden" name="refid" value="@if(empty($getRefByDetail)) 0 @else {{$getRefByDetail->id}} @endif">
                        @if(empty($getRefByDetail))
                        <input type="text" name="email" id="email" value="{{ old('email') }}" class="form-control py-3 mb-4 @error('email') is-invalid @enderror" placeholder="Enter your email">
                        @else
                        <input type="text" name="email" id="email" value="@if(empty($getRefByDetail)){{ old('email') }} @else {{$getRefByDetail->referral_to}} @endif" class="form-control py-3 mb-4 @error('email') is-invalid @enderror" placeholder="Enter your email">
                        @endif
                        @error('email')
                            <div class="alert">{{ $message }}</div>
                        @enderror
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control py-3 mb-4 @error('name') is-invalid @enderror" placeholder="Full Name">
                        @error('name')
                            <div class="alert">{{ $message }}</div>
                        @enderror
                        <input type="number" name="phone" id="phone" value="{{ old('phone') }}" class="form-control py-3 mb-4 @error('phone') is-invalid @enderror" placeholder="Mobile Number">
                        @error('phone')
                            <div class="alert">{{ $message }}</div>
                        @enderror
                        <select class="form-control py-3 mb-4 form-select @error('role') is-invalid @enderror" name="role" id="role" aria-label="Default select example">
                            <option value="">Select Role</option>
                            @foreach ($getrole as $role)
                            <option value="{{$role->role_name}}" @if(old('role') == $role->role_name) selected @endif>{{$role->role_name}}</option>
                            @endforeach
                        </select>
                        @error('role')
                            <div class="alert">{{ $message }}</div>
                        @enderror
                        <select class="form-control py-3 mb-4 form-select @error('category') is-invalid @enderror" name="category" id="category" aria-label="Default select example">
                            <option value="">Select Categories</option>
                            @foreach ($getcategory as $category)
                            <option value="{{$category->category_id}}" @if(old('category') == $category->category_id) selected @endif>{{$category->category_name}}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <div class="alert">{{ $message }}</div>
                        @enderror
                        <input name="password" id="password" type="password" value="" class="form-control py-3 mb-4 @error('password') is-invalid @enderror" placeholder="Password">
                        <div class="input-group-append position-relative">
                            <span onclick="password_show_hide();">
                              <i class="fas fa-eye" id="show_eye"></i>
                              <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                            </span>
                        </div>
                        @error('password')
                            <div class="alert">{{ $message }}</div>
                        @enderror
                        @if(empty($getRefByDetail))
                        <input type="text" name="code" id="code" value="{{ old('code') }}" class="form-control py-3 mb-4 @error('code') is-invalid @enderror" placeholder="Referral Code(Optional)">
                        @else
                        <input type="text" name="code" id="code" value="@if(empty($getRefByDetail)){{ old('code') }} @else {{$getRefByDetail->referral_token}} @endif" class="form-control py-3 mb-4 @error('code') is-invalid @enderror" placeholder="Referral Code(Optional)">
                        @endif
                        <button type="submit" class="btn btn-primary py-3 w-100 fw-bold login-btn">Sign Up</button>
                        <p class="pt-4 text-center">Don’t have an account ? <a href="{{ route('web.login') }}" class="primary-color fw-bold">Login</a></p>
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
    