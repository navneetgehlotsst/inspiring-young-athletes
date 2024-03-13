@extends('admin.layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right mr-2" style="display: block">
                    <a href="{{route('admin.users.index')}}" class="btn btn-primary btn-primary-gs">< Go back </a>
                </div>
                <h4 class="page-title">User Detail</h4>
                
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card text-center">
                <div class="card-body">
                    @if(!empty($data->avtar))
                        <img src="{{asset('uploads/user/images/'.$data->avtar)}}" rounded-circle avatar-lg img-thumbnail" alt="profile-image" width="150px">
                    @else
                        <img src="{{asset("assets/admin/images/demo-user.png")}}" rounded-circle avatar-lg img-thumbnail" alt="profile-image" width="150px">
                    @endif

                    
                    <div class="text-left mt-3">
                        <div class="nav nav-pills bg-nav-pills nav-justified mb-3">
                            <a href="javascript:void(0);" data-toggle="tab" aria-expanded="false" class="nav-link rounded-0">General Info</a>
                        </div>
                        <p class="text-muted mb-2 font-13"><strong>First Name :</strong> <span class="ml-2">{{$data->first_name}}</span></p>
                        <p class="text-muted mb-2 font-13"><strong>Last Name :</strong> <span class="ml-2">{{$data->last_name}}</span></p>
                        <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span class="ml-2">{{$data->full_name}}</span></p>

                        <p class="text-muted mb-2 font-13"><strong>Phone Number :</strong><span class="ml-2">({{$data->country_code}}) {{$data->phone}}</span></p>

                        <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ml-2 ">{{$data->email}}</span></p>
                        <p class="text-muted mb-1 font-13"><strong>Location :</strong> <span class="ml-2">{{$data->address}}</span></p>
                    </div>
                    
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div>    
    </div>
</div>
@endsection
