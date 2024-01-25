@extends('web.layouts.app') 
@section('content')
@if(session('success'))
    <script>
        $(document).ready(function() {
			toastr.options = {
				'closeButton': true,
				'debug': false,
				'newestOnTop': false,
				'progressBar': false,
				'positionClass': 'toast-top-right',
				'preventDuplicates': false,
				'showDuration': '1000',
				'hideDuration': '1000',
				'timeOut': '5000',
				'extendedTimeOut': '1000',
				'showEasing': 'swing',
				'hideEasing': 'linear',
				'showMethod': 'fadeIn',
				'hideMethod': 'fadeOut',
			}
		});
        toastr.success('{{ session('success') }}');
    </script>
@endif


@if(session('error'))
    <script>
        $(document).ready(function() {
			toastr.options = {
				'closeButton': true,
				'debug': false,
				'newestOnTop': false,
				'progressBar': false,
				'positionClass': 'toast-top-right',
				'preventDuplicates': false,
				'showDuration': '1000',
				'hideDuration': '1000',
				'timeOut': '5000',
				'extendedTimeOut': '1000',
				'showEasing': 'swing',
				'hideEasing': 'linear',
				'showMethod': 'fadeIn',
				'hideMethod': 'fadeOut',
			}
		});
        toastr.error('{{ session('error') }}');
    </script>
@endif



<section class="dashboard-section">
    <div class="container">
        <div class="row">
            @include('web.layouts.elements.leftsidebar')
            <div class="col-lg-9 py-3">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Change Password</h1>                               
                </div>
                <!-- Content Row -->
                <div class="card shadow p-3">
                    <form role="form" action="{{ route('web.athletes.coach.passwordupdate') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <form>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <input type="password" name="old_password" class="form-control py-3 mb-4" placeholder="Old Password" value="">
                                                    @error('old_password')
                                                        <div class="alert">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-12">
                                                    <input type="password" name="new_password" class="form-control py-3 mb-4" placeholder="New Password" value="">
                                                    @error('new_password')
                                                        <div class="alert">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-12">
                                                    <input type="password" name="new_password_confirmation" class="form-control py-3 mb-4" placeholder="Confirm Password" value="">
                                                </div>
                                                <div class="col-lg-4 ms-auto">
                                                    <button type="submit" class="btn btn-primary py-3 w-100 fw-bold login-btn">Change Password</button>
                                                </div>
                                            </div>
                                          
                                        </form>
                                    </div>
                                </div>
                            </div>
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
    