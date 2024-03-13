@extends('web.layouts.app')
@section('content')
<section class="mt-5">
   <div class=" osahan-pricing">
      <div class="container">
         <div class="row py-lg-4">
            <div class="col-md-9 mx-auto mb-md-2">
               <div class="text-center mt-4">
                  <h2 class="text-gray-900">My Active Plan</h2>
               </div>
               <div class="row py-lg-4">
               <div class="col-md-8 mb-md-2 m-auto">
                  <div class="shadow-sm bg-white rounded  p-4">
                     <header class="card-header bg-white border-bottom ">
                        <span class="d-block ">
                        <span class="display-4 gs-price text-gray-900 font-weight-bold">
                        <span class="small">
                        @if($plan->planList->total_amount)   
                           $</span><del>{{ $plan->planList->total_amount }}
                           </del></span>
                        @endif      
                        </span></span>
                        </span>
                           <h4 class="h6  gs-price-head mb-2 mt-3">{{ $plan->planList->name }} <span class="badge "> Active Plan </span></h4>
                     </header>
                     <div class="card-body p-4">
                        {!! $plan->planList->content !!}
                        <a href="{{route('my.plan')}}" class="btn btn-gs-sub" tabindex="0">Upgrade Plan</a>
                     </div>
                  </div>
               </div>                      
            </div>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection 