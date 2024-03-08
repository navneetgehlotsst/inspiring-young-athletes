@extends('web.layouts.app') 
@section('content')
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
<section class="watch-video-free py-3">
    <div class="top-section text-center publisher-section pt-5 pb-5">
        <h2 class="text-white">Contact Us</h2>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-7 m-auto align-self-center">
                <div class="from-box p-5">
                    <div class="row">
                        <div class="col-lg-6 p-3">
                            Email us: <br />
                            <a href="mailto:info@inspiringyoungathletes.com">info@inspiringyoungathletes.com</a>
                        </div>

                        <div class="col-lg-6 p-3">
                            Contact us: <br />
                            <a href="tel:+610452327021"> +61 0452327021</a>
                        </div>
                    </div>
                    <form action="{{ route('web.contactus.create') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" class="form-control py-3 mb-4" name="name" placeholder="Your Name" required/>
                            </div>
                            <div class="col-lg-6">
                                <input type="email" class="form-control py-3 mb-4" name="email" placeholder="Enter your email" required/>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control py-3 mb-4" name="number" placeholder="Your number" required/>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control py-3 mb-4" name="organisation" placeholder="Your organisation" required/>
                            </div>
                        </div>
                        <textarea class="form-control py-3 mb-4" placeholder="Your Comments or enquriy" name="message" required></textarea>
                        <div class="row my-4">
                            <div class="col-md-8">
                                <div class="form-check form-switch ps-0">
                                    <input type="checkbox" required/>
                                    <label class="form-check-label" for="flexSwitchCheckChecked">I have read the Privacy Statement</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary py-3 w-100 fw-bold login-btn">Submit</button>
                    </form>
                </div>
            </div>
            <!--<div class="col-lg-5 mt-5">-->
            <!--    <div class="address-box">-->

            <!--        <a href="mailto:info@inspiringyoungathletes.com"><i class="fas fa-envelope me-2"></i> info@inspiringyoungathletes.com</a>-->
            <!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d24529.563023697665!2d-104.90487986852264!3d39.780170565431256!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x876c7b677c83826b%3A0xbec4ced5234ef641!2sHome2%20Suites%20by%20Hilton%20Denver%20Northfield!5e0!3m2!1sen!2sin!4v1701767020202!5m2!1sen!2sin" width="600" height="500" style="border:0; border-radius: 15px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>-->
            <!--    </div>-->
            <!--</div>-->
        </div>
    </div>
</section>


@endsection 
@section('script') 
@endsection
    