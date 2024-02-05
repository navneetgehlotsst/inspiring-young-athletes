@extends('web.layouts.app') 
@section('content')
<style>
    .pointes-box{
        background: #1badc4;
        color: #fff;
        padding: 5px;
        font-size: 18px;
        border-radius: 5px;
        min-width: 40px;
        min-height: 30px;
        text-align: center;
    }
</style>
<!-- Video Publisher Section Start-->
<section class="publisher-section themeix-ptb-2">
    <div class="container">
        <div class="website-title-white text-center">
            <h2 class="text-white">Question List</h2>
            <div class="border-box m-auto"></div>
        </div>
    </div>
</section>
<!-- Video Publisher Section End-->
<!-- Categories Section Start-->
<section class="categories-section pt-5 pb-5">
    <div class="container">
        <div class="position-relative">
            @php $i = 1; @endphp
            @foreach($QuestionList as $questionList)
            <div class="d-flex align-items-baseline py-2">
            <p class="mb-0 pointes-box">{{$i++}}.</p>
            <h4 class="h6 question-icon ps-2 py-2"><a href="{{ route('web.question.video',$questionList->question_id) }}">{{$questionList->question}}</a></h4>
            </div>
            @endforeach
        </div>
        <div class="row g-3 mt-4">
            <div class="mt-3">
                {{ $QuestionList->links('pagination::bootstrap-5') }}
            </div>
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
    