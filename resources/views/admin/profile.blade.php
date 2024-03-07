@extends('admin.layouts.app')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Setting</h4>
    <div class="row">
        <div class="col-md-12">
          <div class="card mb-4">
            <h5 class="card-header">Update Profile</h5>
            <div class="card-body">
              <form action="{{ route('admin.profileupdate') }}" method="post">
                @csrf
                <div class="mb-3">
                  <label for="defaultFormControlInput" class="form-label">Name</label>
                  <input
                    type="text"
                    class="form-control"
                    name="name"
                    id="defaultFormControlInput"
                    placeholder=""
                    value="{{$user->name}}"
                    aria-describedby="defaultFormControlHelp" required />
                </div>
                <div class="mb-3">
                  <label for="defaultFormControlInput" class="form-label">Email</label>
                  <input
                    type="email"
                    class="form-control"
                    name="email"
                    id="defaultFormControlInput"
                    placeholder=""
                    value="{{$user->email}}"
                    aria-describedby="defaultFormControlHelp" required />
                </div>
                <div class="mb-3">
                  <label for="defaultFormControlInput" class="form-label">Email</label>
                  <input
                    type="text"
                    class="form-control"
                    name="phone"
                    id="defaultFormControlInput"
                    placeholder=""
                    value="{{$user->phone}}"
                    aria-describedby="defaultFormControlHelp" required />
                </div>
                <div class="row">
                      <div class="col-12">
                          <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                </div>
              </form>            
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
    