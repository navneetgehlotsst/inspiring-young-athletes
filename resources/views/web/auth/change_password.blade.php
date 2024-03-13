@extends('web.layouts.app')
@section('style')
@endsection 
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <ol class="breadcrumb1 mb-0 mt-0 bg-white">
                        <li class="breadcrumb-item1"><a href="{{route('/')}}">Home</a></li>
                        <li class="breadcrumb-item1"><a href="{{route('my-account')}}">User</a></li>
                        <li class="breadcrumb-item1 active">My Account</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="sptb pt-0">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4">
                @include('web.auth.my_account_head')
            </div>
            <div class="col-xl-8 col-lg-8 col-md-8">
                <div class="card mb-0">
                    <div class="card-header">
                        <h3 class="card-title">Change Password</h3>
                    </div>
                    <form action="{{route('update.password')}}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-12">
                                            <div class="form-group">
                                                <label class="form-label text-dark">Old Password</label>
                                                <div class="input-group input-group-merge">
                                                    <input type="password" id="old_password" name="old_password" class="form-control old_password @error('old_password') is-invalid @enderror" placeholder="Set Password" required>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="password-eye" data-id="old_password"><i class="fa fa-eye-slash"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                @error('old_password')
                                                    <span class="error-message">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12">
                                            <div class="form-group">
                                                <label class="form-label text-dark">New Password</label>
                                                <div class="input-group input-group-merge">
                                                    <input type="password" id="password" name="password" class="form-control password @error('password') is-invalid @enderror" placeholder="Set Password" required>
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
                                        <div class="col-sm-6 col-md-12">
                                            <div class="form-group">
                                                <label class="form-label text-dark">Confirm New Password</label>
                                                <div class="input-group input-group-merge">
                                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Retype Password" required>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="password-eye" data-id="password_confirmation"><i class="fa fa-eye-slash"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                @error('password_confirmation')
                                                    <span class="error-message">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="submit" class="btn btn-primary mb-4 mt-3" value="Update Password">
                        </div>
                    </form>    
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 
@section('script')
@endsection
