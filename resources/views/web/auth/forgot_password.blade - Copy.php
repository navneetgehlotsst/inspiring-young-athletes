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
                        <form action="{{route('forgot.password.post')}}" method="post" class="card-body pb-2" tabindex="500">
                            @csrf
                            <h3 align="left">Are you having trouble logging in?</h3>
                            <p class="text-dark text-left pb-4">Please enter the registered email address to get started</p>
                            <div class="control-group form-group">
                                <div class="form-group"> 
                                    <label class="form-label text-dark">Email address</label> 
                                    <input type="email" name="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" placeholder="Enter email address" required>
                                    @error('email')
                                        <span class="error-message">{{$message}}</span>
                                    @enderror 
                                </div>
                            </div>
                            <div class="submit"> 
                                <input type="submit" class="btn btn-primary btn-block" value="Countinue"> 
                            </div>
                        </form>
                        <hr class="divider">
                        <div class="card-body pb-3 pt-3">
                            <div class="d-flex mb-0">
                                <div class="ms-auto font-weight-bold">
                                    <div class="ms-auto font-weight-bold"><a href="{{route('login.get')}}" class="ms-default-color mx-1">Login</a></div>
                                </div>
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
