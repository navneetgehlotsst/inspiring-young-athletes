@extends('admin.layouts.login_layout') 
@section('content') 
<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header pt-2 pb-2 text-center bg-primary">
                        <span><img src="{{asset('assets/admin/images/logo.png')}}" alt="Punters" height="60"></span>
                    </div>
                    <div class="card-body p-4">
                        <div class="text-center w-75 m-auto">
                            <h4 class="text-dark-50 text-center mt-0 font-weight-bold">Reset Password</h4>
                            <p class="text-muted mb-4">Enter your email address to generate password link.</p>
                        </div>
                        @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif
                        <form action="{{route('admin.forget.password.post')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="email">E-Mail Address</label>
                                <input class="form-control" id="email" type="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" autofocus required="">
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-0 text-center">
                                <button type="submit" class="btn btn-primary">
                                Send Password Reset Link
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection