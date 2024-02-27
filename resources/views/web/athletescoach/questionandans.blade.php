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
                                              <th scope="col" class="text-center">Action</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <th class="align-middle" scope="row">1</th>
                                              <td class="align-middle">What would you say to parents of talented young kids based on your learnings with your child?</td>
                                              <td class="text-center align-middle play-video-box-tab"><a href="#" class="fw-bold w-100" data-bs-toggle="modal" data-bs-target="#exampleModal"> <img src="{{asset('web/assets/images/new-img/favicon.svg')}}" alt="Play Icon" width="20"> Play Video</a></td>
                                              <td class="text-center align-middle">
                                                    <a href="#" class="btn btn-success px-3 py-1"><i class="far fa-edit"></i></a>
                                                    <!-- <a href="#" class="btn btn-info px-3 py-1 text-white"><i class="fas fa-plus"></i> Add Video</a> -->
                                              </td>
                                            </tr>
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
                                              <th scope="col" class="text-center">Action</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <th class="align-middle" scope="row">1</th>
                                              <td class="align-middle">What would you say to parents of talented young kids based on your learnings with your child?</td>
                                              <td class="text-center align-middle play-video-box-tab"><a href="#" class="fw-bold w-100" data-bs-toggle="modal" data-bs-target="#exampleModal"> <img src="{{asset('web/assets/images/new-img/favicon.svg')}}" alt="Play Icon" width="20"> Play Video</a></td>
                                              <td class="text-center align-middle">
                                                    <a href="#" class="btn btn-success px-3 py-1"><i class="far fa-edit"></i></a>
                                                    <!-- <a href="#" class="btn btn-info px-3 py-1 text-white"><i class="fas fa-plus"></i> Add Video</a> -->
                                              </td>
                                            </tr>
                                            <tr>
                                                <th class="align-middle" scope="row">2</th>
                                                <td class="align-middle">What would you say to parents of talented young kids based on your learnings with your child?</td>
                                                <td class="text-center align-middle play-video-box-tab"><a href="#" class="fw-bold w-100" data-bs-toggle="modal" data-bs-target="#exampleModal"> <img src="{{asset('web/assets/images/new-img/favicon.svg')}}" alt="Play Icon" width="20"> Play Video</a></td>
                                                <td class="text-center align-middle">
                                                    <!-- <a href="#" class="btn btn-success px-3 py-1"><i class="far fa-edit"></i></a> -->
                                                    <a href="#" class="btn btn-info px-3 py-1 text-white"><i class="fas fa-plus"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="align-middle" scope="row">3</th>
                                                <td class="align-middle">What would you say to parents of talented young kids based on your learnings with your child?</td>
                                                <td class="text-center align-middle play-video-box-tab"><a href="#" class="fw-bold w-100" data-bs-toggle="modal" data-bs-target="#exampleModal"> <img src="{{asset('web/assets/images/new-img/favicon.svg')}}" alt="Play Icon" width="20"> Play Video</a></td>
                                                <td class="text-center align-middle">
                                                    <a href="#" class="btn btn-success px-3 py-1"><i class="far fa-edit"></i></a>
                                                    <!-- <a href="#" class="btn btn-info px-3 py-1 text-white"><i class="fas fa-plus"></i></a> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="align-middle" scope="row">4</th>
                                                <td class="align-middle">What would you say to parents of talented young kids based on your learnings with your child?</td>
                                                <td class="text-center align-middle play-video-box-tab"><a href="#" class="fw-bold w-100" data-bs-toggle="modal" data-bs-target="#exampleModal"> <img src="{{asset('web/assets/images/new-img/favicon.svg')}}" alt="Play Icon" width="20"> Play Video</a></td>
                                                <td class="text-center align-middle">
                                                    <!-- <a href="#" class="btn btn-success px-3 py-1"><i class="far fa-edit"></i></a> -->
                                                    <a href="#" class="btn btn-info px-3 py-1 text-white"><i class="fas fa-plus"></i></a>
                                                </td>
                                            </tr>
                                            
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
                                              <th scope="col" class="text-center">Action</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <th class="align-middle" scope="row">1</th>
                                              <td class="align-middle">What would you say to parents of talented young kids based on your learnings with your child?</td>
                                              <td class="text-center align-middle play-video-box-tab"><a href="#" class="fw-bold w-100" data-bs-toggle="modal" data-bs-target="#exampleModal"> <img src="{{asset('web/assets/images/new-img/favicon.svg')}}" alt="Play Icon" width="20"> Play Video</a></td>
                                              <td class="text-center align-middle">
                                                    <a href="#" class="btn btn-success px-3 py-1"><i class="far fa-edit"></i></a>
                                                    <!-- <a href="#" class="btn btn-info px-3 py-1 text-white"><i class="fas fa-plus"></i> Add Video</a> -->
                                              </td>
                                            </tr>
                                            <tr>
                                                <th class="align-middle" scope="row">2</th>
                                                <td class="align-middle">What would you say to parents of talented young kids based on your learnings with your child?</td>
                                                <td class="text-center align-middle play-video-box-tab"><a href="#" class="fw-bold w-100" data-bs-toggle="modal" data-bs-target="#exampleModal"> <img src="{{asset('web/assets/images/new-img/favicon.svg')}}" alt="Play Icon" width="20"> Play Video</a></td>
                                                <td class="text-center align-middle">
                                                    <!-- <a href="#" class="btn btn-success px-3 py-1"><i class="far fa-edit"></i></a> -->
                                                    <a href="#" class="btn btn-info px-3 py-1 text-white"><i class="fas fa-plus"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="align-middle" scope="row">3</th>
                                                <td class="align-middle">What would you say to parents of talented young kids based on your learnings with your child?</td>
                                                <td class="text-center align-middle play-video-box-tab"><a href="#" class="fw-bold w-100" data-bs-toggle="modal" data-bs-target="#exampleModal"> <img src="{{asset('web/assets/images/new-img/favicon.svg')}}" alt="Play Icon" width="20"> Play Video</a></td>
                                                <td class="text-center align-middle">
                                                    <a href="#" class="btn btn-success px-3 py-1"><i class="far fa-edit"></i></a>
                                                    <!-- <a href="#" class="btn btn-info px-3 py-1 text-white"><i class="fas fa-plus"></i></a> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="align-middle" scope="row">4</th>
                                                <td class="align-middle">What would you say to parents of talented young kids based on your learnings with your child?</td>
                                                <td class="text-center align-middle play-video-box-tab"><a href="#" class="fw-bold w-100" data-bs-toggle="modal" data-bs-target="#exampleModal"> <img src="{{asset('web/assets/images/new-img/favicon.svg')}}" alt="Play Icon" width="20"> Play Video</a></td>
                                                <td class="text-center align-middle">
                                                    <!-- <a href="#" class="btn btn-success px-3 py-1"><i class="far fa-edit"></i></a> -->
                                                    <a href="#" class="btn btn-info px-3 py-1 text-white"><i class="fas fa-plus"></i></a>
                                                </td>
                                            </tr>
                                            
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
                                              <th scope="col" class="text-center">Action</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <th class="align-middle" scope="row">1</th>
                                              <td class="align-middle">What would you say to parents of talented young kids based on your learnings with your child?</td>
                                              <td class="text-center align-middle play-video-box-tab"><a href="#" class="fw-bold w-100" data-bs-toggle="modal" data-bs-target="#exampleModal"> <img src="{{asset('web/assets/images/new-img/favicon.svg')}}" alt="Play Icon" width="20"> Play Video</a></td>
                                              <td class="text-center align-middle">
                                                    <a href="#" class="btn btn-success px-3 py-1"><i class="far fa-edit"></i></a>
                                                    <!-- <a href="#" class="btn btn-info px-3 py-1 text-white"><i class="fas fa-plus"></i> Add Video</a> -->
                                              </td>
                                            </tr>
                                            <tr>
                                                <th class="align-middle" scope="row">2</th>
                                                <td class="align-middle">What would you say to parents of talented young kids based on your learnings with your child?</td>
                                                <td class="text-center align-middle play-video-box-tab"><a href="#" class="fw-bold w-100" data-bs-toggle="modal" data-bs-target="#exampleModal"> <img src="{{asset('web/assets/images/new-img/favicon.svg')}}" alt="Play Icon" width="20"> Play Video</a></td>
                                                <td class="text-center align-middle">
                                                    <!-- <a href="#" class="btn btn-success px-3 py-1"><i class="far fa-edit"></i></a> -->
                                                    <a href="#" class="btn btn-info px-3 py-1 text-white"><i class="fas fa-plus"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="align-middle" scope="row">3</th>
                                                <td class="align-middle">What would you say to parents of talented young kids based on your learnings with your child?</td>
                                                <td class="text-center align-middle play-video-box-tab"><a href="#" class="fw-bold w-100" data-bs-toggle="modal" data-bs-target="#exampleModal"> <img src="{{asset('web/assets/images/new-img/favicon.svg')}}" alt="Play Icon" width="20"> Play Video</a></td>
                                                <td class="text-center align-middle">
                                                    <a href="#" class="btn btn-success px-3 py-1"><i class="far fa-edit"></i></a>
                                                    <!-- <a href="#" class="btn btn-info px-3 py-1 text-white"><i class="fas fa-plus"></i></a> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="align-middle" scope="row">4</th>
                                                <td class="align-middle">What would you say to parents of talented young kids based on your learnings with your child?</td>
                                                <td class="text-center align-middle play-video-box-tab"><a href="#" class="fw-bold w-100" data-bs-toggle="modal" data-bs-target="#exampleModal"> <img src="{{asset('web/assets/images/new-img/favicon.svg')}}" alt="Play Icon" width="20"> Play Video</a></td>
                                                <td class="text-center align-middle">
                                                    <!-- <a href="#" class="btn btn-success px-3 py-1"><i class="far fa-edit"></i></a> -->
                                                    <a href="#" class="btn btn-info px-3 py-1 text-white"><i class="fas fa-plus"></i></a>
                                                </td>
                                            </tr>
                                            
                                          </tbody>
                                        </table>
                                    </div>
                                    <!--Question for Friday Frenzy End-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection 
@section('script')
@endsection
    