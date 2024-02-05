@extends('web.layouts.app') 
@section('content')

<!-- Hero Slider Area Start-->
<section class="hero-banner-bg py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 align-self-center">
                <div class="banner-text">
                    <h2 class="text-white"><span class="fw-bold">About Us</span></h2>
                    <div class="py-3"><span class="bg-white p-2 fw-bold h5 rounded">Aspiring Young Athletes</span></div>
                    <p class="py-3">In the heart of Inspiring Young Athletes lies a deeply personal journey. Conceived by our founder, Dave Turnbull, this platform emerged from a parental quest for answers, a quest sparked by his son's unwavering passion for sports - soccer, cricket, rugby, Oz tag, NFL flag football – you name it.</p>
                    <p class="pt-2">Dave, ever the concerned parent, sought insights from professional athletes. Questions burned within him: Did they play multiple sports? What set them apart? When did they specialize? In his pursuit of information, he found a gap. No platform offered the specifics he sought. So, fuelled by the belief that information empowers, he decided to create that platform.</p>
                </div>
            </div>
            <div class="col-lg-6 align-self-center text-center">
                <img src="{{asset('web/assets/images/new-img/about-0.png')}}" alt="Banner Img" class="img-fluid">
            </div>
        </div>
    </div>
</section>
<!-- Hero Slider Area End-->
<!-- Watch video by Start-->
<section class="watch-video-free  py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 align-self-center">
                <img src="{{asset('web/assets/images/new-img/about-1.png')}}" alt="About" class="img-fluid">
            </div>
            <div class="col-lg-6 align-self-center">
                <p>Three years of weekly dialogues with friend and ex-Olympian Owen Hughes followed. Finally, in late 2023, the vision was shared with two like-minded friends, both fathers who resonated with the cause. Over coffee, Inspiring Young Athletes was born.</p>
                <p>Obstacles, which in hindsight mirrored the challenges athletes face, were overcome. Lessons learned by Dave became the driving force - never give up, especially on a passion that could impact young lives.</p>
            </div>
        </div>
    </div>
</section>
<section class="watch-video-free">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 align-self-center">
                <p><span class="fw-bold">Our Mission Is Simple : to empower the next generation of athletes aspiring for events like the Brisbane 2032 Olympics. We recognize the financial struggles of many athletes, particularly women and those with disabilities. So, a major percentage of subscription income directly supports them, creating a symbiotic relationship between mentor and mentee.</p>
                <p>Beyond personal gain, 5% of our income goes to charities associated with kids' sports, aligning with our commitment to community impact. Our ultimate goal is to spread knowledge, inspire resilience, and show that setbacks are part of the journey. Aspiring Young Athletes is not just a platform; it's a beacon of motivation for every young dreamer out there.</p>
            </div>
            <div class="col-lg-6 align-self-center">
                <img src="{{asset('web/assets/images/new-img/mission-1.png')}}" alt="About" class="img-fluid">
            </div>
        </div>
    </div>
</section>
<!-- Watch video by End-->

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
    