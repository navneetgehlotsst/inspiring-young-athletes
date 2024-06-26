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

@if(session('success'))
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
        toastr.success('{{ session('success') }}');
    </script>
@endif

<style>
    .alert-info {
        color: #055160;
        background-color: #cff4fc;
        border-color: #b6effb;
    }
</style>
<!-- video Publisher Section Start-->
<section class="publisher-section themeix-ptb-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 m-auto">
                <div class="text-center">
                    <h2 class="text-white fw-bold">Questions And Answer</h2>
                    <p class="text-white">You need to answer 8 questions in total, that could be 5 athlete questions, one of your parents answer one of the parent questions, one of your old coaches (preferably from your teenage years) answers the coach question and give us a game day prep 30 second video as long as 8 answers are uploaded in total.</p>
                </div>
                <div class="complete-box-position">
                    <span class="complete-questions"><span class="h4" id="showanswerecount">@if($userAnswerCount == '0') 0 @else {{$userAnswerCount}} @endif</span> Complete</span>
                </div>
                <ul class="nav nav-pills justify-content-center mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item questions-answer-tap" role="presentation">
                        <a href="#pills-athletes" class="btn tab-btn-white active" id="pills-home-tab" data-toggle="tab" data-bs-toggle="pill" data-bs-target="#pills-athletes" type="button" role="tab" aria-controls="pills-athletes" aria-selected="true">Athletes</a>
                    </li>
                    <li class="nav-item questions-answer-tap" role="presentation">
                        <a href="#pills-parents" class="btn tab-btn-white" id="pills-profile-tab" data-toggle="tab" data-bs-toggle="pill" data-bs-target="#pills-parents" type="button" role="tab" aria-controls="pills-parents" aria-selected="false">Parents</a>
                    </li>
                    <li class="nav-item questions-answer-tap" role="presentation">
                        <a href="#pills-coaches" class="btn tab-btn-white" id="pills-contact-tab" data-toggle="tab" data-bs-toggle="pill" data-bs-target="#pills-coaches" type="button" role="tab" aria-controls="pills-coaches" aria-selected="false">Coaches</a>
                    </li>
                    <li class="nav-item questions-answer-tap" role="presentation">
                        <a href="#pills-frenzy" class="btn tab-btn-white" id="pills-contact-tab" data-toggle="tab" data-bs-toggle="pill" data-bs-target="#pills-frenzy" type="button" role="tab" aria-controls="pills-frenzy" aria-selected="false">Game Day Prep</a>
                    </li>
                    {{-- <li class="nav-item questions-answer-tap" role="presentation">
                        <button class="btn tab-btn-white" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-female" type="button" role="tab" aria-controls="pills-frenzy" aria-selected="false">Female Athletes</button>
                    </li> --}}
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-athletes" role="tabpanel" aria-labelledby="pills-home-tab">
                        <!--Athletes Questions Start-->
                        <div class="from-box p-3 p-lg-5">
                            <div class="row">
                                <div class="col-lg-8 col-8 alert alert-info">
                                    If you choose the wrong option and need to switch between athlete and coach, <a href="{{ route('web.athletes.coach.update.role') }}" class="fw-bold">Click Here</a>
                                </div>
                                <div class="col-lg-9 col-9">
                                    <h4 class="fw-bold">Questions for athletes:</h4>
                                    <h5 class="">{{$questionforathletes}} Questions</h5>
                                    <p>You need to answer 8 questions in total, that could be 5 athlete questions, one of your parents answer one of the parent questions, one of your old coaches (preferably from your teenage years) answers the coach question and give us a game day prep 30 second video as long as 8 answers are uploaded in total.</p>
                                </div>
                                <div class="col-lg-4 col-4 text-end">
                                    {{-- <span class="complete-questions"><span class="h4" id="showanswerecount">@if($userAnswerCount == '0') 0 @else {{$userAnswerCount}} @endif</span> Complete</span> --}}
                                </div>
                            </div>
                            <div class="questions-answer-section">
                                <div class="accordion" id="accordionAthletesQuestions">
                                    @php $i = 1; @endphp
                                    @foreach($question as $questionList)
                                        @if($questionList->question_type == "for_athletes")
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingQuestions{{$questionList->question_id}}">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseQuestions{{$questionList->question_id}}" aria-expanded="true" aria-controls="collapseQuestions1">
                                                        <span class="questions-complete-img @if(in_array($questionList->question_id, $userAns)) @else d-none @endif" id="ansGiven{{$questionList->question_id}}">
                                                            <i class="text-success fas fa-check-circle"></i>
                                                        </span>
                                                        <p class="h6">
                                                            <strong>{{$i++}}.</strong>
                                                            {!!$questionList->question!!}
                                                        </p>
                                                    </button>
                                                </h2>
                                                <div id="collapseQuestions{{$questionList->question_id}}" class="accordion-collapse collapse @if($i == 2) show @endif" aria-labelledby="headingQuestions{{$questionList->question_id}}" data-bs-parent="#accordionAthletesQuestions">
                                                    <div class="accordion-body position-relative">
                                                        <form id="imageUploadForm{{$questionList->question_id}}" class="@if(in_array($questionList->question_id, $userAns)) d-none @endif" enctype="multipart/form-data">
                                                            <div class="mb-4">
                                                                <input type="hidden" name="questiontype" value="{{$questionList->question_type}}">
                                                                <input type="hidden" name="questionid" value="{{$questionList->question_id}}">
                                                                <input class="choose-btn-iyg" name="video" id="formFileLg{{$questionList->question_id}}" type="file" accept="video/mp4,video/x-m4v,video/*" onchange="uploadImage({{$questionList->question_id}})" />
                                                            </div>
                                                        </form>
                                                        <button type="button" id="removevideobutton{{$questionList->question_id}}" class="btn btn-danger @if(in_array($questionList->question_id, $userAns))  @else d-none @endif" onclick="removevideo({{$questionList->question_id}})">Remove</button>
                                                        <div id="uploadStatus{{$questionList->question_id}}"></div>
                                                        <div id="progress-bar-container{{$questionList->question_id}}" style="display: none;">
                                                            {{-- <div id="progress-bar{{$questionList->question_id}}"></div> --}}
                                                            {{-- <progress id="progress-bar{{$questionList->question_id}}" value="0" max="100"></progress> --}}
                                                            <div class="progress">
                                                                <div class="progress-bar customprogressbar" id="progress-bar{{$questionList->question_id}}" role="progressbar" value="0" max="100">0%</div>
                                                                <a class="text-danger close-btn-onclick-btn" onclick="cancelUploade()" btn btn-primary><i class="fas fa-times-circle"></i></a>
                                                            </div>
                                                            {{-- <div id="progress-text{{$questionList->question_id}}">0%</div> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!--Athletes Questions End-->
                    </div>
                    <div class="tab-pane fade" id="pills-parents" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <!--Parents Questions Start-->
                        <div class="from-box p-3 p-lg-5 mt-3">
                            <div class="row">
                                <div class="col-lg-8 col-8">
                                    <h4 class="fw-bold">Questions for Parents of professional athletes</h4>
                                    <h5 class="">1/{{$questionforparents}} Questions</h5>
                                    <p>Answer any 3 of our pre-determined questions as an athlete or coach to activate your account online</p>
                                </div>
                                <div class="col-lg-4 col-4 text-end">
                                    {{-- <span class="complete-questions"><span class="h4">0</span> Complete</span> --}}
                                </div>
                            </div>
                            <div class="questions-answer-section">
                                <div class="accordion" id="accordionParents">
                                    @php $i = 1; @endphp
                                    @foreach($question as $questionList)
                                        @if($questionList->question_type == "for_parents")
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingQuestions{{$questionList->question_id}}">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseQuestions{{$questionList->question_id}}" aria-expanded="true" aria-controls="collapseQuestions1">
                                                        <span class="questions-complete-img @if(in_array($questionList->question_id, $userAns)) @else d-none @endif" id="ansGiven{{$questionList->question_id}}">
                                                            <i class="text-success fas fa-check-circle"></i>
                                                        </span>
                                                        <p class="h6">
                                                            <strong>{{$i++}}.</strong>
                                                            {!!$questionList->question!!}
                                                        </p>
                                                    </button>
                                                </h2>
                                                <div id="collapseQuestions{{$questionList->question_id}}" class="accordion-collapse collapse @if($i == 2) show @endif" aria-labelledby="headingQuestions{{$questionList->question_id}}" data-bs-parent="#accordionAthletesQuestions">
                                                    <div class="accordion-body position-relative">
                                                        <form id="imageUploadForm{{$questionList->question_id}}" class="@if(in_array($questionList->question_id, $userAns)) d-none @endif" enctype="multipart/form-data">
                                                            <div class="mb-4">
                                                                <input type="hidden" name="questiontype" value="{{$questionList->question_type}}">
                                                                <input type="hidden" name="questionid" value="{{$questionList->question_id}}">
                                                                <input class="choose-btn-iyg" name="video" id="formFileLg{{$questionList->question_id}}" type="file" accept="video/mp4,video/x-m4v,video/*" onchange="uploadImage({{$questionList->question_id}})" />
                                                            </div>
                                                        </form>
                                                        <button type="button" id="removevideobutton{{$questionList->question_id}}" class="btn btn-danger @if(in_array($questionList->question_id, $userAns))  @else d-none @endif" onclick="removevideo({{$questionList->question_id}})">Remove</button>
                                                        <div id="uploadStatus{{$questionList->question_id}}"></div>
                                                        <div id="progress-bar-container{{$questionList->question_id}}" style="display: none;">
                                                            {{-- <div id="progress-bar{{$questionList->question_id}}"></div> --}}
                                                            {{-- <progress id="progress-bar{{$questionList->question_id}}" value="0" max="100"></progress> --}}
                                                            <div class="progress">
                                                                <div class="progress-bar customprogressbar" id="progress-bar{{$questionList->question_id}}" role="progressbar" value="0" max="100">0%</div>
                                                                <a class="text-danger close-btn-onclick-btn" onclick="cancelUploade()" btn btn-primary><i class="fas fa-times-circle"></i></a>
                                                            </div>
                                                            {{-- <div id="progress-text{{$questionList->question_id}}">0%</div> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!--Parents Questions End-->
                    </div>
                    <div class="tab-pane fade" id="pills-coaches" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <!--coaches and teenager Questions Start-->
                        <div class="from-box p-3 p-lg-5 mt-3">
                            <div class="row mb-3">
                                <div class="col-lg-8 col-8">
                                    <h4 class="fw-bold">Question from one of your coaches you had as a teenager</h4>
                                </div>
                                <div class="col-lg-4 col-4 text-end">
                                    {{-- <span class="complete-questions"><span class="h4">0</span> Complete</span> --}}
                                </div>
                            </div>
                            <div class="questions-answer-section">
                                <div class="accordion" id="accordionCoaches">
                                    @php $i = 1; @endphp
                                    @foreach($question as $questionList)
                                        @if($questionList->question_type == "for_athletes_coaches")
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingQuestions{{$questionList->question_id}}">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseQuestions{{$questionList->question_id}}" aria-expanded="true" aria-controls="collapseQuestions1">
                                                        <span class="questions-complete-img @if(in_array($questionList->question_id, $userAns)) @else d-none @endif" id="ansGiven{{$questionList->question_id}}">
                                                            <i class="text-success fas fa-check-circle"></i>
                                                        </span>
                                                        <p class="h6">
                                                            <strong>{{$i++}}.</strong>
                                                            {!!$questionList->question!!}
                                                        </p>
                                                    </button>
                                                </h2>
                                                <div id="collapseQuestions{{$questionList->question_id}}" class="accordion-collapse collapse @if($i == 2) show @endif" aria-labelledby="headingQuestions{{$questionList->question_id}}" data-bs-parent="#accordionAthletesQuestions">
                                                    <div class="accordion-body position-relative">
                                                        <form id="imageUploadForm{{$questionList->question_id}}" class="@if(in_array($questionList->question_id, $userAns)) d-none @endif" enctype="multipart/form-data">
                                                            <div class="mb-4">
                                                                <input type="hidden" name="questiontype" value="{{$questionList->question_type}}">
                                                                <input type="hidden" name="questionid" value="{{$questionList->question_id}}">
                                                                <input class="choose-btn-iyg" name="video" id="formFileLg{{$questionList->question_id}}" type="file" accept="video/mp4,video/x-m4v,video/*" onchange="uploadImage({{$questionList->question_id}})" />
                                                            </div>
                                                        </form>
                                                        <button type="button" id="removevideobutton{{$questionList->question_id}}" class="btn btn-danger @if(in_array($questionList->question_id, $userAns))  @else d-none @endif" onclick="removevideo({{$questionList->question_id}})">Remove</button>
                                                        <div id="uploadStatus{{$questionList->question_id}}"></div>
                                                        <div id="progress-bar-container{{$questionList->question_id}}" style="display: none;">
                                                            {{-- <div id="progress-bar{{$questionList->question_id}}"></div> --}}
                                                            {{-- <progress id="progress-bar{{$questionList->question_id}}" value="0" max="100"></progress> --}}
                                                            <div class="progress">
                                                                <div class="progress-bar customprogressbar" id="progress-bar{{$questionList->question_id}}" role="progressbar" value="0" max="100">0%</div>
                                                                <a class="text-danger close-btn-onclick-btn" onclick="cancelUploade()" btn btn-primary><i class="fas fa-times-circle"></i></a>
                                                            </div>
                                                            {{-- <div id="progress-text{{$questionList->question_id}}">0%</div> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!--coaches and teenager Questions End-->
                    </div>
                    <div class="tab-pane fade" id="pills-frenzy" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <!--Question for Friday Frenzy Start-->
                        <div class="from-box p-3 p-lg-5 mt-3">
                            <div class="row mb-3">
                                <div class="col-lg-8 col-8">
                                    <h4 class="fw-bold">Question for Friday Frenzy</h4>
                                </div>
                                <div class="col-lg-4 col-4 text-end">
                                    {{-- <span class="complete-questions"><span class="h4">0</span> Complete</span> --}}
                                </div>
                            </div>
                            <div class="questions-answer-section">
                                <div class="accordion" id="accordionFrenzy">
                                    @php $i = 1; @endphp
                                    @foreach($question as $questionList)
                                        @if($questionList->question_type == "for_friday_frenzy")
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingQuestions{{$questionList->question_id}}">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseQuestions{{$questionList->question_id}}" aria-expanded="true" aria-controls="collapseQuestions1">
                                                        <span class="questions-complete-img @if(in_array($questionList->question_id, $userAns)) @else d-none @endif" id="ansGiven{{$questionList->question_id}}">
                                                            <i class="text-success fas fa-check-circle"></i>
                                                        </span>
                                                        <p class="h6">
                                                            <strong>{{$i++}}.</strong>
                                                            {!!$questionList->question!!}
                                                        </p>
                                                    </button>
                                                </h2>
                                                <div id="collapseQuestions{{$questionList->question_id}}" class="accordion-collapse collapse @if($i == 2) show @endif" aria-labelledby="headingQuestions{{$questionList->question_id}}" data-bs-parent="#accordionAthletesQuestions">
                                                    <div class="accordion-body position-relative">
                                                        <form id="imageUploadForm{{$questionList->question_id}}" class="@if(in_array($questionList->question_id, $userAns)) d-none @endif" enctype="multipart/form-data">
                                                            <div class="mb-4">
                                                                <input type="hidden" name="questiontype" value="{{$questionList->question_type}}">
                                                                <input type="hidden" name="questionid" value="{{$questionList->question_id}}">
                                                                <input class="choose-btn-iyg" name="video" id="formFileLg{{$questionList->question_id}}" accept="video/mp4,video/x-m4v,video/*" type="file" onchange="uploadImage({{$questionList->question_id}})" />
                                                            </div>
                                                        </form>
                                                        <button type="button" id="removevideobutton{{$questionList->question_id}}" class="btn btn-danger @if(in_array($questionList->question_id, $userAns))  @else d-none @endif" onclick="removevideo({{$questionList->question_id}})">Remove</button>
                                                        <div id="uploadStatus{{$questionList->question_id}}"></div>
                                                        <div id="progress-bar-container{{$questionList->question_id}}" style="display: none;">
                                                            {{-- <div id="progress-bar{{$questionList->question_id}}"></div> --}}
                                                            {{-- <progress id="progress-bar{{$questionList->question_id}}" value="0" max="100"></progress> --}}
                                                            <div class="progress">
                                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" id="progress-bar{{$questionList->question_id}}" role="progressbar" value="0" max="100">0%</div>
                                                                <a class="text-danger close-btn-onclick-btn" onclick="cancelUploade()" btn btn-primary><i class="fas fa-times-circle"></i></a>
                                                            </div>
                                                            {{-- <div id="progress-text{{$questionList->question_id}}">0%</div> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!--Question for Friday Frenzy End-->
                    </div>

                </div>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div>

   
                        <h4 class="fw-bold text-white"><span id="compltedquestioncount">@if($userAnswerCount == '0') 0  @elseif($userAnswerCount > 8) 8 @else {{$userAnswerCount}} @endif</span>/8 Questions Complete</h4>
                        <p class="text-white">You need to answer 8 questions in total, that could be 5 athlete questions, one of your parents answer one of the parent questions, one of your old coaches (preferably from your teenage years) answers the coach question and give us a game day prep 30 second video as long as 8 answers are uploaded in total.</p>
                    </div>
                    <a href="javascript:void(0)" class="btn iya-btn-white py-3 fw-bold confrmationmsg @if($userAnswerCount < '8') disabled @else enable @endif" id="enabledisable">Go to Dashboard</a>
                    {{-- <a href="{{ route('web.athletes.coach.SaveAnswere') }}" class="btn iya-btn-white py-3 fw-bold enable" id="enabledisable">Go to Dashboard</a> --}}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- video Publisher Section End-->
@include('web.layouts.elements.newsletter')

@endsection
@section('script')
@endsection
