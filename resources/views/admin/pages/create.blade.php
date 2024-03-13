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
                    <a href="{{route('admin.pages.index')}}" class="btn btn-sm btn-info">All Pages </a>
                </div>
                <h4 class="page-title">Add Page</h4>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card profile-card">
                <div class="card-body  pb-5">
                    <form  method="POST" action="{{ route('admin.pages.store')}}" enctype="multipart/form-data" id="addForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Title*</label>
                                <input type="text" name="title" class="form-control" placeholder="Enter Title" value="{{ old('title') }}" required>
                                @error('title')
                                    <span class="error-message">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >Content</label>
                                <textarea name="description" id="editor" class="form-control" value="{{ old('description') }}" placeholder="Enter Content"></textarea>
                                @error('description')
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


