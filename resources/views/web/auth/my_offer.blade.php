@extends('web.layouts.app')
@section('content')
<section class="">
   <div class="container">
     <div class="row">
       <div class="col-md-12 mt-lg-4 mb-4">
         <div class="page-title-h5 d-flex align-items-center">
           <h5 class="my-0 text-gray-900">You Have {{count($offers)}} Offers listed</h5>
           <div class="dropdown ml-auto">
             <a class="btn btn-secondary btn-md border-white-btn" href="{{route('create.offer')}}" >+ Create New Offer </a>
           </div>
         </div>
       </div>
     </div>
     <div class="row mb-lg-4">
       <div class="col-lg-12">
        @if(!$offers->isEmpty())
        <div class="row offerRow">
        @foreach ($offers as $offerList)
           <div class="col-xl-3 col-sm-6 mb-3">
             <div class="custom-card shadow-sm h-100">
               <div class="custom-card-image">
                 <a href="javascript:void(0);">
                   <img class="img-fluid item-img" src="{{asset('uploads/offers/images/'.$offerList->image)}}">
                   
                   @if($offerList->status == '0')
                    <div class="button-g-btn button-g-btn-gs button-g-btn-up">
                     <span>Pending</span>
                    </div>
                    @elseif($offerList->status == '1') 
                    <div class="button-g-btn button-g-btn-up">
                      <span>Approved</span>
                     </div>
                     @elseif($offerList->status == '2')
                     <div class="button-g-btn button-g-btn-up">
                      <span>Rejected</span>
                     </div>
                    @endif
                    </a>
               </div>
               <div class="p-3 pt-4">
                 <div class="custom-card-body">
                   <h6 class="mb-3">
                     <a class="text-gray-900" href="#">{{$offerList->text}}</a>
                   </h6>
                   <p class="" style="color: green;" >
                     <i class="icofont-clock-time"></i> Ends in {{$diffrence_days}} days
                   </p>
                 </div>
                 <div class="custom-card-footer d-flex align-items-center">
                   <a class="btn btn-sm btn-edite-gs gl-sm-offerbtn ml-auto" href="{{route('offer.creation.edit',$offerList->id)}}">Edit</a>
                   {{--
                   <a class="btn btn-sm btn-view-gs gl-sm-offerbtn ml-auto" href="javascript:void(0);">View</a>
                   <a class="btn btn-sm btn-view-gs gl-sm-offerbtn ml-auto" href="{{route('offer.creation.view',$offerList->id)}}">View</a>
                   --}}
                   <a class="btn btn-sm btn-delete-gs gl-sm-offerbtn ml-2" href="javascript:void(0);" onclick="confirm({{$offerList->id}})" >Delete</a>
                 </div>
               </div>
             </div>
           </div>
           @endforeach
          </div>
          @if(count($offers) > 10) 
           <div class="col-xl-12 text-center">
             <a href="javascript:void(0);" class="btn btn-primary shadow btn-sm show-more-btn">Loading <i class="fas fa-circle-notch fa-spin"></i>
             </a>
           </div>
           @endif
          @else
          <div>offers are not available.</div> 
         @endif
       </div>
     </div>
   </div>
</section>
@endsection 
@section('script')
<script>
  function confirm(id){
    var url = '{{ route("offer.creation.destroy", ":id") }}';
    url = url.replace(':id', id);
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to delete this data!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
    if(result.isConfirmed == true) {
          $.ajax({
              type: "POST",
              url: url,
              data: {'_token': "{{ csrf_token() }}"},
              success: function(response) {
                  if(response.success){
                          setFlesh('success','Offer has been deleted successfully');
                  }else{
                      setFlesh('error','There is some problem! Please contact to your server adminstrator');
                  }
                  setTimeout(function() {
                      location.reload();
                  }, 2000);  
              }
          });
        }else{
          setFlesh('error','There is some problem! Please contact to your server adminstrator');
          setTimeout(function() {
              location.reload();
          }, 2000);
        }
  });
}
  var start = 10;
  $('.show-more-btn').click(function() {
      $.ajax({
          url: "{{ route('offer.load.more') }}",
          method: "POST",
          data: {
            "_token": "{{ csrf_token() }}",
              "start": start,
          },
          dataType: "json",
          beforeSend: function() {
              $('.show-more-btn').html('Loading...');
              $('.show-more-btn').attr('disabled', true);
          },
          success: function(data) {
              if (data.data.length > 0) {
                var html = '';
                $.each( data.data, function( key, val ) {
                  html += '<div class="col-xl-3 col-sm-6 mb-3">';
                  html += '<div class="custom-card shadow-sm h-100">';
                  html += '<div class="custom-card-image">';
                  html += '<a href="javascript:void(0);"><img class="img-fluid item-img" src="">';
                  if(val.status == '0'){  
                    html += '<div class="button-g-btn button-g-btn-gs button-g-btn-up"><span>Pending</span></div></a></div>';
                  }else if(val.status == '1'){
                    html += '<div class="button-g-btn button-g-btn-up"><span>Approved</span></div></a></div>';
                  }else if(val.status == '2'){
                    html += '<div class="button-g-btn button-g-btn-up"><span>Expired</span></div></a></div>';
                  }
                  html += '<div class="p-3 pt-4"><div class="custom-card-body">';
                  html += '<h6 class="mb-3"><a class="text-gray-900" href="#">'+val.text+'</a></h6>';
                  html += '<p class="" style="color: green;"><i class="icofont-clock-time"></i> Ends in 18 days</p></div>';
                  html += '<div class="custom-card-footer d-flex align-items-center">';
                  html += '<a class="btn btn-sm btn-edite-gs gl-sm-offerbtn ml-auto" href="http://localhost:8000/offer-creation-edit/'+val.id+'">Edit</a>';
                  html += '<a class="btn btn-sm btn-view-gs gl-sm-offerbtn ml-auto" href="http://localhost:8000/offer-creation-view/'+val.id+'">View</a>';
                  html += '<a class="btn btn-sm btn-delete-gs gl-sm-offerbtn ml-auto" href="http://localhost:8000/offer-creation-destroy/'+val.id+'">Delete</a>';
                  html += '</div></div></div></div>';

                });
                  $('.offerRow').append($(html).hide().fadeIn(1000));
                  $('.show-more-btn').html('Loading <i class="fas fa-circle-notch fa-spin"></i>');
                  $('.show-more-btn').attr('disabled', false);
                  start = data.next;
              } else {
                  $('.show-more-btn').html('No More Data Available');
                  $('.show-more-btn').attr('disabled', true);
              }
          }
      });
  });
</script>
@endsection