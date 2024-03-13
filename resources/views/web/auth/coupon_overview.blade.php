@extends('web.layouts.app')
@section('content')
<section class="custom-nav bg-white border-top shadow-sm">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <ul class="nav" id="pills-tab" role="tablist">
            <li class="nav-item">
              <span class="nav-link active" id="pills-order-online-tab" data-toggle="pill" href="#pills-order-online" role="tab" aria-controls="pills-order-online" aria-selected="true">Active Tokens</span>
            </li>
            <li class="nav-item">
              <span class="nav-link" id="pills-restaurant-info-tab" data-toggle="pill" href="#pills-restaurant-info" role="tab" aria-controls="pills-restaurant-info" aria-selected="false">Redeemed Tokens</span>
            </li>
            {{--
            <li class="nav-item">
              <span class="nav-link" id="pills-gallery-tab" data-toggle="pill" href="#pills-gallery" role="tab" aria-controls="pills-gallery" aria-selected="false">Expired Tokens</span>
            </li>
            --}}
          </ul>
        </div>
      </div>
    </div>
</section>
<section class="er-dedicated-body section-padding pt-0">
    <div class="container ">
      <div class="row">
        <div class="col-lg-12">
          <div class="er-dedicated-body-left">
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-order-online" role="tabpanel" aria-labelledby="pills-order-online-tab">
                @if($activeToken)
                <div class="row">
                  <div class="col-md-12 mt-lg-4 mb-4">
                    <div class="page-title-h5 d-flex align-items-center">
                      <h5 class="my-0 text-gray-900">All Active Tokens: {{$activeCount}} </h5>
                      @if(count($activeToken) >= 2) 
                      <div class="dropdown ml-auto custom-select-box">
                        <form class="custom-select-bg">
                          <select name="filter" id="activeFilter" class="custom-select activeFilter" data-status="Active" placeholder="Sort by: Newest">
                            <option value="newest">Sort by: Newest</option>
                            <option value="amount">Sort by: Amount</option>
                          </select>
                        </form>
                      </div>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row ActiveRow">
                  @foreach($activeToken as $token)
                  <div class="col-xl-3 col-md-12 mb-4">
                      <div class="bg-white all-coupon-gs p-4 shadow-sm text-center h-100 border-radius">
                        <div class="all-coupon">
                          <h4 class="mt-1 h4 text-gray-900">Token Amount</h4>
                          <h3 class="mt-1 h3 text-gray-900"> {{ '$'.$token->token_amount }} </h3>
                        </div>
                        <div class="mb-0 mt-3">
                          <p class="mb-0 text-info ext-info-gs">
                            <i class="icofont-clock-time"></i> Ends {{date('d.m.Y',strtotime($token->token_validaty))}}
                          </p>
                        </div>
                        <div class=" mt-4" style="height: 38px;">
                          <span class="codespan-one"> XX-XX-XX </span>
                          <span class="codespan-two">Token </span>
                        </div>
                      </div>
                  </div>
                  @endforeach
                </div>
                @if(count($activeToken) > 10) 
                <div class="col-xl-12 text-center">
                  <a href="javascript:void(0);" id="ActiveMore" class="btn btn-primary shadow btn-sm show-more-btn load_more_button" data-status="Active" data-start="10">Loading <i class="fas fa-circle-notch fa-spin"></i>
                  </a>
                </div>
                @endif
                @endif
              </div>
              <div class="tab-pane fade" id="pills-restaurant-info" role="tabpanel" aria-labelledby="pills-restaurant-info-tab">
                @if($redeemToken)
                <div class="row">
                  <div class="col-md-12 mt-lg-4 mb-4">
                    <div class="page-title-h5 d-flex align-items-center">
                      <h5 class="my-0 text-gray-900">All Redeemed Tokens: {{$redeemCount}} </h5>
                      @if(count($redeemToken) >= 2) 
                      <div class="dropdown ml-auto custom-select-box">
                        <form class="custom-select-bg">
                          <select name="filter" id="redeemFilter" class="custom-select redeemFilter" data-status="Inactive" placeholder="Sort by: Newest">
                            <option value="newest">Sort by: Newest</option>
                            <option value="amount">Sort by: Amount</option>
                          </select>
                        </form>
                      </div>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row InactiveRow">
                  @foreach($redeemToken as $token)
                  <div class="col-xl-3 col-md-12 mb-4">
                      <div class="bg-white all-coupon-gs p-4 shadow-sm text-center h-100 border-radius">
                        <div class="all-coupon">
                          <h4 class="mt-1 h4 text-gray-900">Token Amount</h4>
                          <h3 class="mt-1 h3 text-gray-900"> {{ '$'.$token->token_amount }} </h3>
                        </div>
                        <div class="mb-0 mt-3">
                          <p class="mb-0 " style="color: #1364aa;">
                            <i class="icofont-clock-time"></i> Redeemed {{date('d.m.Y',strtotime($token->redeem_date))}}
                          </p>
                        </div>
                        <a href="javascript:void(0);" class="couponDetail" data-token="{{$token->token_code}}">
                        <div class=" mt-4" style="height: 38px;">
                          <span class="re-codespan-one"> XX-XX-XX </span>
                          <span class="re-codespan-two">Show Code</span>
                        </div>
                        <div class="mt-2 btn btn-gs-primary">
                          View Details <i class="icofont-long-arrow-right"></i>
                        </div>
                      </a>
                      </div>
                  </div>
                  @endforeach
                </div>
                @if(count($redeemToken) > 10)  
                  <div class="col-xl-12 text-center">
                    <a href="javascript:void(0);" id="InactiveMore" class="btn btn-primary shadow btn-sm show-more-btn load_more_button" data-status="Inactive" data-start="10">Loading <i class="fas fa-circle-notch fa-spin"></i>
                    </a>
                  </div>
                @endif  
                @endif  
              </div>
              {{--
              <div class="tab-pane fade" id="pills-gallery" role="tabpanel" aria-labelledby="pills-gallery-tab">
                <div class="row">
                  <div class="col-md-12 mt-lg-4 mb-4">
                    <div class="page-title-h5 d-flex align-items-center">
                      <h5 class="my-0 text-gray-900">All Expired Tokens: {{count($expireToken)}} </h5>
                      <div class="dropdown ml-auto">
                        <a class="btn btn-secondary dropdown-toggle btn-sm border-white-btn" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Sort by: <span class="text-theme">Amount</span> &nbsp;&nbsp; </a>
                        <div class="dropdown-menu dropdown-menu-right">
                          <a class="dropdown-item" href="#">Percent</a>
                          <a class="dropdown-item" href="#">Amount</a>
                          <a class="dropdown-item" href="#">Newest</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  @foreach($expireToken as $token)
                  <div class="col-xl-3 col-md-12 mb-4">
                    <a href="#" data-toggle="modal" data-target="#exampleModalCenter-gs">
                      <div class="bg-white all-coupon-gs p-4 shadow-sm text-center h-100 border-radius">
                        <div class="all-coupon">
                          <h4 class="mt-1 h4 text-gray-900">Token Amount</h4>
                          <h3 class="mt-1 h3 text-gray-900"> {{ '$'.$token->token_amount }} </h3>
                        </div>
                        <div class="mb-0 mt-3">
                          <p class="mb-0 text-danger">
                            <i class="icofont-clock-time"></i> Expired {{date('d.m.Y',strtotime($token->token_validaty))}}
                          </p>
                        </div>
                        <div class=" mt-4" style="height: 38px;">
                          <span class="in-codespan-one"> XX-XX-XX </span>
                          <span class="in-codespan-two">Show Code</span>
                        </div>
                        <div class="mt-2">
                          <a href="#" data-toggle="modal" data-target="#exampleModalCenter-gs" class="btn btn-gs-primary  ">View Details <i class="icofont-long-arrow-right"></i>
                          </a>
                        </div>
                      </div>
                    </a>
                  </div>
                  @endforeach
                  <div class="col-xl-12 text-center">
                    <a href="#" class="btn btn-primary shadow btn-sm show-more-btn">Loading <i class="fas fa-circle-notch fa-spin"></i>
                    </a>
                  </div>
                </div>
              </div>
              --}}
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
<div class="modal fade" id="exampleModalCenter-gs-re" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content ">
      <div class="modal-header modal-header-cuctome">
        <button type="submit" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="modal-header-gs">
          <div class="gold-members ">
            {{--
            <div class="media">
              <img class="mr-3 user_image" src="{{asset('assets/web/images/no-user.jpg')}}" alt="Generic placeholder image">
              <div class="media-body">
                <div class="custom-card-body">
                  <h6 class="mb-2">
                    <a class="text-gray-900 user_name"></a>
                  </h6>
                  <p class="">
                    <i class="icofont-location-pin user_address"></i>
                  </p>
                </div>
              </div>
            </div>
            --}}
            <div class="row">
              <div class="col-md-4">
                <div class="cop-model-detail ">
                  <p class="mb-1"> Token Amount</p>
                  <p class="mb-0 cop-model-detail-p token_amount"></p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="cop-model-detail ">
                  <p class="mb-1"> Token Code</p>
                  <p class="mb-0 cop-model-detail-p token_code"></p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="cop-model-detail ">
                  <p class="mb-1"> Redeemed Date </p>
                  <p class="mb-0 cop-model-detail-p redeem_date"></p>
                </div>
              </div>
              <div class="col-md-12">
                <hr>
              </div>
              <div class="col-md-12">
                <div class="user-gs-token">
                  <p class="mb-0"> Token Created Date</p>
                  <h6 class="text-gray-900 created_date"></h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <button type="button" class="nextBtn btn btn-primary btn-block btn-lg closeButton" data-dismiss="modal" aria-label="Close">
          Close
        </button>
      </div>
    </div>
  </div>
</div>
@endsection 
@section('script')
<script>
  $('#ActiveMore').click(function() {
    var start = $(this).attr('data-start');
    var status = $(this).data("status");
    var filter = $('.activeFilter').find(":selected").val();
      $.ajax({
          url: "{{ route('coupon.load.more') }}",
          method: "POST",
          data: {
            "_token": "{{ csrf_token() }}",
              "start": start,
              "status": status,
              "filter": filter,
          },
          dataType: "json",
          beforeSend: function() {
              $('#'+status+'More').html('Loading...');
              $('#'+status+'More').attr('disabled', true);
          },
          success: function(data) {
              if (data.data.length > 0) {
                var html = '';
                $.each( data.data, function( key, val ) {
                  var token_validaty = moment(val.token_validaty).format('DD.MM.YYYY'); 
                  html += '<div class="col-xl-3 col-md-12 mb-4">';
                  html += '<div class="bg-white all-coupon-gs p-4 shadow-sm text-center h-100 border-radius">';
                  html += '<div class="all-coupon"><h4 class="mt-1 h4 text-gray-900">Token Amount</h4>';
                  html += '<h3 class="mt-1 h3 text-gray-900">$'+val.token_amount+'</h3></div>';
                  html += '<div class="mb-0 mt-3">';
                  html += '<p class="mb-0 text-info ext-info-gs"><i class="icofont-clock-time"></i> Ends '+token_validaty+'</p></div>';
                  html += '<div class=" mt-4" style="height: 38px;"><span class="codespan-one"> XX-XX-XX </span><span class="codespan-two">Token </span></div>';
                  html += '</div></div>';
                  
                });
                  $('.'+status+'Row').append($(html).hide().fadeIn(1000));
                  $('#'+status+'More').html('Loading <i class="fas fa-circle-notch fa-spin"></i>');
                  $('#'+status+'More').attr('disabled', false);
                  $('#'+status+'More').attr('data-start', data.next);
                  //start = data.next;
              } else {
                  $('#'+status+'More').html('No More Data Available');
                  $('#'+status+'More').attr('disabled', true);
              }
          }
      });
  });
</script>  
<script>
  $('#InactiveMore').click(function() {
    var rStart = $(this).attr('data-start');
    var status = $(this).data("status");
    var filter = $('.redeemFilter').find(":selected").val();
    $.ajax({
        url: "{{ route('coupon.load.more') }}",
        method: "POST",
        data: {
          "_token": "{{ csrf_token() }}",
            "start": rStart,
            "status": status,
            "filter": filter,
        },
        dataType: "json",
        beforeSend: function() {
            $('#'+status+'More').html('Loading...');
            $('#'+status+'More').attr('disabled', true);
        },
        success: function(data) {
            if (data.data.length > 0) {
              var html = '';
              $.each( data.data, function( key, val ) {
                var redeem_date = '';
                if(val.redeem_date != null){
                  redeem_date = moment(val.redeem_date).format('DD.MM.YYYY'); 
                }
                html += '<div class="col-xl-3 col-md-12 mb-4">';
                html += '<div class="bg-white all-coupon-gs p-4 shadow-sm text-center h-100 border-radius">';
                html += '<div class="all-coupon"><h4 class="mt-1 h4 text-gray-900">Token Amount</h4>';
                html += '<h3 class="mt-1 h3 text-gray-900">$'+val.token_amount+'</h3></div>';
                html += '<div class="mb-0 mt-3">';
                html += '<p class="mb-0 " style="color: #1364aa;"><i class="icofont-clock-time"></i> Redeemed '+redeem_date+'</p></div>';
                html += '<div class=" mt-4" style="height: 38px;"><span class="re-codespan-one"> XX-XX-XX </span><span class="re-codespan-two">Show Code </span></div>';
                html += '<div class="mt-2"><a href="javascript:void(0);" class="btn btn-gs-primary couponDetail " data-token="'+val.token_code+'">View Details <i class="icofont-long-arrow-right"></i>';
                html += '</div></div></a></div>';
              });
                $('.'+status+'Row').append($(html).hide().fadeIn(1000));
                $('#'+status+'More').html('Loading <i class="fas fa-circle-notch fa-spin"></i>');
                $('#'+status+'More').attr('disabled', false);
                $('#'+status+'More').attr('data-start', data.next);
                //rStart = data.next;
            } else {
                $('#'+status+'More').html('No More Data Available');
                $('#'+status+'More').attr('disabled', true);
            }
        }
    });
  });
</script>
<script>
  $(document).on("click",".couponDetail", function(){
    var token_code = $(this).data('token');
    $.ajax({
        url:"<?php echo route('coupon.detail.post'); ?>",
        type:"POST",
        data: {
                "_token": "{{ csrf_token() }}",
                "token_code": token_code,
        },
        success:function(datas)
        {
          $('.error-message').remove();
          if(datas.status == 'error'){
            $('.tokenCode').after('<span class="error-message">'+datas.message+'</span>');
            return false;
          }
          var val = datas.data;
          var redeem_date = '';
          if(val.redeem_date != null){
            redeem_date = moment(val.redeem_date).format('DD.MM.YYYY'); 
          }
          var created_date = moment(val.created_at).format('MMM DD, YYYY');
          var name = '';
          var add = '';
          
          if(val.user != null){
            var image_name = val.user.avatar;
            name = val.user.full_name;
            add = val.user.address;
          }
          if(image_name == null){
            image_name = 'no-user.jpg';
          }
          $(".user_image").attr('src',"{{asset('uploads/user')}}/"+image_name);
          $('.user_name').text(name);
          $('.user_address').text(add);
          $('.token_amount').text('$'+val.token_amount);
          $('.token_code').text(val.token_code);
          $('.redeem_date').text(redeem_date);
          $('.created_date').text(created_date);
          
          $('#exampleModalCenter-gs-re').show();
          $('#exampleModalCenter-gs-re').addClass('show');
        }
    })
});   
</script>
<script>
  $('.close,.closeButton').click(function(){
      $('#exampleModalCenter-gs-re').hide();
      $('#exampleModalCenter-gs-re').removeClass('show');
  });
  </script> 
  <script>
  $(".custom-select").each(function() {
  var classes = $(this).attr("class"),
      id      = $(this).attr("id"),
      name    = $(this).attr("name");
      
  var template =  '<div class="' + classes + '">';
      template += '<span class="custom-select-trigger">' + $(this).attr("placeholder") + '</span>';
      template += '<div class="custom-options">';
      $(this).find("option").each(function() {
        template += '<span class="'+id+'-option ' + $(this).attr("class") + '" data-value="' + $(this).attr("value") + '">' + $(this).html() + '</span>';
      });
  template += '</div></div>';
  
  $(this).wrap('<div class="custom-select-wrapper"></div>');
  $(this).hide();
  $(this).after(template);
});
$(".activeFilter-option:first-of-type",".redeemFilter-option:first-of-type").hover(function() {
  $(this).parents(".custom-options").addClass("option-hover");
}, function() {
  $(this).parents(".custom-options").removeClass("option-hover");
});
$(".custom-select-trigger").on("click", function() {
  $('html').one('click',function() {
    $(".custom-select").removeClass("opened");
  });
  $(this).parents(".custom-select").toggleClass("opened");
  event.stopPropagation();
});
</script>
<script>
$(".activeFilter-option").on("click", function() { 
  $(this).parents(".custom-select-wrapper").find("select").val($(this).data("value"));
  $(this).parents(".custom-options").find(".activeFilter-option").removeClass("selection");
  $(this).addClass("selection");
  $(this).parents(".custom-select").removeClass("opened");
  $(this).parents(".custom-select").find(".custom-select-trigger").text($(this).text());
  var status = $(this).parents(".custom-select-wrapper").find(".activeFilter").data("status");
  var filter = $(this).parents(".custom-select-wrapper").find(".activeFilter").find(":selected").val();   
  
  $.ajax({
        url: "{{ route('coupon.overview') }}",
        method: "POST",
        data: {
          "_token": "{{ csrf_token() }}",
            "status": status,
            "filter": filter
        },
        dataType: "json",
        success: function(data) {
            if (data.data.length > 0) {
              var html = '';
                $.each( data.data, function( key, val ) {
                  var token_validaty = moment(val.token_validaty).format('DD.MM.YYYY'); 
                  html += '<div class="col-xl-3 col-md-12 mb-4">';
                  html += '<div class="bg-white all-coupon-gs p-4 shadow-sm text-center h-100 border-radius">';
                  html += '<div class="all-coupon"><h4 class="mt-1 h4 text-gray-900">Token Amount</h4>';
                  html += '<h3 class="mt-1 h3 text-gray-900">$'+val.token_amount+'</h3></div>';
                  html += '<div class="mb-0 mt-3">';
                  html += '<p class="mb-0 text-info ext-info-gs"><i class="icofont-clock-time"></i> Ends '+token_validaty+'</p></div>';
                  html += '<div class=" mt-4" style="height: 38px;"><span class="codespan-one"> XX-XX-XX </span><span class="codespan-two">Token </span></div>';
                  html += '</div></div>';
                  
                });
                $('.'+status+'Row').html($(html).hide().fadeIn(1000));
                $('#'+status+'More').html('Loading <i class="fas fa-circle-notch fa-spin"></i>');
                $('#'+status+'More').attr('disabled', false);
                $('#'+status+'More').attr('data-start', 10);
            }
        }
    });
});
</script>
<script>
$(".redeemFilter-option").on("click", function() { 
  $(this).parents(".custom-select-wrapper").find("select").val($(this).data("value"));
  $(this).parents(".custom-options").find(".redeemFilter-option").removeClass("selection");
  $(this).addClass("selection");
  $(this).parents(".custom-select").removeClass("opened");
  $(this).parents(".custom-select").find(".custom-select-trigger").text($(this).text());
  var status = $(this).parents(".custom-select-wrapper").find(".redeemFilter").data("status");
  var filter = $(this).parents(".custom-select-wrapper").find(".redeemFilter").find(":selected").val(); 
    $.ajax({
        url: "{{ route('coupon.overview') }}",
        method: "POST",
        data: {
          "_token": "{{ csrf_token() }}",
            "status": status,
            "filter": filter
        },
        dataType: "json",
        success: function(data) {
            if (data.data.length > 0) {
              var html = '';
              $.each( data.data, function( key, val ) {
                var redeem_date = '';
                if(val.redeem_date != null){
                  redeem_date = moment(val.redeem_date).format('DD.MM.YYYY'); 
                }
                html += '<div class="col-xl-3 col-md-12 mb-4">';
                html += '<div class="bg-white all-coupon-gs p-4 shadow-sm text-center h-100 border-radius">';
                html += '<div class="all-coupon"><h4 class="mt-1 h4 text-gray-900">Token Amount</h4>';
                html += '<h3 class="mt-1 h3 text-gray-900">$'+val.token_amount+'</h3></div>';
                html += '<div class="mb-0 mt-3">';
                html += '<p class="mb-0 " style="color: #1364aa;"><i class="icofont-clock-time"></i> Redeemed '+redeem_date+'</p></div>';
                html += '<div class=" mt-4" style="height: 38px;"><span class="re-codespan-one"> XX-XX-XX </span><span class="re-codespan-two">Show Code </span></div>';
                html += '<div class="mt-2"><a href="javascript:void(0);" class="btn btn-gs-primary couponDetail " data-token="'+val.token_code+'">View Details <i class="icofont-long-arrow-right"></i>';
                html += '</div></div></a></div>';
              });
                $('.'+status+'Row').html($(html).hide().fadeIn(1000));
                $('#'+status+'More').html('Loading <i class="fas fa-circle-notch fa-spin"></i>');
                $('#'+status+'More').attr('disabled', false);
                $('#'+status+'More').attr('data-start', 10);
            }
        }
    });
});
</script>
<script>
  $('.close,.closeButton').click(function(){
      $('#exampleModalCenter-gs-re').hide();
      $('#exampleModalCenter-gs-re').removeClass('show');
  });
  </script> 
@endsection 
