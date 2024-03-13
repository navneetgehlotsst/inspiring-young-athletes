@extends('web.layouts.home')
@section('content')

<div class="form-design shadow mt-5">
    <h5 class=" mb-2 ">Verify its you</h5>
    <form action="{{route('verify.forgot-password.post')}}" method="post" class="card-body pb-2" tabindex="500">
        @csrf
        <p class="text-dark text-left">Please enter 4 digit verification code that have been sent to your email address</p>
        <div class="control-group form-group">
            <div class="form-group"> 
                <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror" placeholder="Enter 4 digit verification code" minlength="4" maxlength="4" required>
                @error('code')
                    <span class="error-message">{{$message}}</span>
                @enderror 
            </div>
        </div>
        <div class="submit"> 
            <input type="submit" class="btn btn-primary btn-block" value="Submit"> 
        </div>
    </form>
    <hr class="divider">
    <div class="card-body pb-3 pt-3">
        <div class="d-flex mb-0">
            <div class="ms-auto font-weight-bold">
                <a onclick="resendOtp()" style="cursor: pointer;" class="ms-default-color mx-1">Resend code</a>
            </div>
        </div>
    </div>
</div>

@endsection 

@section('script')
<script>
function resendOtp(){
    Swal.fire({
      title: "Loading...",
      html: "Please wait a moment"
    })
    Swal.showLoading();
    $.ajax({
        type: "POST",
        url: "{{route('sendotp')}}",
        data: {'_token': "{{ csrf_token() }}"},
        success: function(response) {
            $('#code').val('');
            setFlesh('success','New otp sent successfully');
            Swal.hideLoading();
        }
    });
}
</script>

@endsection
