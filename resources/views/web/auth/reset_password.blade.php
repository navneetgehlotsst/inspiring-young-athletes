@extends('web.layouts.home')
@section('content')
<div class="form-design shadow mt-5">
    <h5 class=" mb-2 ">Reset Password</h5>
    <form action="{{route('reset.password.post')}}" method="post" id="" class="card-body pb-2" tabindex="500">
        @csrf
        <div class="control-group form-group">
            <div class="form-group">
                <label class="form-label text-dark">Password</label>
                <div class="input-group input-group-merge">
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Please enter new password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span toggle="#password-field" class="fa fa-fw fa-eye-slash field_icon toggle-password"></span>
                        </div>
                    </div>
                </div>
                @error('password')
                    <span class="error-message">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="control-group form-group">
            <div class="form-group">
                <label class="form-label text-dark">Confirm Password</label>
                <div class="input-group input-group-merge">
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Please enter confirm new password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span toggle="#password-field" class="fa fa-fw fa-eye-slash field_icon toggle-password-confirmation"></span>
                        </div>
                    </div>
                </div>
                @error('password_confirmation')
                    <span class="error-message">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="submit">
            <input type="submit" class="btn btn-primary btn-block" value="Save Password">
        </div>
    </form>
    <hr class="divider">
    <div class="card-body pb-3 pt-3">
        <div class="d-flex mb-0">
            <div class="ms-auto font-weight-bold">
                <a href="{{route('login.get')}}" class="ms-default-color mx-1">Login</a>
            </div>
        </div>
    </div>
</div>
@endsection 
@section('script')
<script>
    $("body").on('click', '.toggle-password', function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $("#password");
        if (input.attr("type") === "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });

    $("body").on('click', '.toggle-password-confirmation', function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $("#password_confirmation");
        if (input.attr("type") === "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
</script>
@endsection