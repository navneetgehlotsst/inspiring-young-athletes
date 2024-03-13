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
                        <form action="{{route('email.verify.post')}}" method="post" class="card-body pb-2" tabindex="500">
                            @csrf
                            <h3 align="left">Verify its you</h3>
                            <p class="text-dark text-left pb-4">Please enter 4 digit verification code that have been sent to your email address</p>
                            <div class="control-group form-group">
                                <div class="form-group"> 
                                    <label class="form-label text-dark">4 digit verification code</label> 
                                    <input type="number" name="code" id="code" class="form-control @error('code') is-invalid @enderror" placeholder="Enter 4 digit verification code" minlength="4" maxlength="4" required>
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
                </div>
            </div>
        </div>
    </div>
</section>

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
