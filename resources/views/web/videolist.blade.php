@extends('web.layouts.app')
@section('content')

 <!-- Video Publisher Section Start-->
 <section class="publisher-view py-4">
    <div class="container">
        @if(!empty($userdetail))
            <div class="row">
                @php
                    $datetime = $userdetail->created_at;
                    $dateTimestring = new DateTime($datetime);
                    $year = $dateTimestring->format("Y");
                @endphp
                <div class="col-lg-6 align-self-center">
                    <div class="d-flex">
                        <div class="publisher-img">
                            @if( $userdetail->profile =="")
                                <img class="img-account-profile rounded-circle mb-2 imgprofileupdate" src="{{asset('web/assets/images/new-img/dummyuser.png')}}" alt="">
                            @else
                                <img class="img-account-profile rounded-circle mb-2 imgprofileupdate" src="{{asset($userdetail->profile)}}" alt="">
                            @endif
                        </div>
                        <div class="publisher-details mt-2 ps-4">
                            <h4 class="text-white">{{$userdetail->name}} ({{$categoryFirst->category_name}})</h4>
                            <p class="mb-1 text-white"><i class="far fa-play-circle text-white me-2"></i> {{$userdetail->videos_count}} videos</p>
                            <p class="mb-0 text-white"><i class="far fa-calendar-alt text-white me-2"></i> joined {{$year}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 align-self-center text-lg-end">
                    <div class="mt-2">
                        <a href="#" class="my-2 my-lg-0 me-3 text-white btn btn-primary"><i class="fab fa-facebook text-white"></i></a>
                        <a href="#" class="my-2 my-lg-0 me-3 text-white btn btn-success"><i class="fab fa-instagram text-white"></i></a>
                        <a href="#" class="my-2 my-lg-0 me-3 text-white btn btn-danger"><i class="fab fa-youtube text-white"></i></a>
                        <a href="#" class="my-2 my-lg-0 me-3 text-white btn btn-info"><i class="fas fa-envelope text-white"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 text-end d-none d-lg-block align-self-center">
                    <div class="position-relative">
                        <div class="publisher-role text-center">
                            <img src="{{asset('web/assets/images/new-img/coach.svg')}}" alt="Icon" class="img-fluid w-75">
                            <p class="text-white h5 pt-3">{{$userdetail->roles}}</p>
                        </div>
                    </div>
                </div>
            </div>
        @else
        <div class="row">
            <div class="col-lg-6 align-self-center">
                <div class="d-flex">
                    <div class="publisher-img">
                        <img class="img-account-profile rounded-circle mb-2 imgprofileupdate" src="{{asset('web/assets/images/new-img/dummyuser.png')}}" alt="">
                    </div>
                    <div class="publisher-details mt-2 ps-4">
                        <h4 class="text-white">All Video</h4>
                        {{-- <p class="mb-1 text-white"><i class="far fa-play-circle text-white me-2"></i> {{$userdetail->videos_count}} videos</p> --}}
                        {{-- <p class="mb-0 text-white"><i class="far fa-calendar-alt text-white me-2"></i> joined {{$year}}</p> --}}
                    </div>
                </div>
            </div>
            {{-- <div class="col-lg-4 align-self-center text-lg-end">
                <div class="mt-2">
                    <a href="#" class="my-2 my-lg-0 me-3 text-white btn btn-primary"><i class="fab fa-facebook text-white"></i></a>
                    <a href="#" class="my-2 my-lg-0 me-3 text-white btn btn-success"><i class="fab fa-instagram text-white"></i></a>
                    <a href="#" class="my-2 my-lg-0 me-3 text-white btn btn-danger"><i class="fab fa-youtube text-white"></i></a>
                    <a href="#" class="my-2 my-lg-0 me-3 text-white btn btn-info"><i class="fas fa-envelope text-white"></i></a>
                </div>
            </div>
            <div class="col-lg-2 text-end d-none d-lg-block align-self-center">
                <div class="position-relative">
                    <div class="publisher-role text-center">
                        <img src="{{asset('web/assets/images/new-img/coach.svg')}}" alt="Icon" class="img-fluid w-75">
                        <p class="text-white h5 pt-3">{{$userdetail->roles}}</p>
                    </div>
                </div>
            </div> --}}
        </div>    
        @endif
    </div>
</section>
<!-- Video Publisher Section End-->
@php
    $count = count($VideoList)
@endphp
<!-- All Video Carousel Start-->
<section class="video-carousel-area themeix-ptb">
    <div class="container">
        <div class="themeix-section-h">
            <span class="heading-icon"><i class="far fa-play-circle"></i></span>
            <h3>All Videos</h3>
        </div>
        <div class="row mt-5">
            @if($count != 0)
                @foreach ($VideoList as $Video)
                @php
                    $uplaoddate = date_format($Video->created_at,"d/m/Y")
                @endphp
                    <div class="col-lg-4">
                        <div class="card single-video p-3">
                            <div class="video-img">
                                @auth
                                    <a href="{{ route('web.video',$Video->video_id) }}">
                                        <img class="lazy" alt="Video" src="{{asset($Video->thumbnails)}}" style="" />
                                    </a>
                                @else
                                    <a href="{{ route('web.login') }}" >
                                        <img class="lazy" alt="Video" src="{{asset($Video->thumbnails)}}" style="" />
                                    </a>
                                @endauth
                                {{-- <span class="video-duration">5.28</span> --}}
                            </div>
                            <div class="video-content">
                                @auth
                                    <h4><a class="video-title" href="{{ route('web.video',$Video->video_id) }}">{{$Video->video_title}}</a></h4>
                                @else
                                    <h4><a class="video-title" href="{{ route('web.login') }}">{{$Video->video_title}}</a></h4>
                                @endauth
                                <h4><a class="video-title">{{$uplaoddate}}</a></h4>
                                <div class="video-counter">
                                    <div class="video-viewers">
                                        <span class="fa fa-eye view-icon"></span>
                                        <span>{{$Video->video_veiw_count}}</span>
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
                    </div>
                @endforeach
            @else
            <div class="card p-3 nodatafoundcard">
                <div class="card-body">
                  <img src="{{asset('web/assets/images/new-img/empty_item.svg')}}" alt="logo">
                  <h5 class="card-title text-center">No record Found</h5>
                </div>
              </div>
            @endif
        </div>
        <div class="mt-3">
            {{ $VideoList->links('pagination::bootstrap-5') }}
        </div>
    </div>
</section>
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
