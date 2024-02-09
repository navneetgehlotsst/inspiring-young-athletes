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
                    <h1 class="h3 mb-0 text-gray-800">Referral and Earn</h1>                               
                </div>
                <!-- Content Row -->
                <div class="card shadow p-3">
                    <div class="card-body">
                        <form class="referral-form" action="{{ route('web.athletes.coach.referralAndEarnSend') }}" method="post">
                            @csrf
                            <div class="mb-4 mt-1">
                                <h5>Invite your friends</h5>
                                <div class="d-flex flex-wrap flex-lg-nowrap gap-3 align-items-end">
                                    <div class="w-75">
                                        <label class="form-label mb-0" for="referralEmail">Enter friend’s email address and invite them</label>
                                        <input type="hidden" name="url" value="{{$url}}">
                                        <input type="hidden" name="code" value="{{auth()->user()->referral_token}}">
                                        <input type="email" id="referralEmail" name="referralEmail" class="form-control w-100" placeholder="Email address" required>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn iya-btn-blue">Submit</button>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex flex-wrap flex-lg-nowrap gap-3 align-items-end">
                                    <div class="w-75">
                                        <label class="form-label mb-0" for="referralEmail">Copy referral code to share with your friend’s</label>
                                        <input type="text" id="codeCopy" class="form-control w-100" onclick="myFunction()" placeholder="Email address" value="{{auth()->user()->referral_token}}" readonly>
                                        <div class="d-none" id="displayMessage" style="color: #40ed4e;">You have copied code sharing with friend’s</div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card shadow p-3 mt-2">
                    <div class="card-body">
                        <div class="mb-4 mt-1">
                            <h5>Invite History</h5>
                            @if(!empty($getrefhistory))
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Referred To</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ( $getrefhistory as $getref )
                                            <tr>
                                                <td>{{$getref->referral_to}}</td>
                                                <td class="text-capitalize">{{$getref->status}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p>No Invite history yet</p>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<script>
    function myFunction() {
      // Get the text field
      var copyText = document.getElementById("codeCopy");
    
      // Select the text field
      copyText.select();
      copyText.setSelectionRange(0, 99999); // For mobile devices
    
      // Copy the text inside the text field
      navigator.clipboard.writeText(copyText.value);
      
      // Alert the copied text
      //alert("You have copied code sharing with friend’s: " + copyText.value);
      $('#displayMessage').removeClass('d-none');

    }
    </script>

@endsection 
@section('script')

@endsection
    