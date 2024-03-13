@extends('web.layouts.app')
@section('content')
<div class=" osahan-pricing">
	<div class="container">
		<div class="row py-lg-4">
			<div class="col-md-5 mx-auto mb-md-2">
			  <div class="text-center mt-4">
			   <img src="{{asset('assets/web/images/Checklist-dd.png')}}" class="img-fluid">
			   <h2 class="text-gray-900">You Have not Purchase Plan</h2>
			   <h6>You have not Purchase any Plan yet.</h6>
			   <div>
				<a href="{{route('my.plan')}}" class="one-dd btn">View Our Pricing</a>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection 
