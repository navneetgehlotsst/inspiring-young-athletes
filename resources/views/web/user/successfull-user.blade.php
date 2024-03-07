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
                    <form>
                        <a href="{{ route('web.index') }}" class="btn btn-primary py-3 w-100 fw-bold login-btn">Back To home</a>
                    </form>
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
