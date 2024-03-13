@extends('layouts.app')
@section('style')
<style>
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
                    <a href="{{route('users.index')}}" class="btn btn-sm btn-info">All Users <span class="uil uil-users-alt"></span></a>
                </div>
                <h4 class="page-title">Add User</h4>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card profile-card">
                <div class="card-body  pb-5">
                    <form  method="POST" action="{{ route('users.store')}}" enctype="multipart/form-data" id="addForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >First Name*</label>
                                <input type="text" name="first_name" class="form-control" placeholder="Enter First Name" value="{{ old('first_name') }}" required>
                                <span class="error-message"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Last Name*</label>
                                <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name" value="{{ old('last_name') }}" required>
                                <span class="error-message"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Mobile Number*</label>
                                <input type="tel" name="mobile" class="form-control" placeholder="Enter Mobile Number" value="{{ old('mobile') }}" required>
                                <span class="error-message"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Alternate Mobile Number*</label>
                                <input type="tel" name="alternate_mobile" class="form-control" placeholder="Enter Alternate Mobile Number" value="{{ old('alternate_mobile') }}">
                                <span class="error-message"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Email Address*</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter Email Address" value="{{ old('email') }}" required>
                                <span class="error-message"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Role*</label>
                                <select name="role" class="form-control" placeholder="Select User Role" required>
                                    <option value="user">User</option>
                                </select>
                                <span class="error-message"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Set Password*</label>
                                <input type="password" name="password" class="form-control" placeholder="Set User Password" required>
                                <span class="error-message"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Confirm Password*</label>
                                <input type="password" name="confirm_password" class="form-control" placeholder="Set User Password" required>
                                <span class="error-message"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Bio</label>
                                <textarea name="bio" class="form-control" placeholder="Enter user description"></textarea>
                                <span class="error-message"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>User Status</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="status" value="1" class="custom-control-input" id="adduserstatus" onchange="adduserStatus()" checked>
                                <label class="custom-control-label" id="add-user-status-label" for="adduserstatus">Active</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 submit-btn">
                            <hr class="mt-1">
                            <button type="submit" class="btn btn-sm btn-primary">Save</button>
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
<script>
function adduserStatus(){
    if($('#adduserstatus').prop('checked') == true){
        $('#add-user-status-label').text('Active');
    }else{
        $('#add-user-status-label').text('Inactive');
    }
}
</script>
@endsection



