@extends('web.layouts.app') 
@section('content')
@if(session('error'))
<script>
    $(document).ready(function() {
      toastr.options = {
        'closeButton': true,
        'debug': true,
        'newestOnTop': true,
        'progressBar': true,
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
    toastr.error('{{ session('error') }}');
</script>
@endif
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
  .imgprofileupdatehome{
    height: 80px;
    width: 80px;
    background: #1badc4;
  }

  .publisher-details_home {
      font-size: 14px !important;
      font-weight: 500;
  }

  .view-btn-box-home {
      background: var(--dark-navy);
      border-radius: 10px 0px;
      position: absolute;
      bottom: -8px;
      right: -8px;
      padding: 8px 15px;
  }
  p.pt-3 {
      font-size: 16px;
      font-weight: bold;
  }
</style>
    <!-- Hero Slider Area End-->
    <section class="hero-banner-bg py-5">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h1>Become Part of the Inspiring Young Athletes Journey</h1>
            <div class="py-3">
              <a href="{{ route('web.video.publisher.all') }}" class="btn iya-btn-white">Watch Limited Free Videos</a>
            </div>
            <p class="mb-0">Want to see more? Subscribe here for only <span class="fw-bold">US$3.95/Month</span> and unlock the most powerful tool in Youth Sport.</p>
          </div>
          <div class="col-lg-12 pt-5">
            <h5 class="text-white">Trending Video</h5>
            <div class="row">
              <div class="col-lg-9">
                <div class="row">
                  @foreach ( $athleticCoaches as $athleticCoachprofile ) @php $datetime = $athleticCoachprofile->created_at; $dateTimestring = new DateTime($datetime); $year = $dateTimestring->format("Y"); $videoCount =
                  $athleticCoachprofile->videos_count; @endphp
                  <div class="col-md-6 col-xl-4 mb-3 d-none d-lg-block d-xl-block">
                    <div class="publisher-box p-2">
                      <div class="d-flex position-relative">
                        <div class="publisher-img align-self-center">
                          @if( $athleticCoachprofile->profile =="")
                          <img class="img-account-profile rounded-circle imgprofileupdatehome" src="{{asset('web/assets/images/new-img/dummyuser.png')}}" alt="" />
                          @else
                          <img class="img-account-profile rounded-circle imgprofileupdatehome" src="{{asset($athleticCoachprofile->profile)}}" alt="" />
                          @endif
                        </div>
                        <div class="publisher-details mt-2 ps-3 align-self-center">
                          <h6 class="lh-1">{{$athleticCoachprofile->name}}</h6>
                          <p class="lh-base mb-1 text-dark publisher-details_home"><i class="far fa-play-circle text-danger me-2"></i> {{$videoCount}} videos</p>
                          <p class="lh-base mb-0 text-dark publisher-details_home"><i class="far fa-calendar-alt text-break me-2"></i> joined {{$year}}</p>
                        </div>
                        <div class="view-btn-box-home">
                          <a href="{{ route('web.video.publisher.list',$athleticCoachprofile->id) }}" class="text-white">View <img src="{{asset('web/assets/images/new-img/view-icon.svg')}}" alt="arrow icon" /></a>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                  <div class="col-md-12 col-xl-4   mb-3 d-md-block d-lg-none">
                    <div class="home-trending-video-carousel owl-carousel">
                      <div>
                        @foreach ( $athleticCoaches as $athleticCoachprofile ) @php $datetime = $athleticCoachprofile->created_at; $dateTimestring = new DateTime($datetime); $year = $dateTimestring->format("Y"); $videoCount = $athleticCoachprofile->videos_count; @endphp
                        <div class="publisher-box p-2 mb-3">
                          <div class="d-flex position-relative">
                            <div class="publisher-img align-self-center">
                              @if( $athleticCoachprofile->profile =="")
                              <img class="img-account-profile rounded-circle imgprofileupdatehome" src="{{asset('web/assets/images/new-img/dummyuser.png')}}" alt="" />
                              @else
                              <img class="img-account-profile rounded-circle imgprofileupdatehome" src="{{asset($athleticCoachprofile->profile)}}" alt="" />
                              @endif
                            </div>
                            <div class="publisher-details mt-2 ps-3 align-self-center">
                              <h6 class="lh-1">{{$athleticCoachprofile->name}}</h6>
                              <p class="lh-base mb-1 text-dark publisher-details_home"><i class="far fa-play-circle text-danger me-2"></i> {{$videoCount}} videos</p>
                              <p class="lh-base mb-0 text-dark publisher-details_home"><i class="far fa-calendar-alt text-break me-2"></i> joined {{$year}}</p>
                            </div>
                            <div class="view-btn-box-home">
                              <a href="{{ route('web.video.publisher.list',$athleticCoachprofile->id) }}" class="text-white">View <img src="{{asset('web/assets/images/new-img/view-icon.svg')}}" alt="arrow icon"  class="d-none"/></a>
                            </div>
                          </div>
                        </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
              </div>
              </div>
              <div class="col-lg-3 mt-3 mt-lg-0">
                <div class="banner-slide-carousel owl-carousel">
                  <div>
                    <img src="{{asset('web/assets/images/quotes/Kidspic1.jpg')}}" alt="Quotes" class="img-fluid" />
                  </div>
                  <div>
                    <img src="{{asset('web/assets/images/quotes/Kidspic2.jpg')}}" alt="Quotes" class="img-fluid" />
                  </div>
                  <div>
                    <img src="{{asset('web/assets/images/quotes/Kidspic3.jpg')}}" alt="Quotes" class="img-fluid" />
                  </div>
                  <div>
                    <img src="{{asset('web/assets/images/quotes/Kidspic4.jpg')}}" alt="Quotes" class="img-fluid" />
                  </div>
                  <div>
                    <img src="{{asset('web/assets/images/quotes/Kidspic5.jpg')}}" alt="Quotes" class="img-fluid" />
                  </div>
                  <div>
                    <img src="{{asset('web/assets/images/quotes/Kidspic6.jpg')}}" alt="Quotes" class="img-fluid" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <!-- Video Publisher Section Start-->
     <section class="themeix-ptb-5 py-4">
      <div class="container">
          <p class="pt-3">Are you ready to leap ahead in your athletic journey? Whether you're sprinting, swimming, or scoring, the Inspiring Young Athletes program is your digital coach to success! Tailored for the mobile generation, this innovative platform connects you with legends of the game—real athletes and coaches who've walked the path you're on now.</p>
          <h3 class="">Discover the Secrets to Sporting Success:</h3>
          <ul class="top-list-icon pb-4">
              <li class=""><i class="far fa-check-circle me-2"></i> Personal stories of triumph and challenge from professional athletes.</li>
              <li class=""><i class="far fa-check-circle me-2"></i> Insider tips on what top coaches really look for in young talent.</li>
              <li class=""><i class="far fa-check-circle me-2"></i> Answers to the burning questions every up-and-comer has</li>
          </ul>
      </div>
    </section>
    <!-- Categories Section Start-->
    <section class="publisher-section categories-section py-5 pb-5">
        <div class="container">
            <div class="website-title text-center pb-5">
                <h2 class="text-white">Popular Sport Categories</h2>
                <div class="border-box m-auto"></div>
            </div>
            <div class="row g-3 mt-4">
                @foreach ($getcategory as $category)
                <div class="col-lg-2 col-6 mb-3">
                    <a href="{{ route('web.video.publisher',$category->category_slug) }}">
                        <div class="categorie-box text-center bg-white py-4 mx-3 rounded ">
                            <img class="" src="{{asset('storage')}}/{{$category->category_image}}" alt="{{$category->category_name}}">
                            <p class="mb-0">{{$category->category_name}}</p>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            <div class="text-center my-3">
                <a href="{{ route('web.categories') }}" class="btn iya-btn-white">View All Categories</a>
            </div>
        </div>
    </section>
    <!-- Categories Section End-->
    <!-- Video Publisher Section End-->
    <!-- Pricing Plan Section Start-->
    <section class="categories-section pt-5 my-5 pb-5">
        <div class="container">
            <div class="row g-3 mt-4">
                <div class="col-lg-10 m-auto">
                    <div class="row g-3">
                        <div class="col-lg-9 m-auto">
                            <div class="pricing-plan-box bg-blue border-blue py-3 px-4">
                                <h3 class="fw-bold text-left text-white">Why Subscribe for only <span class="pricing-amount text-white">US$ 3.95</span><span class="fw-bold"> / per month?</span></h3>
                                <!-- <p class="text-left text-white mb-0"><span class="fw-bold">Why Subscribe for only </span><span class="pricing-amount text-white">$ 4.50</span><span class="fw-bold"> / per month?</span></p> -->
                                <hr class="text-white">
                                <ul class="top-list-icon text-left">
                                    <li class="text-white"><i class="far fa-check-circle me-2 text-white"></i><span class="fw-bold">Expertise :</span> Professionals offer valuable insights.</li>
                                    <li class="text-white"><i class="far fa-check-circle me-2 text-white"></i><span class="fw-bold">Inspiration :</span> Their success stories motivate aspiring athletes.</li>
                                    <li class="text-white"><i class="far fa-check-circle me-2 text-white"></i><span class="fw-bold">Learning from Setbacks :</span> Professionals share lessons from failures, teaching resilience and adaptability.</li>
                                    <li class="text-white"><i class="far fa-check-circle me-2 text-white"></i><span class="fw-bold">Practical Tips :</span> They provide specific strategies for success.</li>
                                    <li class="text-white"><i class="far fa-check-circle me-2 text-white"></i><span class="fw-bold">Understanding the Lifestyle :</span> Pros share an athlete's life, revealing the dedication and sacrifices needed.</li>
                                    <li class="text-white"><i class="far fa-check-circle me-2 text-white"></i><span class="fw-bold">Goal Setting and Planning :</span> Pros guide in setting realistic goals and crafting a strategic plan.</li>
                                </ul>
                                <div class="mt-3 text-left">
                                    @if(empty($checkSubscriptions))
                                    <a href="{{ route('web.joinnow') }}" class="btn iya-btn-white text-blue">Join Now</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Pricing Plan Section End-->

    <!-- FAQ Section Start-->

    <section class="faq-section pb-5">
        <div class="container">
            <div class="website-title text-center pb-5">
                <h2>Frequently Asked Questions</h2>
                <div class="border-box m-auto"></div>
            </div>
            <div class="row">
                <div class="col-lg-8 m-auto">
                    <div class="faq-accordion p-3">
                        <div class="accordion" id="accordionExample">
                            @foreach ($faqs as $faq)
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button text-black" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$faq->id}}" aria-expanded="true" aria-controls="collapse{{$faq->id}}">
                                  {{$faq->question}}
                                </button>
                              </h2>
                              <div id="collapse{{$faq->id}}" class="accordion-collapse collapse" aria-labelledby="heading{{$faq->id}}" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                  <p>{{$faq->answer}}</p>
                                </div>
                              </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section End-->

    <!-- Start Call To Action Area -->
    <div class="call-to-action-area py-5 mt-0 mt-lg-5 ">
        <div class="container">
            <div class="row py-5">
                <div class="col-md-12">
                    <div class="action-content text-center pb-5">
                        <h2 class="text-dark fw-bold lh-base">Don't miss out on the latest updates, promotions, and exclusive content. Sign up for our newsletters by entering your email address below.</h2>
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
    