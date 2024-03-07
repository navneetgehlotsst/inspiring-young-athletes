@extends('web.layouts.app') 
@section('content')

<!-- Video Publisher Section Start-->
<section class="publisher-section themeix-ptb-2">
    <div class="container">
        <div class="website-title-white text-center">
            <h2 class="text-white">All Coach</h2>
            <div class="border-box m-auto"></div>
        </div>
    </div>
</section>
<!-- Video Publisher Section End-->
<!-- Categories Section Start-->
<section class="categories-section pt-5 pb-5">
    <div class="container">
        <div class="row py-4 g-3">
            <div class="col-lg-12 align-self-center">
                <form role="form" action="{{ route('web.coach') }}" method="get">
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
                            <h4>No Coach Found</h4>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="mt-3">
            {{ $athleticCoaches->links('pagination::bootstrap-5') }}
        </div>
    </div>
</section>
<!-- Categories Section End-->

<!-- Start Call To Action Area -->
<div class="call-to-action-area py-5 mt-0 mt-lg-5 ">
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
    