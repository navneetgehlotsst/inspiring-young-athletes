@extends('web.layouts.app')
@section('content')

<!--Video Section Start-->
<section class="pt-3 publisher-videos-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-8">
                <!-- Start Video Post -->
                <div class="video-post-wrapper">
                    <div class="single-video full-video-view">
                        <div class="video-img feature-post-img">
                           <video id="main-video" class="w-100" playsinline controls poster="{{asset($getVideo->thumbnails)}}">
                                <!-- <source src="{{asset($getVideo->video)}}" type="video/mp4/mov/avi/wmv">
                                <source src="{{asset($getVideo->video)}}" type="video/ogg"> -->
                                <source src="{{asset($getVideo->video)}}">
                                 Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>
                    <div class="video-posts-data">
                        <div class="video-post-title">
                            <div class="d-flex">
                                <span class="video-icons bg-white">
                                    <div class="publisher-img">

                                        

                                        @if(!empty($userDetail))
                                            @if($userDetail->profile == "")
                                                <img class="img-fluid publisher-img-width" src="{{asset('web/assets/images/new-img/user.png')}}" alt="">
                                            @else
                                                <img class="img-fluid publisher-img-width" src="{{asset($userDetail->profile)}}" alt="">
                                            @endif
                                        @else
                                            <img class="img-fluid publisher-img-width" src="{{asset('web/assets/images/new-img/user.png')}}" alt="">
                                        @endif

                                    </div>
                                </span>
                                <div class="video-post-info">
                                    <h4><a href="#">{{$getVideo->video_title}}</a></h4>
                                    <div class="video-post-date pt-2">
                                        <span class="h5"><i class="fas fa-calendar-alt"></i></span>
                                        @php
                                            $uplaoddate = date_format($getVideo->created_at,"d/m/Y")
                                        @endphp
                                        <p class="h5">{{$uplaoddate}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php
                            if (Auth::check()){
                            $watch = Helper::userview($getVideo->video_id,Auth::user()->id);

                            }
                        @endphp
                        <div class="video-post-counter text-end">
                            <div class="video-post-viewers d-flex">
                                @if(!empty($watch))
                                    <span class="watched-video-tag mr-2"><i class="fas fa-check-circle"></i> Watched</span>
                                @else

                                @endif
                                <p class="h5"><span class="fa fa-eye view-icon"></span>{{$getVideo->video_veiw_count}} views</p>
                            </div>
                            {{-- <div class="video-like">
                                <div class="share-options">
                                    <p>Share On</p>
                                    <ul class="social-share">
                                        <li class="twitter-bg"><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li class="facebook-bg"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li class="google-bg"><a href="#"><i class="fab fa-youtube"></i></a></li>
                                    </ul>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <!-- End Video Post -->
            </div>
            <!-- Start Popular Videos -->
            <div class="col-lg-3 col-md-4">
                <!-- Start Popular Videos -->
                <div class="themeix-section-h pt-0">
                    <span class="heading-icon"><i class="fa fa-fire" aria-hidden="true"></i></span>
                    <h3>Popular Videos</h3>
                </div>
                <div class="single-feature row g-3">
                    @if(count($popularVideos) != 0)
                        @foreach($popularVideos as $video)

                            @php
                                $uplaoddate = date_format($video->created_at,"d/m/Y")
                            @endphp
                            @php
                                if (Auth::check()){
                                $watch = Helper::userview($video->video_id,Auth::user()->id);

                                }
                            @endphp
                            <div class="slider-part-two col-md-12">
                                <div class="single-video">
                                    <div class="video-img feature-post-img">
                                        <a href="{{ route('web.video',$video->video_id) }}">
                                            <img class="lazy" alt="Video" src="{{asset($video->thumbnails)}}" style="" />
                                        </a>
                                        <!-- <span class="video-duration">10.52</span> -->
                                    </div>
                                    <div class="video-content">
                                        @auth
                                        <h4><a class="video-title" href="{{ route('web.video',$video->video_id) }}">{{$video->video_title}}</a></h4>
                                        @else
                                            <h4><a class="video-title" href="{{ route('web.login') }}">{{$video->video_title}}</a></h4>
                                        @endauth
                                    </div>
                                    @if(!empty($watch))
                                        <span class="free-video-tag">Watched</span>
                                    @else

                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="fw-bold">No Popular Videos</p>
                    @endif
                </div>
                <!-- End Popular Videos -->
            </div>
        </div>
    </div>
</section>
<!--Video Section End-->

<!-- All Video Carousel Start-->
<div class="video-carousel-area themeix-ptb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="themeix-section-h">
                    <span class="heading-icon"><i class="fa fa-bolt"></i></span>
                    <h3>Trending Videos</h3>
                </div>
                <div class="video-carousel owl-carousel">
                    @if(!empty($trendingVideo))
                        @foreach ($trendingVideo as $userdataVideo)

                            @foreach ($userdataVideo->TopVideoList as $Video )
                                @php
                                    $uplaoddate = date_format($Video->created_at,"d/m/Y")
                                @endphp
                                <div class="single-video">
                                    <div class="video-img">
                                        @if($Video->video_type == 2)

                                            <a href="{{ route('web.video',$Video->video_id) }}">
                                                <img class="lazy" alt="Video" src="{{asset($Video->thumbnails)}}" style="" />
                                            </a>
                                        @else
                                        @auth
                                            @if ($is_subcribed == 1)
                                                <a href="{{ route('web.video',$Video->video_id) }}">
                                                    <img class="lazy" alt="Video" src="{{asset($Video->thumbnails)}}" style="" />
                                                </a>
                                            @else
                                                <a href="{{ route('web.athletes.coach.MySubcription') }}">
                                                    <img class="lazy" alt="Video" src="{{asset($Video->thumbnails)}}" style="" />
                                                </a>
                                            @endif
                                        @else
                                            <a href="{{ route('web.login') }}" >
                                                <img class="lazy" alt="Video" src="{{asset($Video->thumbnails)}}" style="" />
                                            </a>
                                        @endauth
                                        @endif
                                        {{-- <span class="video-duration">5.28</span> --}}
                                    </div>
                                    <div class="video-content">
                                            @if($Video->video_type == '2')
                                                <h4><a class="video-title" href="{{ route('web.video',$Video->video_id) }}">{{$Video->video_title}}</a></h4>
                                            @else
                                                @auth
                                                    @if ($is_subcribed == 1)
                                                        <h4><a class="video-title" href="{{ route('web.video',$Video->video_id) }}">{{$Video->video_title}}</a></h4>
                                                    @else
                                                        <h4><a class="video-title" href="{{ route('web.athletes.coach.MySubcription') }}">{{$Video->video_title}}</a></h4>
                                                    @endif
                                                @else
                                                    <h4><a class="video-title" href="{{ route('web.login') }}">{{$Video->video_title}}</a></h4>
                                                @endauth
                                            @endif
                                            <h4><a class="video-title">{{$uplaoddate}}</a></h4>
                                            <div class="video-counter">
                                                <div class="video-viewers">
                                                    <span class="fa fa-eye view-icon"></span>
                                                    <span>{{$Video['video_veiw_count']}}</span>
                                                </div>
                                                @php
                                                    if (Auth::check()){
                                                    $watch = Helper::userview($Video->video_id,Auth::user()->id);

                                                    }
                                                @endphp
                                                <div class="video-feedback py-1">
                                                    @if($Video->video_type == 2)
                                                        <span class="free-video-tag">Free</span>
                                                    @else
                                                        <span class="paid-video-tag">Paid</span>
                                                    @endif
                                                    @if(!empty($watch))
                                                        <span class="free-video-tag">Watched</span>
                                                    @else
                                                    @endif
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    @else
                            <h3>No Video Found</h3>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
<!-- All Video Carousel End-->

@include('web.layouts.elements.newsletter')


@endsection
@section('script')
<!-- START: Mobile Autoplay Video -->
<script>
    /* for (video of document.getElementsByTagName("video")) {
        video.setAttribute("playsinline", "");
        video.setAttribute("muted", "");
        video.play();
    } */
</script>
<!-- END: Mobile Autoplay Video -->
@endsection
