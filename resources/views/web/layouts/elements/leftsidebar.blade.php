<div class="col-lg-3 col-md-12 px-0 px-lg-3">
    <!-- Start Navigation -->
    <div class="header-section dashboard-menu py-2 px-0 px-lg-3">
        <div class="mod-menu">
            <div class="d-none d-lg-block">
                <div class=" image d-flex flex-column justify-content-center align-items-center">
                    <div class="user-profile mt-2 mt-lg-5">
                        @if(empty(auth()->user()->profile))
                            <img src="{{asset('web/assets/images/new-img/dummyuser.png')}}" alt="user img" height="100" width="100" />
                        @else
                            <img src="{{asset(auth()->user()->profile)}}" alt="user img" height="100" width="100" />
                        @endif
                    </div>
                    <h5 class="text-white mt-3">{{ auth()->user()->name }}</h5>
                    @if(auth()->user()->roles != "User")
                        @php
                            $catid = auth()->user()->category;
                            $category = DB::table('category')->where('category_id',$catid)->first();
                        @endphp
                        <p class="text-white">{{$category->category_name ?? ''}}</p>
                    @endif
                    <div> <a href="{{ route('web.athletes.coach.GetEditProfile') }}" class="btn btn-primary bg-white text-dark border-0 px-4">Edit Profile</a> </div>
                </div>
            </div>
            <hr class="d-none d-lg-block">
            @if(auth()->user()->roles != "User")
            <nav class="navbar left-menu-box px-3 px-lg-0">
                <button class="navbar-toggler d-lg-none d-md-block" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <div class="d-flex"><span class="fa fa-bars text-white"></span><span class="d-block d-lg-none ps-3 text-white">Dashboard</span></div>
                </button>
                <div class="d-block d-lg-none d-flex edit-btn-set">
                    <div class="user-profile mt-lg-5 d-flex justify-content-center">
                        <a class="c-cat d-flex align-items-center" href="#">
                            <div class="d-flex justify-content-center">
                                @if(empty(auth()->user()->profile))
                                    <img src="{{asset('web/assets/images/new-img/dummyuser.png')}}" alt="user img" height="100" width="100" />
                                @else
                                    <img src="{{asset(auth()->user()->profile)}}" alt="user img" height="100" width="100" />
                                @endif 
                            </div>
                            <div>
                                <span class="text-white h6">{{ auth()->user()->name }}</span> <br>
                                <span class="text-white cate-name">{{$category->category_name ?? ''}}</span>
                            </div>
                        </a>
                    </div>
                    <div class="edit-btn"><a href="{{ route('web.athletes.coach.GetEditProfile') }}" class="btn btn-primary btn-sm bg-white text-dark border-0">Edit</a></div>
                </div>
                <div class="collapse navbar-collapse px-3 px-lg-3 m-space" id="navbarNavDarkDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link px-2 {{ request()->is('athletes-coach/dashboard') ? 'active' : '' }}" href="{{ route('web.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle px-2 {{ request()->is('athletes-coach/Video*') ? 'show' : '' }}" href="#"
                                id="navbarDarkDropdownMenuLink" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="far fa-play-circle me-2"></i> Videos
                            </a>
                            <ul class="dropdown-menu {{ request()->is('athletes-coach/Video*') ? 'show' : '' }}"
                                aria-labelledby="navbarDarkDropdownMenuLink">
                                <li class="py-0"><a class="dropdown-item" href="{{ route('web.athletes.coach.questionandanswere') }}">Question & Answer</a></li>
                                <li class="py-0"><a class="dropdown-item {{ request()->is('athletes-coach/Video/index') ? 'active' : '' }}" href="{{ route('web.Video.index') }}">All Videos</a></li>
                                <li class="py-0"><a class="dropdown-item {{ request()->is('athletes-coach/Video/add') ? 'active' : '' }}" href="{{ route('web.Video.add') }}">Add New Video</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link px-2" href="{{ route('web.revenue.history') }}"><i class="fas fa-coins me-2"></i> Revenue History</a></li>
                        <li class="nav-item"><a class="nav-link px-2" href="{{ route('web.athletes.coach.referralAndEarn') }}"><i class="fas fa-coins me-2"></i> Refer and Earn</a></li>
                        {{-- <li class="nav-item"><a href="{{ route('web.athletes.coach.questionandanswere') }}" class="nav-link px-2"><i class="fas fa-coins me-2"></i>Question & Answer</a></li> --}}
                        <li class="nav-item"><a href="{{ route('web.athletes.coach.ChangePassword') }}" class="nav-link px-2 {{ request()->is('athletes-coach/changepassword') ? 'active' : '' }}" href="#"><i class="fas fa-coins me-2"></i> Change Password</a></li>
                        {{-- <li class="nav-item"><a class="nav-link px-2" href="{{ route('web.bank.index') }}"><i class="fas fa-coins me-2"></i> Add Account</a></li> --}}
                    </ul>
                </div>
            </nav>
            @else
            <nav class="navbar left-menu-box px-3 px-lg-0 m-space">
                <button class="navbar-toggler d-lg-none d-md-block" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <div class="d-flex"><span class="fa fa-bars text-white"></span></div>
                </button>
                <div class="d-block d-lg-none d-flex edit-btn-set">
                    <div class="user-profile mt-2 mt-lg-5">
                       <a href="#">
                       @if(empty(auth()->user()->profile))
                            <img src="{{asset('web/assets/images/new-img/dummyuser.png')}}" alt="user img" height="40" width="40" />
                        @else
                            <img src="{{asset(auth()->user()->profile)}}" alt="user img"/>
                        @endif 
                        <span class="text-white h6">{{ auth()->user()->name }}</span></a>
                    </div>
                    <div class="edit-btn"><a href="{{ route('web.athletes.coach.GetEditProfile') }}" class="btn btn-primary btn-sm bg-white text-dark border-0">Edit</a></div>
                </div>
                <div class="collapse navbar-collapse px-3 px-lg-3" id="navbarNavDarkDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a href="{{ route('web.athletes.coach.MySubcription') }}" class="nav-link px-2" href="#"><i class="fas fa-coins me-2"></i> My Subscription</a></li>
                        <li class="nav-item"><a href="{{ route('web.athletes.coach.ChangePassword') }}" class="nav-link px-2 {{ request()->is('athletes-coach/changepassword') ? 'active' : '' }}" href="#"><i class="fas fa-coins me-2"></i> Change Password</a></li>
                    </ul>
                </div>
            </nav>
            @endif
        </div>
    </div>
    <!-- end navigation -->
</div>
