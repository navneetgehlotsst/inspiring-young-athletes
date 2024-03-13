@extends('admin.layouts.app')
@section('style')
<style>
.submit-btn{
    text-align: right;
 }
</style>
@endsection  
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right mr-2" style="display: block">
                    <a href="{{route('admin.plans.index')}}" class="btn btn-sm btn-info">All Plans </a>
                </div>
                <h4 class="page-title">Add Plan</h4>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card profile-card">
                <div class="card-body  pb-5">
                    <form  method="POST" action="{{ route('admin.plans.store')}}" enctype="multipart/form-data" id="addForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Name*</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{ old('name') }}" required>
                                @error('name')
                                    <span class="error-message">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Amount*</label>
                                <input type="text" name="amount" class="form-control" placeholder="Enter Amount" value="{{ old('amount') }}" required>
                                @error('amount')
                                    <span class="error-message">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Discount*</label>
                                <input type="text" name="discount_percent" class="form-control" placeholder="Enter Discount" value="{{ old('discount_percent') }}">
                                @error('discount_percent')
                                    <span class="error-message">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Total offers*</label>
                                <input type="text" name="total_offer" class="form-control" placeholder="Enter Total offers" value="{{ old('total_offer') }}" required>
                                @error('total_offer')
                                    <span class="error-message">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Valid Days*</label>
                                <input type="text" name="valid_days" class="form-control" placeholder="Enter Valid Days" value="{{ old('valid_days') }}" required>
                                @error('valid_days')
                                    <span class="error-message">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >Content</label>
                                <textarea name="content" id="editor" class="form-control" value="{{ old('content') }}" placeholder="Enter Content"></textarea>
                                @error('content')
                                    <span class="error-message">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 submit-btn">
                            <hr class="mt-1">
                            <button type="submit" class="btn btn-sm btn-primary">Save</button>
                        </div>
                    </div>
                    
                </form>                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .then( editor => {
                    console.log( editor );
            } )
            .catch( error => {
                    console.error( error );
            } );
</script>
@endsection


