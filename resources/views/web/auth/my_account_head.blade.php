<div class="card overflow-hidden">
    <div class="card-header">
        <h3 class="card-title">My Account</h3>
    </div>
    <div class="card-body text-center item-user mb-3">
        <div class="profile-pic">
            <div class="profile-pic-img">
                @if(Auth::user()->avatar && file_exists(public_path(Auth::user()->avatar))) 
                    <img src="{{asset(Auth::user()->avatar)}}" class="brround" alt="user">
                @else
                    <img src="{{asset('assets/web/assets/images/avatar.jpg')}}" class="brround" alt="user">
                @endif 
            </div>
            <a href="userprofile.html" class="text-dark">
                <h4 class="mt-4 mb-1 font-weight-semibold">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</h4>
            </a>
            <p>{{Auth::user()->email}}</p>
        </div>
    </div>
</div>