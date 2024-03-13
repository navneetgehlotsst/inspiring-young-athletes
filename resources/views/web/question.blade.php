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
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link fw-bold active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#for_athletes" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Athletics</button>
                                            <button class="nav-link fw-bold" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#for_parents" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Parents</button>
                                            <button class="nav-link fw-bold" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#for_athletes_coaches" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Coaches</button>
                                            <button class="nav-link fw-bold" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#for_friday_frenzy" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Game Day Prep</button>
                                            {{-- <button class="nav-link fw-bold" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#for_female_athletes" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Female Athletes</button> --}}
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="for_athletes" role="tabpanel" aria-labelledby="nav-home-tab">
                                            @php $athi = 1; @endphp
                                            @foreach($AthletesList as $athletesList)
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingParents1">
                                                    <button class="accordion-button" type="button">
                                                        <a href="{{ route('web.question.video',$athletesList->question_id) }}" class="h6"><strong>{{$athi++}}. </strong>{!!$athletesList->question!!}</a>    
                                                    </button>
                                                </h2>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="tab-pane fade" id="for_parents" role="tabpanel" aria-labelledby="nav-profile-tab">
                                            @php $pari = 1; @endphp
                                            @foreach($parentList as $parentLists)
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingParents1">
                                                    <button class="accordion-button" type="button">
                                                        <a href="{{ route('web.question.video',$parentLists->question_id) }}" class="h6"><strong>{{$pari++}}. </strong>{{$parentLists->question}}</a>    
                                                    </button>
                                                </h2>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="tab-pane fade" id="for_athletes_coaches" role="tabpanel" aria-labelledby="nav-contact-tab">
                                            @php $athchi = 1; @endphp
                                            @foreach($atheliticsCoachesList as $atheliticsCoaches)
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingParents1">
                                                    <button class="accordion-button" type="button">
                                                        <a href="{{ route('web.question.video',$atheliticsCoaches->question_id) }}" class="h6"><strong>{{$athchi++}}. </strong>{{$atheliticsCoaches->question}}</a>    
                                                    </button>
                                                </h2>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="tab-pane fade" id="for_friday_frenzy" role="tabpanel" aria-labelledby="nav-contact-tab">
                                            @php $frii = 1; @endphp
                                            @foreach($fridayfrenziList as $fridayfrenzi)
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingParents1">
                                                    <button class="accordion-button" type="button">
                                                        <a href="{{ route('web.question.video',$fridayfrenzi->question_id) }}" class="h6"><strong>{{$frii++}}. </strong>{{$fridayfrenzi->question}}</a>    
                                                    </button>
                                                </h2>
                                            </div>
                                            @endforeach
                                        </div>
                                        {{-- <div class="tab-pane fade" id="for_female_athletes" role="tabpanel" aria-labelledby="nav-contact-tab">
                                            @php $fmale = 1; @endphp
                                            @foreach($forfemaleathletes as $forfemaleathlete)
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingParents1">
                                                    <button class="accordion-button" type="button">
                                                        <a href="{{ route('web.question.video',$forfemaleathlete->question_id) }}" class="h6"><strong>{{$fmale++}}. </strong>{{$forfemaleathlete->question}}</a>    
                                                    </button>
                                                </h2>
                                            </div>
                                            @endforeach
                                        </div> --}}
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

@include('web.layouts.elements.newsletter')


@endsection 
@section('script') 
@endsection
    