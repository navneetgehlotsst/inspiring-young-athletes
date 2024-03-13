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

<style>
    .loader {
      display: none;
      border: 16px solid #f3f3f3; /* Light grey */
      border-top: 16px solid #3498db; /* Blue */
      border-radius: 50%;
      width: 120px;
      height: 120px;
      animation: spin 2s linear infinite;
      margin: auto;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
  </style>


<section class="dashboard-section">
    <div class="container">
        <div class="row">
            @include('web.layouts.elements.leftsidebar')
            <div class="col-lg-9 py-3">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Edit Video</h1>
                </div>
                {{-- $videodetail['VideoDetail']->video --}}
                <!-- Content Row -->
                <div class="card shadow p-3">
                    <form id="videoUpload" role="form" action="{{ route('web.athletes.coach.question.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="videoid" value="{{$videodetail['VideoDetail']->video_id}}">
                        <input type="text" name="title" class="form-control py-3 mb-4" value="{{$questiondetail->question}}" placeholder="Video Title" readonly>
                        @if($videodetail['VideoDetail']->video_status == '2')
                            <input type="text" name="remark" class="form-control py-3 mb-4" value="{{$videorejectedcomment->comment}}" placeholder="Video Reject Comment" readonly>
                        @endif
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-4 d-flex justify-content-center">
                                    <video width="600" controls>
                                        <source src="{{$videodetail['VideoDetail']->video}}">
                                    </video>
                                </div>
                            </div>
                        </div>
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
                                <button type="submit" class="btn btn-primary py-3 w-100 fw-bold login-btn" onclick="showLoader()">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="loader" class="loader"></div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('script')
@endsection
