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
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button text-black" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    What inspirational content can I expect on the website?
                                </button>
                              </h2>
                              <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                  <p>Every athlete has an inspirational story behind their success and our mission is to have over 300 athletes on board within 2 years</p>
                                </div>
                              </div>
                            </div>
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Are there success stories of young athletes overcoming obstacles?
                                </button>
                              </h2>
                              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Some of our professional athletes are still fairly young athletes but all our athletes have overcome obstacles at some stage in their journey.</p>
                                </div>
                              </div>
                            </div>
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Do you provide tips for balancing academics and sports for young athletes?
                                </button>
                              </h2>
                              <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>If this is not one of the questions asked online, we do have an ‘ask a question to an athlete’ button on the page where your question will be sent to a specific  athlete that you may want to ask it to and if time allows, they may answer it for you.</p>
                                </div>
                              </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFor">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFor" aria-expanded="false" aria-controls="collapseFor">
                                    Are there exclusive features or interviews with professional athletes and coaches?
                                  </button>
                                </h2>
                                <div id="collapseFor" class="accordion-collapse collapse" aria-labelledby="headingFor" data-bs-parent="#accordionExample">
                                  <div class="accordion-body">
                                      <p>Every athlete or coach is asked 8 questions to activate their profile and after that can give any advice after that. They can download unlimited videos with advice.</p>
                                  </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFive">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    How can young athletes benefit from joining the community or forum on the site?
                                  </button>
                                </h2>
                                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                  <div class="accordion-body">
                                      <p>Aspiring Young Athletes would have unlimited resources to choose from seeing athletes from numerous sporting codes talk each answering a minimum of 8 questions from their journey through their teen years so the benefits are immense.</p>
                                  </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingSix">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    Do you offer training resources and workout plans for specific sports?
                                  </button>
                                </h2>
                                <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                                  <div class="accordion-body">
                                      <p>Unfortunately, we don’t offer training plans as each athlete is different and this would need to be advised by a specialist coach or mentor who understand that athlete.</p>
                                  </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingSeven">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                    What advice do you have for parents supporting aspiring young athletes?
                                  </button>
                                </h2>
                                <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                                  <div class="accordion-body">
                                      <p>Great question, we actually ask athletes what their parents did (right or wrong) and hope in time to include parents of athletes on the platform to ask them about their kids.</p>
                                  </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingEight">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                    What advice do you have for parents supporting aspiring young athletes?
                                  </button>
                                </h2>
                                <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#accordionExample">
                                  <div class="accordion-body">
                                      <p>Great question, we actually ask athletes what their parents did (right or wrong) and hope in time to include parents of athletes on the platform to ask them about their kids.</p>
                                  </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingEight">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                    Are there opportunities for networking or mentorship within the platform?
                                  </button>
                                </h2>
                                <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#accordionExample">
                                  <div class="accordion-body">
                                      <p>At this stage no but definitely something we are looking at in the future allowing aspiring young athletes across the world to be able to speak to each other and support one another.</p>
                                  </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingNine">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                    What sets your platform apart in terms of inspiring young athletes?
                                  </button>
                                </h2>
                                <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine" data-bs-parent="#accordionExample">
                                  <div class="accordion-body">
                                      <p>We see this platform as the only program for aspiring young athletes where they can hear from multiple male, female and disabled athletes and coaches across different sporting codeson one platform.</p>
                                  </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTen">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                                    Is the content suitable for athletes in various sports, or is it focused on specific ones?
                                  </button>
                                </h2>
                                <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen" data-bs-parent="#accordionExample">
                                  <div class="accordion-body">
                                      <p>Most definitely. We aim to have 30+ sporting codes available in time. Our belief is no matter the sport, aspiring young athletes can learn lessons from all athletes, not just those from their specific sport.</p>
                                  </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingEleven">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                                    How frequently is new content added to the website?
                                  </button>
                                </h2>
                                <div id="collapseEleven" class="accordion-collapse collapse" aria-labelledby="headingEleven" data-bs-parent="#accordionExample">
                                  <div class="accordion-body">
                                      <p>Athletes are free to download content whenever they please. Initially they need to download 8 videos each onto the platform and then have choices of other questions to download on top of the initial 8.</p>
                                  </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwelve">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
                                    Are there age-appropriate resources for very young athletes?
                                  </button>
                                </h2>
                                <div id="collapseTwelve" class="accordion-collapse collapse" aria-labelledby="headingTwelve" data-bs-parent="#accordionExample">
                                  <div class="accordion-body">
                                      <p>I believe the stories from athletes who have become professional will resonate with ALL aspiring young athletes no matter what their ages are.</p>
                                  </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThirteen">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen">
                                    Can coaches or educators benefit from the content on the website?
                                  </button>
                                </h2>
                                <div id="collapseThirteen" class="accordion-collapse collapse" aria-labelledby="headingThirteen" data-bs-parent="#accordionExample">
                                  <div class="accordion-body">
                                      <p>The idea behind Raising Young Athletes is one of education so yes 100% anyone can learn from these athletes. We will have a login where education facilities can pay for a subscription on behalf of a young aspiring athlete with an access code.</p>
                                  </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFourteen">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFourteen" aria-expanded="false" aria-controls="collapseFourteen">
                                    Is the content accessible to individuals outside of a specific region or country?
                                  </button>
                                </h2>
                                <div id="collapseFourteen" class="accordion-collapse collapse" aria-labelledby="headingFourteen" data-bs-parent="#accordionExample">
                                  <div class="accordion-body">
                                      <p>The beauty of this online platform is that it is accessible to all who have an internet connection anywhere in the world.</p>
                                  </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFifteen">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFifteen" aria-expanded="false" aria-controls="collapseFifteen">
                                    Can I cancel my subscription at any time?
                                  </button>
                                </h2>
                                <div id="collapseFifteen" class="accordion-collapse collapse" aria-labelledby="headingFifteen" data-bs-parent="#accordionExample">
                                  <div class="accordion-body">
                                      <p>Yes you can, you just need to give 30 days’ notice.</p>
                                  </div>
                                </div>
                            </div>
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
    