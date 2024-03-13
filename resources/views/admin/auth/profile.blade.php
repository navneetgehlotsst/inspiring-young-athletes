@extends('admin.layouts.app')
@section('style')
<style>
 .profile-card{
    width: 80%;
    margin: auto;
 }
 .user-image{
    height: 80px;
    width: auto;
    border:1px dotted lightgray;
    padding:4px;
 }
 .submit-btn{
    text-align: right;
 }   
</style>
@endsection 
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right mr-2" style="display: block">
                    <a href="{{ route('admin.change.password') }}" class="btn btn-sm btn-primary">
                        Change Password <i class="mdi mdi-key-chain"></i>
                    </a>
                </div>
                <h4 class="page-title">My Profile <i class="uil uil-user"></i></h4>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card profile-card">
                <div class="card-body  pb-5">
                    <form action="{{ route('admin.update.profile') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >First Name*</label>
                                    <input type="text" name="first_name" class="form-control" placeholder="Enter First Name" value="{{old('first_name',$user->first_name)}}" required>
                                    @error('first_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Last Name*</label>
                                    <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name" value="{{ old('last_name',$user->last_name)}}" required>
                                    @error('last_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Phone Number*</label>
                                    <input type="tel" name="phone" class="form-control" placeholder="Enter Phone Number" value="{{ old('phone',$user->phone) }}" required>
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Email Address*</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter Email Address" value="{{ old('email',$user->email) }}" required>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    @if($user->avatar)
                                        <img src="{{asset($user->avatar)}}" class="user-image" id="user-image">
                                    @else
                                        <img src="{{asset('assets/admin/images/admin.png')}}" class="user-image" id="user-image">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Profile Picture</label>
                                    <div class="custom-file">
                                        <input type="file" name="avatar" accept="image/*" class="custom-file-input" id="avatar" onchange="document.getElementById('user-image').src = window.URL.createObjectURL(this.files[0])">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                    @error('avatar')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr class="mt-1">
                        <div class="row">
                            <div class="col-md-12 submit-btn">
                                <button type="submit" class="btn btn-primary">Save</button> 
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')

@endsection