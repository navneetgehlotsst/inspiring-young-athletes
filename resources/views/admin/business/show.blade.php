@extends('admin.layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right mr-2" style="display: block">
                    <a href="{{route('admin.business.index')}}" class="btn btn-primary btn-primary-gs">< Go back </a>
                </div>
                <h4 class="page-title">Business Detail</h4>
                
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card text-center">
                <div class="card-body">
                    @if(!empty($data->avatar))
                        <img src="{{asset($data->avatar)}}" rounded-circle avatar-lg img-thumbnail" alt="profile-image" width="150px">
                    @else
                        <img src="{{asset("assets/admin/images/demo-user.png")}}" rounded-circle avatar-lg img-thumbnail" alt="profile-image" width="150px">
                    @endif

                    
                    <div class="text-left mt-3">
                        <div class="nav nav-pills bg-nav-pills nav-justified mb-3">
                            <a href="javascript:void(0);" data-toggle="tab" aria-expanded="false" class="nav-link rounded-0">General Info</a>
                        </div>
                        <p class="text-muted mb-2 font-13"><strong>Business Name :</strong> <span class="ml-2">{{$data->business_name}}</span></p>
                        <p class="text-muted mb-2 font-13"><strong>Contact Person Name :</strong> <span class="ml-2">{{$data->full_name}}</span></p>

                        <p class="text-muted mb-2 font-13"><strong>Phone Number :</strong><span class="ml-2">({{$data->country_code}}) {{$data->phone}}</span></p>

                        <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ml-2 ">{{$data->email}}</span></p>
                        <p class="text-muted mb-1 font-13"><strong>Location :</strong> <span class="ml-2">{{$data->address}}</span></p>
                    </div>
                    <div class="text-left mt-3">
                        <div class="nav nav-pills bg-nav-pills nav-justified mb-3">
                            <a href="javascript:void(0);" data-toggle="tab" aria-expanded="false" class="nav-link rounded-0">Business Category</a>
                        </div>
                        @if(!empty($category))
                        <p class="text-muted mb-1 font-13"><strong>Category :</strong> </p>
                        <p class="text-muted mb-1 font-13">
                            @foreach($category as $key => $cat)
                                <span class="ml-2">{{$catList[$cat]}}</span><br/> 
                            @endforeach
                        </p>
                        @else 
                            <p class="text-muted mb-1 font-13">No category yet.</P>
                        @endif    
                            
                    </div>
                    <div class="text-left mt-3">
                        <div class="nav nav-pills bg-nav-pills nav-justified mb-3">
                            <a href="javascript:void(0);" data-toggle="tab" aria-expanded="false" class="nav-link rounded-0">Business Operational hours & days</a>
                        </div>
                        @if(!$data->busOperation->isEmpty())
                        @foreach($data->busOperation as $operations)
                        <p class="text-muted mb-1 font-13">
                            <span class="">{{$operations->business_day}}</span> <span class="ml-2">{{date('g:i a',strtotime($operations->open_time))}}</span> – <span class="">{{date('g:i a',strtotime($operations->close_time))}} </span><br/>
                        </p>
                        @endforeach
                        @else
                            <p class="text-muted mb-1 font-13">No business operational hours & days yet.</P>
                        @endif
                    </div>
                    <div class="text-left mt-3">
                        <div class="nav nav-pills bg-nav-pills nav-justified mb-3">
                            <a href="javascript:void(0);" data-toggle="tab" aria-expanded="false" class="nav-link rounded-0">Bank Details</a>
                        </div>
                        @if(!empty($data->bank_name))
                        <p class="text-muted mb-1 font-13"><strong>Bank Name :</strong> <span class="ml-2">{{$data->bank_name}}</span></p>
                        <p class="text-muted mb-1 font-13"><strong>Account BSB :</strong> <span class="ml-2">{{$data->bsb}}</span></p>
                        <p class="text-muted mb-1 font-13"><strong>Account Number :</strong> <span class="ml-2">{{$data->account_number}}</span></p>
                        <p class="text-muted mb-1 font-13"><strong>Account Holder Name :</strong> <span class="ml-2">{{$data->account_holder_name}}</span></p>
                        @else 
                            <p class="text-muted mb-1 font-13">No Bank details yet.</P>
                        @endif
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div>    
    </div>
</div>
@endsection
