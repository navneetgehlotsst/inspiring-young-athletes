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
                           <video class="w-100" height="500" playsinline controls poster="{{asset($getVideo->thumbnails)}}">
                                <source src="{{asset($getVideo->video)}}" type="video/mp4/mov/avi/wmv">
                                <source src="{{asset($getVideo->video)}}" type="video/ogg">
                                 Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>
                    <div class="video-posts-data">
                        <div class="video-post-title">
                            <div class="d-flex">
                                <span class="video-icons bg-white">
                                    <div class="publisher-img">
                                        @if( $userdetail->profile =="")
                                            <img class="img-fluid publisher-img-width" src="{{asset('web/assets/images/new-img/dummyuser.png')}}" alt="">
                                        @else
                                            <img class="img-fluid publisher-img-width" src="{{asset($userdetail->profile)}}" alt="">
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
                        <div class="video-post-counter text-end">
                            <div class="video-post-viewers">
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
                    @if(!empty($popularVideos))

                        @foreach($popularVideos as $video)

                            @php
                                $uplaoddate = date_format($video->created_at,"d/m/Y")
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
                                        <h4><a class="video-title" href="{{ route('web.video',$video->video_id) }}">{{$video->video_title}}</a></h4>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
                    @foreach ($trendingVideo as $userdataVideo)

                        @foreach ($userdataVideo->TopVideoList as $Video )
                        @php
                            $uplaoddate = date_format($Video->created_at,"d/m/Y")
                        @endphp
                        <div class="single-video">
                            <div class="video-img">
                                @auth
                                    <a href="{{ route('web.video',$Video['video_id']) }}">
                                        <img class="lazy" alt="Video" src="{{asset($Video['thumbnails'])}}" style="" />
                                    </a>
                                @else
                                    <a href="{{ route('web.login') }}" >
                                        <img class="lazy" alt="Video" src="{{asset($Video['thumbnails'])}}" style="" />
                                    </a>
                                @endauth
                                {{-- <span class="video-duration">5.28</span> --}}
                            </div>
                            <div class="video-content">
                                @auth
                                        <h4><a class="video-title" href="{{ route('web.video',$Video['video_id']) }}">{{$Video['video_title']}}</a></h4>
                                    @else
                                        <h4><a class="video-title" href="{{ route('web.login') }}">{{$Video['video_title']}}</a></h4>
                                    @endauth
                                    <h4><a class="video-title">{{$uplaoddate}}</a></h4>
                                    <div class="video-counter">
                                        <div class="video-viewers">
                                            <span class="fa fa-eye view-icon"></span>
                                            <span>{{$Video['video_veiw_count']}}</span>
                                        </div>
                                            @if($Video->Video_type == 0)
                                                <div class="video-feedback py-1">
                                                    <span class="free-video-tag">Free</span>
                                                </div>
                                            @else
                                                <div class="video-feedback py-1">
                                                    <span class="paid-video-tag">Paid</span>
                                                </div>
                                            @endif
                                    </div>
                            </div>
                        </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- All Video Carousel End-->

<!-- Start Call To Action Area -->
<div class="call-to-action-area py-5">
    <div class="container">
        <div class="row py-5">
            <div class="col-md-12">
                <div class="action-content text-center pb-5">
                    <h2 class="text-dark fw-bold lh-base">Don't miss out on the latest updates, promotions, and exclusive content. Sign up for our newsletters by entering your email address below.</h2>
                </div>
            </div>
            <div class="col-md-6 m-auto">
                <div class="subscribe-section">
                    <input type="email" placeholder="Enter your email">
                    <button class="px-2 px-lg-5">Subscribe</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Call To Action Area -->


@endsection
@section('script')
@endsection
