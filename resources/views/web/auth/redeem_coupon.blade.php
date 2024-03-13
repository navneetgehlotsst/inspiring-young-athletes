@extends('web.layouts.app')
@section('content')
<section class="section-padding homepage-search-block position-relative mb-5">
    <div class="container">
        <div class="row ">
            <div class="col-lg-6 mx-auto pt-lg-5">
                <div class="homepage-search-title text-center">
                    <h2 class="mb-3 text-shadow text-gray-900 font-weight-bold">Redeem Token </span>
                    </h2>
                    <p class="mb-3 text-shadow text-gray-800 font-weight-normal">Enter token CODE!!</p>
                </div>
                <div class="homepage-search-form">
                    <form class="form-noborder redeemCoupon">
                        <div class="form-row mx-auto">
                            <div class="col-lg-9 col-md-9 col-sm-12 form-group">
                                <input type="text" name="token_code" placeholder="Enter Token Code" class="form-control border-0 form-control-lg shadow-sm tokenCode" required>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 form-group">
                                <input type="button" class="btn btn-primary btn-block btn-lg btn-gradient shadow-sm tokenCodeSubmit" value="Redeem">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content ">
        <div class="modal-header modal-header-cuctome">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!--
          <div class="stepwizard ">
            <div class="stepwizard-row setup-panel d-none">
              <div class="stepwizard-step">
                <a href="#step-1" type="button" class="btn btn-primary btn-circle d-none"></a>
              </div>
              <div class="stepwizard-step">
                <a href="#step-2" type="button" class="btn btn-default btn-circle d-none" disabled="disabled"></a>
              </div>
              <div class="stepwizard-step">
                <a href="#step-3" type="button" class="btn btn-default btn-circle d-none" disabled="disabled"></a>
              </div>
            </div>
          </div>
          -->
          <form role="form" >
            <input type="hidden" name="business_id" class="business_id" value="">
            <input type="hidden" name="token_id" class="token_id" value="">
            <input type="hidden" name="email" class="user_email" value="">
            <input type="hidden" name="mobile" class="user_mobile" value="">
            <input type="hidden" name="total_amount" class="total_amount" value="">
            <div class="setup-content_bck" id="step-1">
              <div class="">
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
                          <p class=""><i class="icofont-location-pin user_address"></i></p>
                        </div>
                      </div>
                    </div>
                    --}}
                    <div class="row">
                      <div class="col-md-4">
                        <div class="cop-model-detail">
                          <p class="mb-1"> Token Amount</p>
                          <p class="mb-0 cop-model-detail-p token_amount"></p>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="cop-model-detail">
                          <p class="mb-1"> Token Code</p>
                          <p class="mb-0 cop-model-detail-p token_code"></p>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="cop-model-detail">
                          <p class="mb-1"> Token Expiry Date</p>
                          <p class="mb-0 cop-model-detail-p expiry_date"></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="steps-inner mt-3">
                  <div class="lightSpeedIn row align-self-center justify-content-center">
                    <div class="tab-50 col-6 col-md-6 mb-3">
                      <div class="step1_radio">
                        <label>Full Charge</label>
                        <input type="radio" checked name="service" value="" type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="noCheck">
                      </div>
                    </div>
                    <div class="tab-50 col-6 col-md-6 mb-3">
                      <div class="step1_radio">
                        <label>Enter Amount</label>
                        <input type="radio" name="service" value="" onclick="javascript:yesnoCheck();" name="yesno" id="yesCheck">
                      </div>
                    </div>
                  </div>
                  <div id="ifYes" style="display:none; " class="mb-3">
                    <div class="form-group floating-label-form-group enter-value">
                      <label>Enter Amount</label>
                      <input type="text" name="amount" class="form-control redeemAmount" value="" placeholder="Enter Amount">
                    </div>
                  </div>
                </div>
                <hr>
                <button class="nextBtn btn btn-primary btn-block btn-lg proceed" type="button">Proceed</button>
              </div>
            </div>
            <div class="setup-content" id="step-2">
              <div class="modal-header-gs text-center pb-1 mt-2">
                <h5>Verification Token Code</h5>
                <p> Enter the 4 digit code that we send to <span class="countryCode"></span> <span class="contactNo"></span></p>
              </div>
              <div class="otp-field mb-4">
                <input type="number" class="getVCode" />
                <input type="number" class="getVCode" disabled />
                <input type="number" class="getVCode" disabled />
                <input type="number" class="getVCode" disabled />
              </div>
              <input type="hidden" name="vcode" class="vcode">
              <p class="text-center">Didn’t Receive Anything? <a href="javascript:void(0);" class="resend"> Resend Code</a>
              </p>
              <hr>
              <button class="nextBtn btn btn-primary btn-block btn-lg submitButton" type="button">Submit</button>
            </div>
            <div class="setup-content text-center" id="step-3">
              <div class="img-succ-gs">
                <img src="{{asset('assets/web/images/accept.png')}}" style="width: 120px;">
                <h3 class="mt-3">Token Redeem Successfully!</h3>
                <p>Congratulations, <span class="redeem_amount"></span> Redeem successfully!!</p>
              </div>
              <hr>
              <a class="nextBtn btn btn-primary-gs btn-block btn-lg closeButton" href="{{route('redeem.coupon')}}">Close</a>
            </div>
        </div>
      </div>
      </form>
    </div>
  </div>
@endsection

@section('script')
<script>
    function yesnoCheck() {
      if (document.getElementById('yesCheck').checked) {
        document.getElementById('ifYes').style.display = 'block';
      } else document.getElementById('ifYes').style.display = 'none';
    }
  </script>
  <script>
$(".redeemCoupon").submit(function (e) {
    e.preventDefault();
    redeemCoupon();  
});        
$('.tokenCodeSubmit').click(function(){
  redeemCoupon();
});  
function redeemCoupon(){  
    $('.error-message').remove();
    var token_code = $('.tokenCode').val();
    if(token_code == null || token_code == ''){
      $('.tokenCode').after('<span class="error-message">Please enter token code</span>');
      return false;
    }

    $.ajax({
        url:"<?php echo route('redeem.coupon.post'); ?>",
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
          var expiry_date = moment(val.token_validaty).format('MMM DD, YYYY');
          var image_name = '';
          var name = '';
          var add = '';
          var email = '';
          var country_code = '';
          var mobile = '';
          
          if(val.user != null){
              image_name = val.user.avatar;
              name = val.user.full_name;
              add = val.user.address;
              email = val.user.email;
              country_code = val.user.country_code;
              mobile = val.user.phone;
          }
          
          $(".user_image").attr('src',"{{asset('assets/web/images/no-user.jpg')}}");
          if(image_name){
            $(".user_image").attr('src',"{{asset('uploads/user')}}/"+image_name);
          }

          $('.user_name').text(name);
          $('.user_address').text(add);
          $('.token_amount').text('$'+val.balance);
          $('.total_amount').val(val.token_amount);
          $('.token_code').text(val.token_code);
          $('.expiry_date').text(expiry_date);
          $('.token_id').val(val.id);
          $('.redeemAmount').val(val.balance);
          $('.user_email').val(email);
          $('.user_mobile').val(mobile);
          $('.countryCode').text(country_code);
          $('.contactNo').text(mobile);
          $('.business_id').val(val.bussiness_id);
          
          $('#exampleModalCenter').show();
          $('#exampleModalCenter').addClass('show');
          $('body').addClass('modal-open');
          $('#exampleModalCenter').after('<div class="modal-backdrop fade show"></div>');
        }
    });
}

$('.proceed').click(function(){
    $('.error-message').remove();
    var token_id = $('.token_id').val();
    var redeemAmount = $('.redeemAmount').val();
    var totalAmount = $('.total_amount').val();
    var email = $('.user_email').val();
    var mobile = $('.user_mobile').val();
    if(redeemAmount == null || redeemAmount == ''){
      $('.redeemAmount').after('<span class="error-message">Please enter amount</span>');
      return false;
    }

    $.ajax({
        url:"<?php echo route('redeem.value.post'); ?>",
        type:"POST",
        data: {
                "_token": "{{ csrf_token() }}",
                "token_id": token_id,
                "total_amount": totalAmount,
                "amount": redeemAmount,
                "email": email,
                "mobile": mobile,
        },
        success:function(datas)
        {
          $('.error-message').remove();
          if(datas.status == 'error'){
            $('#noCheck').prop('checked', false);
            $('#yesCheck').prop('checked', true);
            $('#ifYes').show();
            $('.redeemAmount').after('<span class="error-message">'+datas.message+'</span>');
            return false;
          }
          
          $('.redeem_amount').text('$'+datas.data);
          $('#step-1').hide();
          $('#step-2').show();
        }
    })
});

$('.resend').click(function(){
    $('.error-message').remove();
    $('.success-message').remove();
    var token_id = $('.token_id').val();
    var email = $('.user_email').val();
    var mobile = $('.user_mobile').val();
    
    $.ajax({
        url:"<?php echo route('redeem.resend.code'); ?>",
        type:"POST",
        data: {
                "_token": "{{ csrf_token() }}",
                "token_id": token_id,
                "email": email,
                "mobile": mobile,
        },
        success:function(datas)
        {
          $('.error-message').remove();
          $('.success-message').remove();
          if(datas.status == 'error'){
            $('.otp-field').after('<p class="error-message text-center">'+datas.message+'</p>');
            return false;
          }
          
          $('.otp-field').after('<p class="success-message text-center">'+datas.message+'</p>');

        }
    })
});

$('.submitButton').click(function(){
  $('.error-message').remove();
  var token_id = $('.token_id').val();
  var token_code = $('.token_code').text();
  var totalAmount = $('.total_amount').val();
  var redeemAmount = $('.redeemAmount').val();
  var email = $('.user_email').val();
  var mobile = $('.user_mobile').val();
  var business_id = $('.business_id').val();
  var inputs = $(".getVCode");
  var vCode = '';
  for(var i = 0; i < inputs.length; i++){
    vCode += $(inputs[i]).val();
  }

    if(vCode == '' || vCode.length < 4){
      $('.otp-field').after('<p class="error-message text-center">Please enter correct verification code.</p>');
      return false;
    }

    $.ajax({
        url:"<?php echo route('redeem.verify.code'); ?>",
        type:"POST",
        data: {
                "_token": "{{ csrf_token() }}",
                "token_id": token_id,
                "token_code": token_code,
                "v_code": vCode,
                "total_amount": totalAmount,
                "redeemAmount": redeemAmount,
                "email": email,
                "mobile": mobile,
                "business_id": business_id,
        },
        success:function(datas)
        {
          $('.error-message').remove();
          if(datas.status == 'error'){
            $('.otp-field').after('<p class="error-message text-center">'+datas.message+'</p>');
            return false;
          }
          
          $('#step-1').hide();
          $('#step-2').hide();
          $('#step-3').show();
        }
    })
});

$('.close').click(function(){
  $('#exampleModalCenter').hide();
  $('#exampleModalCenter').removeClass('show');
  $('body').removeClass('modal-open');
  $('.modal-backdrop').remove();
});


  </script>
@endsection
 
