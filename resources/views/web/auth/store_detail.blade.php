@extends('web.layouts.app')
@section('content')
<section class="restaurant-detailed-banner">
  <div class="text-center">
    @if($business->avatar)
    <img class="img-fluid cover" src="{{asset($business->avatar)}}">
    @else
    <img class="img-profile rounded-circle" src="{{asset('assets/web/images/no-user.jpg')}}">
    @endif
  </div>
  <div class="restaurant-detailed-header">
    <div class="container">
      <div class="row d-flex align-items-end">
        <div class="col-lg-8">
          <div class="restaurant-detailed-header-left d-flex align-items-center">
            @if($business->avatar)
            <img class="img-fluid-pic mr-3 float-left logo-img-gs" alt="Osahan Deel" src="{{asset($business->avatar)}}">
            @else
            <img class="img-profile rounded-circle" src="{{asset('assets/web/images/no-user.jpg')}}" width="200">
            @endif
            <div>
              <h3 class="text-gray-900 mb-2">{{$business->full_name}}</h3>
              <p class="mb-1">
                <i class="icofont-location-pin"></i> {{$business->address}}
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="restaurant-detailed-header-right text-right">
            <button class="btn btn-success" type="button"> Total revenue: {{'$'.$totalRevenue}} </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="custom-nav bg-white border-top shadow-sm">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="nav" id="pills-tab" role="tablist">
          <li class="nav-item">
            <span class="nav-link active" id="pills-restaurant-info-tab" data-toggle="pill" href="#pills-restaurant-info" role="tab" aria-controls="pills-restaurant-info" aria-selected="false">Store Info</span>
          </li>
          <li class="nav-item">
            <span class="nav-link " id="pills-order-online-tab" data-toggle="pill" href="#pills-order-online" role="tab" aria-controls="pills-order-online" aria-selected="true">Edit Profile</span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>
<section class="offer-dedicated-body mb-5">
  <div class="container py-lg-4">
    <div class="row">
      <div class="col-lg-12">
        <div class="offer-dedicated-body-left">
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-restaurant-info" role="tabpanel" aria-labelledby="pills-restaurant-info-tab">
              <div class="row">
                <div class="col-lg-12">
                  <div id="restaurant-info" class="bg-white rounded shadow-sm p-4 mb-4">
                    <a href="javascript:void(0);" class="btn btn-outline-primary btn-sm float-right updateInfo">Update Info</a>
                    <h5 class="mb-3 text-gray-900">Store Info</h5>
                    <hr class="clearfix">
                    <div class="row">
                      <div class="col-lg-6">
                        <p class="mb-2">
                          <i class="icofont-phone-circle text-primary mr-2"></i> {{$business->country_code}} {{$business->phone}}
                        </p>
                        <p class="mb-2">
                          <i class="icofont-email text-primary mr-2"></i>
                          <a href="javascript:void(0);" class="__cf_email__" data-cfemail="f1889e8483949c90989db1969c90989ddf929e9c">{{$business->email}}</a>
                        </p>
                        @if(!$business->busOperation->isEmpty())
                        @foreach($business->busOperation as $operations)
                        <p class="mb-2">
                          <i class="icofont-clock-time text-primary mr-2"></i> <span>{{$operations->business_day}}</span> <span>{{date('g:i a',strtotime($operations->open_time))}}</span> – <span>{{date('g:i a',strtotime($operations->close_time))}} </span>
                        </p>
                        @endforeach
                        @endif
                        <div class="pb-2 mt-4">
                          <div class=" align-items-center clearfix restaurant-detailed-earn-pts gs-bank-detail">
                            {{-- <img class="img-fluid float-left mr-3" src="{{asset('assets/web/images/anz.jpg')}}"> --}}
                            <div>
                              <h6 class="pt-0 mb-1 text-gray-900">{{$business->bank_name}} Bank </h6>
                              <p class="mb-0">A/C XXXXX {{substr($business->account_number,-4)}} <span class="text-pri-gs">
                                  <i class="icofont-check-circled"></i>Primary A/C </span>
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div id="map" style="height: 300px;"></div>
                      </div>
                    </div>
                    <hr class="clearfix">
                    <a href="javascript:void(0);" class="btn btn-outline-primary btn-sm float-right updateCategory">Update category</a>
                    <h5 class="mt-4 text-gray-900 mb-3">Store category</h5>
                    <div class="border-btn-main mb-4">
                      @if(isset($business->category) && $business->category != "null" && $business->category != "")
                      @php $arr = explode(",",$business->category); @endphp
                        @foreach($arr as $cat)
                        <a class="border-btn text-success mr-2">
                          <i class="icofont-check-circled"></i> {{isset($catList[$cat]) ? $catList[$cat] : ''}} </a>
                        @endforeach
                      @endif
                    </div>
                  </div>
                </div>
                <div class="col-lg-7">
                  <div id="restaurant-info" class="bg-white rounded shadow-sm p-4 mb-4">
                    <h5 class="mb-3 text-gray-900">My Plan</h5>
                    <hr class="clearfix">
                    <div class="dsd-single-bookings-wraps">
                      <div class="dsd-single-book-caption">
                        <div class="dsd-single-book-title">
                          <h6 class="mb-3">{{isset($business->plan->plan) ? $business->plan->plan.' Plan' : 'No plan yet.'}}   {!! isset($business->plan->status) ? "<span class='badge badge-success'>".$business->plan->status."</span>" : '' !!}
                          </h6>
                        </div>
                        <div class="dsd-single-descr">
                          <div class="dsd-single-item">
                            <span class="dsd-item-title">Plan Date:</span>
                            <span class="dsd-item-info">{{isset($business->plan->created_at) ? date('d M Y',strtotime($business->plan->created_at)) : ''}}</span>
                          </div>
                          <div class="dsd-single-item">
                            <span class="dsd-item-title">Vaild Till:</span>
                            <span class="dsd-item-info">{{isset($business->plan->expiry_date) ? date('d M Y',strtotime($business->plan->expiry_date)) : ''}}</span>
                          </div>
                          <div class="dsd-single-item">
                            <span class="dsd-item-title">Amount Paid:</span>
                            <span class="dsd-item-info">{{isset($business->plan->amount) ? '$'.$business->plan->amount : ''}}</span>
                          </div>
                          <div class="dsd-single-item">
                            <span class="dsd-item-title">Listing Ads Remaining:</span>
                            <span class="dsd-item-info">{{isset($remaining) ? $remaining : ''}}</span>
                          </div>
                        </div>

                        <hr class="mt-2">
                        <div class="dsd-single-book-footer">
                          @if(isset($business->plan->plan))
                            <a href="{{route('my.plan')}}" class="btn btn-aprd mr-1">Upgrade Plan</a>
                          @else
                            <a href="{{route('my.plan')}}" class="btn btn-aprd mr-1">Get Plan</a>
                          @endif
                          {{-- <a href="javascript:void(0);" class="btn btn-reject mr-1">Cancel Plan</a> --}}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-5">
                  @php
                    $sdata = array("business_id" => $business->id,"business_name" => $business->business_name);
                    $sdata =  json_encode($sdata);
                  @endphp   
                  <div id="restaurant-info" class="bg-white rounded shadow-sm p-4 mb-4">
                    <a href="https://api.qrserver.com/v1/create-qr-code/?size=350x350&amp;data={{$sdata}}&choe=UTF-8&amp;download=1" title="Qrcode" download="Qrcode.jpg" class="btn btn-outline-primary btn-sm float-right downloadQr"><span>Download QR</span></a>
                    <h5 class="mb-3 text-gray-900"> Download QR</h5>
                      <hr class="clearfix">
                    <div class="text-center">
                      <img src="https://api.qrserver.com/v1/create-qr-code/?size=350x350&amp;data={{$sdata}}&choe=UTF-8" alt="Qrcode" class="img-fluid" style="max-height: 245px;" title="Link to On Me" />
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="pb-2">
                    <div class="bg-white rounded shadow-sm mb-4 p-4  align-items-center clearfix restaurant-detailed-earn-pts card-icon-overlap">
                      <h5 class="mb-3 text-gray-900">Transaction History</h5>
                      <hr class="clearfix">
                      <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                          <tr>
                            <th>User Name</th>
                            <th>Time</th>
                            <th>Date</th>
                            <th>Price</th>
                          </tr>
                        </thead>
                        <tbody>
                          @if(isset($business->token) && !$business->token->isEmpty())
                          @foreach($business->token as $token)
                          <tr>
                            <td>{{isset($token->user->full_name) ? $token->user->full_name : ''}}</td>
                            <td>{{date('H:i',strtotime($token->created_at))}}</td>
                            <td>{{date('d M Y',strtotime($token->created_at))}}</td>
                            <td>{{'$'.$token->token_amount}}</td>
                          </tr>
                          @endforeach
                          @else
                          <tr><td colspan="5">No data available in table</td></tr>
                        </tbody>
                          @endif
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade " id="pills-order-online" role="tabpanel" aria-labelledby="pills-order-online-tab">
              <div class=" ind-module">
                <div class="row mt-50">
                  <div class="col-12 col-sm-3 mt-20">
                    <div class="nav nav-gs-horozontal flex-column nav-pills bg-white rounded shadow-sm p-3 mb-4" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                      <a class="nav-link updateInfo active" id="v-pills-account-tab" data-toggle="pill" href="javascript:void(0);" role="tab" aria-controls="v-pills-account" aria-selected="true">Change General Info</a>
                      <a class="nav-link updateTime" id="v-pills-crm-tab" data-toggle="pill" href="javascript:void(0);" role="tab" aria-controls="v-pills-crm" aria-selected="false">Change Time</a>
                      <a class="nav-link updateCategory" id="v-pills-inventory-tab" data-toggle="pill" href="javascript:void(0);" role="tab" aria-controls="v-pills-inventory" aria-selected="false">Change Category </a>
                      <a class="nav-link updateBank" id="v-pills-purchase-tab" data-toggle="pill" href="javascript:void(0);" role="tab" aria-controls="v-pills-purchase" aria-selected="false">Change Bank Details</a>
                      <a class="nav-link updatePassword" id="v-pills-manufacturing-tab" data-toggle="pill" href="javascript:void(0);" role="tab" aria-controls="v-pills-manufacturing" aria-selected="true">Change Password</a>
                    </div>
                  </div>
                  <div class="col-12 col-sm-9">
                    <div class="tab-content bg-white rounded shadow-sm p-4 mb-4" id="v-pills-tabContent">
                      <div class="tab-pane fade show active" id="v-pills-account" role="tabpanel" aria-labelledby="v-pills-account-tab">
                        <form class="row" enctype="multipart/form-data">
                          @csrf
                          <div class="form-group col-md-6  floating-label-form-group enter-value">
                            <label>Business Name</label>
                            <input type="text" class="form-control" name="business_name" value="{{($business->business_name) ? $business->business_name : old('business_name')}}" placeholder="Update Business Name">
                            @error('business_name')
                                <span class="error-message">{{$message}}</span>
                            @enderror
                          </div>
                          <div class="form-group col-md-6  floating-label-form-group enter-value">
                            <label>Contact Person Name</label>
                            <input type="text" class="form-control" name="full_name" value="{{($business->full_name) ? $business->full_name : old('full_name')}}" placeholder="Update Contact Person Name">
                            @error('full_name')
                                <span class="error-message">{{$message}}</span>
                            @enderror
                          </div>
                          <div class="form-group col-md-6  floating-label-form-group enter-value">
                            <div class="input-gs">
                              <div class="row">
                                <div class="col-12 col-md-3">
                                    <label>Code</label>
                                    {{--<input type="text" name="country_code" class="form-control" value="{{old('country_code')}}" />  --}}
                                    <select class="form-control country_code" name="country_code">
                                        @if($countryCode)
                                          @foreach($countryCode as $key => $cntryCode)
                                          <option {{($business->country_code == $key) ? 'selected' : '' }} value="+{{$key}}">+{{$cntryCode}}</option>
                                          @endforeach
                                        @endif
                                    </select>
                                    @error('country_code')
                                        <span class="error-message">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-9">
                                    <label>Phone Number</label>
                                    <input type="text" class="form-control" name="phone" value="{{($business->phone) ? $business->phone : old('phone')}}" placeholder="Update Phone Number" />
                                    @error('phone')
                                        <span class="error-message">{{$message}}</span>
                                    @enderror
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="form-group col-md-6  floating-label-form-group enter-value">
                            <div class="input-gs">
                              <label>Email</label>
                              <input type="text" class="form-control" name="email" value="{{($business->email) ? $business->email : old('email')}}" placeholder="Update Email">
                            </div>
                            @error('email')
                                <span class="error-message">{{$message}}</span>
                            @enderror
                          </div>
                          <div class="form-group col-md-12 floating-label-form-group enter-value">
                            <label>Add Location</label>
                            <input type="text" class="form-control" name="address" id="address" value="{{($business->address) ? $business->address : old('address')}}" placeholder="Update Your Location">
                            @error('address')
                                <span class="error-message">{{$message}}</span>
                            @enderror
                            <input type="hidden" name="area" id="area" value="{{$business->area}}">
                            <input type="hidden" name="city" id="city" value="{{$business->city}}">
                            <input type="hidden" name="state" id="state" value="{{$business->state}}">
                            <input type="hidden" name="country" id="country" value="{{$business->country}}">
                            <input type="hidden" name="zipcode" id="zipcode" value="{{$business->zipcode}}">
                            <input type="hidden" name="latitude" id="latitude" value="{{$business->latitude}}">
                            <input type="hidden" name="longitude" id="longitude" value="{{$business->longitude}}">
                          </div>
                          <div class="mt-3 col-md-12">
                            <div id="gMap" style="height: 300px;"></div>
                          </div>
                          <div class="form-group col-md-12 floating-label-form-group enter-value">
                            <div class="input-gs">
                              <label>About Business</label>
                              <textarea name="about" rows="3" class="form-control">{{($business->about) ? $business->about : old('about')}}</textarea>
                            </div>
                            @error('email')
                                <span class="error-message">{{$message}}</span>
                            @enderror
                          </div>
                          <div class=" col-md-12 mt-3">
                            <label>Business Logo/Image</label>
                            <input type="file" name="avatar" class="cusom_img" id="" accept="image/png, image/gif, image/jpeg, image/jpg, image/svg" />
                          </div>
                          @if($business->avatar)
                          <div class="mt-3 col-md-12">
                            <input type="hidden" name="hidden_avatar" value="{{$business->avatar}}" />
                            <img src="{{asset($business->avatar)}}" width="100px" />
                          </div>
                          @endif
                          <div class="col-md-12 mt-3">
                            <input type="button" class="btn btn-primary btn-block btn-lg generalInfo" value="Next">
                          </div>
                        </form>
                      </div>
                      <div class="tab-pane" id="v-pills-crm" role="tabpanel" aria-labelledby="v-pills-crm-tab">
                        <form class="">
                          @csrf
                          <div class="mt-3 ">
                            <div class="info-field">
                              @if($businessArr)
                              @foreach($businessArr as $busArr)
                              <?php
                                $busArr     =   strtolower($busArr);
                                ?>
                                    @if($busOperation && array_key_exists($busArr,$busOperation))
                                    <div class="row gs-time align-items-center businessParent">
                                      <div class="col-12 col-md-2">
                                          <div class="form-check">
                                              <input name="business_day[]" value="{{$busArr}}" class="form-check-input form-gs-custom business_day" type="checkbox" checked/>
                                              <label class="form-gs-custom-label-g ml-1"> {{ucfirst($busArr)}}</label>
                                          </div>
                                      </div>
                                      <div class="col-6 col-md-10 checkOff">
                                          <div class="form-check">
                                              <p class="mb-0">Closed</p>
                                          </div>
                                      </div>
                                      <div class="col-6 col-md-5 checkOn">
                                          <div class="form-group floating-label-form-group enter-value">
                                              <label>Open Time</label>
                                              <input type="time" class="form-control openTime" name="open_time[]" value="{{$busOperation[$busArr][0]}}" placeholder="Open Time" />
                                          </div>
                                      </div>
                                      <div class="col-6 col-md-5 checkOn">
                                          <div class="form-group floating-label-form-group enter-value">
                                              <label>Close Time</label>
                                              <input type="time" class="form-control closeTime" name="close_time[]" value="{{$busOperation[$busArr][1]}}" placeholder="Close Time" />
                                          </div>
                                      </div>
                                  </div>
                                  @else
                                  <div class="row gs-time align-items-center businessParent">
                                    <div class="col-12 col-md-2">
                                        <div class="form-check">
                                            <input name="business_day[]" value="{{$busArr}}" class="form-check-input form-gs-custom business_day" type="checkbox"/>
                                            <label class="form-gs-custom-label-g ml-1"> {{ucfirst($busArr)}}</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-10 checkOff" style="display: block;">
                                        <div class="form-check">
                                            <p class="mb-0">Closed</p>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-5 checkOn" style="display: none;">
                                        <div class="form-group floating-label-form-group enter-value">
                                            <label>Open Time</label>
                                            <input type="time" class="form-control openTime" name="open_time[]" placeholder="Open Time" />
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-5 checkOn" style="display: none;">
                                        <div class="form-group floating-label-form-group enter-value">
                                            <label>Close Time</label>
                                            <input type="time" class="form-control closeTime" name="close_time[]" placeholder="Close Time" />
                                        </div>
                                    </div>
                                </div>
                                  @endif
                               @endforeach
                               @endif
                            </div>
                            @error('open_time.*')
                                <span class="error-message">{{$message}}</span>
                            @enderror
                          </div>
                          <div class="row">
                            <div class=" mt-3 col-12 col-md-12">
                              <hr style="margin-top: 7px; margin-bottom: 3px;">
                            </div>
                            <div class=" mt-3 col-12 col-md-12">
                              <input type="button" value="Next" class="btn btn-primary btn-block btn-lg timeInfo">
                            </div>
                          </div>
                        </form>
                      </div>
                      <div class="tab-pane" id="v-pills-inventory" role="tabpanel" aria-labelledby="v-pills-inventory-tab">
                        <form class="">
                          @csrf
                          <div class="mt-3 ">
                            <h6 class="mb-3">Select Business Category</h6>
                            <div class="info-formfield info-formfield-check row">
                              @if($catList)
                              @php $Usercategory = explode(",",$business->category) @endphp
                              @foreach ($catList as $id=> $category)
                              <div class="mb-2 col-6 col-md-4 ">
                                <div class="form-check ">
                                  <input class="form-check-input form-gs-custom" type="checkbox" name="category[]" value="{{$id}}" @if($business->category != '' && $business->category != 'null' && in_array($id,$Usercategory)) checked @endif>
                                  <label class="form-gs-custom-label" for="Oid1"> {{$category}}</label>
                                </div>
                              </div>
                              @endforeach
                              @endif
                            </div>
                            @error('category')
                                <span class="error-message">{{$message}}</span>
                            @enderror
                            <div class="row">
                              <div class=" mt-3 col-12 col-md-12">
                                <hr style="margin-top: 7px; margin-bottom: 3px;">
                              </div>
                            </div>
                            <div class=" mt-3 col-12 col-md-12">
                              <input type="button" value="Next" class="btn btn-primary btn-block btn-lg categoryInfo">
                            </div>
                          </div>
                        </form>
                      </div>
                      <div class="tab-pane" id="v-pills-purchase" role="tabpanel" aria-labelledby="v-pills-purchase-tab">
                        <div class=" ">
                          <form class="">
                            @csrf
                            <div class="form-group floating-label-form-group enter-value">
                              <label>Bank Name</label>
                              <input type="text" name="bank_name" class="form-control " value="{{$business->bank_name}}" placeholder="Enter Bank Name">
                              @error('bank_name')
                                <span class="error-message">{{$message}}</span>
                              @enderror
                            </div>
                            <div class="form-group floating-label-form-group enter-value">
                              <label>BSB</label>
                              <input type="text" name="bsb" class="form-control " value="{{$business->bsb}}" placeholder="Enter BSB">
                              @error('bsb')
                                <span class="error-message">{{$message}}</span>
                              @enderror
                            </div>
                            <div class="form-group floating-label-form-group enter-value">
                              <label>Account Number</label>
                              <input type="text" name="account_number" class="form-control " value="{{$business->account_number}}" placeholder="Enter Account Number">
                              @error('account_number')
                                <span class="error-message">{{$message}}</span>
                              @enderror
                            </div>
                            <div class="form-group floating-label-form-group enter-value">
                              <label>Reapet Account Number</label>
                              <input type="text" name="repeat_account_number" class="form-control " value="{{$business->account_number}}" placeholder="Reapet Account Number">
                              @error('repeat_account_number')
                                <span class="error-message">{{$message}}</span>
                              @enderror
                            </div>
                            <div class="form-group floating-label-form-group enter-value">
                              <label>Account Holder Name</label>
                              <input type="text" name="account_holder_name" class="form-control " value="{{$business->account_holder_name}}" placeholder="Enter Account Holder Name">
                              @error('account_holder_name')
                                <span class="error-message">{{$message}}</span>
                              @enderror
                            </div>
                            <div class="row">
                                <div class=" mt-3 col-12 col-md-12">
                                  <hr style="margin-top: 7px; margin-bottom: 3px;">
                                </div>
                            </div>
                            <div class=" mt-3 col-12 col-md-12">
                                <input type="button" value="Next" class="btn btn-primary btn-block btn-lg bankInfo" />
                            </div>
                          </form>
                        </div>
                      </div>
                      <div class="tab-pane fade show" id="v-pills-manufacturing" role="tabpanel" aria-labelledby="v-pills-manufacturing-tab">
                        <form class="">
                          @csrf
                          <div class="form-group  floating-label-form-group enter-value">
                            <label>Enter Last Password</label>
                            <input type="password" name="old_password" class="form-control" value="" placeholder="Enter Last Password">
                            @error('old_password')
                              <span class="error-message">{{$message}}</span>
                            @enderror
                          </div>
                          <div class="form-group  floating-label-form-group enter-value">
                            <label>Enter New Password</label>
                            <input type="password" name="password" class="form-control" value="" placeholder="Enter New Password">
                              @error('password')
                                <span class="error-message">{{$message}}</span>
                              @enderror
                          </div>
                          <div class="form-group  floating-label-form-group enter-value">
                            <label>Repeat New Password</label>
                            <input type="password" name="repeat_password" class="form-control" value="" placeholder="Repeat New Password">
                            @error('repeat_password')
                                <span class="error-message">{{$message}}</span>
                            @enderror
                          </div>
                          <div class=" mt-3">
                            <input type="button" value="Update" class="btn btn-primary btn-block btn-lg passwordInfo">
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
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
@section('script')
<script>
$('.generalInfo').click(function(){
  $('.error-message').remove();
  var url = "{{route('register.update',':id')}}";
  url = url.replace(':id',{{$business->id}});
  var fd = new FormData();
  var business_names = $('input[name="business_name"]').val();
  var full_names = $('input[name="full_name"]').val();
  var country_codes = $('select[name="country_code"]').find(":selected").val();
  var phones = $('input[name="phone"]').val();
  var emails = $('input[name="email"]').val();
  var about = $('textarea[name="about"]').val();
  var addresses = $('input[name="address"]').val();
  var area = $('input[name="area"]').val();
  var city = $('input[name="city"]').val();
  var state = $('input[name="state"]').val();
  var country = $('input[name="country"]').val();
  var zipcode = $('input[name="zipcode"]').val();
  var latitude = $('input[name="latitude"]').val();
  var longitude = $('input[name="longitude"]').val();
  var hidden_avatar = $('input[name="hidden_avatar"]').val();
  var files = $('.cusom_img')[0].files[0];

  fd.append("_token", "{{ csrf_token() }}")
	fd.append('business_name',business_names);
	fd.append('full_name',full_names);
	fd.append('country_code',country_codes);
	fd.append('phone',phones);
	fd.append('email',emails);
	fd.append('about',about);
	fd.append('address',addresses);
	fd.append('area',area);
	fd.append('city',city);
	fd.append('state',state);
	fd.append('country',country);
	fd.append('zipcode',zipcode);
	fd.append('latitude',latitude);
	fd.append('longitude',longitude);
	fd.append('hidden_avatar',hidden_avatar);
	fd.append('file',files);
    $.ajax({
        url: url,
        method: "POST",
        data: fd,
        enctype: 'multipart/form-data',
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(data) {
          if (data.status == 'success') {
            setFlesh('success',data.message);
              $('#v-pills-account-tab').removeClass('active');
              $('#v-pills-account').removeClass(['fade', 'show', 'active']);
              $('#v-pills-crm-tab').addClass('active');
              $('#v-pills-crm').addClass(['fade', 'show', 'active']);
          }
        },
        error: function(response) {
            if (response.status ==422){
                $.each(response.responseJSON.errors, function (key, item) {
                    $('input[name="'+key+'"]').after('<span class="error-message">'+item+'</span>');

                });
            }
        }
    });
  });

  $('.timeInfo').click(function(){
  $('.error-message').remove();
  var url = "{{route('register.update.time',':id')}}";
  url = url.replace(':id',{{$business->id}});
  var fd = new FormData();
  var business_day = $('input[name="business_day[]"]').map(function(idx, elem) {
    return $(elem).val();
  }).get();
  var business_dayChecked = $('input[name="business_day[]"]:checked').map(function(idx, elem) {
    return $(elem).val();
  }).get();
  var open_time = $('input[name="open_time[]"]').map(function(idx, elem) {
    return $(elem).val();
  }).get();
  var close_time = $('input[name="close_time[]"]').map(function(idx, elem) {
    return $(elem).val();
  }).get();

  fd.append("_token", "{{ csrf_token() }}")
	fd.append('business_dayChecked',business_dayChecked);
	fd.append('business_day',business_day);
	fd.append('open_time',open_time);
	fd.append('close_time',close_time);
  $.ajax({
        url: url,
        method: "POST",
        data: fd,
        enctype: 'multipart/form-data',
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(data) {
          if (data.status == 'success') {
            setFlesh('success',data.message);
              $('#v-pills-crm-tab').removeClass('active');
              $('#v-pills-crm').removeClass(['fade', 'show', 'active']);
              $('#v-pills-inventory-tab').addClass('active');
              $('#v-pills-inventory').addClass(['fade', 'show', 'active']);
          }
        },
      error: function(response) {

        if (response.status ==422){
          $.each(response.responseJSON.errors, function (key, item) {
              $('input[name="'+key+'"]').after('<span class="error-message">'+item+'</span>');

          });

        }
      }
    });
  });
  $('.categoryInfo').click(function(){
  $('.error-message').remove();
  var url = "{{route('register.update.category',':id')}}";
  url = url.replace(':id',{{$business->id}});
  var fd = new FormData();
  var category = $('input[name="category[]"]:checked').map(function(idx, elem) {
    return $(elem).val();
  }).get();
  //console.log(category);
  //return false;
  fd.append("_token", "{{ csrf_token() }}")
	fd.append('category',category);
  $.ajax({
        url: url,
        method: "POST",
        data: fd,
        enctype: 'multipart/form-data',
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(data) {
          if (data.status == 'success') {
            setFlesh('success',data.message);
              $('#v-pills-inventory-tab').removeClass('active');
              $('#v-pills-inventory').removeClass(['fade', 'show', 'active']);
              $('#v-pills-purchase-tab').addClass('active');
              $('#v-pills-purchase').addClass(['fade', 'show', 'active']);
          }
        },
      error: function(response) {

        if (response.status ==422){
          $.each(response.responseJSON.errors, function (key, item) {
              $('.info-formfield-check').after('<span class="error-message">'+item+'</span>');

          });

        }
      }
    });
  });
  $('.bankInfo').click(function(){
  $('.error-message').remove();
  var url = "{{route('register.update.bank',':id')}}";
  url = url.replace(':id',{{$business->id}});
  var fd = new FormData();
  var bank_name = $('input[name="bank_name"]').val();
  var bsb = $('input[name="bsb"]').val();
  var account_number = $('input[name="account_number"]').val();
  var repeat_account_number = $('input[name="repeat_account_number"]').val();
  var account_holder_name = $('input[name="account_holder_name"]').val();
  fd.append("_token", "{{ csrf_token() }}")
	fd.append('bank_name',bank_name);
	fd.append('bsb',bsb);
	fd.append('account_number',account_number);
	fd.append('repeat_account_number',repeat_account_number);
	fd.append('account_holder_name',account_holder_name);
  $.ajax({
        url: url,
        method: "POST",
        data: fd,
        enctype: 'multipart/form-data',
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(data) {
          if (data.status == 'success') {
            setFlesh('success',data.message);
              $('#v-pills-purchase-tab').removeClass('active');
              $('#v-pills-purchase').removeClass(['fade', 'show', 'active']);
              $('#v-pills-manufacturing-tab').addClass('active');
              $('#v-pills-manufacturing').addClass(['fade', 'show', 'active']);
          }
        },
      error: function(response) {

        if (response.status ==422){
          $.each(response.responseJSON.errors, function (key, item) {
            $('input[name="'+key+'"]').after('<span class="error-message">'+item+'</span>');

          });

        }
      }
    });
  });
  $('.passwordInfo').click(function(){
  $('.error-message').remove();
  var url = "{{route('update.password')}}";
  //url = url.replace(':id',{{$business->id}});
  var fd = new FormData();
  var old_password = $('input[name="old_password"]').val();
  var password = $('input[name="password"]').val();
  var repeat_password = $('input[name="repeat_password"]').val();
  fd.append("_token", "{{ csrf_token() }}")
	fd.append('old_password',old_password);
	fd.append('password',password);
	fd.append('repeat_password',repeat_password);
  $.ajax({
        url: url,
        method: "POST",
        data: fd,
        enctype: 'multipart/form-data',
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(data) {
          if (data.status == 'success') {
            setFlesh('success',data.message);
            setTimeout(function() {
                location.reload();
            }, 2000);
          }
          if (data.status == 'error') {
            $('input[name="old_password"]').after('<span class="error-message">'+data.message+'</span>');
          }
        },
      error: function(response) {

        if (response.status ==422){
          $.each(response.responseJSON.errors, function (key, item) {
            $('input[name="'+key+'"]').after('<span class="error-message">'+item+'</span>');

          });

        }
      }
    });
  });
</script>
<script>
  // $('#pills-order-online-tab').click(function(){
  //   console.log('123');
  // });
  $('.updateInfo').click(function(){
    $('.nav-link').removeClass('active');
    $('.tab-pane').removeClass(['fade','active','show']);
    $('#pills-order-online-tab').addClass('active');
    $('#v-pills-account-tab').addClass('active');
    $('#v-pills-account').addClass(['fade','active','show']);
    $('#pills-order-online').addClass(['active','show']);

    $('#pills-restaurant-info-tab').removeClass('active');
    $('#pills-restaurant-info').removeClass(['active','show']);
  });

  $('.updateTime').click(function(){
    $('.nav-link').removeClass('active');
    $('.tab-pane').removeClass(['fade','active','show']);
    $('#pills-order-online-tab').addClass('active');
    $('#v-pills-crm').addClass(['fade','active','show']);
    $('#pills-order-online').addClass(['active','show']);

    $('#pills-restaurant-info-tab').removeClass('active');
    $('#pills-restaurant-info').removeClass(['active','show']);
  });

  $('.updateCategory').click(function(){
    $('.nav-link').removeClass('active');
    $('.tab-pane').removeClass(['fade','active','show']);
    $('#pills-order-online-tab').addClass('active');
    $('#v-pills-inventory-tab').addClass('active');
    $('#v-pills-inventory').addClass(['active']);
    $('#pills-order-online').addClass(['active','show']);

    $('#pills-restaurant-info-tab').removeClass('active');
    $('#pills-restaurant-info').removeClass(['active','show']);
  });

  $('.updateBank').click(function(){
    $('.nav-link').removeClass('active');
    $('.tab-pane').removeClass(['fade','active','show']);
    $('#pills-order-online-tab').addClass('active');
    $('#v-pills-purchase').addClass(['fade','active','show']);
    $('#pills-order-online').addClass(['active','show']);

    $('#pills-restaurant-info-tab').removeClass('active');
    $('#pills-restaurant-info').removeClass(['active','show']);
  });

  $('.updatePassword').click(function(){
    $('.nav-link').removeClass('active');
    $('.tab-pane').removeClass(['fade','active','show']);
    $('#pills-order-online-tab').addClass('active');
    $('#v-pills-manufacturing').addClass(['fade','active','show']);
    $('#pills-order-online').addClass(['active','show']);

    $('#pills-restaurant-info-tab').removeClass('active');
    $('#pills-restaurant-info').removeClass(['active','show']);
  });

  $('.business_day').on('change', function() {
      if($(this).is(':checked')){
          $(this).parents('.businessParent').find('.openTime,.closeTime').attr('disabled',false);
          $(this).parents('.businessParent').find('.checkOn').show();
          $(this).parents('.businessParent').find('.checkOff').hide();
      }else {
          $(this).parents('.businessParent').find('.openTime,.closeTime').attr('disabled',true);
          $(this).parents('.businessParent').find('.checkOn').hide();
          $(this).parents('.businessParent').find('.checkOff').show();
      }
  });
</script>
<script>
  /* function myMap() {
    var lat = '{{$business->latitude}}';
    var long = '{{$business->longitude}}';
    console.log(lat);
  var mapProp= {
    center:new google.maps.LatLng(lat,long),
    zoom:13,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    scrollwheel: false,
    title: 'Halal',
  };
  var map = new google.maps.Map(document.getElementById("map"),mapProp);
  } */
  </script>
<script>
  function getLocation(latitude,longitude,address){
    var geocoder;
      var latlng = new google.maps.LatLng(latitude, longitude);
      var mapProp= {
          center:latlng,
          zoom:1,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          scrollwheel: true,
          title: 'On Me',
      };
      var map = new google.maps.Map(document.getElementById("map"),mapProp);
      var gMap = new google.maps.Map(document.getElementById("gMap"),mapProp);

      var marker = new google.maps.Marker({
          map: map,
          position: latlng,
          draggable: true,
          title: address,
          anchorPoint: new google.maps.Point(0, 0)
      });
      var marker = new google.maps.Marker({
          map: gMap,
          position: latlng,
          draggable: true,
          title: address,
          anchorPoint: new google.maps.Point(0, 0)
      });

  }

  function myMap() {
      var latitude = '{{$business->latitude}}';
      var longitude = '{{$business->longitude}}';
      var address = '{{$business->address}}';

      geocoder = new google.maps.Geocoder();
      getLocation(latitude,longitude,address);
      //geocoder = new google.maps.Geocoder();
      //codeAddress(geocoder, map);

      const options = {
          //componentRestrictions: {
              //country: "aus"
          //},
          types: ["address"],
      };

      var input = document.getElementById('address');

      var autocomplete = new google.maps.places.Autocomplete(input, options);

      autocomplete.addListener("place_changed", fillInAddress);

      function fillInAddress() {
          // Get the place details from the autocomplete object.
          const place = autocomplete.getPlace();
          let area = "";
          let city = "";
          let state = "";
          let country = "";
          let zipcode = "";
          let latitude = place.geometry.location.lat();
          let longitude = place.geometry.location.lng();
          getLocation(latitude,longitude);

          for (const component of place.address_components) {
              // @ts-ignore remove once typings fixed
              // console.log(component);
              const componentType = component.types[0];

              switch (componentType) {
                  case "street_number": {
                      area = `${component.long_name} ${area}`;
                      break;
                  }

                  case "route": {
                      area += component.short_name;
                      break;
                  }

                  case "postal_code": {
                      zipcode = component.long_name;
                      break;
                  }

                  case "postal_code_suffix": {
                      zipcode = `${zipcode}-${component.long_name}`;
                      break;
                  }

                  case "locality": {
                      city = component.long_name;
                      break;
                  }

                  case "administrative_area_level_1": {
                      state = component.short_name;
                      break;
                  }

                  case "country": {
                      country = component.long_name;
                      break;
                  }


              }
          }

          $("#area").val(area);
          $("#city").val(city);
          $("#state").val(state);
          $("#country").val(country);
          $("#zipcode").val(zipcode);
          $("#latitude").val(latitude);
          $("#longitude").val(longitude);

      }
  }
</script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={!!env('GOOGLE_MAP_KEY')!!}&callback=myMap&libraries=places"> </script>
  {{-- Halal --}}
@endsection
