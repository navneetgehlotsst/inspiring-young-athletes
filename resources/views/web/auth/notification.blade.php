@extends('web.layouts.app')
@section('content')
<section class="mt-5 mb-5">
	<div class="container">
		<div class="row mb-lg-4">
		<div class="col-lg-12 mx-auto">
		  <div class="bg-white rounded shadow-sm mb-4 p-4  align-items-center clearfix restaurant-detailed-earn-pts card-icon-overlap">
			@if(!$notification->isEmpty())
			@foreach($notification as $notice)
			<div class="media p-3 border-bottom align-items-center">
			  <div class="media-body pl-3">
				<h6 class="h6 mb-1 text-gray-900">{{$notice->message}}</h6>
				<p class="d-block text-muted m-0">{{date('d M, Y',strtotime($notice->date))}} {{$notice->time}}</p>
			  </div>
			</div>
			@endforeach
			@php 
				echo '<div class="float-left cust_pagination">';
				$total = $notification->total();
				$currentPage = $notification->currentPage();
				$perPage = $notification->perPage();
				
				$from = ($currentPage - 1) * $perPage + 1;
				$to = min($currentPage * $perPage, $total);
				
				echo "Showing {$from} to {$to} of {$total} entries";
				echo '</div>';
			@endphp
			{{ $notification->links("web.layouts.elements.cust_pagination") }}
			@else
			<p>No notification yet.</p>
			@endif	
		</div>
		</div>
	  </div>
	</div>
</section>
@endsection 
