 <!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu">
                <!-- LOGO -->
                <a href="{{route('admin.')}}" class="logo text-center logo-light">
                    <span class="logo-lg">
                        <img src="{{asset('assets/admin/images/logo.png')}}" alt="" height="50">
                    </span>
                    <span class="logo-sm">
                        <img src="{{asset('assets/admin/images/logo.png')}}" alt="" height="50">
                    </span>
                </a>

                <!-- LOGO -->
                <a href="{{route('admin.')}}" class="logo text-center logo-dark">
                    <span class="logo-lg">
                        <img src="{{asset('assets/admin/images/logo.png')}}" alt="" height="50">
                    </span>
                    <span class="logo-sm">
                        <img src="{{asset('assets/admin/images/logo.png')}}" alt="" height="50">
                    </span>
                </a>

                <div class="h-100" id="left-side-menu-container" data-simplebar>
                    <ul class="metismenu side-nav">
                        <li class="side-nav-title side-nav-item"></li>
                        <li class="side-nav-item">
                            <a href="{{route('admin.dashboard')}}" class="side-nav-link">
                                <i class="uil-home-alt"></i><span> Dashboard </span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="javascript: void(0);" class="side-nav-link"> <i class="uil-users-alt"></i> <span>Users</span> <span class="menu-arrow"></span> </a>
                            <ul class="side-nav-second-level" aria-expanded="false">
                                <li> <a href="{{route('admin.users.index')}}">All Users</a> </li>
                            </ul>
                        </li>
                        <li class="side-nav-item">
                            <a href="javascript: void(0);" class="side-nav-link"> <i class="uil-bag"></i> <span>Businesses</span> <span class="menu-arrow"></span> </a>
                            <ul class="side-nav-second-level" aria-expanded="false">
                                <li> <a href="{{route('admin.business.index')}}">Businesses List</a> </li>
                            </ul>
                        </li>
                        <li class="side-nav-item">
                            <a href="javascript: void(0);" class="side-nav-link"> <i class="uil-document"></i> <span>Pages</span> <span class="menu-arrow"></span> </a>
                            <ul class="side-nav-second-level" aria-expanded="false">
                                <li> <a href="{{route('admin.pages.index')}}">Page List</a> </li>
                            </ul>
                        </li>
                        <!-- <li class="side-nav-item">
                            <a href="javascript: void(0);" class="side-nav-link"> <i class="uil-dollar-alt"></i> <span>Plans</span> <span class="menu-arrow"></span> </a>
                            <ul class="side-nav-second-level" aria-expanded="false">
                                <li> <a href="{{route('admin.plans.index')}}">Plan List</a> </li>
                            </ul>
                        </li> -->
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- Left Sidebar End -->
