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
<!-- Video Publisher Section Start-->
<section class="publisher-section themeix-ptb-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 align-self-center">
                <h2 class="text-white">Inspire the Next Champions and Generate passive income!</h2>
                <h6 class="text-white mt-3 fw-bold"><span>🏆</span>Join the 'Inspiring Young Athletes' Movement<span>🏆</span></h6>
                <p class="lh-lg text-white py-3">Inspiring Young Athletes isn't just a platform—it's a community where experience meets ambition, and where your journey inspires the next generation. As a seasoned athlete or coach, you possess invaluable insights that can light the way for youngsters eager to follow in your footsteps.</p>
                <h6 class="text-white mt-3 fw-bold">Discover the Secrets to Sporting Success NOW :</h6>
                <ul class="top-list-icon">
                    <li class="text-white"><i class="far fa-check-circle me-2 text-white"></i> Personal stories of triumph and challenge from professional athletes.</li>
                    <li class="text-white"><i class="far fa-check-circle me-2 text-white"></i> Insider tips on what top coaches really look for in young talent.</li>
                    <li class="text-white"><i class="far fa-check-circle me-2 text-white"></i> Answers to the burning questions every up-and-comer has.</li>
                </ul>
            </div>
            <div class="col-lg-6 align-self-center">
                <div class="from-box text-center p-5">
                    <div class="pb-3">
                        <h2 class="fw-bold">Create Your Account</h2>
                    </div>
                    <form role="form" action="{{ route('web.user.register.post') }}" method="post" id="coachAtheliticsRegister">
                        @csrf
                        <input type="text" name="email" id="email" value="{{ old('email') }}" class="form-control py-3 mb-4 @error('email') is-invalid @enderror" placeholder="Enter your email">
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
                        <button type="submit" class="btn btn-primary py-3 w-100 fw-bold login-btn">Sign up</button>
                        <p class="pt-4 text-center">Don’t have an account ? <a href="{{ route('web.login') }}" class="primary-color fw-bold">Login</a></p>
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
    