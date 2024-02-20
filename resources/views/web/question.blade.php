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
    .accordion-button:not(.collapsed)::after {
        display: none;
    }
</style>
{{-- <!-- Video Publisher Section Start-->
<section class="publisher-section themeix-ptb-2">
    <div class="container">
        <div class="website-title-white text-center">
            <h2 class="text-white">Question List</h2>
            <div class="border-box m-auto"></div>
        </div>
    </div>
</section> --}}
<!-- Video Publisher Section End-->
<section class="publisher-section themeix-ptb-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 m-auto">
                <div class="text-center">
                    <h2 class="text-white fw-bold">Questions And Answer</h2>
                    <p class="text-white">Answer any 8 of our pre-determined questions as an athlete or coach to activate your account online</p>
                </div>
                <ul class="nav nav-pills justify-content-center mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item questions-answer-tap" role="presentation">
                      <button class="btn tab-btn-white active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-athletes" type="button" role="tab" aria-controls="pills-athletes" aria-selected="true">Athletes</button>
                    </li>
                    <li class="nav-item questions-answer-tap" role="presentation">
                      <button class="btn tab-btn-white" id="pills-coachs-tab" data-bs-toggle="pill" data-bs-target="#pills-coachs" type="button" role="tab" aria-controls="pills-coachs" aria-selected="false">Coaches</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade active show" id="pills-athletes" role="tabpanel" aria-labelledby="pills-home-tab">
                        <!--Athletes Questions Start-->
                        <div class="from-box p-3 p-lg-5">
                            <div class="questions-answer-section">
                                <div class="accordion" id="accordionAthletesQuestions">
                                    @php $athi = 1; @endphp
                                    @foreach($AthletesList as $athletesList)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingParents1">
                                            <button class="accordion-button" type="button">
                                                <a href="{{ route('web.question.video',$athletesList->question_id) }}" class="h6"><strong>{{$athi++}}. </strong>{{$athletesList->question}}</a>    
                                            </button>
                                        </h2>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!--Athletes Questions End-->
                    </div>
                    <div class="tab-pane fade" id="pills-coachs" role="tabpanel" aria-labelledby="pills-coachs-tab">
                        <!--Parents Questions Start-->
                        <div class="from-box p-3 p-lg-5 mt-3">
                            <div class="questions-answer-section">
                                <div class="accordion" id="accordionParents">
                                    @php $chi = 1; @endphp
                                    @foreach($CoachList as $coachlist)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingParents1">
                                            <button class="accordion-button" type="button">
                                                <a href="{{ route('web.question.video',$coachlist->question_id) }}" class="h6"><strong>{{$chi++}}. </strong>{{$coachlist->question}}</a>    
                                            </button>
                                        </h2>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!--Parents Questions End-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Start Call To Action Area -->
<div class="call-to-action-area py-5 mt-0 mt-lg-0">
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
    