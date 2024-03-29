@extends('admin.layouts.app')
@section('content')
<style>
  .incometableth{
    text-align: center !important;
  }

  .incometabletd{
    text-align: center !important;
  }
</style>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Athlete And Coach /</span> Detail</h4>
    <div class="row">
      <div class="col-12">
          <div class="card mb-4">
              <div class="user-profile-header-banner">
                  <img src="{{asset('admin/assets/img/avatars/profile-banner.png')}}" alt="Banner image" class="rounded-top" />
              </div>
              <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                  <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">

                        @if(empty($users->profile))
                          <img src="{{asset('admin/assets/img/avatars/user.png')}}" alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" />
                        @else
                          <img src="{{asset($users->profile)}}" alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" />
                        @endif
                  </div>
                  <div class="flex-grow-1 mt-3 mt-sm-5">
                      <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                          <div class="user-profile-info">
                              <h4>{{$users->name}}</h4>
                              <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                  <li class="list-inline-item fw-medium"><i class='bx bx-envelope'></i> {{$users->email}}</li>
                                  <li class="list-inline-item fw-medium"><i class='bx bx-phone' ></i> {{$users->phone}}</li>
                                  <li class="list-inline-item fw-medium"><i class='bx bx-category'></i> {{$userscat->category_name}}</li>
                              </ul>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
          <div class="nav-align-top mb-4">
            <div class="nav-align-top mb-4">
              <ul class="nav nav-pills mb-3" role="tablist">
                <li class="nav-item" role="presentation">
                  <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-intro" aria-controls="navs-pills-top-intro" aria-selected="false" tabindex="-1">
                    Intro Video
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-question" aria-controls="navs-pills-top-question" aria-selected="false" tabindex="-1">
                    Question And Answer
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-video" aria-controls="navs-pills-top-video" aria-selected="false" tabindex="-1">
                    Video
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-income" aria-controls="navs-pills-income" aria-selected="false" tabindex="-1">
                    Income
                  </button>
                </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-pills-top-intro" role="tabpanel">
                  <div class="row">
                    @if(!empty($usersintro->IntroVideo))
                    <h3>{{$usersintro->IntroVideo['0']->video_title}}</h3>
                    <div class="embed-responsive embed-responsive-16by9">
                      <video width="400" controls>
                        <source src="{{$usersintro->IntroVideo['0']->video}}" type="video/mp4">
                        <source src="{{$usersintro->IntroVideo['0']->video}}" type="video/ogg">
                      </video>
                      <div>
                        @if($usersintro->IntroVideo['0']->video_status == 0 )
                            <button type="button" class="btn btn-outline-success aproved" id="approved-{{ $usersintro->IntroVideo['0']->video_id}}" data-videoid ="{{ $usersintro->IntroVideo['0']->video_id }}" data-url='{{ route("admin.athelitics.show.video") }}'>Approve</button>
                            <button type="button" class="btn btn-outline-danger reject ms-2" id="rejected-{{$usersintro->IntroVideo['0']->video_id}}" data-videoid ="{{$usersintro->IntroVideo['0']->video_id}}" data-url='{{ route("admin.athelitics.changestatus") }}'>Reject</button>
                        @elseif($usersintro->IntroVideo['0']->video_status == 2)
                            <button type="button" class="btn btn-outline-success aproved" id="approved-{{$usersintro->IntroVideo['0']->video_id}}" data-videoid ="{{$usersintro->IntroVideo['0']->video_id}}" data-url='{{ route("admin.athelitics.show.video") }}'>Approve</button>
                            <button type="button" class="btn btn-outline-danger reject ms-2 d-none" id="rejected-{{$usersintro->IntroVideo['0']->video_id}}" data-videoid ="{{$usersintro->IntroVideo['0']->video_id}}" data-url='{{ route("admin.athelitics.changestatus") }}'>Reject</button>
                        @else
                            <button type="button" class="btn btn-outline-success aproved d-none" id="approved-{{$usersintro->IntroVideo['0']->video_id}}" data-videoid ="{{$usersintro->IntroVideo['0']->video_id}}" data-url='{{ route("admin.athelitics.show.video") }}'>Approve</button>
                            <button type="button" class="btn btn-outline-danger reject ms-2" id="rejected-{{$usersintro->IntroVideo['0']->video_id}}" data-videoid ="{{$usersintro->IntroVideo['0']->video_id}}" data-url='{{ route("admin.athelitics.changestatus") }}'>Reject</button>
                        @endif
                      </div>
                    </div>
                    @else
                      <h3>Intro Video Not Uploaded</h3>
                    @endif
                  </div>
                </div>
                <div class="tab-pane fade" id="navs-pills-top-question" role="tabpanel">
                    <table id="questionDataTable" class="table datatables-users border-top" style="width: 100%">
                        <thead>
                          <tr class="text-nowrap">
                              <th>S. No.</th>
                              <th col="3">Questions</th>
                              <th>Views</th>
                              <th>Answer</th>
                              <th>Type</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                          @php
                            $i = '1';
                          @endphp
                          @foreach ($questionAnswere as $usersvideo)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{!!$usersvideo['question']!!}</td>
                                    <td>{{$usersvideo['video_veiw_count']}}</td>
                                    <td>
                                      @if ($usersvideo['answere'] != "")
                                        <a href="javascript:void(0);" class="showvideo" data-videoid ="{{$usersvideo['video_id']}}" data-url='{{ route("admin.athelitics.show.video") }}'>
                                          <img src="{{asset('admin/assets/img/play.svg')}}" alt="{{$usersvideo['question']}}" width="20">
                                        <span class="fw-bold">Play Video</span>
                                        </a>
                                      @endif
                                    </td>
                                    <td>
                                      @if ($usersvideo['answere'] != "")
                                        @if($usersvideo['video_type'] == '1' )
                                            <p class="badge bg-label-danger" id='changetype-{{$usersvideo['video_id']}}'>Paid</p>
                                        @elseif($usersvideo['video_type'] == '0')
                                          <p class="badge bg-label-warning" id='changetype-{{$usersvideo['video_id']}}'>Pending</p>
                                        @else
                                            <p class="badge bg-label-success" id='changetype-{{$usersvideo['video_id']}}'>Free</p>
                                        @endif
                                      @endif
                                    </td>
                                    <td>
                                      @if ($usersvideo['answere'] != "")
                                        @if($usersvideo['video_status'] == 1 )
                                            <p class="badge bg-label-success" id='changestatus-{{$usersvideo['video_id']}}'>Approved</p>
                                        @elseif($usersvideo['video_status'] == 0)
                                        <p class="badge bg-label-warning" id='changestatus-{{$usersvideo['video_id']}}'>Pending</p>
                                        @else
                                            <p class="badge bg-label-danger" id='changestatus-{{$usersvideo['video_id']}}'>Rejected</p>
                                        @endif
                                      @endif
                                    </td>
                                    <td>
                                      <div class="btn-group">
                                        @if ($usersvideo['answere'] != "")
                                          @if($usersvideo['video_status'] == 0 )
                                              <button type="button" class="btn btn-outline-success aproved" id="approved-{{$usersvideo['video_id']}}" data-videoid ="{{$usersvideo['video_id']}}" data-url='{{ route("admin.athelitics.show.video") }}'>Approve</button>
                                              <button type="button" class="btn btn-outline-danger reject ms-2" id="rejected-{{$usersvideo['video_id']}}" data-videoid ="{{$usersvideo['video_id']}}" data-url='{{ route("admin.athelitics.changestatus") }}'>Reject</button>
                                          @elseif($usersvideo['video_status'] == 2)
                                              <button type="button" class="btn btn-outline-success aproved" id="approved-{{$usersvideo['video_id']}}" data-videoid ="{{$usersvideo['video_id']}}" data-url='{{ route("admin.athelitics.show.video") }}'>Approve</button>
                                              <button type="button" class="btn btn-outline-danger reject ms-2 d-none" id="rejected-{{$usersvideo['video_id']}}" data-videoid ="{{$usersvideo['video_id']}}" data-url='{{ route("admin.athelitics.changestatus") }}'>Reject</button>
                                          @else
                                              <button type="button" class="btn btn-outline-success aproved d-none" id="approved-{{$usersvideo['video_id']}}" data-videoid ="{{$usersvideo['video_id']}}" data-url='{{ route("admin.athelitics.show.video") }}'>Approve</button>
                                              <button type="button" class="btn btn-outline-danger reject ms-2" id="rejected-{{$usersvideo['video_id']}}" data-videoid ="{{$usersvideo['video_id']}}" data-url='{{ route("admin.athelitics.changestatus") }}'>Reject</button>
                                          @endif
                                        @endif
                                      </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="navs-pills-top-video" role="tabpanel">
                  @if (count($videolists) != 0)
                    <table id="videoDataTable" class="table datatables-users border-top" style="width: 100%">
                      <thead>
                        <tr class="text-nowrap">
                            <th>S. No.</th>
                            <th>Title</th>
                            <th>View</th>
                            <th>Video</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody class="table-border-bottom-0">
                        @php
                          $i = '1';
                        @endphp
                        @foreach ($videolists as $videolist)
                              <tr>
                                  <td>{{$i++}}</td>
                                  <td>{{$videolist->video_title}}</td>
                                  <td>{{$videolist->video_veiw_count}}</td>
                                  <td>
                                      <a href="javascript:void(0);" class="showvideo" data-videoid ="{{$videolist->video_id}}" data-url='{{ route("admin.athelitics.show.video") }}'>
                                        <img src="{{asset('admin/assets/img/play.svg')}}" alt="{{$videolist->video_title}}" width="20">
                                        <span class="fw-bold">Play Video</span>
                                      </a>
                                  </td>
                                  <td>
                                      @if($videolist->video_type == '1' )
                                          <span class="badge bg-label-danger" id='changetype-{{$videolist->video_id}}'>Paid</span>
                                      @elseif($videolist->video_type == '0')
                                        <span class="badge bg-label-warning" id='changetype-{{$videolist->video_id}}'>Pending</span>
                                      @else
                                          <span class="badge bg-label-success" id='changetype-{{$videolist->video_id}}'>Free</span>
                                      @endif
                                  </td>
                                  <td>
                                      @if($videolist->video_status == 1 )
                                          <span class="badge bg-label-success" id='changestatus-{{$videolist->video_id}}'>Approved</span>
                                      @elseif($videolist->video_status == 0)
                                          <span class="badge bg-label-warning" id='changestatus-{{$videolist->video_id}}'>Pending</span>
                                      @else
                                          <span class="badge bg-label-danger" id='changestatus-{{$videolist->video_id}}'>Rejected</span>
                                      @endif
                                  </td>
                                  <td>
                                    <div class="btn-group">
                                        @if($videolist->video_status == 0 )
                                            <button type="button" class="btn btn-outline-success aproved" id="approved-{{$videolist->video_id}}" data-videoid ="{{$videolist->video_id}}" data-url='{{ route("admin.athelitics.show.video") }}'>Approve</button>
                                            <button type="button" class="btn btn-outline-danger reject ms-2" id="rejected-{{$videolist->video_id}}" data-videoid ="{{$videolist->video_id}}" data-url='{{ route("admin.athelitics.rejectstatus") }}'>Reject</button>
                                        @elseif($videolist->video_status == 2)
                                            <button type="button" class="btn btn-outline-success aproved" id="approved-{{$videolist->video_id}}" data-videoid ="{{$videolist->video_id}}" data-url='{{ route("admin.athelitics.show.video") }}'>Approve</button>
                                            <button type="button" class="btn btn-outline-danger reject ms-2 d-none" id="rejected-{{$videolist->video_id}}" data-videoid ="{{$videolist->video_id}}" data-url='{{ route("admin.athelitics.rejectstatus") }}'>Reject</button>
                                        @else
                                            <button type="button" class="btn btn-outline-success aproved d-none" id="approved-{{$videolist->video_id}}" data-videoid ="{{$videolist->video_id}}" data-url='{{ route("admin.athelitics.show.video") }}'>Approve</button>
                                            <button type="button" class="btn btn-outline-danger reject ms-2" id="rejected-{{$videolist->video_id}}" data-videoid ="{{$videolist->video_id}}" data-url='{{ route("admin.athelitics.rejectstatus") }}'>Reject</button>
                                        @endif
                                    </div>
                                  </td>
                              </tr>
                          @endforeach
                      </tbody>
                    </table>
                  @else
                      <p>No video added yet</p>
                  @endif
                </div>
                <div class="tab-pane fade" id="navs-pills-income" role="tabpanel">
                  <div class="btn btn-outline-primary mb-2">
                    Total Income
                    <span class="badge ms-2">${{$totalIncome}}</span>
                  </div>
                  <table id="userIncomeDataTable" class="table datatables-users border-top" style="width: 100%">
                      <thead>
                        <tr class="text-nowrap">
                            <th class="incometableth">S. No.</th>
                            <th class="incometableth">Video Revenue</th>
                            <th class="incometableth">Referral And Earn</th>
                            <th class="incometableth">Month</th>
                            <th class="incometableth">Year</th>
                        </tr>
                      </thead>
                      <tbody class="table-border-bottom-0">
                        @php
                          $i = '1';
                        @endphp
                        @foreach ($userincomes as $userincome)
                              <tr>
                                  <td class="incometabletd">{{$i++}}</td>
                                  <td class="incometabletd">{{$userincome->videorevenue}}</td>
                                  <td class="incometabletd">{{$userincome->referralrevenue}}</td>
                                  <td class="incometabletd">{{$userincome->month}}</td>
                                  <td class="incometabletd">{{$userincome->years}}</td>
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


<!--show Video-->
<div class="modal fade" id="modalVideo" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="VideoTitle"></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <video id="viewVideo" width="500" controls>
                  <source src="" />
              </video>
          </div>
          <div class="modal-footer"></div>
      </div>
  </div>
</div>
<!-- Change Status-->
<div class="modal fade" id="changeStatus" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="modalToggleLabel"></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <input type="hidden" name="videoId" id="videoId" value="" />
              <div class="mt-2 mb-3">
                <label for="type" class="form-label">Video Type</label>
                <select id="type" class="form-select form-select-lg">
                    <option>select</option>
                    <option value="0">Pending</option>
                    <option value="1">Paid</option>
                    <option value="2">Free</option>
                </select>
            </div>
          </div>
          <div class="modal-footer">
              <button class="btn btn-primary SaveChanges" data-url='{{ route("admin.athelitics.aprrovedstatus") }}' data-bs-dismiss="modal">
                  Save
              </button>
          </div>
      </div>
  </div>
</div>
<!-- Reject Model-->
<div class="modal fade" id="rejectmodel" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="modalToggleLabel">Rejection Comment</h5>
              {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
          </div>
          <div class="modal-body mt-0 pt-0 pb-0">
              <input type="hidden" name="videoId" id="videoId" value="" />
              <div class="mt-2 mb-3">
                <label for="comment" class="form-label">Comment</label>
                <textarea name="comment" id="comment" class="form-control" cols="30"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
              Close
            </button>
              <button class="btn btn-primary Savecomment" data-url='{{ route("admin.athelitics.rejectstatus") }}' data-bs-dismiss="modal">
                  Save
              </button>
          </div>
      </div>
  </div>
</div>

@endsection
