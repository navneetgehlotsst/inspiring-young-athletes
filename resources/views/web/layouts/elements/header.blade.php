<!-- Start Header -->
<header>
    <div class="header-top hidden-xs">
        <div class="container">
            <div class="row">
                <div class="col-md-12 d-none d-lg-block">
                    <div class="header-top-area">
                        <div class="site-info left">
                            <div class="mail-address">
                                <i class="fa fa-envelope text-white"></i>
                                <a href="mailto:info@inspiringyoungathletes.com">info@inspiringyoungathletes.com </a>
                            </div>
                        </div>
                        @if(Auth::check())
                            <div class="user-info right pr-0">
                                <div class="login-info">
                                    @if(auth()->user()->roles == "User")
                                        <a href="{{ route('web.index') }}" class="pr-0"><i class="fa fa-lock"></i><em>Welcome, </em> {{ auth()->user()->name }}</a>
                                        <a href="{{ route('web.user.profile') }}" class="text-white"><i class="fa fa-lock"></i>Edit Profile</a>
                                    @else
                                        <a href="{{ route('web.dashboard') }}" class="pr-0"><i class="fa fa-lock"></i><em>Welcome, </em> {{ auth()->user()->name }}</a>
                                    @endif
                                    <span class="sepator">|</span>
                                </div>
                                <div class="upload-opt">
                                    <a href="{{ route('web.athletes.coach.logout') }}"><i class="fas fa-user"></i>Logout</a>
                                </div>
                            </div>
                        @else
                            <div class="user-info right">
                                <div class="upload-opt">
                                    <a href="{{ route('web.athletes.coach.register') }}"><i class="fas fa-user"></i>Register Athletes & Coach</a>
                                    <span class="sepator">|</span>
                                </div>
                                <div class="upload-opt">
                                    <a href="{{ route('web.user.register') }}"><i class="fas fa-user"></i> User Register</a>
                                    <span class="sepator">|</span>
                                </div>
                                <div class="login-info">
                                    <a href="{{ route('web.login') }}"><i class="fa fa-lock"></i> login</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-12 d-lg-none d-block">
                    @if(Auth::check())
                    <div class="user-info right">
                        <div class="login-info">
                            <a href="{{ route('web.athletes.coach.logout') }}"><i class="fas fa-user"></i>Logout</a>
                        </div>
                    </div>
                    <div class="dropdown w-75">
                            @php
                                $name = explode(" ", auth()->user()->name)
                            @endphp
                        @if(auth()->user()->roles == "User")
                            <a href="{{ route('web.index') }}" class="text-white"><i class="fa fa-lock"></i><em>Welcome, </em> {{ $name['0'] }}</a>
                            <a href="{{ route('web.index') }}" class="text-white"><i class="fa fa-lock"></i>Edit Profile</a>
                        @else
                            <a href="{{ route('web.dashboard') }}" class="text-white"><i class="fa fa-lock"></i><em>Welcome, </em> {{ $name['0'] }}</a>
                        @endif
                    </div>
                    @else
                    <div class="user-info right">
                        <div class="login-info">
                            <a href="{{ route('web.login') }}"><i class="fa fa-lock"></i> login</a>
                        </div>
                    </div>
                    <div class="dropdown w-75">
                        <a class="dropdown-toggle text-white" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            Register
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li>
                                <a class="dropdown-item" href="{{ route('web.athletes.coach.register') }}"><i class="fas fa-user"></i>Register Athletes & Coach</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('web.user.register') }}"><i class="fas fa-user"></i> User Register</a>
                            </li>
                        </ul>
                    </div>
                    @endif
                </div>                
            </div>
        </div>
    </div>
    <!-- Navigation area starts -->
    <div class="main-menu"> 
        <!-- Start Navigation -->
        <nav class="header-section pin-style">
            <div class="container">
                <div class="mod-menu">
                    <div class="row">
                        <div class="col-lg-3 col-9 align-self-center">
                            <a href="{{ route('web.index') }}" title="logo" class="logo"><img src="{{asset('web/assets/images/new-img/logo.svg')}}" alt="logo"></a>
                        </div>
                        <div class="col-lg-9 col-3 nopadding align-self-center">
                            <div class="main-nav rightnav">
                                <ul class="top-nav">
                                    <li class="visible-this d-md-none menu-icon">
                                        <a href="#" class="navbar-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#menu" aria-expanded="false"><i class="fa fa-bars"></i></a>
                                    </li>
                                </ul>
                                <div id="menu" class="collapse header-menu">
                                    <ul class="nav themeix-nav">
                                        <li><a href="{{ route('web.athletes') }}">Athletes</a></li>
                                        <li><a href="{{ route('web.coach') }}">Coach</a></li>
                                        <li><a href="{{ route('web.coming-soon') }}">Parent</a></li>
                                        <li class="mega-menu remove-border active"><a href="{{ route('web.categories') }}">Categories</a><span class="arrow"></span>
                                            <ul>
                                                @php 
                                                    $getcategory = DB::table('category')->get();
                                                @endphp
                                                @foreach ($getcategory as $category)
                                                    <li>
                                                        <a href="{{ route('web.video.publisher',$category->category_slug) }}"> <img src="{{asset('storage')}}/{{$category->category_image}}" alt="{{$category->category_name}}" @if($category->category_id == 3 || $category->category_id == 13) width="23px" @else width="25px" @endif>
                                                            {{$category->category_name}}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li><a href="{{ route('web.friday.frenzy') }}">Game Day Prep</a></li>
                                        <li><a href="{{ route('web.question') }}">Athlete/Coach Questions</a></li>
                                        <li><a href="{{ route('web.new.video') }}">New Videos</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <!-- end navigation -->
    </div>
    <!-- Navigation area ends -->
</header>
<!-- End Header -->