@extends('web.layouts.app') 
@section('content')

<!-- Video Publisher Section Start-->
<section class="publisher-section themeix-ptb-2">
    <div class="container">
        <div class="website-title-white text-center">
            <h2 class="text-white">Video Categories</h2>
            <div class="border-box m-auto"></div>
        </div>
    </div>
</section>
<!-- Video Publisher Section End-->
<!-- Categories Section Start-->
<section class="categories-section pt-5 pb-5">
    <div class="container">
        <div class="row g-3 mt-4">
            @foreach ($getcategory as $category)
                <div class="col-lg-2 col-6 mb-3">
                    <a href="{{ route('web.video.publisher',$category->category_slug) }}">
                        <div class="categorie-box text-center">
                            <img src="{{asset('storage')}}/{{$category->category_image}}" alt="{{$category->category_name}}">
                            <p class="my-3">{{$category->category_name}}</p>
                        </div>
                    </a>
                </div>
            @endforeach
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
    