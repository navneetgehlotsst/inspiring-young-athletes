@extends('layouts.app') 
@section('content')

<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-sm-12">
            <div class="card bg-primary">
                <div class="card-body profile-user-box">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="media">
                                <span class="float-left mr-4">
                                    @if(!empty($result->avtar) && File::exists(USER_IMAGE_ROOT_PATH . $result->avtar))
                                    <!-- <div class="profile_bg_img md" style="background-image:url('{{USER_IMAGE_URL.$result->avtar}}')"><img src="{{ USER_IMAGE_URL.$result->avtar}}" alt="" class="rounded-circle img-thumbnail"></div> -->
                                        <img src="{{ USER_IMAGE_URL.$result->avtar}}" style="height: 120px;" alt="" class="img-thumbnail">
                                    @else
                                        <img src="{{NO_USER_IMAGE}}" style="height: 120px;" alt="" class=" img-thumbnail">
                                    @endif
                                </span>
                                <div class="media-body">
                                    <h4 class="mt-1 mb-1 text-white">{{ $result->first_name ?? '' }}</h4>
                                    <p class="font-13 text-white-50">
                                        @if($result->user_role_id == SITE_MANAGER_ROLE)
                                            Site Manager
                                        @elseif($result->user_role_id == CLIENT_ROLE)
                                            User
                                        @elseif($result->user_role_id == CLEANING_MANAGER_ROLE)
                                            Account/Cleaning Manager
                                        @elseif($result->user_role_id == CLEANING_COMPANY_ROLE)
                                            Cleaning Company
                                        @endif
                                    </p>
                                
                                    <div class="row mb-0 text-light">
                                        <!--
                                            <div class="col-md-6">
                                                <h5 class="mb-1">0621 4587 6542</h5>
                                                <p class="mb-1 font-13 text-white-50">Contact Number</p>
                                            </div>
                                            <div class="col-md-6 ">
                                                <h5 class="mb-1">michael@cleansmart.com.au</h5>
                                                <p class="mb-1 font-13 text-white-50">Email Address</p>
                                            </div>
                                                -->
                                                <!-- <div class="col-md-6">
                                                <h5 class="mb-1">Moderate</h5>
                                                <p class="mb-1 font-13 text-white-50">Admin Panel Access</p>
                                                </div> -->

                                        <div class="col-md-6">
                                            @if($result->status==1)    
                                                <h5 class="mb-1">Active</h5>
                                            @else
                                                <h5 class="mb-1 text-danger">Inctive</h5>
                                            @endif
                                            <p class="mb-1 font-13 text-white-50">Account Status</p>
                                        </div>
                                            
                                    </div>
                                </div> 
                            </div>
                        </div> 
                        <div class="col-sm-4">
                            <div class="mt-2 text-sm-right">
                                @if(Auth::user()->user_role_id == ADMIN_ROLE)
                                    @if($result->user_role_id == CLIENT_ROLE)
                                        <a href="{{route('client.edit',$result->id)}}" class="btn btn-light"><i class="mdi mdi-account-edit mr-1"></i> Edit User</a>
                                    @endif
                                @elseif(Auth::user()->user_role_id == CLIENT_ROLE)
                                    @if($result->user_role_id == SITE_MANAGER_ROLE)
                                        <a href="{{route('users.edit',$result->id)}}" class="btn btn-light"><i class="mdi mdi-account-edit mr-1"></i> Edit User</a>
                                    @endif
                                @elseif(Auth::user()->user_role_id == CLEANING_COMPANY_ROLE)
                                    @if($result->user_role_id == CLIENT_ROLE)
                                        <a href="{{route('cleaning-companies.edit',$result->id)}}" class="btn btn-light"><i class="mdi mdi-account-edit mr-1"></i> Edit User</a>
                                    @endif
                                @elseif(Auth::user()->user_role_id == CLEANING_MANAGER_ROLE)
                                    @if($result->user_role_id == CLEANING_COMPANY_ROLE)
                                        <a href="{{route('users.edit',$result->id)}}" class="btn btn-light"><i class="mdi mdi-account-edit mr-1"></i> Edit User</a>
                                    @endif
                                @endif
                                
                            </div>
                            
                            <div class="mt-3 text-sm-right">
                                <a href="{{route('chat.start',$result->id)}}" class="btn btn-success">
                                    <i class="mdi mdi-chat mr-1"></i> Message
                                </a>
                            </div>
                        </div> 
                    </div> 
                </div> 
            </div>
        </div> 
    </div>
        
    <div class="row">
        <div class="col-lg-12">
            
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mt-0 mb-3">User Information</h4>
                    <p class="text-muted font-13">
                        {{$result->bio}}
                    </p>

                    <hr/>
                    <div class="text-left">
                        <p class="text-muted"><strong>Full Name :</strong> <span class="ml-2">{{ $result->full_name }}</span></p>
                        <!-- <p class="text-muted"><strong>Date Of Birth :</strong> <span class="ml-2">30-01-1985</span></p> -->
                        <p class="text-muted"><strong>Mobile :</strong><span class="ml-2">{{$result->mobile}}</span></p>
                        <p class="text-muted"><strong>Alternate Mobile :</strong><span class="ml-2">{{$result->mobile_1 ?? ''}}</span></p>
                        <p class="text-muted"><strong>Email :</strong> <span class="ml-2">{{$result->email}}</span></p>
                        <!-- <p class="text-muted"><strong>Site Location :</strong> <span class="ml-2">{{$result->address}}</span></p> -->  
                    </div>
                </div>
            </div>

        </div> 
    </div>
        
    </div>
</div>

 <!-- -------Site Details Start -------->

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
        <div class="page-title-box">
            <!-- <div class="page-title-right" style="display: block"> <a href="add-site.html" class="btn btn-dark btn-rounded"><span class="uil uil-plus"></span> Add Site</a> </div> -->
            <h4 class="page-title">Sites</h4>
        </div>
        </div>
        <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card-body">
            <div class="table-responsive">
                <table id="datatable-buttons" class="table table-bordered table-centered mb-0">
                <thead>
                    <tr>
                        <th>Sites</th>
                        <th>Manager</th>
                        <th>Contact Number</th>
                        <th>Cleaning Company</th>
                        <!-- <th class="text-center">Action</th> -->
                    </tr>
                </thead>
                <tbody>

                    @foreach($siteresult as $results)
                        <tr>
                            <td><a href="{{route('sites.sites-details',$results->id)}}">{{$results->name}}</a></td>
                            <td><a href="{{route('users.show',$results->manager_id)}}">{{ $results->manager->full_name ?? '' }}</a></td>
                            <td>{{ $results->manager->mobile ?? ''}}</td>
                            <td>
                                @if(!empty($results->cleaningCompanies))
                                    @foreach($results->cleaningCompanies as $CCkey => $cleaningCompany) 
                                        @if(isset($cleaningCompany->companyDetails->c_name) && !empty($cleaningCompany->companyDetails->c_name))
                                            <a href="{{route('cleaning-companies.details',$cleaningCompany->companyDetails->id)}}">{{$cleaningCompany->companyDetails->c_name}}</a> <br />
                                        @endif
                                    @endforeach
                                @else
                                    Not Assigned
                                @endif
                            </td>
                            <!-- <td class="table-action text-center"><div class="col-auto"> <a href="javascript:void(0);" data-toggle="tooltip" data-placement="bottom" title="" class="btn btn-link text-danger btn-lg p-0 pr-2" data-original-title="Delete"> <i class="uil uil-multiply"></i> </a> <a href="add-site.html" data-toggle="tooltip" data-placement="bottom" title="" class="btn btn-link text-muted btn-lg p-0 pr-2" data-original-title="Edit"> <i class="uil uil-edit-alt"></i> </a> 
                                <a href="chat.html" data-toggle="tooltip" data-placement="bottom" title="" class="btn btn-link text-muted btn-lg p-0" data-original-title="Chat"> <i class="mdi mdi-chat"></i> </a>
                                </div>
                            </td> -->
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


@endsection
