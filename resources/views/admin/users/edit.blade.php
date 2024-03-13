@extends('layouts.app') 
@section('content')
<style>
  .error {
      color: red;
      /*line-height: 28px;
      margin-top: 10px;*/
  }
</style>
<div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="page-title-box">
          <div class="page-title-right" style="display: block"> 
            <a href="{{route($viewPath.'.index')}}" class="btn btn-outline-secondary btn-rounded"><span class="uil uil-users-alt"></span> All Users</a> 
          </div>
          <h4 class="page-title">Update User</h4>
        </div>
      </div>
      <div class="col-xl-12 col-lg-12">
        <div class="card">
          <div class="card-body  pb-5">
            
            <form action="{{ route($viewPath.'.update',$result->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label >First Name*</label>
                            <input type="text" name="first_name" class="form-control" placeholder="Enter First Name" value="{{old('first_name',$result->first_name)}}" required>
                            @error('first_name')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label >Last Name*</label>
                            <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name" value="{{old('last_name',$result->last_name)}}" required>
                            @error('last_name')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    @if($result->user_role_id == CLIENT_ROLE)
                    <div class="col-md-4">
                        <div class="form-group">
                            <label >Position*</label>
                            <input type="text" name="position" class="form-control" placeholder="Enter User Position" value="{{ old('position',($result->meta->position ?? '')) }}">
                            <!-- <select name="position" class="form-control select2" data-toggle="select2" value="{{ old('position',($result->meta->position ?? '')) }}" required>
                                <option value="">Select Position</option>
                                <option value="Account Manager">Account Manager</option>
                                <option value="Cleaner">Cleaner</option>
                            </select> -->
                            @error('name')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    @endif

                    @if($userDetails->user_role_id==4 || $userDetails->user_role_id==5)
                    <div class="col-md-4" id="sites-block">
                        <div class="form-group">
                        <label >Site*</label>
                            
                            <select class="select2 form-control select2-multiple" name="site_id[]" data-toggle="select2" multiple="multiple" data-placeholder="Choose ...">
                                <optgroup label="You can choose multiple sites">
                                @if(!empty($siteList))
                                    @foreach($siteList as $siteItem)
                                        @if(!empty($selectedSites) && in_array($siteItem->id,$selectedSites))
                                        <option selected value="{{$siteItem->id}}">{{$siteItem->name}}</option>
                                        @else
                                        <option value="{{$siteItem->id}}">{{$siteItem->name}}</option>
                                        @endif
                                    @endforeach
                                @endif
                                </optgroup>
                            </select>
                            @error('site_id')
                            <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    @else
                    @endif
                </div>    

                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label >Mobile Number*</label>
                            <input type="tel" name="mobile" class="form-control" placeholder="Enter Mobile Number" value="{{old('mobile', $result->mobile) }}" required>
                            @error('mobile')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
               
                    <div class="col-md-4">
                        <div class="form-group">
                            <label >Alternate Number</label>
                            <input type="tel" name="mobile_1" class="form-control" placeholder="Enter Alternate Number" value="{{old('mobile_1', $result->mobile_1) }}">
                            @error('mobile_1')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label >Email Address*</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter Email Address" value="{{old('email', $result->email) }}" required>
                            @error('email')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- <div class="col-md-4">
                        <div class="form-group">
                            <label >Set Password*</label>
                            <input type="password" name="password" class="form-control" placeholder="Set User Password" required>
                            <span class="error-message"></span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label >Confirm Password*</label>
                            <input type="password" name="confirm_password" class="form-control" placeholder="Set User Password" required>
                            <span class="error-message"></span>
                        </div>
                    </div> -->
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Profile Picture</label>
                            <div class="input-group">
                                <!-- <span class="float-left m-2 mr-4"> -->
                                    @if(!empty($result->avtar) && File::exists(USER_IMAGE_ROOT_PATH . $result->avtar))
                                        <img src="{{ USER_IMAGE_URL . $result->avtar }}" class="img-thumbnail mr-2" alt="User Image" width="100"/>
                                    @else
                                        <img src="{{NO_USER_IMAGE}}" style="height: 100px;" alt="" class="img-thumbnail">
                                    @endif
                                <!-- </span> -->
                                <div class="custom-file">
                                    <input type="file" name="avtar" accept="image/*" class="custom-file-input" id="avtar">
                                    <label class="custom-file-label" for="avtar">Choose picture</label>
                                </div>
                            </div>
                            @error('avtar')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    @if($result->user_role_id != SITE_MANAGER_ROLE)
                     <div class="col-md-8">
                        <div class="form-group">
                            <label for="example-textarea">Short Bio</label>
                            <textarea class="form-control" name="bio" id="example-textarea" rows="2" placeholder="Enter Little Bio" >{{$result->meta->bio ?? '' }}</textarea>
                            <span class="error-message"></span>
                        </div>
                    </div>
                    @endif
                    
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <hr class="mt-1">
                    </div>
                    <div class="col-md-4  ms-mt-3">
                        <label>User Status</label>
                        <input type="checkbox" name="status" id="switch2" value="1" {{ ($result->status == 1) ? "checked" : "" }} data-switch="success"/>
                        <label for="switch2" data-on-label="Active" data-off-label="Inactive" class="mb-0 d-block"></label>
                    </div>
                    <div class="col-md-8">
                        <div class=" ms-float-right"> 
                            <button type="submit" class="btn btn-info ms-mt-2 ms-block">Save</button> 
                        </div>
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
    $(document).ready(function(){
        var user = <?php echo json_encode($result); ?>;
        if('meta' in user){
            if(user.meta.position == 'Admin Assist'){
                $('#sites-block').css('display','none');
            }
        }
    });
</script>
@endsection
