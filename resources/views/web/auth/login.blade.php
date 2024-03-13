@extends('web.layouts.home')
@section('style')
@endsection 
@section('content')

<div class="form-design shadow mt-5">
    <h5 class=" mb-2 ">Login Your account</h5>
    <form action="{{route('login.post')}}" method="post" id="" class="card-body pb-2" tabindex="500">
        @csrf
        <div class="form-group floating-label-form-group enter-value">
            <label>Enter Your Email</label>
            <input type="email" name="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email address" required>
            @error('email')
                <span class="error-message">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group floating-label-form-group enter-value">
            <label>Password</label>
            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
            @error('password')
                <span class="error-message">{{$message}}</span>
            @enderror
        </div>
        <div class="mt-3">
            <p class="light-gray"><a href="{{route('forgot.password.get')}}">Forgot Password?</a>
            </p>
        </div>
        <div class="">
            <input type="submit" class="btn btn-primary btn-block btn-lg" value="Login">
        </div>                    
    </form>
    <div class="text-center mt-3">
      <p class="light-gray">Don’t have an account? <a href="{{route('register.get')}}">Register</a>
      </p>
    </div>
    </div>
@endsection 

@section('script')

@endsection
