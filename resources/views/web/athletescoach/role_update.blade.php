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


@include('web.layouts.elements.newsletter')


@endsection
@section('script')
@endsection
