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

            <form id="formAuthentication" class="mb-3" action="{{ route('admin.loginpost') }}" method="post">
                @csrf
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input
                  type="text"
                  class="form-control"
                  id="email"
                  name="email"
                  placeholder="Enter your email"
                  autofocus />
              </div>
                @error('email')
                    <div class="alert">{{ $message }}</div>
                @enderror
              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">Password</label>
                  <a href="{{ route('admin.forgotpassword') }}">
                    <small>Forgot Password?</small>
                  </a>
                </div>
                <div class="input-group input-group-merge">
                  <input
                    type="password"
                    id="password"
                    class="form-control"
                    name="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password" />
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
              </div>
                @error('password')
                    <div class="alert">{{ $message }}</div>
                @enderror
              <div class="mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="remember-me" />
                  <label class="form-check-label" for="remember-me"> Remember Me </label>
                </div>
              </div>
              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
              </div>
            </form>

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
    