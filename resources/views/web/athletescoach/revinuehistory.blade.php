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



<section class="dashboard-section">
    <div class="container">
        <div class="row">
            @include('web.layouts.elements.leftsidebar')
            <div class="col-lg-9 py-3">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Revenue History</h1>                               
                </div>
                <div class="themeix-section-h">
                    <span class="heading-icon"><i class="far fa-play-circle"></i></span>
                    <h3>Revenue History</h3>
                </div>
                <div class="row g-4">
                    @if(!empty($userIncomes))
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Video Revenue</th>
                            <th scope="col">Referral Revenue</th>
                            <th scope="col">Month</th>
                            <th scope="col">Years</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($userIncomes as $userIncome )
                                <tr>
                                    <td>{{$userIncome->videorevenue}}</td>
                                    <td>{{$userIncome->referralrevenue}}</td>
                                    <td>{{$userIncome->month}}</td>
                                    <td>{{$userIncome->years}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        <p>No revenue history yet</p>
                    @endif
                </div>          
            </div>
        </div>
    </div>
</section>

@endsection 
@section('script')
@endsection
    