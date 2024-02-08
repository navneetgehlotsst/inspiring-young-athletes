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
                            <li class="page-item"><a href="#" class="page-link">Today</a></li>
                            <li class="page-item"><a href="#" class="page-link">Week</a></li>
                            <li class="page-item active"><a href="#" class="page-link">Month</a></li>
                            <li class="page-item"><a href="#" class="page-link">Year</a></li>
                            <li class="page-item"><a href="#" class="page-link">Custom</a></li>                                
                        </ul>
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
                                        <div class="mb-0 h3">{{$UniqueViews}}</div>
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
                                        <div class="mb-0 h3">$50,200</div>
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
                                        <div class="mb-0 h3">$1,200</div>
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
                                <h6 class="m-0 font-weight-bold text-dark">Monthly Video Views</h6>
                            </div>
                            <div class="card-body">
                                <canvas id="myChart" style="width:100%; width:100%"></canvas>
                            </div>
                        </div>

                        <!-- Color System -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 border-0 bg-white">
                                <h6 class="m-0 font-weight-bold text-dark">Monthly Video Views</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                      <thead class="border-bottom">
                                        <tr>
                                          <th scope="col" class="border-0">#</th>
                                          <th scope="col" class="border-0">Video Name</th>
                                          <th scope="col" class="border-0">Views</th>
                                          <th scope="col" class="text-center border-0">Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <th scope="row" class="align-middle py-4">1</th>
                                          <td class="align-middle py-4">Lorem sit amet, consectetur adipiscing elit.</td>
                                          <td class="align-middle py-4">15,52,200</td>
                                          <td class="text-center align-middle"><a href="#" class="btn btn-dark py-1">View</a></td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="align-middle py-4">2</th>
                                            <td class="align-middle py-4">Lorem sit amet, consectetur adipiscing elit.</td>
                                            <td class="align-middle py-4">15,52,200</td>
                                            <td class="text-center align-middle"><a href="#" class="btn btn-dark py-1">View</a></td>
                                          </tr>
                                          <tr>
                                            <th scope="row" class="align-middle py-4">3</th>
                                            <td class="align-middle py-4">Lorem sit amet, consectetur adipiscing elit.</td>
                                            <td class="align-middle py-4">15,52,200</td>
                                            <td class="text-center align-middle"><a href="#" class="btn btn-dark py-1">View</a></td>
                                          </tr>
                                          <tr>
                                            <th scope="row" class="align-middle py-4">4</th>
                                            <td class="align-middle py-4">Lorem sit amet, consectetur adipiscing elit.</td>
                                            <td class="align-middle py-4">15,52,200</td>
                                            <td class="text-center align-middle"><a href="#" class="btn btn-dark py-1">View</a></td>
                                          </tr>
                                          <tr>
                                            <th scope="row" class="align-middle py-4">5</th>
                                            <td class="align-middle py-4">Lorem sit amet, consectetur adipiscing elit.</td>
                                            <td class="align-middle py-4">15,52,200</td>
                                            <td class="text-center align-middle"><a href="#" class="btn btn-dark py-1">View</a></td>
                                          </tr>
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

@endsection 
@section('script')
@endsection
    