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
                    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    <div class="d-none d-sm-inline-block">
                        <ul class="pagination">
                            <li class="page-item @if(empty($by)) active @endif"><a href="{{ route('web.dashboard') }}" class="page-link">Month</a></li>
                            <li class="page-item @if(!empty($by)) active @endif"><a href="{{ route('web.dashboard', ['by' => 'year']) }}" class="page-link">Year</a></li>                                
                        </ul>
                    </div>
                            
                </div>
                <div class="row">
                    <div class="col-xl-12 col-md-12 mb-4">
                        @if($user->stripe_account_status == '0')
                        <div class="card border-danger mb-3" style="max-width: 100%;">
                            <div class="card-body text-dark">
                                <p class="card-text">Please provide us your <a href="{{ route('web.bank.index') }}" class="text-danger fw-bold">payout details</a> so that we can pay you once you accrue earnings.</p>
                            </div>
                        </div>        
                        @elseif($user->stripe_account_status == '2')
                        <div class="card border-danger mb-3" style="max-width: 100%;">
                            <div class="card-body text-dark">
                                <p class="card-text">Please Update Your pendancy in <a href="{{ route('web.bank.index') }}" class="text-danger fw-bold">payout details</a> so that we can pay you once you accrue earnings.</p>
                            </div>
                        </div>
                        @else
                        @endif
                        @if (!empty($introVideoCheck))
                            @if($introVideoCheck->video_status == '2')
                                <div class="card border-warning mb-3" style="max-width: 100%;">
                                    <div class="card-body text-dark">
                                        <p class="card-text">Your intro video is rejected <a href="{{ route('web.Video.edit.video', $introVideoCheck->video_id ) }}" class="text-warning fw-bold">Update Intro Video</a></p>
                                    </div>
                                </div>
                            @endif
                            
                        @else
                            {{-- <div class="card border-warning mb-3" style="max-width: 100%;">
                                <div class="card-body text-dark">
                                    <p class="card-text">Your intro video is rejected <a href="{{ route('web.Video.edit.video', $introVideoCheck->video_id ) }}" class="text-warning fw-bold">Update Intro Video</a></p>
                                </div>
                            </div> --}}
                        @endif
                    </div>
                </div>
                <!-- Content Row -->
                <div class="row">

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 px-3 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs text-dark mb-2 h6">
                                            Unique Views </div>
                                        <div class="mb-0 h3">{{$uniqueViews}}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-chart-bar text-success h1 text-green"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 px-3 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs text-dark mb-2 h6">
                                            Video Revenue </div>
                                        @if(!empty($userIncome->videorevenue))
                                        <div class="mb-0 h3">${{$userIncome->videorevenue}}</div>
                                        @else
                                        <div class="mb-0 h3">$0</div>
                                        @endif
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-coins text-warning h1 text-green"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 px-3 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs text-dark mb-2 h6">
                                            Referral Revenue </div>
                                        @if(!empty($userIncome->referralrevenue))
                                        <div class="mb-0 h3">${{$userIncome->referralrevenue}}</div>
                                        @else
                                        <div class="mb-0 h3">$0</div>
                                        @endif
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-coins text-success h1 text-green"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                </div>
                <!-- Content Row -->
                <div class="row">

                    <!-- Content Column -->
                    <div class="col-lg-12 mb-4">

                        <!-- Project Card Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 bg-white">
                                <h6 class="m-0 font-weight-bold text-dark">{{$type}} Video Views</h6>
                            </div>
                            <div class="card-body">
                                <canvas id="myChart" style="width:100%; width:100%"></canvas>
                            </div>
                        </div>

                        <!-- Color System -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 border-0 bg-white">
                                <h6 class="m-0 font-weight-bold text-dark">{{$type}} Video Views</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                      <thead class="border-bottom">
                                        <tr>
                                          <th scope="col" class="border-0">Video Name</th>
                                          <th scope="col" class="border-0">Views</th>
                                          <th scope="col" class="text-center border-0">Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach ($videoLists as $videoList)
                                            <tr>
                                                <td class="align-middle py-4">{{$videoList->video_title}}</td>
                                                <td class="align-middle py-4">{{$videoList->video_veiw_count}}</td>
                                                <td class="text-center align-middle"><a href="{{ route('web.Video.viewVideo',$videoList->video_id) }}" class="btn btn-dark py-1">View</a></td>
                                            </tr>
                                        @endforeach
                                      </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script>

        const xValues = {{ Js::from($date) }};
        const yValues = {{ Js::from($count) }};
    
    new Chart("myChart", {
      type: "bar",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: "#55BFCF",
          data: yValues,
          borderSkipped: false,
        }]
      },
      options: {
        legend: {display: false},
        title: {
          display: true,
        //   text: "World Wine Production 2018"
        },
        // scales: {
        //     yAxes: [{ticks: {min: 0, max:200}}],
            
        // }

        scales: {
            xAxes: [{
                gridLines: {
                    display:false
                }
            }],
            yAxes: [{
                gridLines: {
                    display:false
                }   
            }]
        }
        
      }
    });
</script>
@endsection 
@section('script')
@endsection
    