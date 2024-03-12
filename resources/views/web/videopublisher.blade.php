@extends('web.layouts.app')
@section('content')

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

<!-- Video Publisher Section Start-->
<section class="publisher-section themeix-ptb-2">
    <div class="container">
        <div class="website-title-white text-center">
            <h2 class="text-white">Video Publisher</h2>
            <div class="border-box m-auto"></div>
        </div>
    </div>
</section>
<!-- Video Publisher Section End-->


<!-- Categories Section Start-->
<section class="categories-section pt-5 pb-5">
    <div class="container">
        <div class="row py-4 g-3">
            <div class="col-lg-2 align-self-center">
                <div class="h5 mb-0 text-center text-lg-start">
                    <img src="{{asset('storage')}}/{{$categoryFirst->category_image}}" alt="Football" width="30px">
                    <span class="text-capitalize">{{$categoryFirst->category_name}}</span>
                </div>
            </div>
            <div class="col-lg-10 align-self-center">
                <form role="form" action="{{ route('web.video.publisher',$categoryFirst->category_slug) }}" method="get">
                    <div class="row g-3">
                        <div class="col-lg-5">
                            <div class="input-group position-relative">
                                <input class="form-control iya-input border" type="text" name="search" value="{{$search}}" placeholder="Search by name">
                                <span class="input-group-append">
                                    <button class="btn btn-outline-secondary bg-white border-0" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <select class="form-select iya-input" name="categorys" aria-label="Default select example">
                                <option value="">Select Categories</option>
                                @foreach ($getcategory as $category)
                                    <option value="{{$category->category_id}}" @if(!empty($categorys))@if($categorys == $category->category_id) selected @endif @endif>{{$category->category_name}}</option>
                                @endforeach
                              </select>
                        </div>
                        <div class="col-lg-2">
                            <button type="submit" class="btn iya-btn-blue w-100">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row g-3">
            @if ($videoCount != '0')
                @foreach ( $athleticCoaches as $athleticCoachprofile )
                @php
                    $datetime = $athleticCoachprofile->created_at;
                    $dateTimestring = new DateTime($datetime);
                    $year = $dateTimestring->format("Y");
                    $videoCount = $athleticCoachprofile->videos_count;
                @endphp
                <div class="col-lg-4">
                    <div class="publisher-box p-3">
                        <div class="d-flex position-relative">
                            <div class="publisher-img">
                                @if( $athleticCoachprofile->profile =="")
                                    <img class="img-account-profile rounded-circle mb-2 imgprofileupdate" src="{{asset('web/assets/images/new-img/dummyuser.png')}}" alt="">
                                @else
                                    <img class="img-account-profile rounded-circle mb-2 imgprofileupdate" src="{{asset($athleticCoachprofile->profile)}}" alt="">
                                @endif
                            </div>
                            <div class="publisher-details mt-2 ps-3">
                                <h4>{{$athleticCoachprofile->name}}</h4>
                                <p class="mb-1"><i class="far fa-play-circle text-danger me-2"></i> {{$videoCount}} videos</p>
                                <p class="mb-0"><i class="far fa-calendar-alt text-break me-2"></i> joined {{$year}}</p>
                            </div>
                            <div class="view-btn-box">
                                <a href="{{ route('web.video.publisher.list',$athleticCoachprofile->id) }}" class="text-white">View <img src="{{asset('web/assets/images/new-img/view-icon.svg')}}"
                                        alt="arrow icon"></a>
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
            {{ $athleticCoaches->links('pagination::bootstrap-5') }}
        </div>

        {{-- <nav aria-label="Page navigation example">
            <ul class="pagination">
              <li class="page-item"><a class="page-link" href="#">Previous</a></li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav> --}}
    </div>
</section>
<!-- Categories Section End-->

<!-- Trending Video Carousel Start-->
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
<!-- Trending Video Carousel End-->

@include('web.layouts.elements.newsletter')


@endsection
@section('script')
@endsection
