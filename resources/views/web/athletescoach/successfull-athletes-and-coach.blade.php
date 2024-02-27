@extends('web.layouts.app')
@section('content')

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
                        <div class="accordion-body">
                            <p class="fw-bold text-center">Please Add 30 second video giving introduction about your self like Your Name and Which Sport you played.</p>
                            <form id="imageUploadFormintro" class="d-flex justify-content-center" enctype="multipart/form-data">
                                <div class="mb-4">
                                    <input type="hidden" name="questiontype" value="QA">
                                    <input type="hidden" name="questionid" value="0">
                                    <input class="choose-btn-iyg" name="video" id="formFileLgintro" accept="video/mp4,video/x-m4v,video/*" type="file" onchange="uploadImage('intro')" />
                                </div>
                            </form>
                            <button type="button" id="removevideobuttonintro" class="btn btn-danger d-none" onclick="removevideo('intro')">Remove</button>
                            <div id="uploadStatusintro"></div>
                            <div id="progress-bar-containerintro" style="display: none;">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" id="progress-barintro" role="progressbar" value="0" max="100">0%</div>
                                </div>
                            </div>
                        </div>
                    <a href="{{ route('web.athletes.coach.atheliticsCoachQuestion') }}" class="btn btn-primary py-3 w-100 fw-bold login-btn">Continue</a>
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
