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



<section class="dashboard-section">
    <div class="container">
        <div class="row">
            @include('web.layouts.elements.leftsidebar')
            <div class="col-lg-9 py-3">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Add New Video</h1>                               
                </div>
                <!-- Content Row -->
                <div class="card shadow p-3">
                    <form id="videoUpload" role="form" action="{{ route('web.Video.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="title" class="form-control py-3 mb-4" value="{{ old('title') }}" placeholder="Video Title">
                        @error('title')
                            <div class="alert">{{ $message }}</div>
                        @enderror
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="mb-4">
                                    <input class="choose-btn-iyg" name="video" id="formFileLg" accept="video/mp4,video/x-m4v,video/*" type="file">
                                </div>
                                @error('video')
                                    <div class="alert">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <button type="submit" class="btn btn-primary py-3 w-100 fw-bold login-btn">Add Video</button>
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
    