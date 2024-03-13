@extends('web.layouts.app')
@section('content')
<div class=" osahan-pricing">
  <div class="container">
     <div class="row py-lg-4">
        <div class="col-md-9 mx-auto mb-md-2">
           <div class="text-center mt-4">
              <h6>Our Pricing</h6>
              <h2 class="text-gray-900">Choose Your Package</h2>

           </div>
           <form class="planForm">
            @csrf
            {{-- <input type="hidden" name="plan" class="plan" value="" />
            <input type="hidden" name="amount" class="amount" value="" />
            <input type="hidden" name="total_offer" class="total_offer" value="" />
            <input type="hidden" name="expiry_date" class="expiry_date" value="" />
            <input type="hidden" name="name" class="business_name" value="{{$business->full_name}}" /> --}}

           @if($plan)
           <div class="row py-lg-4  mb-5">
               @foreach($plan as $planList)
                    <div class="col-md-6 mb-md-2 ">
                        <div class="shadow-sm bg-white rounded  p-4">
                            <header class="card-header bg-white border-bottom ">
                                <span class="d-block ">
                                <span class="display-4 gs-price text-gray-900 font-weight-bold">
                                <span class="small">$</span><del>{{ $planList->total_amount }}</del>
                                </span>
                                <span class=" text-secondary text-secondary-ga"><span class="small"></span><del>{{ ($planList->discount_percent != 0) ? '$'.$planList->amount : ''}}</del>
                                </span></span>
                                </span>
                                <h4 class="h6  gs-price-head mb-2 mt-3">{{ $planList->name }} Plan {!! ($planList->discount_percent != 0) ? '<span class="badge ">'. $planList->discount_percent .'% Off </span>' : '' !!}</h4>
                            </header>
                            <div class="card-body p-4">
                                {!! $planList->content !!}
                                @if(isset($business->plan->amount) && ($business->plan->amount == $planList->total_amount))
                                <a href="javascript:void(0);"class="btn btn-gs-sub" >Active Plan</a>
                                @else
                                <a href="{{route('card',$planList->name)}}"class="btn btn-gs-sub purchase" >Purchase Now</a>
                                @endif
                            </div>
                        </div>
                    </div>
               @endforeach
            </div>
            @endif
         </form>
        </div>
     </div>
  </div>
</div>
@endsection
