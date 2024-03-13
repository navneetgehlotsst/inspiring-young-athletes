@extends('admin.layouts.app') 
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                {{-- <div class="page-title-right">
                    <form class="form-inline">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-light" id="dash-daterange" disabled>
                                <div class="input-group-append">
                                    <span class="input-group-text bg-primary border-primary text-white">
                                        <i class="mdi mdi-calendar-range font-13"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div> --}}
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="row">
                <div class="col-lg-4">
                    <a href="{{route('admin.users.index')}}">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-right">
                                <i class="mdi mdi-account-multiple widget-icon"></i>
                            </div>
                            <h5 class="text-muted font-weight-normal mt-0" title="Number of Users">Users</h5>
                            <h3 class="mt-3 mb-3">{{$userCount}}</h3>
                            <p class="mb-0 text-muted">
                                {{-- <span class="text-success mr-2"><i class="mdi mdi-arrow-up-bold"></i> </span>
                                <span class="text-nowrap"></span>   --}}
                            </p>
                        </div>
                    </div>
                    </a>
                </div>

                <div class="col-lg-4">
                    <a href="{{route('admin.business.index')}}">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-right">
                                <i class=" widget-icon uil-bag"></i>
                            </div>
                            <h5 class="text-muted font-weight-normal mt-0" title="Number of Businesses">Businesses</h5>
                            <h3 class="mt-3 mb-3">{{$businessCount}}</h3>
                            <p class="mb-0 text-muted">
                                {{-- <span class="text-danger mr-2"><i class="mdi mdi-arrow-down-bold"></i> 1.08%</span>
                                <span class="text-nowrap">Since last month</span> --}}
                            </p>
                        </div> 
                    </div> 
                    </a>
                </div> 

                <div class="col-lg-4">
                    <a href="{{route('admin.plans.index')}}">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-right">
                                <i class="fa-solid fa-page"></i>
                                <i class="mdi mdi-currency-usd widget-icon"></i>
                            </div>
                            <h5 class="text-muted font-weight-normal mt-0" title="Number of Plans">Plans</h5>
                            <h3 class="mt-3 mb-3">{{$planCount}}</h3>
                            <p class="mb-0 text-muted">
                                {{-- <span class="text-danger mr-2"><i class="mdi mdi-arrow-down-bold"></i> 7.00%</span>
                                <span class="text-nowrap">Since last month</span> --}}
                            </p>
                        </div> 
                    </div>
                    </a> 
                </div> 

                {{-- <div class="col-lg-3">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-right">
                                <i class="mdi mdi-pulse widget-icon"></i>
                            </div>
                            <h5 class="text-muted font-weight-normal mt-0" title="Growth">Growth</h5>
                            <h3 class="mt-3 mb-3">+ 30.56%</h3>
                            <p class="mb-0 text-muted">
                                <span class="text-success mr-2"><i class="mdi mdi-arrow-up-bold"></i> 4.87%</span>
                                <span class="text-nowrap">Since last month</span>
                            </p>
                        </div> 
                    </div> 
                </div>  --}}
            </div> 
        
        </div> 

        {{-- <div class="col-xl-12  col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Projections Vs Actuals</h4>
                    <div id="high-performing-product" class="apex-charts" data-colors="#727cf5,#e3eaef"></div>
                </div> 
            </div> 

        </div>  --}}
    </div>
</div>
@endsection

@section('script')
@endsection