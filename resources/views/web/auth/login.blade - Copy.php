@extends('web.layouts.app')
@section('style')
@endsection 
@section('content')
<section class="sptb">
    <div class="container customerpage">
        <div class="row">
            <div class="single-page">
                <div class="col-lg-6 col-xl-4 col-md-6 d-block mx-auto">
                    <div class="ms-shadow p-4">
                        <form action="{{route('login.post')}}" method="post" id="" class="card-body pb-2" tabindex="500">
                            @csrf
                            <h3 align="left">Login</h3>
                            <p class="text-dark text-left pb-4">Login to access and use many features of<br>On Me</p>
                            <div class="control-group form-group">
                                <div class="form-group">
                                    <label class="form-label text-dark">Email Address</label>
                                    <input type="email" name="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" placeholder="Enter email address" required>
                                    @error('email')
                                        <span class="error-message">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="control-group form-group">
                                <div class="form-group">
                                    <label class="form-label text-dark">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Set Password" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="password-eye" data-id="password"><i class="fa fa-eye-slash"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    @error('password')
                                        <span class="error-message">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="submit pb-4">
                                <input type="submit" class="btn btn-primary float-end" value="Continue">
                            </div>
                            <p class="mb-2"><a href="{{route('forgot.password.get')}}">Forgot Password</a></p>
                        </form>
                        <hr class="divider">
                        <div class="card-body pb-3 pt-3">
                            <div class="d-flex mb-0"> <span class="text-dark mb-0">Don't have an account?</span>
                                <div class="ms-auto font-weight-bold"><a href="{{route('register.get')}}" class="ms-default-color mx-1">Register</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 

@section('script')

@endsection
