@extends('web.layouts.app')
@section('content')
<section class="mt-5">
	<div class="container">
	  <div class="row mb-lg-4">
		<div class="col-lg-8 mx-auto">
			<div id="about" class="bg-white shadow-sm rounded p-4 mb-4">
				<h5 class="mb-2  text-gray-900">List Your Offer  </h5>
			   	<hr>
				@if(isset($plan->offer) && !$plan->offer->isEmpty())
				   @foreach($plan->offer as $offer)
				   <div class="mb-2">
						<img src="{{asset('uploads/offers/images/'.$offer->image)}}" class="shadow img-fluid">
					</div>	
					@endforeach
				@endif
			 	<div class=" custom-card-badge-gs mt-2">
				You have {{$remaining}} Offers remaining to list </div>
				@if($remaining)
				<div class="mt-3">
					<a href="{{route('offer.creation.last')}}" class="btn btn-crete-add">Create New Offer </a>
				</div>
			   @endif
			</div>
		</div>
	  </div>
	</div>
  </section>
@endsection 
