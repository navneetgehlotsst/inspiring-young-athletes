@extends('web.layouts.app')
@section('content')

<!-- Video Publisher Section Start-->
<section class="publisher-section themeix-ptb-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="from-box p-5">
                    <div class="pb-3 text-center">
                        <h2 class="fw-bold text-success mt-4">Update Roles</h2>
                    </div>
                        <div class="accordion-body">
                            <form  role="form" action="{{ route('web.athletes.coach.save.role') }}" method="post" id="coachAtheliticsRegister">
                                @csrf
                                <select class="form-control py-3 mb-4 form-select @error('role') is-invalid @enderror" name="role" id="role" aria-label="Default select example">
                                    <option value="">Select Role</option>
                                    @foreach ($getrole as $role)
                                    <option value="{{$role->role_name}}" @if($UserDetail->roles == $role->role_name) selected @endif>{{$role->role_name}}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <div class="alert">{{ $message }}</div>
                                @enderror
                                <button type="submit" class="btn btn-primary py-3 w-100 fw-bold login-btn">Save</button>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Video Publisher Section End-->


<!-- Start Call To Action Area -->
<div class="call-to-action-area py-5">
    <div class="container">
        <div class="row py-5">
            <div class="col-md-12">
                <div class="action-content text-center pb-5">
                    <h2 class="text-dark fw-bold lh-base">Dont miss out on the latest updates, promotions, and exclusive content. Sign up for our newsletters by entering your email address below.</h2>
                </div>
            </div>
            <div class="col-md-6 m-auto">
                <div class="subscribe-section">
                    <input type="email" placeholder="Enter your email">
                    <button class="px-2 px-lg-5">Subscribe</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Call To Action Area -->


@endsection
@section('script')
@endsection
