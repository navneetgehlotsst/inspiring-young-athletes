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
    .loading-overlay {
    display: none;
    background: rgba(255, 255, 255, 0.7);
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    top: 0;
    z-index: 9998;
    align-items: center;
    justify-content: center;
    }

    .loading-overlay.is-active {
    display: flex;
    }

    .code {
    font-family: monospace;
    /*   font-size: .9em; */
    color: #dd4a68;
    background-color: rgb(238, 238, 238);
    padding: 0 3px;
    }
    .close-btn-onclick-btn{
        position: absolute;
        right: 0;
        font-size: 18px;
        bottom:12px;
    }
  </style>
<div class="loading-overlay">
    <span class="fas fa-spinner fa-3x fa-spin"></span>
</div>


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
                    {{-- <form id="videoUpload" role="form" action="{{ route('web.athletes.coach.question.update') }}" method="post" enctype="multipart/form-data"> --}}
                    <form id="imageUploadFormeditquestiovideo" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="videoid" value="{{$videodetail['VideoDetail']->video_id}}">
                        <input type="hidden" name="title" class="form-control py-3 mb-4" value="{{$questiondetail->question}}" placeholder="Video Title" readonly>
                        <div class="py-3 mb-4 h5">{!!$questiondetail->question!!}</div>
                        @if($videodetail['VideoDetail']->video_status == '2')
                            <input type="hidden" name="remark" class="form-control py-3 mb-4" value="{{$videorejectedcomment->comment}}" placeholder="Video Reject Comment" readonly>
                            <div class="py-3 mb-4 h5">Rejected For: {{$videorejectedcomment->comment}}</div>
                        @endif
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-4 d-flex justify-content-center">
                                    <video width="100%" height="500px" controls>
                                        <source src="{{$videodetail['VideoDetail']->video}}">
                                    </video>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="mb-4">
                                    <input class="choose-btn-iyg" name="video" id="formFileLgeditquestionvideo" accept="video/mp4,video/x-m4v,video/*" type="file">
                                    <div class="alert mt-2 d-none" id="formFileLgeditquestionvideocheck">Video Field is required</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <button type="button" class="btn btn-primary py-3 w-100 fw-bold login-btn" onclick="uploadqueseditVideo('editquesVideo')" id="load-button">Save</button>
                            </div>
                        </div>
                    </form>
                    <div id="uploadStatuseditquesVideo"></div>
                    <div id="progressbarcontainereditquesVideo" style="display: none;">
                        <div class="progress" >
                            <div class="progress-bar bg-success" id="progressbareditquesVideo" role="progressbar" value="0" max="100">0%</div>
                            <a class="text-danger close-btn-onclick-btn" id="removeprogrssbareditquesVideo" onclick="cancelUploade()" btn btn-primary><i class="fas fa-times-circle"></i></a>
                        </div>
                    </div>
                </div>
                <div id="loader" class="loader"></div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('script')
@endsection
