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



<section class="dashboard-section">
    <div class="container">
        <div class="row">
            @include('web.layouts.elements.leftsidebar')
            <div class="col-lg-9 py-3">
                
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Questions And Answer</h1>                                
                </div>
                @if ($UserDetail->roles == 'Athletes')
                  <div class="">
                    <div class="m-auto">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item questions-answer-tap" role="presentation">
                              <button class="btn dashboard-tab-btn-blue active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-athletes" type="button" role="tab" aria-controls="pills-athletes" aria-selected="true">Athletes</button>
                            </li>
                            <li class="nav-item questions-answer-tap" role="presentation">
                              <button class="btn dashboard-tab-btn-blue" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-parents" type="button" role="tab" aria-controls="pills-parents" aria-selected="false">Parents</button>
                            </li>
                            <li class="nav-item questions-answer-tap" role="presentation">
                              <button class="btn dashboard-tab-btn-blue" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-coaches" type="button" role="tab" aria-controls="pills-coaches" aria-selected="false">Coaches</button>
                            </li>
                            <li class="nav-item questions-answer-tap" role="presentation">
                              <button class="btn dashboard-tab-btn-blue" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-frenzy" type="button" role="tab" aria-controls="pills-frenzy" aria-selected="false">Friday Frenzy</button>
                            </li>
                            {{-- <li class="nav-item questions-answer-tap" role="presentation">
                              <button class="btn dashboard-tab-btn-blue" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-female" type="button" role="tab" aria-controls="pills-frenzy" aria-selected="false">Female Athletes</button>
                            </li> --}}
                        </ul>
                        <div class="card shadow p-3">
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-athletes" role="tabpanel" aria-labelledby="pills-home-tab">
                                    <!--Athletes Questions Start-->
                                    <div class="table-responsive"> 
                                        <table class="table table-bordered">
                                          <thead class="thead-dark">
                                            <tr>
                                              <th scope="col">S.R.</th>
                                              <th scope="col">Questions</th>
                                              <th scope="col" class="text-center">Video</th>
                                              <th scope="col" class="text-center">Status</th>
                                              <th scope="col" class="text-center">Action</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            @php $i = 1; @endphp
                                            @foreach($questionathelitics as $questionList)
                                              @if($questionList->question_type == "for_athletes")
                                              @php
                                                $videodetail = Helper::videodetail($questionList->question_id,Auth::user()->id); 
                                                
                                               
                                              @endphp
                                              <tr>
                                                <th class="align-middle" scope="row">{{$i++}}.</th>
                                                <td class="align-middle">{{$questionList->question}}</td>
                                                <td class="text-center align-middle play-video-box-tab">
                                                  @if(in_array($questionList->question_id, $userAns))  
                                                      <a href="javascript:void(0);" class="showvideo fw-bold w-100" data-question ="{{$questionList->question_id}}" data-url='{{ route("web.athletes.coach.show.video") }}' class="fw-bold w-100"> 
                                                        <img src="{{asset('web/assets/images/new-img/favicon.svg')}}" alt="Play Icon" width="20"> 
                                                        Play Video
                                                  @else
                                                      <a href="#" class="fw-bold w-100">
                                                        No Answere
                                                  @endif
                                                  </a>
                                                </td>
                                                <td class="text-center align-middle">
                                                  @if(in_array($questionList->question_id, $userAns))
                                                      @if($videodetail['VideoDetail']->video_status == '0')
                                                            <span class="badge bg-warning text-dark">Pending</span>
                                                      @elseif($videodetail['VideoDetail']->video_status == '1')
                                                            <span class="badge bg-success">Approved</span>
                                                      @else
                                                            <span class="badge bg-danger">Rejected</span>
                                                      @endif
                                                  @else
                                                  @endif
                                                </td>
                                                <td class="text-center align-middle">
                                                      @if(in_array($questionList->question_id, $userAns))  
                                                        <a href="{{ route('web.athletes.coach.edit.video', $questionList->question_id ) }}" class="btn btn-success px-3 py-1"><i class="far fa-edit"></i></a>
                                                      @else
                                                        <a href="{{ route('web.athletes.coach.add.video', $questionList->question_id ) }}" class="btn btn-info px-3 py-1 text-white"><i class="fas fa-plus"></i></a>
                                                      @endif
                                                </td>
                                              </tr>
                                              @endif
                                            @endforeach
                                          </tbody>
                                        </table>
                                    </div>
                                    <!--Athletes Questions End-->
                                </div>
                                <div class="tab-pane fade" id="pills-parents" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <!--Parents Questions Start-->
                                    <div class="table-responsive"> 
                                        <table class="table table-bordered">
                                          <thead class="thead-dark">
                                            <tr>
                                              <th scope="col">S.R.</th>
                                              <th scope="col">Questions</th>
                                              <th scope="col" class="text-center">Video</th>
                                              <th scope="col" class="text-center">Status</th>
                                              <th scope="col" class="text-center">Action</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            @php $i = 1; @endphp
                                            @foreach($questionathelitics as $questionList)
                                              @if($questionList->question_type == "for_parents")
                                              @php
                                                $videodetail = Helper::videodetail($questionList->question_id,Auth::user()->id); 
                                              @endphp
                                              <tr>
                                                <th class="align-middle" scope="row">{{$i++}}.</th>
                                                <td class="align-middle">{{$questionList->question}}</td>
                                                <td class="text-center align-middle play-video-box-tab">
                                                  <a href="#" class="showvideo fw-bold w-100" data-question ="{{$questionList->question_id}}" data-url='{{ route("web.athletes.coach.show.video") }}'> 
                                                      @if(in_array($questionList->question_id, $userAns))  
                                                        <img src="{{asset('web/assets/images/new-img/favicon.svg')}}" alt="Play Icon" width="20"> 
                                                        Play Video
                                                      @else
                                                        No Answere
                                                      @endif
                                                  </a>
                                                </td>
                                                <td class="text-center align-middle">
                                                  @if(in_array($questionList->question_id, $userAns))
                                                      @if($videodetail['VideoDetail']->video_status == '0')
                                                            <span class="badge bg-warning text-dark">Pending</span>
                                                      @elseif($videodetail['VideoDetail']->video_status == '1')
                                                            <span class="badge bg-success">Approved</span>
                                                      @else
                                                            <span class="badge bg-danger">Rejected</span>
                                                      @endif
                                                  @else
                                                  @endif
                                                </td>
                                                <td class="text-center align-middle">
                                                  @if(in_array($questionList->question_id, $userAns))  
                                                    <a href="{{ route('web.athletes.coach.edit.video', $questionList->question_id ) }}" class="btn btn-success px-3 py-1"><i class="far fa-edit"></i></a>
                                                  @else
                                                    <a href="{{ route('web.athletes.coach.add.video', $questionList->question_id ) }}" class="btn btn-info px-3 py-1 text-white"><i class="fas fa-plus"></i></a>
                                                  @endif
                                                </td>
                                              </tr>
                                              @endif
                                            @endforeach
                                          </tbody>
                                        </table>
                                    </div>
                                    <!--Parents Questions End-->
                                </div>
                                <div class="tab-pane fade" id="pills-coaches" role="tabpanel" aria-labelledby="pills-contact-tab">
                                    <!--coaches and teenager Questions Start-->
                                    <div class="table-responsive"> 
                                        <table class="table table-bordered">
                                          <thead class="thead-dark">
                                            <tr>
                                              <th scope="col">S.R.</th>
                                              <th scope="col">Questions</th>
                                              <th scope="col" class="text-center">Video</th>
                                              <th scope="col" class="text-center">Status</th>
                                              <th scope="col" class="text-center">Action</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            @php $i = 1; @endphp
                                            @foreach($questionathelitics as $questionList)
                                              @if($questionList->question_type == "for_athletes_coaches")
                                              @php
                                                $videodetail = Helper::videodetail($questionList->question_id,Auth::user()->id); 
                                              @endphp
                                              <tr>
                                                <th class="align-middle" scope="row">{{$i++}}.</th>
                                                <td class="align-middle">{{$questionList->question}}</td>
                                                <td class="text-center align-middle play-video-box-tab">
                                                  <a href="#" class="showvideo fw-bold w-100" data-question ="{{$questionList->question_id}}" data-url='{{ route("web.athletes.coach.show.video") }}'> 
                                                      @if(in_array($questionList->question_id, $userAns))  
                                                        <img src="{{asset('web/assets/images/new-img/favicon.svg')}}" alt="Play Icon" width="20"> 
                                                        Play Video
                                                      @else
                                                        No Answere
                                                      @endif
                                                  </a>
                                                </td>
                                                <td class="text-center align-middle">
                                                  @if(in_array($questionList->question_id, $userAns))
                                                      @if($videodetail['VideoDetail']->video_status == '0')
                                                            <span class="badge bg-warning text-dark">Pending</span>
                                                      @elseif($videodetail['VideoDetail']->video_status == '1')
                                                            <span class="badge bg-success">Approved</span>
                                                      @else
                                                            <span class="badge bg-danger">Rejected</span>
                                                      @endif
                                                  @else
                                                  @endif
                                                </td>
                                                <td class="text-center align-middle">
                                                    @if(in_array($questionList->question_id, $userAns))  
                                                      <a href="{{ route('web.athletes.coach.edit.video', $questionList->question_id ) }}" class="btn btn-success px-3 py-1"><i class="far fa-edit"></i></a>
                                                    @else
                                                      <a href="{{ route('web.athletes.coach.add.video', $questionList->question_id ) }}" class="btn btn-info px-3 py-1 text-white"><i class="fas fa-plus"></i></a>
                                                    @endif
                                                </td>
                                              </tr>
                                              @endif
                                            @endforeach
                                          </tbody>
                                        </table>
                                    </div>
                                    <!--coaches and teenager Questions End-->
                                </div>
                                <div class="tab-pane fade" id="pills-frenzy" role="tabpanel" aria-labelledby="pills-contact-tab">
                                    <!--Question for Friday Frenzy Start-->
                                    <div class="table-responsive"> 
                                        <table class="table table-bordered">
                                          <thead class="thead-dark">
                                            <tr>
                                              <th scope="col">S.R.</th>
                                              <th scope="col">Questions</th>
                                              <th scope="col" class="text-center">Video</th>
                                              <th scope="col" class="text-center">Status</th>
                                              <th scope="col" class="text-center">Action</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            @php $i = 1; @endphp
                                            @foreach($questionathelitics as $questionList)
                                              @if($questionList->question_type == "for_friday_frenzy")
                                              @php
                                                $videodetail = Helper::videodetail($questionList->question_id,Auth::user()->id); 
                                              @endphp
                                              <tr>
                                                <th class="align-middle" scope="row">{{$i++}}.</th>
                                                <td class="align-middle">{{$questionList->question}}</td>
                                                <td class="text-center align-middle play-video-box-tab">
                                                  <a href="#" class="showvideo fw-bold w-100" data-question ="{{$questionList->question_id}}" data-url='{{ route("web.athletes.coach.show.video") }}'> 
                                                      @if(in_array($questionList->question_id, $userAns))  
                                                        <img src="{{asset('web/assets/images/new-img/favicon.svg')}}" alt="Play Icon" width="20"> 
                                                        Play Video
                                                      @else
                                                        No Answere
                                                      @endif
                                                  </a>
                                                </td>
                                                <td class="text-center align-middle">
                                                  @if(in_array($questionList->question_id, $userAns))
                                                      @if($videodetail['VideoDetail']->video_status == '0')
                                                            <span class="badge bg-warning text-dark">Pending</span>
                                                      @elseif($videodetail['VideoDetail']->video_status == '1')
                                                            <span class="badge bg-success">Approved</span>
                                                      @else
                                                            <span class="badge bg-danger">Rejected</span>
                                                      @endif
                                                  @else
                                                  @endif
                                                </td>
                                                <td class="text-center align-middle">
                                                    @if(in_array($questionList->question_id, $userAns))  
                                                      <a href="{{ route('web.athletes.coach.edit.video', $questionList->question_id ) }}" class="btn btn-success px-3 py-1"><i class="far fa-edit"></i></a>
                                                    @else
                                                      <a href="{{ route('web.athletes.coach.add.video', $questionList->question_id ) }}" class="btn btn-info px-3 py-1 text-white"><i class="fas fa-plus"></i></a>
                                                    @endif
                                                </td>
                                              </tr>
                                              @endif
                                            @endforeach
                                          </tbody>
                                        </table>
                                    </div>
                                    <!--Question for Friday Frenzy End-->
                                </div>
                                {{-- <div class="tab-pane fade" id="pills-female" role="tabpanel" aria-labelledby="pills-contact-tab">
                                  <!--Question for Friday Frenzy Start-->
                                  <div class="table-responsive"> 
                                      <table class="table table-bordered">
                                        <thead class="thead-dark">
                                          <tr>
                                            <th scope="col">S.R.</th>
                                            <th scope="col">Questions</th>
                                            <th scope="col" class="text-center">Video</th>
                                            <th scope="col" class="text-center">Status</th>
                                            <th scope="col" class="text-center">Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @php $i = 1; @endphp
                                          @foreach($questionathelitics as $questionList)
                                            @if($questionList->question_type == "for_female_athletes")
                                            @php
                                              $videodetail = Helper::videodetail($questionList->question_id,Auth::user()->id); 
                                            @endphp
                                            <tr>
                                              <th class="align-middle" scope="row">{{$i++}}.</th>
                                              <td class="align-middle">{{$questionList->question}}</td>
                                              <td class="text-center align-middle play-video-box-tab">
                                                <a href="#" class="fw-bold w-100" data-bs-toggle="modal" data-bs-target="#exampleModal"> 
                                                    @if(in_array($questionList->question_id, $userAns))  
                                                      <img src="{{asset('web/assets/images/new-img/favicon.svg')}}" alt="Play Icon" width="20"> 
                                                      Play Video
                                                    @else
                                                      No Answere
                                                    @endif
                                                </a>
                                              </td>
                                              <td class="text-center align-middle">
                                                @if(in_array($questionList->question_id, $userAns))
                                                    @if($videodetail['VideoDetail']->video_status == '0')
                                                          <span class="badge bg-warning text-dark">Pending</span>
                                                    @elseif($videodetail['VideoDetail']->video_status == '1')
                                                          <span class="badge bg-success">Approved</span>
                                                    @else
                                                          <span class="badge bg-danger">Rejected</span>
                                                    @endif
                                                @else
                                                @endif
                                              </td>
                                              <td class="text-center align-middle">
                                                  @if(in_array($questionList->question_id, $userAns))  
                                                    <a href="{{ route('web.athletes.coach.edit.video', $questionList->question_id ) }}" class="btn btn-success px-3 py-1"><i class="far fa-edit"></i></a>
                                                  @else
                                                    <a href="{{ route('web.athletes.coach.add.video', $questionList->question_id ) }}" class="btn btn-info px-3 py-1 text-white"><i class="fas fa-plus"></i></a>
                                                  @endif
                                              </td>
                                            </tr>
                                            @endif
                                          @endforeach
                                        </tbody>
                                      </table>
                                  </div>
                                  <!--Question for Friday Frenzy End-->
                                </div> --}}
                            </div>
                        </div>
                    </div>
                  </div>
                @else
                <div class="">
                  <div class="m-auto">
                      <div class="card shadow p-3">
                          <div class="tab-content" id="pills-tabContent">
                              <div class="tab-pane fade show active" id="pills-athletes" role="tabpanel" aria-labelledby="pills-home-tab">
                                  <!--Athletes Questions Start-->
                                  <div class="table-responsive"> 
                                      <table class="table table-bordered">
                                        <thead class="thead-dark">
                                          <tr>
                                            <th scope="col">S.R.</th>
                                            <th scope="col">Questions</th>
                                            <th scope="col" class="text-center">Video</th>
                                            <th scope="col" class="text-center">Status</th>
                                            <th scope="col" class="text-center">Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @php $i = 1; @endphp
                                          @foreach($questioncoaches as $questionList)
                                          @php
                                                $videodetail = Helper::videodetail($questionList->question_id,Auth::user()->id); 
                                                
                                               
                                              @endphp
                                            <tr>
                                              <th class="align-middle" scope="row">{{$i++}}.</th>
                                              <td class="align-middle">{{$questionList->question}}</td>
                                              <td class="text-center align-middle play-video-box-tab">
                                                <a href="#" class="showvideo fw-bold w-100" data-question ="{{$questionList->question_id}}" data-url='{{ route("web.athletes.coach.show.video") }}'> 
                                                    @if(in_array($questionList->question_id, $userAns))  
                                                      <img src="{{asset('web/assets/images/new-img/favicon.svg')}}" alt="Play Icon" width="20"> 
                                                      Play Video
                                                    @else
                                                      No Answere
                                                    @endif
                                                </a>
                                              </td>
                                              <td class="text-center align-middle">
                                                @if(in_array($questionList->question_id, $userAns))
                                                    @if($videodetail['VideoDetail']->video_status == '0')
                                                          <span class="badge bg-warning text-dark">Pending</span>
                                                    @elseif($videodetail['VideoDetail']->video_status == '1')
                                                          <span class="badge bg-success">Approved</span>
                                                    @else
                                                          <span class="badge bg-danger">Rejected</span>
                                                    @endif
                                                @else
                                                @endif
                                              </td>
                                              <td class="text-center align-middle">
                                                  @if(in_array($questionList->question_id, $userAns))  
                                                    <a href="{{ route('web.athletes.coach.edit.video', $questionList->question_id ) }}" class="btn btn-success px-3 py-1"><i class="far fa-edit"></i></a>
                                                  @else
                                                    <a href="{{ route('web.athletes.coach.add.video', $questionList->question_id ) }}" class="btn btn-info px-3 py-1 text-white"><i class="fas fa-plus"></i></a>
                                                  @endif
                                              </td>
                                            </tr>
                                          @endforeach
                                        </tbody>
                                      </table>
                                  </div>
                                  <!--Athletes Questions End-->
                              </div>
                          </div>
                      </div>
                  </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="modalVideo" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="VideoTitle"></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <video id="viewVideo" width="470" controls>
                  <source src="" />
              </video>
          </div>
          <div class="modal-footer"></div>
      </div>
  </div>
</div>
<!-- Modal -->
@endsection
    