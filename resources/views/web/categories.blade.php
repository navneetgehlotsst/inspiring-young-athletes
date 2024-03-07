@extends('web.layouts.app') 
@section('content')

<!-- Video Publisher Section Start-->
<section class="publisher-section themeix-ptb-2">
    <div class="container">
        <div class="website-title-white text-center">
            <h2 class="text-white">Sport Categories</h2>
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

@include('web.layouts.elements.newsletter')


@endsection 
@section('script') 
@endsection
    