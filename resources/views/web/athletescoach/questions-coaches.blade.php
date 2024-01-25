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
        <div class="row">
            <div class="col-lg-10 m-auto">
                <div class="text-center">
                    <h2 class="text-white fw-bold">Questions And Answer</h2>
                    <p class="text-white">Answer any 8 of our pre-determined questions as an athlete or coach to activate your account online</p>
                </div>
                <div class="complete-box-position">
                    <span class="complete-questions"><span class="h4 pt-3" id="showanswerecount">@if($userAnwereCount == '0') 0 @else {{$userAnwereCount}} @endif</span> Complete</span>
                </div>
                <!--Athletes Questions Start-->
                <div class="from-box p-3 p-lg-5">
                    <div class="row">
                        <div class="col-lg-8 col-8">
                            <h4 class="fw-bold">Questions for Coach:</h4>
                            <h5 class="">{{$questionCount}} Questions</h5>
                            <p>Answer any 8 of our pre-determined questions as an athlete or coach to activate your account online</p>
                        </div>
                        <div class="col-lg-4 col-4 text-end">
                            {{-- <span class="complete-questions"><span class="h4 pt-3">0</span> Complete</span> --}}
                        </div>
                    </div>
                    <div class="questions-answer-section">
                        <div class="accordion" id="accordionAthletesQuestions">
                            @php $i = 1; @endphp
                            @foreach($question as $questionList)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingQuestions{{$questionList->question_id}}">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseQuestions{{$questionList->question_id}}" aria-expanded="true" aria-controls="collapseQuestions1">
                                            <span class="questions-complete-img @if(in_array($questionList->question_id, $userAns)) @else d-none @endif" id="ansGiven{{$questionList->question_id}}">
                                                <i class="text-success fas fa-check-circle"></i>
                                            </span>
                                            <p class="h6 ps-3">
                                                <strong>{{$i++}}.</strong>
                                                {{$questionList->question}}
                                            </p>
                                        </button>
                                    </h2>
                                    <div id="collapseQuestions{{$questionList->question_id}}" class="accordion-collapse collapse @if($i == 2) show @endif" aria-labelledby="headingQuestions{{$questionList->question_id}}" data-bs-parent="#accordionAthletesQuestions">
                                        <div class="accordion-body">
                                            <form id="imageUploadForm{{$questionList->question_id}}" class="@if(in_array($questionList->question_id, $userAns)) d-none @endif" enctype="multipart/form-data">
                                                <div class="mb-4">
                                                    <input type="hidden" name="questiontype" value="{{$questionList->question_type}}">
                                                    <input type="hidden" name="questionid" value="{{$questionList->question_id}}">
                                                    <input class="choose-btn-iyg" name="vedio" id="formFileLg{{$questionList->question_id}}" type="file" accept="video/mp4,video/x-m4v,video/*" onchange="uploadImage({{$questionList->question_id}})" />
                                                </div>
                                            </form>
                                            <button type="button" id="removevediobutton{{$questionList->question_id}}" class="btn btn-danger @if(in_array($questionList->question_id, $userAns))  @else d-none @endif" onclick="removeVedio({{$questionList->question_id}})">Remove</button>
                                            <div id="uploadStatus{{$questionList->question_id}}"></div>
                                            <div id="progress-bar-container{{$questionList->question_id}}" style="display: none;">
                                                {{-- <div id="progress-bar{{$questionList->question_id}}"></div> --}}
                                                {{-- <progress id="progress-bar{{$questionList->question_id}}" value="0" max="100"></progress> --}}
                                                <div class="progress">
                                                    <div class="progress-bar customprogressbar" id="progress-bar{{$questionList->question_id}}" role="progressbar" value="0" max="100">0%</div>
                                                </div>
                                                {{-- <div id="progress-text{{$questionList->question_id}}">0%</div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!--Athletes Questions End-->
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div>
                        <h4 class="fw-bold text-white"><span id="compltedquestioncount">@if($userAnwereCount == '0') 0  @elseif($userAnwereCount > 8) 8 @else {{$userAnwereCount}} @endif</span>/8 Questions Complete</h4>
                        <p class="text-white">Answer any 8 of our pre-determined questions as an athlete or coach to activate your account online</p>
                    </div>
                    {{-- <a href="{{ route('web.athletes.coach.SaveAnswere') }}" class="btn iya-btn-white py-3 fw-bold enable" id="enabledisable">Go to Dashboard</a> --}}
                    <a href="{{ route('web.athletes.coach.SaveAnswere') }}" class="btn iya-btn-white py-3 fw-bold @if($userAnwereCount > '1') disabled @else enable @endif" id="enabledisable">Go to Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Video Publisher Section End-->
<!-- Start Call To Action Area -->
<div class="call-to-action-area py-5">
    <div class="container">
        <div class="row py-5">
            <div class="col-md-12">
                <div class="action-content text-center pb-5">
                    <h2 class="text-dark fw-bold lh-base">Dont miss out on the latest updates, promotions, and exclusive content. Sign up for our newsletters by entering your email address below.</h2>
                </div>
            </div>
            <div class="col-md-6 m-auto">
                <div class="subscribe-section">
                    <input type="email" placeholder="Enter your email" />
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
