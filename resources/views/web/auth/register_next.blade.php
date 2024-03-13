@extends('web.layouts.home')
@section('style')
<style>
    .iti{
        width: 100%;
    }
</style>
@endsection
@section('content')
<div class="form-design shadow mt-5 mb-5">
    <h5 class="mb-2">Add Store Details</h5>
    <form action="{{route('register.next.post')}}"  method="post" class="" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$bissunesID}}">
        <div class="form-group floating-label-form-group enter-value">
            <label>Add Location</label>
            <input type="text" class="form-control" name="address" id="address" value="{{ old('address') }}" placeholder="Enter Your Location" />
            @error('address')
                <span class="error-message">{{$message}}</span>
            @enderror
            <input type="hidden" name="area" id="area" value="{{old('area')}}">
            <input type="hidden" name="city" id="city" value="{{old('city')}}">
            <input type="hidden" name="state" id="state" value="{{old('state')}}">
            <input type="hidden" name="country" id="country" value="{{old('country')}}">
            <input type="hidden" name="zipcode" id="zipcode" value="{{old('zipcode')}}">
            <input type="hidden" name="latitude" id="latitude" value="{{old('latitude')}}">
            <input type="hidden" name="longitude" id="longitude" value="{{old('longitude')}}">
        </div>
        <div class="mt-3">
            <div id="map" style="height: 300px;"></div>
        </div>
        <div class="mt-3 gs-check-form-bg">
            <h6 class="mb-3">Select Business Category</h6>
            <div class="info-formfield info-formfield-check row">
                @foreach ($categories as $id=> $category)
                    <div class="mb-2 col-6 col-md-4 gs-div" style="display: block;">
                        <div class="form-check">
                            <input class="form-check-input form-gs-custom" type="checkbox" name="category[]" value="{{$id}}" @if(old('category') != null && in_array($id,old('category'))) checked @endif />
                            <label class="form-gs-custom-label" for="Oid1"> {{$category}}</label>
                        </div>
                    </div>
                @endforeach
            </div>
            @error('category')
                <span class="error-message">{{$message}}</span>
            @enderror
        </div>
        <div class="mt-3 gs-check-form-bg">
            <h6 class="mb-3">Business Operational hours & days</h6>
            <div class="form-check">
                <input id="same_time" class="form-check-input form-gs-custom business_day" type="checkbox"/>
                <label class="form-gs-custom-label-g ml-1"> Same Time</label>
            </div>
            <div class="info-field">
                <div class="row gs-time align-items-center businessParent">
                    <div class="col-12 col-md-2">
                        <div class="form-check">
                            <input name="business_day[]" value="sun" class="form-check-input form-gs-custom business_day" type="checkbox" checked/>
                            <label class="form-gs-custom-label-g ml-1"> Sun</label>
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
                            <input type="time" class="form-control openTime" id="sun_open_time" name="open_time[]" placeholder="Open Time" />
                        </div>
                    </div>
                    <div class="col-6 col-md-5 checkOn">
                        <div class="form-group floating-label-form-group enter-value">
                            <label>Close Time</label>
                            <input type="time" class="form-control closeTime" id="sun_close_time" name="close_time[]" placeholder="Close Time" />
                        </div>
                    </div>
                </div>
                <div class="row gs-time align-items-center businessParent">
                    <div class="col-12 col-md-2">
                        <div class="form-check">
                            <input name="business_day[]" value="mon" class="form-check-input form-gs-custom business_day" type="checkbox" checked />
                            <label class="form-gs-custom-label-g ml-1"> Mon</label>
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
                            <input type="time" class="form-control openTime" name="open_time[]" placeholder="Open Time" />
                        </div>
                    </div>
                    <div class="col-6 col-md-5 checkOn">
                        <div class="form-group floating-label-form-group enter-value">
                            <label>Close Time</label>
                            <input type="time" class="form-control closeTime" name="close_time[]" placeholder="Close Time" />
                        </div>
                    </div>
                </div>
                <div class="row gs-time align-items-center businessParent">
                    <div class="col-12 col-md-2">
                        <div class="form-check">
                            <input name="business_day[]" value="tue" class="form-check-input form-gs-custom business_day" type="checkbox" checked />
                            <label class="form-gs-custom-label-g ml-1"> Tue</label>
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
                            <input type="time" class="form-control openTime" name="open_time[]" placeholder="Open Time" />
                        </div>
                    </div>
                    <div class="col-6 col-md-5 checkOn">
                        <div class="form-group floating-label-form-group enter-value">
                            <label>Close Time</label>
                            <input type="time" class="form-control closeTime" name="close_time[]" placeholder="Close Time" />
                        </div>
                    </div>
                </div>
                <div class="row gs-time align-items-center businessParent">
                    <div class="col-12 col-md-2">
                        <div class="form-check">
                            <input name="business_day[]" value="wed" class="form-check-input form-gs-custom business_day" type="checkbox" checked />
                            <label class="form-gs-custom-label-g ml-1"> Wed</label>
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
                            <input type="time" class="form-control openTime" name="open_time[]" placeholder="Open Time" />
                        </div>
                    </div>
                    <div class="col-6 col-md-5 checkOn">
                        <div class="form-group floating-label-form-group enter-value">
                            <label>Close Time</label>
                            <input type="time" class="form-control closeTime" name="close_time[]" placeholder="Close Time" />
                        </div>
                    </div>
                </div>
                <div class="row gs-time align-items-center businessParent">
                    <div class="col-12 col-md-2">
                        <div class="form-check">
                            <input name="business_day[]" value="thu" class="form-check-input form-gs-custom business_day" type="checkbox" checked />
                            <label class="form-gs-custom-label-g ml-1"> Thu</label>
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
                            <input type="time" class="form-control openTime" name="open_time[]" placeholder="Open Time" />
                        </div>
                    </div>
                    <div class="col-6 col-md-5 checkOn">
                        <div class="form-group floating-label-form-group enter-value">
                            <label>Close Time</label>
                            <input type="time" class="form-control closeTime" name="close_time[]" placeholder="Close Time" />
                        </div>
                    </div>
                </div>
                <div class="row gs-time align-items-center businessParent">
                    <div class="col-12 col-md-2">
                        <div class="form-check">
                            <input name="business_day[]" value="fri" class="form-check-input form-gs-custom business_day" type="checkbox" checked />
                            <label class="form-gs-custom-label-g ml-1"> Fri</label>
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
                            <input type="time" class="form-control openTime" name="open_time[]" placeholder="Open Time" />
                        </div>
                    </div>
                    <div class="col-6 col-md-5 checkOn">
                        <div class="form-group floating-label-form-group enter-value">
                            <label>Close Time</label>
                            <input type="time" class="form-control closeTime" name="close_time[]" placeholder="Close Time" />
                        </div>
                    </div>
                </div>
                <div class="row gs-time align-items-center businessParent">
                    <div class="col-12 col-md-2">
                        <div class="form-check">
                            <input name="business_day[]" value="sat" class="form-check-input form-gs-custom business_day" type="checkbox" checked />
                            <label class="form-gs-custom-label-g ml-1"> Sat</label>
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
                            <input type="time" class="form-control openTime" name="open_time[]" placeholder="Open Time" />
                        </div>
                    </div>
                    <div class="col-6 col-md-5 checkOn">
                        <div class="form-group floating-label-form-group enter-value">
                            <label>Close Time</label>
                            <input type="time" class="form-control closeTime" name="close_time[]" placeholder="Close Time" />
                        </div>
                    </div>
                </div>
            </div>
            @error('open_time.*')
                <span class="error-message">{{$message}}</span>
            @enderror
        </div>

        <div class=" mt-3">
            <input type="file" class="cusom_img" name="avatar" accept="image/png, image/gif, image/jpeg, image/jpg, image/svg" />
            @error('avatar')
                <span class="error-message">{{$message}}</span>
            @enderror
        </div>

        <div class="row">
            <div class="mt-3 col-12 col-md-12">
                <hr style="margin-top: 7px; margin-bottom: 3px;" />
            </div>
            <div class="mt-3 col-6 col-md-6">
                <a href="{{route('register.get')}}" class="btn btn-primary btn-primary-gs btn-block btn-lg">Go back </a>
            </div>
            <div class="mt-3 col-6 col-md-6">
                <input type="submit" class="btn btn-primary btn-block btn-lg" value="Next" name="next">
            </div>
        </div>
    </form>
</div>
@endsection

@section('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>



<script>
   /*  $($('input[name=category]')).on('change', function() {
        $('input[name=category]').not(this).prop('checked', false);
    }); */
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

    $("#phone").intlTelInput({
        preferredCountries: ["us", "gb", "au"],
        separateDialCode: true,
        initialCountry: "us"
    }).on('countrychange', function (e, countryData) {
        $("#code").val(($("#phone").intlTelInput("getSelectedCountryData").dialCode));

    });
</script>

<script>
    function getLocation(latitude,longitude){
        var mapProp= {
            center:new google.maps.LatLng(latitude,longitude),
            zoom:13,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            scrollwheel: false,
            title: 'On Me',
        };
        var map = new google.maps.Map(document.getElementById("map"),mapProp);
    }

    function myMap() {
        var latitude = '-33.947346';
        var longitude = '151.179428';
        getLocation(latitude,longitude);

        const options = {
            // componentRestrictions: {
            //     country: "aus"
            // },
            types: ["address"], //"establishment"
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

{{-- Navneet Js Start --}}
<script>
    $(document).ready(function(){
        // Cache the elements for better performance
        var $sameTimeCheckbox = $('#same_time');
        var $openTimeElements = $('.openTime');
        var $closeTimeElements = $('.closeTime');
        var $sunOpenTime = $('#sun_open_time');
        var $sunCloseTime = $('#sun_close_time');

        // Function to set open and close time values
        function setTimeValues(openTime, closeTime) {
            $openTimeElements.val(openTime);
            $closeTimeElements.val(closeTime);
        }

        // Attach a click event listener to the checkbox
        $sameTimeCheckbox.click(function(){
            // Check if the checkbox is checked
            var isChecked = $(this).prop('checked');
            var sunOpenTime = $sunOpenTime.val();
            var sunCloseTime = $sunCloseTime.val();

            if (isChecked && (sunOpenTime && sunCloseTime)) {
                setTimeValues(sunOpenTime, sunCloseTime);
                $(this).prop('checked', false);
            } else if (!isChecked) {
                // Clear the values
                setTimeValues('', '');
            } else {
                Toast.fire({
                    icon: 'error',
                    title: 'First select at least time for the week'
                });
                $(this).prop('checked', false);
            }
        });
    });
</script>
{{-- Navneet Js End --}}
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={!!env('GOOGLE_MAP_KEY')!!}&callback=myMap&libraries=places"> </script>


@endsection
