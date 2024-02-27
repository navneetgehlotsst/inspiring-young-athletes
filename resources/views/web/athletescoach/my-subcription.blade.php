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

<section class="dashboard-section">
    <div class="container">
        <div class="row">
            @include('web.layouts.elements.leftsidebar')
            <div class="col-lg-9 py-3">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">My Subscription</h1>                               
                </div>
                <!-- Content Row -->
                <div class="card shadow p-3">
                    <div class="card-body">
                        <div class="ground-list ground-hover-list">
                            <div class="ground ground-list-single">
                                <div class="ground-content">
                                    <div class="row py-5">
                                        <div class="col-lg-10 m-auto">
                                            <div class="row symigfl">
                                                <div class="col-lg-6 m-auto">
                                                    <div class="plan-box border py-5 text-center">
                                                        <h4 class="text-center py-3 text-uppercase">{{$resulplan->name ?? ''}}</h4>
                                                        <h1 class="amount-box text-center"><span class="dollar-icon">$</span>{{$resulplan->price ?? ''}}</h1>
                                                        <p class="text-center">Every Month</p>
                                                        <p class="text-center">{{$resulplan->description ?? ''}}</p>
                                                        @if(empty($result))
                                                            <a href="{{ route('web.joinnow') }}" class="btn btn-primary w-50 m-auto">Get Membership</a>
                                                        @else
                                                            @if($result->ends_at == "")
                                                                <a href="{{route('web.athletes.coach.cancel_subcription')}}" class="btn btn-danger w-50 m-auto">Cancel Membership</a>
                                                            @else
                                                                <a href="{{route('web.athletes.coach.resume_subcription')}}" class="btn btn-primary w-50 m-auto">Resume Membership</a>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
            
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
    