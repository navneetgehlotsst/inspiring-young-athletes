@extends('admin.layouts.app')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">User /</span> Detail</h4>
    <div class="row">
        <div class="col-xl-12">
          <h6 class="text-muted">Viewers Details</h6>
          <div class="nav-align-top mb-4">
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item">
                <button
                  type="button"
                  class="nav-link active"
                  role="tab"
                  data-bs-toggle="tab"
                  data-bs-target="#navs-top-detail"
                  aria-controls="navs-top-detail"
                  aria-selected="true">
                  Viewers Detail
                </button>
              </li>
              <li class="nav-item">
                <button
                  type="button"
                  class="nav-link"
                  role="tab"
                  data-bs-toggle="tab"
                  data-bs-target="#navs-top-subcription"
                  aria-controls="navs-top-subcription"
                  aria-selected="false">
                  Subcription
                </button>
              </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane fade show active" id="navs-top-detail" role="tabpanel">
                    <h5>Basic Info</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="defaultFormControlInput" class="form-label">Name</label>
                            <input type="text" class="form-control" id="defaultFormControlInput" placeholder="{{$users->name}}" value="{{$users->name}}" aria-describedby="defaultFormControlHelp" readonly/>
                        </div>
                        <div class="col-md-6">
                            <label for="defaultFormControlInput" class="form-label">Email</label>
                            <input type="text" class="form-control" id="defaultFormControlInput" placeholder="{{$users->email}}" value="{{$users->email}}" aria-describedby="defaultFormControlHelp" readonly/>
                        </div>
                        <div class="col-md-6">
                            <label for="defaultFormControlInput" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="defaultFormControlInput" placeholder="{{$users->phone}}" value="{{$users->phone}}" aria-describedby="defaultFormControlHelp" readonly/>
                        </div>
                    </div>
              </div>
              <div class="tab-pane fade" id="navs-top-subcription" role="tabpanel">
                <h5>User Subcription</h5>
                <div class="row">
                  @if (!empty($formattedStartDate))
                    <div class="col-md-6">
                        <label for="defaultFormControlInput" class="form-label">Start Date</label>
                        <input type="text" class="form-control" id="defaultFormControlInput" placeholder="{{$formattedStartDate}}" value="{{$formattedStartDate}}" aria-describedby="defaultFormControlHelp" readonly/>
                    </div>
                    <div class="col-md-6">
                        <label for="defaultFormControlInput" class="form-label">End Date</label>
                        <input type="text" class="form-control" id="defaultFormControlInput" placeholder="{{$enddate}}" value="{{$enddate}}" aria-describedby="defaultFormControlHelp" readonly/>
                    </div>
                  @else
                    <div class="col-md-12">
                        <p>Not purchased yet</p>
                    </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection
    