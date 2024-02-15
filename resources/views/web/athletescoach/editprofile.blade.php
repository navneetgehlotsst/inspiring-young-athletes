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

<style>
    .profile-img-position {
        position: absolute;
        opacity: 0;
        top: 90px;
        right: -40px;
    }

    .camera-img{
        border-radius: 20px;
        background: #1badc4;
        padding: 5px;
        width: 30px;
        height: 30px;
        padding: 5px;
        position: relative;
        top: -40px;
        right: -40px;
    }
    .edit-profile-box{
        height: 160px;
    }
    
</style>

<section class="dashboard-section">
    <div class="container">
        <div class="row">
            @include('web.layouts.elements.leftsidebar')
            <div class="col-lg-9 py-3">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Edit Profile</h1>                               
                </div>
                <!-- Content Row -->
                <div class="card shadow p-3">
                    <form role="form" action="{{ route('web.athletes.coach.profileupdate') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card mb-4 mb-xl-0">
                                    <div class="card-body text-center edit-profile-box">
                                        <div class="position-relative">
                                            @if(empty(auth()->user()->profile))
                                                <img class="img-account-profile rounded-circle mb-2 imgprofileupdate" id="image-preview" src="{{asset('web/assets/images/new-img/dummyuser.png')}}" alt="">
                                            @else
                                            <img class="img-account-profile rounded-circle mb-2 imgprofileupdate" id="image-preview" src="{{asset(auth()->user()->profile)}}" alt="">
                                            @endif
                                            <div class="camera-img m-auto">
                                                <img src="{{asset('web/assets/images/new-img/camera.png')}}" width="30px" class="camera-images">
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <input class="edit-btn-iyg py-2 profile-img-position" id="file-input" accept="image/png, image/gif, image/jpeg" name="profileimg" type="file">
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <!-- Form Group (username)-->
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label for="name" class="form-label">Name:</label>
                                                <input type="text" class="form-control py-3 mb-4" placeholder="Name" name="name" value="{{ auth()->user()->name }}" required>
                                            </div>
                                            <div class="col-lg-12">
                                                <label for="name" class="form-label">Email:</label>
                                                <input type="email" class="form-control py-3 mb-4 disabled" placeholder="Email" name="email" value="{{ auth()->user()->email }}" required>
                                            </div>
                                            <div class="col-lg-12">
                                                <label for="name" class="form-label">Number:</label>
                                                <input type="number" class="form-control py-3 mb-4 disabled" placeholder="Enter phone number" name="number" value="{{ auth()->user()->phone }}" required>
                                            </div>
                                            @if(auth()->user()->roles != "User")
                                            <div class="col-lg-12">
                                                <label for="name" class="form-label">Category:</label>
                                                <select class="form-control py-3 mb-4 form-select @error('category') is-invalid @enderror" name="category" id="category" aria-label="Default select example" required>
                                                    <option value="">Select Categories</option>
                                                    @foreach ($getcategory as $category)
                                                    <option value="{{$category->category_id}}" @if(auth()->user()->category == $category->category_id) selected @endif>{{$category->category_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-12">
                                                <label for="name" class="form-label">Linkedin:</label>
                                                <input type="url" class="form-control py-3 mb-4 disabled" placeholder="Enter Linkedin" name="linkedin" value="{{ auth()->user()->linkedin }}">
                                            </div>
                                            <div class="col-lg-12">
                                                <label for="name" class="form-label">Tik Tok:</label>
                                                <input type="url" class="form-control py-3 mb-4 disabled" placeholder="Enter tiktok" name="tiktok" value="{{ auth()->user()->tiktok }}">
                                            </div>
                                            <div class="col-lg-12">
                                                <label for="name" class="form-label">Instagram:</label>
                                                <input type="url" class="form-control py-3 mb-4 disabled" placeholder="Enter instagram" name="instagram" value="{{ auth()->user()->instagram }}">
                                            </div>
                                            <div class="col-lg-12">
                                                <label for="name" class="form-label">Facebook:</label>
                                                <input type="url" class="form-control py-3 mb-4 disabled" placeholder="Enter facebook" name="facebook" value="{{ auth()->user()->facebook }}">
                                            </div>
                                            @endif
                                            <div class="col-lg-4 ms-auto">
                                                <button type="submit" class="btn btn-primary py-3 w-100 fw-bold login-btn">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection 
@section('script')
@endsection
    