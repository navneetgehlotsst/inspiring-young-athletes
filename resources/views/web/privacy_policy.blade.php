@extends('web.layouts.main')
@section('content')
<div class="form-design shadow mt-5">
		<h5 class="mb-5">{{isset($data->title) ? $data->title: ''}}</h5>  
		<div>{!! isset($data->description) ? $data->description : '' !!}</div>
</div>
@endsection 
