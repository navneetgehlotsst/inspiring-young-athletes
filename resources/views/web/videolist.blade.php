@extends('web.layouts.app')
@section('content')
<style>
    div#social-links {
        margin: 0 auto;
        max-width: 500px;
    }
    div#social-links ul li {
        display: inline-block;
    }
    div#social-links ul li a {
        padding: 4px;
        margin: 1px;
        font-size: 30px;
    }
    .social-button .fa-facebook-square{
        color: #fff;
        background: #0d6efd;
        padding: 10px;
        font-size: 18px;
        border-radius: 0.25rem;
    }
    .social-button .fa-twitter{
        color: #fff;
        background: #00a2f3;
        padding: 10px;
        font-size: 18px;
        border-radius: 0.25rem;
    }
    .social-button .fa-linkedin{
        color: #fff;
        background: #00a2f3;
        padding: 10px;
        font-size: 18px;
        border-radius: 0.25rem;
    }

    .social-button .fa-telegram{
        color: #fff;
        background: #00a2f3;
        padding: 10px;
        font-size: 18px;
        border-radius: 0.25rem;
    }

    .social-button .fa-whatsapp{
        color: #fff;
        background: #2ab13f;
        padding: 10px;
        font-size: 18px;
        border-radius: 0.25rem;
    }
</style>
@if(session('You have logged in as Athlete/Coach and cannot view the video'))
    <script>
        $(document).ready(function(){
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "{{ session('error') }}",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.replace("{{ route('web.athletes.coach.MySubcription') }}");
                    }
                });
        });
    </script>
@endif

@if(session('error'))
    <script>
        $(document).ready(function(){
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "{{ session('error') }}",
                });
        });
    </script>
@endif
 <!-- Video Publisher Section Start-->
 <section class="@if(!empty($userdetail)) publisher-view py-4 @endif">
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
                {{-- <div class="col-lg-4 align-self-center text-lg-end">
                    <div class="mt-2">
                        {!! $shareComponent !!}
                    </div>
                </div> --}}
                <div class="col-lg-4 align-self-center text-lg-end">
                    <div class="mt-2">
                        @if(!empty($userdetail->facebook))
                            <a href="{{ $userdetail->facebook }}" target="_blank" class="my-2 my-lg-0 me-3 text-white btn btn-primary"><i class="fab fa-facebook text-white"></i></a>
                        @endif
                        @if (!empty($userdetail->instagram))
                            <a href="{{ $userdetail->instagram }}" target="_blank" class="my-2 my-lg-0 me-3 text-white btn btn-primary"><i class="fab fa-instagram text-white"></i></a>
                        @endif
                        @if(!empty($userdetail->tiktok))
                            <a href="{{ $userdetail->tiktok }}" target="_blank" class="my-2 my-lg-0 me-3 text-white btn btn-primary"><img src="{{asset('web/assets/images/new-img/tiktok.svg')}}" alt="logo" width="16px"></a>
                        @endif
                        @if(!empty($userdetail->linkedin))
                            <a href="{{ $userdetail->linkedin }}" target="_blank" class="my-2 my-lg-0 me-3 text-white btn btn-primary"><i class="fab fa-linkedin"></i></a>
                        @endif
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
            {{-- <div class="col-lg-6 align-self-center">
                <div class="d-flex">
                    <div class="publisher-img">
                        <img class="img-account-profile rounded-circle mb-2 imgprofileupdate" src="{{asset('web/assets/images/new-img/dummyuser.png')}}" alt="">
                    </div>
                    <div class="publisher-details mt-2 ps-4"> --}}
                        {{-- <h4 class="text-white">{{$pagetitel}}</h4> --}}
                        {{-- <p class="mb-1 text-white"><i class="far fa-play-circle text-white me-2"></i> {{$userdetail->videos_count}} videos</p> --}}
                        {{-- <p class="mb-0 text-white"><i class="far fa-calendar-alt text-white me-2"></i> joined {{$year}}</p> --}}
                    {{-- </div>
                </div>
            </div> --}}
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
    if($videoIntro !=""){
        $countvideoIntro = count($videoIntro);
    }
    $count = count($videoList);
@endphp

<!-- All Video Carousel Start-->

<section class="video-carousel-area themeix-ptb">
    <div class="container">
        @if ($videoIntro !="")
        <div class="themeix-section-h">
            <span class="heading-icon"><i class="far fa-play-circle"></i></span>
            <h3>Intro Videos</h3>
        </div>
        <div class="row mt-5">

            @if($countvideoIntro != 0)
                @foreach ($videoIntro as $videoIntros)
                @php
                    $uplaoddate = date_format($videoIntros->created_at,"d/m/Y")
                @endphp
                    <div class="col-lg-12">
                        <div class="card single-video p-3">
                            <div class="video-img">
                                @if($videoIntros->video_type == '2')
                                    <a href="{{ route('web.video',$videoIntros->video_id) }}">
                                        <img class="lazy" alt="Video" src="{{asset($videoIntros->thumbnails)}}" style="" />
                                    </a>
                                @else
                                    @auth
                                        @if ($isSubscribed == 1)
                                            <a href="{{ route('web.video',$videoIntros->video_id) }}">
                                                <img class="lazy" alt="Video" src="{{asset($videoIntros->thumbnails)}}" style="" />
                                            </a>
                                        @else
                                            <a href="{{ route('web.athletes.coach.MySubcription') }}">
                                                <img class="lazy" alt="Video" src="{{asset($videoIntros->thumbnails)}}" style="" />
                                            </a>
                                        @endif
                                    @else
                                        <a href="{{ route('web.login') }}" >
                                            <img class="lazy" alt="Video" src="{{asset($videoIntros->thumbnails)}}" style="" />
                                        </a>
                                    @endauth
                                @endif

                                {{-- <span class="video-duration">5.28</span> --}}
                            </div>
                            <div class="video-content">
                                @if($videoIntros->video_type == '2')
                                    <h4><a class="video-title" href="{{ route('web.video',$videoIntros->video_id) }}">{{$videoIntros->video_title}}</a></h4>
                                @else
                                    @auth
                                        @if ($isSubscribed == 1)
                                            <h4><a class="video-title" href="{{ route('web.video',$videoIntros->video_id) }}">{{$videoIntros->video_title}}</a></h4>
                                        @else
                                            <h4><a class="video-title" href="{{ route('web.athletes.coach.MySubcription') }}">{{$videoIntros->video_title}}</a></h4>
                                        @endif
                                    @else
                                        <h4><a class="video-title" href="{{ route('web.login') }}">{{$videoIntros->video_title}}</a></h4>
                                    @endauth
                                @endif
                                <div class="d-flex justify-content-between">
                                    <p class="fw-bold">{{$uplaoddate}}</p>
                                    @if (!empty($videoIntros->name))
                                        <p><span class="fw-bold">Published By</span> :- {{$videoIntros->name}}</p>
                                    @endif
                                </div>
                                <div class="video-counter">
                                    <div class="video-viewers">
                                        @php
                                            if (Auth::check()){
                                            $watch = Helper::userview($videoIntros->video_id,Auth::user()->id);

                                            }
                                        @endphp
                                        <span class="fa fa-eye view-icon"></span>
                                        <span>{{$videoIntros->video_veiw_count}}</span>
                                    </div>

                                    @if($videoIntros->video_type == '2')
                                        <div class="video-feedback py-1">
                                            <span class="free-video-tag">Free</span>
                                            @if(!empty($watch))
                                                <span class="watched-video-tag"><i class="fas fa-check-circle"></i> Watched</span>
                                            @else

                                            @endif
                                        </div>
                                    @else
                                        <div class="video-feedback py-1">
                                            <span class="paid-video-tag">Paid</span>
                                            @if(!empty($watch))
                                                <span class="watched-video-tag"><i class="fas fa-check-circle"></i> Watched</span>
                                            @else

                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-lg-12">
                    <div class="publisher-box p-3">
                        <div class="text-center">
                            <div class="">
                                <img class="mb-2" width="200" src="{{asset('web/assets/images/new-img/empty_item.svg')}}" alt="">
                            </div>
                            <div class="publisher-details mt-2 ps-3">
                                <h4>NO Video Found</h4>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        @endif
        <div class="themeix-section-h">
            <span class="heading-icon"><i class="far fa-play-circle"></i></span>
            @if(!empty($userdetail))
                <h3>Videos</h3>
            @else
                <h3>{{$pagetitle}}</h3>
            @endif
        </div>
        <div class="row mt-5">

            @if($count != 0)
                @foreach ($videoList as $Video)
                @php
                    $uplaoddate = date_format($Video->created_at,"d/m/Y")
                @endphp
                    <div class="col-lg-4">
                        <div class="card single-video p-3">
                            <div class="video-img">
                                @if($Video->video_type == '2')
                                    <a href="{{ route('web.video',$Video->video_id) }}">
                                        <img class="lazy" alt="Video" src="{{asset($Video->thumbnails)}}" style="" />
                                    </a>
                                @else
                                    @auth
                                        @if ($isSubscribed == 1)
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
                                        @if ($isSubscribed == 1)
                                            <h4><a class="video-title" href="{{ route('web.video',$Video->video_id) }}">{{$Video->video_title}}</a></h4>
                                        @else
                                            <h4><a class="video-title" href="{{ route('web.athletes.coach.MySubcription') }}">{{$Video->video_title}}</a></h4>
                                        @endif
                                    @else
                                        <h4><a class="video-title" href="{{ route('web.login') }}">{{$Video->video_title}}</a></h4>
                                    @endauth
                                @endif
                                <div class="d-flex justify-content-between">
                                    <p class="fw-bold">{{$uplaoddate}}</p>
                                    @if (!empty($Video->name))
                                        <p><span class="fw-bold">Published By</span> :- {{$Video->name}}</p>
                                    @endif
                                </div>
                                <div class="video-counter">
                                    <div class="video-viewers">
                                        @php
                                            if (Auth::check()){
                                            $watch = Helper::userview($Video->video_id,Auth::user()->id);

                                            }
                                        @endphp
                                        <span class="fa fa-eye view-icon"></span>
                                        <span>{{$Video->video_veiw_count}}</span>
                                    </div>

                                    @if($Video->video_type == '2')
                                        <div class="video-feedback py-1">
                                            <span class="free-video-tag">Free</span>
                                            @if(!empty($watch))
                                                <span class="watched-video-tag"><i class="fas fa-check-circle"></i> Watched</span>
                                            @else

                                            @endif
                                        </div>
                                    @else
                                        <div class="video-feedback py-1">
                                            <span class="paid-video-tag">Paid</span>
                                            @if(!empty($watch))
                                                <span class="watched-video-tag"><i class="fas fa-check-circle"></i> Watched</span>
                                            @else

                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-lg-12">
                    <div class="publisher-box p-3">
                        <div class="text-center">
                            <div class="">
                                <img class="mb-2" width="200" src="{{asset('web/assets/images/new-img/empty_item.svg')}}" alt="">
                            </div>
                            <div class="publisher-details mt-2 ps-3">
                                <h4>NO Video Found</h4>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="mt-3">
            {{ $videoList->links('pagination::bootstrap-5') }}
        </div>
    </div>
</section>
<!-- All Video Carousel End-->

@include('web.layouts.elements.newsletter')


@endsection
@section('script')
@endsection
