@extends('web.layouts.app')
@section('content')
<section class="mt-5">
	<div class="container">
	  <div class="row mb-lg-4">
		<div class="col-lg-8 mx-auto">
			<div id="about" class="bg-white shadow-sm rounded p-4 mb-4">
				<h5 class="mb-2  text-gray-900">List Your Offer Ads </h5>
			   <hr>
			   <div class="row">
				<div class="col-lg-5 ">
					<img src="{{asset('assets/web/images/offer-img.png')}}" class="shadow img-fluid">
				</div>
				<div class="col-lg-7 text-center "><div class=" custom-card-badge-gs">
					You have {{$remaining}} Offers remaining to list </div>
					@if($remaining)
					<div class="mt-3">
						<a href="{{route('offer.creation')}}" class="btn btn-crete-add">Create New Offer </a>
					</div>
					@endif
					<div class="mt-3">
						<a href="{{route('my.plan')}}" class="btn btn-crete-add-gs">Upgrade Plan to get more Offers </a>
					</div>
				</div>
			   </div>
			</div>
		</div>
	  </div>
	</div>
</section>
@endsection 
