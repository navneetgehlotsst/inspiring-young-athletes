@extends('web.layouts.app') 
@section('content')

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
                <form>
                    <div class="row g-3">
                        <div class="col-lg-5">
                            <div class="input-group position-relative">
                                <input class="form-control iya-input border" type="search"   placeholder="Search by name">
                                <span class="input-group-append">
                                    <button class="btn btn-outline-secondary bg-white border-0" type="button">
                                        <!-- <button class="search-icon border-0" type="button"></button> -->
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <select class="form-select iya-input" aria-label="Default select example">
                                <option selected>Select Categories</option>
                                @foreach ($getcategory as $category)
                                    <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                                @endforeach
                              </select>
                        </div>
                        <div class="col-lg-2">
                            <a href="#" class="btn iya-btn-blue w-100">Apply Now</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row g-3">
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
                            <a href="{{ route('web.coming-soon') }}" class="text-white">View <img src="{{asset('web/assets/images/new-img/view-icon.svg')}}"
                                    alt="arrow icon"></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
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
                    <div class="single-video">
                        <div class="video-img">
                            <a href="{{ route('web.coming-soon') }}">
                                <img class="lazy" data-src="{{asset('web/assets/images/thumbnails/1.jpg')}}" alt="Video" />
                            </a>
                            <span class="video-duration">5.28</span>
                        </div>
                        <div class="video-content">
                            <h4><a class='video-title' href="{{ route('web.coming-soon') }}">Funny videos 2016 funny pranks try not to laugh challenge</a></h4>
                            <div class="video-counter">
                                <div class="video-viewers">
                                    <span class="fa fa-eye view-icon"></span>
                                    <span>241,021</span>
                                </div>
                                <div class="video-feedback py-1">
                                    <span class="free-video-tag">Free</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-video">
                        <div class="video-img">
                            <a href="{{ route('web.coming-soon') }}">
                            <img class="lazy" data-src="{{asset('web/assets/images/thumbnails/2.jpg')}}" alt="Video" />
                            </a>
                            <span class="video-duration">3.11</span>
                        </div>
                        <div class="video-content">
                            <h4><a class='video-title' href="{{ route('web.coming-soon') }}">Double Chocolate-Stuffed Mini Churros (Pasticcio - English Recipe)</a></h4>
                            <div class="video-counter">
                                <div class="video-viewers">
                                    <span class="fa fa-eye view-icon"></span>
                                    <span>241,021</span>
                                </div>
                                <div class="video-feedback py-1">
                                    <span class="paid-video-tag">Paid</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-video">
                        <div class="video-img">
                            <a href="{{ route('web.coming-soon') }}">
                            <img class="lazy" data-src="{{asset('web/assets/images/thumbnails/3.jpg')}}" alt="Video" />
                            </a>
                            <span class="video-duration">5.10</span>
                        </div>
                        <div class="video-content">
                            <h4><a class='video-title' href="{{ route('web.coming-soon') }}">Greek-Style Pasta Bake (Pasticcio - English Recipe)</a></h4>
                            <div class="video-counter">
                                <div class="video-viewers">
                                    <span class="fa fa-eye view-icon"></span>
                                    <span>241,021</span>
                                </div>
                                <div class="video-feedback py-1">
                                    <span class="paid-video-tag">Paid</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-video">
                        <div class="video-img">
                            <a href="{{ route('web.coming-soon') }}">
                            <img class="lazy" data-src="{{asset('web/assets/images/thumbnails/4.jpg')}}" alt="Video" />
                            </a>
                            <span class="video-duration">2.29</span>
                        </div>
                        <div class="video-content">
                            <h4><a class='video-title' href="{{ route('web.coming-soon') }}">Rainbow Sprinkle Cinnamon Rolls (Gougeres Video)</a></h4>
                            <div class="video-counter">
                                <div class="video-viewers">
                                    <span class="fa fa-eye view-icon"></span>
                                    <span>991,021</span>
                                </div>
                                <div class="video-feedback py-1">
                                    <span class="free-video-tag">Free</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-video">
                        <div class="video-img">
                            <a href="{{ route('web.coming-soon') }}">
                            <img class="lazy" data-src="{{asset('web/assets/images/thumbnails/3.jpg')}}" alt="Video" />
                            </a>
                            <span class="video-duration">5.28</span>
                        </div>
                        <div class="video-content">
                            <h4><a class='video-title' href="{{ route('web.coming-soon') }}">Buffalo Chicken Potato Skins  (Gougeres English Video)</a></h4>
                            <div class="video-counter">
                                <div class="video-viewers">
                                    <span class="fa fa-eye view-icon"></span>
                                    <span>241,021</span>
                                </div>
                                <div class="video-feedback py-1">
                                    <span class="paid-video-tag">Paid</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Trending Video Carousel End--> 

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
    