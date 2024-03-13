@extends('web.layouts.home')
@section('content')
<div class="form-design shadow mt-5">
            <h5 class=" mb-2 ">Change Your Password </h5>
            <form action="{{route('forgot.password.post')}}" method="post">
                @csrf
              <div class="mt-3">
                  <p class="light-gray">Enter your registered Email with On Me to create a new password</p>
                </div>
              <div class="form-group floating-label-form-group enter-value">
                <label>Enter Your Register Email</label>
                <input type="email" name="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" value="" placeholder="Enter Your Register Email" required>
                @error('email')
                    <span class="error-message">{{$message}}</span>
                @enderror   
              </div>
              <div class="mt-3">
                <input type="submit" class="btn btn-primary btn-block btn-lg" value="Countinue" />
              </div>
            </form>
            <div class="text-center mt-3">
              <p class="light-gray">Don’t have an account? <a href="{{route('register.get')}}">Register</a>
              </p>
            </div>
</div>
@endsection 
