<ul class="navbar-nav sidebar accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('redeem.coupon')}}">
      <img class="img-fluid" src="{{asset('assets/web/images/logo.png')}}">
    </a>
    <li class="nav-item">
      <a class="nav-link {{request()->is('redeem-coupon') ? 'nav-link-active' : ''}}" href="{{route('redeem.coupon')}}">
        <i class="fas fa-fw fa-ticket-alt"></i>
        <span>Redeem Tokens</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed {{request()->is('coupon-overview') || request()->is('goodwill-coupon') ? 'nav-link-active' : ''}}" href="javascript:void(0);" data-toggle="collapse" data-target="#coupans" aria-expanded="true" aria-controls="coupans">
      <i class="fas fa-fw fa-ticket-alt"></i>
      <span>My Tokens</span>
      </a>
      <div id="coupans" class="collapse" aria-labelledby="coupans" data-parent="#accordionSidebar">
         <div class="bg-light py-2 collapse-inner rounded">
            <a class="collapse-item {{request()->is('coupon-overview') ? 'nav-link-active' : ''}}" href="{{route('coupon.overview')}}">Token Overview</a>
            <a class="collapse-item {{request()->is('goodwill-coupon') ? 'nav-link-active' : ''}}" href="{{route('goodwill.coupon')}}">Goodwill Token </a>
         </div>
      </div>
   </li>
    <li class="nav-item">
      <a class="nav-link collapsed {{request()->is('store-detail') ? 'nav-link-active' : ''}}" href="{{route('store.detail')}}">
        <i class="fas fa-fw fa-store"></i>
        <span>Store Details</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed {{request()->is('no-plan') || request()->is('my-plan') || request()->is('my-offer') || request()->is('create-offer') || request()->is('offer-creation') || request()->is('offer-creation-last') ? 'nav-link-active' : ''}}" href="javascript:void(0);" data-toggle="collapse" data-target="#stores" aria-expanded="true" aria-controls="stores">
        <i class="fas fa-fw fa-palette"></i>
        <span>My Offers</span>
      </a>
      <div id="stores" class="collapse" aria-labelledby="stores" data-parent="#accordionSidebar">
        <div class="bg-light py-2 collapse-inner rounded">
          <a class="collapse-item {{request()->is('no-plan') ? 'nav-link-active' : ''}}" href="{{route('no.plan')}}">My Plan</a>
          <a class="collapse-item {{request()->is('my-offer') ? 'nav-link-active' : ''}}" href="{{route('my.offer')}}">My Offers</a>
          <a class="collapse-item {{request()->is('create-offer') ? 'nav-link-active' : ''}}" href="{{route('create.offer')}}">Create Offer</a>
        </div>
      </div>
    </li>
    {{-- <li class="nav-item">
      <a class="nav-link collapsed {{request()->is('notifications') ? 'nav-link-active' : ''}}" href="{{route('notification')}}">
        <i class="fas fa-bell fa-fw"></i>
        <span>Notifications </span>
      </a>
    </li> --}}
    <li class="nav-item">
      <a class="nav-link collapsed" href="{{route('logout')}}">
        <i class="fas fa-sign-out-alt"></i>
        <span>Log Out</span>
      </a>
    </li>
    <div class="text-center d-none d-md-inline mt-3">
      <button class="rounded-circle border-0 bg-light" id="sidebarToggle"></button>
    </div>
  </ul>