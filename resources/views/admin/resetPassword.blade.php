@extends('admin.layouts.authapp')
@section('content')

@if(session('error'))
    <script>
        toastr.error('{{ session('error') }}');
    </script>
@endif
<!-- Content -->

  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
              <a href="" class="app-brand-link gap-2">
                <img src="{{asset('web/assets/images/new-img/logo.svg')}}" alt="logo">
              </a>
            </div>
            <!-- /Logo -->
            <h4 class="mb-2">Reset Password?</h4>
            <form id="formAuthentication" class="mb-3" action="{{ route('admin.submitResetPasswordForm') }}"  method="post">
              @csrf
              <input type="hidden" name="token" value="{{ $token }}">
              <div class="mb-3">
                <label for="newpassword" class="form-label">New Password</label>
                <input
                  type="password"
                  class="form-control"
                  id="newpassword"
                  name="newpassword"
                  placeholder="Enter your New Password"
                  autofocus />
              </div>
              <div class="mb-3">
                <label for="conpassword" class="form-label">Confirm Password</label>
                <input
                  type="password"
                  class="form-control"
                  id="conpassword"
                  name="conpassword"
                  placeholder="Enter your Confirm Password"
                  autofocus />
              </div>
              <button class="btn btn-primary d-grid w-100">Save</button>
            </form>
            <div class="text-center">
              <a href="{{ route('admin.login') }}" class="d-flex align-items-center justify-content-center">
                <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                Back to login
              </a>
            </div>
          </div>
        </div>
        <!-- /Register -->
      </div>
    </div>
  </div>

  <!-- / Content -->




@endsection 
@section('script') 
@endsection
    