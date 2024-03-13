@extends('admin.layouts.login_layout') 
@section('content') 
<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header pt-4 pb-4 text-center bg-primary">
                        <a href="index.html">
                            <span><img src="{{asset('assets/admin/images/logo.png')}}" alt="Punters" height="60"></span>
                        </a>
                    </div>
                    
                    <div class="card-body p-4">
                        <div class="text-center w-75 m-auto">
                            <h4 class="text-dark-50 text-center mt-0 font-weight-bold">Sign In</h4>
                            <p class="text-muted mb-4">Enter your email address and password to access admin panel.</p>
                        </div>
                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif
                        <form  method="POST" action="{{ route('admin.login') }}" id="loginForm">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input class="form-control" id="email" type="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" autofocus required="">
                                <span class="error-message"></span>
                            </div>
                            <div class="form-group">
                                <a href="{{ route('admin.forget.password.get') }}" class="text-muted float-right"><small>Forgot your password?</small></a>
                                <label for="password">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password" placeholder="Enter your password" value="{{ old('email') }}" required>
                                    <div class="input-group-append" data-password="false">
                                        <div class="input-group-text">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                </div>
                                <span class="error-message"></span>
                            </div>
                            <div class="form-group mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="checkbox-signin" name="is_remember" checked>
                                    <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                                </div>
                            </div>
                            <div class="form-group mb-0 text-center">
                                {{-- <a href="javascript:void(0);" class="btn btn-primary" type="submit"> Log In </a> --}}
                                <button type="submit" class="btn btn-primary">Log In</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
