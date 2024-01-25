@extends('web.layouts.app') 
@section('content')
<section class="dashboard-section">
    <div class="container">
        <div class="row">
            @include('web.layouts.elements.leftsidebar')
            <div class="col-lg-9 py-3">
                <section class="pt-3">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <!-- Start Video Post -->
                                <div class="video-post-wrapper">
                                    <div class="single-video full-video-view">
                                        <div class="video-img feature-post-img">
                                           <video class="w-100" height="500" controls poster="{{asset($getvedio->thumbnails)}}">
                                                <source src="{{asset($getvedio->vedio)}}" type="video/mp4/mov/avi/wmv">
                                                <source src="{{asset($getvedio->vedio)}}" type="video/ogg">
                                                 Your browser does not support the video tag.
                                            </video>
                                        </div>
                                    </div>
                                    <div class="video-posts-data">
                                        <div class="video-post-title">
                                            <div class="d-flex d-lg-block">
                                                <div class="video-post-info">
                                                    <div class="video-post-date pt-2">
                                                        <span class="h5"><i class="fas fa-calendar-alt"></i></span>
                                                        @php
                                                            $uplaoddate = date_format($getvedio->created_at,"d/m/Y")
                                                        @endphp   
                                                        <p class="h5">{{$uplaoddate}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="video-post-counter text-end">
                                            <div class="video-post-viewers">
                                                <p class="h5"><span class="fa fa-eye view-icon"></span>{{$getvedio->vedio_veiw_count}} views</p>
                                            </div>
                                            {{-- <div class="video-like">
                                                <div class="share-options">
                                                    <p>Share On</p>
                                                    <ul class="social-share">
                                                        <li class="twitter-bg"><a href="#"><i class="fab fa-twitter"></i></a></li>
                                                        <li class="facebook-bg"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                                        <li class="google-bg"><a href="#"><i class="fab fa-youtube"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>                        
                                </div>
                                <!-- End Video Post -->
                            </div>
                        </div>  
                    </div>
                </section>        
            </div>
        </div>
    </div>
</section>

@endsection 
@section('script')
@endsection
    