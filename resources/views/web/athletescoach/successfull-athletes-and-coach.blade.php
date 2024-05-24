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
<style>
    a.disabled {
        pointer-events: none;
        cursor: default;
    }
</style>
<!-- Video Publisher Section Start-->
<section class="publisher-section themeix-ptb-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="from-box p-5">
                    <div class="pb-3 text-center">
                        <img src="{{asset('web/assets/images/new-img/successfully-icon.svg')}}" alt="successfully" class="img-fluid">
                        <h2 class="fw-bold text-success mt-4">Successful!</h2>
                               <p class="fw-bold pt-3 mb-2">Your Email Address has been successfully verified</p>
                    </div>
                        <div class="accordion-body position-relative">
                            <p class="fw-bold text-center">Please add a 30 second introductory video of yourself stating your name, sport you play and accolades to date.</p>
                            <form id="imageUploadFormintro" class="d-flex justify-content-center" enctype="multipart/form-data">
                                <div class="mb-4 align-set">
                                    <input type="hidden" name="questiontype" value="QA">
                                    <input type="hidden" name="questionid" value="0">
                                    <input class="choose-btn-iyg" name="video" id="formFileLgintro" accept="video/mp4,video/x-m4v,video/*" type="file" onchange="uploadIntroVideo('intro')" />
                                </div>
                            </form>
                            <div id="uploadStatusintro"></div>
                            <div id="progress-bar-containerintro" style="display: none;">
                                <div class="progress" >
                                    <div class="progress-bar bg-success" id="progress-barintro" role="progressbar" value="0" max="100">0%</div>
                                    <a class="text-danger close-btn-onclick-btn" id="removeprogrssbarintro" onclick="cancelUploade()"><i class="fas fa-times-circle"></i></a>
                                </div>
                            </div>
                        </div>

                    <a href="{{ route('web.athletes.coach.atheliticsCoachQuestion') }}" class="btn btn-primary py-3 w-100 fw-bold login-btn disabled" id="saveintro">Continue</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Video Publisher Section End-->


@include('web.layouts.elements.newsletter')


@endsection
@section('script')


@endsection
