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
                    <h1 class="h3 mb-0 text-gray-800">Video List</h1>                               
                </div>
                <div class="themeix-section-h">
                    <span class="heading-icon"><i class="far fa-play-circle"></i></span>
                    <h3>Videos {{$Videocount}}</h3>
                </div>
                <div class="row g-4">
                    @foreach ( $getVideo as $Video )
                        @php
                            $uplaoddate = date_format($Video->created_at,"d/m/Y")
                        @endphp   
                        <div class="col-lg-4">
                            <div class="card single-video p-3">
                                <div class="video-img">
                                    <a href="{{ route('web.Video.viewVideo',$Video->video_id) }}">
                                        <img class="lazy" alt="Video" src="{{asset($Video->thumbnails)}}" style="" />
                                    </a>
                                    {{-- <span class="video-duration">5.28</span> --}}
                                </div>
                                <div class="video-content">
                                    <h4><a class="video-title" href="{{ route('web.Video.viewVideo',$Video->video_id) }}">{{$Video->video_title}}</a></h4>
                                    <h4><a class="video-title">{{$uplaoddate}}</a></h4>
                                    <div class="video-counter d-flex justify-content-between">
                                        <div class="video-viewers">
                                            <span class="fa fa-eye view-icon"></span>
                                            <span>{{$Video->video_veiw_count}}</span>
                                        </div>
                                            
                                            <div>
                                                <div class="video-feedback py-1">
                                                    <a class="free-video-tag bg-success ms-2" href="{{ route('web.Video.edit.video', $Video->video_id ) }}">Edit</a>
                                                </div>
                                                @if($Video->video_status == 1)
                                                <div class="video-feedback py-1">
                                                    <span class="free-video-tag">Approved</span>
                                                </div>
                                                @elseif($Video->video_status == 2)
                                                    <div class="video-feedback py-1">
                                                        <span class="paid-video-tag">Rejected</span>
                                                    </div>
                                                @else
                                                    <div class="video-feedback py-1">
                                                        <span class="pending-video-tag">Pending</span>
                                                    </div>
                                                @endif
                                            </div>
                                            
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>          
            </div>
        </div>
    </div>
</section>

@endsection 
@section('script')
@endsection
    