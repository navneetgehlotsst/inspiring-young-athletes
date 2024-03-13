@extends('web.layouts.home')
@section('content')
<div class="form-design shadow mt-5 mb-5">
    <h5 class=" mb-2 ">Add Bank Details</h5>
    <form action="{{route('register.secondNext.post')}}" method="post" class="">
        @csrf
        <input type="hidden" name="id" value="{{$bissunesID}}">
        <div class="form-group floating-label-form-group enter-value">
            <label>Bank Name</label>
            <input type="text" class="form-control" name="bank_name" placeholder="Enter Bank Name" value="{{old('bank_name')}}" />
            @error('bank_name')
                <span class="error-message">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group floating-label-form-group enter-value">
            <label>BSB</label>
            <input type="text" class="form-control" name="bsb" placeholder="Enter BSB" value="{{old('bsb')}}" />
            @error('bsb')
                <span class="error-message">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group floating-label-form-group enter-value">
            <label>Account Number</label>
            <input type="text" class="form-control " name="account_number" placeholder="Enter Account Number" value="{{old('account_number')}}" />
            @error('account_number')
                <span class="error-message">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group floating-label-form-group enter-value">
            <label>Reapet Account Number</label>
            <input type="text" class="form-control " name="repeat_account_number" placeholder="Reapet Account Number" value="{{old('repeat_account_number')}}" />
            @error('repeat_account_number')
                <span class="error-message">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group floating-label-form-group enter-value">
            <label>Account Holder Name</label>
            <input type="text" class="form-control " name="account_holder_name" placeholder="Enter Account Holder Name" value="{{old('account_holder_name')}}" />
            @error('account_holder_name')
                <span class="error-message">{{$message}}</span>
            @enderror
        </div>
        
        <div>
        <div class="row">
            <div class=" mt-3 col-12 col-md-12">
            <hr style="margin-top: 7px; margin-bottom: 3px;">
            </div>
        <div class=" mt-3 col-6 col-md-6">
            <a href="{{route('register.next',['bissunesID'=>$encodeBissunesID])}}" class="btn btn-primary btn-primary-gs btn-block btn-lg">Go back </a>
        </div>
        <div class=" mt-3 col-6 col-md-6">
            <input type="submit" class="btn btn-primary btn-block btn-lg" value="Go Dashboard" name="next">
        </div>
        </div>
    </form>
  </div>
</div>
@endsection
@section('script')

@endsection
