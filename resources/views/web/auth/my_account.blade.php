@extends('web.layouts.app')
@section('style')
<style>
    .iti{
        width: 100%;
    }
</style>
@endsection 
@section('content')
<section class="section-padding homepage-search-block position-relative mb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto pt-lg-5">
                <div class="card mb-0">
                    <div class="card-header">
                        <h3 class="card-title">Edit Profile</h3>
                    </div>
                    <form action="{{route('my-account.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label text-dark">First Name</label>
                                        <input type="text" name="first_name" value="{{old('first_name',$user->first_name)}}" class="form-control @error('first_name') is-invalid @enderror" placeholder="Enter your first name" required>
                                        @error('first_name')
                                            <span class="error-message">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label text-dark">Last Name</label>
                                        <input type="text" name="last_name" value="{{old('last_name',$user->last_name)}}" class="form-control @error('last_name') is-invalid @enderror" placeholder="Enter your last name" required>
                                        @error('last_name')
                                            <span class="error-message">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label text-dark">Email Address</label>
                                        <input type="email" name="email" value="{{old('email',$user->email)}}" class="form-control @error('email') is-invalid @enderror" placeholder="Enter email address" required>
                                        @error('email')
                                            <span class="error-message">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label text-dark">Phone Number</label>
                                        <input type="hidden" id="code" name="country_code" value="{{old('country_code',$user->country_code)}}">
                                        <input type="text" id="phone" name="phone" value="{{old('phone',$user->phone)}}" class="form-control @error('phone') is-invalid @enderror" placeholder="Enter phone number" required>
                                        @error('phone')
                                            <span class="error-message">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label text-dark">Address</label>
                                        <input type="text" name="address" id="address" value="{{old('address',$user->address)}}" class="form-control @error('address') is-invalid @enderror" placeholder="Enter address" required>
                                        @error('address')
                                            <span class="error-message">{{$message}}</span>
                                        @enderror
                                        <input type="hidden" name="area" id="area" value="{{old('area',$user->area)}}">
                                        <input type="hidden" name="city" id="city" value="{{old('city',$user->city)}}">
                                        <input type="hidden" name="state" id="state" value="{{old('state',$user->state)}}">
                                        <input type="hidden" name="country" id="country" value="{{old('country',$user->country)}}">
                                        <input type="hidden" name="zipcode" id="zipcode" value="{{old('zipcode',$user->zipcode)}}">
                                        <input type="hidden" name="latitude" id="latitude" value="{{old('latitude',$user->latitude)}}">
                                        <input type="hidden" name="longitude" id="longitude" value="{{old('longitude',$user->longitude)}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label text-dark">Business/Company Name</label>
                                        <input type="text" name="business_name" value="{{old('business_name',$user->business_name)}}" class="form-control @error('business_name') is-invalid @enderror" placeholder="Enter business name" required>
                                        @error('business_name')
                                            <span class="error-message">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Profile Picture</label>
                                        <div class="form-file"> 
                                            <input type="file" class="form-control example-file-input-custom" name="avatar">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="phone_code" id="phone_code" value="+{{$user->country_code}}{{$user->phone}}">
                        <div class="card-footer"> 
                            <input type="submit" class="btn btn-primary mb-4 mt-3" value="Save Changes">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script>
    $("#phone").intlTelInput({
        preferredCountries: ["us", "gb", "au"],
        separateDialCode: true,
        initialCountry: "us"
    }).on('countrychange', function (e, countryData) {
        $("#code").val(($("#phone").intlTelInput("getSelectedCountryData").dialCode));

    });
    
    let number =   $("#phone_code").val();
    $('#phone').intlTelInput("setNumber",number);

   

</script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={!!env('GOOGLE_MAP_KEY')!!}&libraries=places"> </script>
<script>
    function init() {
    
        const options = {
            componentRestrictions: {
                country: "aus"
            },
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
    
    google.maps.event.addDomListener(window, 'load', init);
</script> 
@endsection