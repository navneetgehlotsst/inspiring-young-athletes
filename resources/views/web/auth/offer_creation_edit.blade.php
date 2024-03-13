@extends('web.layouts.app')
@section('content')
<section class="mt-5">
	<div class="container">
	  <div class="row mb-lg-4">
		<div class="col-lg-8 mx-auto">
		  <div id="about" class="bg-white shadow-sm rounded p-4 mb-4">
			<h5 class="mb-2  text-gray-900">Create Offer   (350x350)px</h5>
			<hr>
			<form action="{{route('offer.update.post',$offer->id)}}" method="post" enctype="multipart/form-data">
				@csrf
				<div class="form-group floating-label-form-group enter-value">
				  <label>Offer Text</label>
				  <input type="text" name="text" class="form-control" value="{{$offer->text}}" placeholder="Enter Offer Text">
				  @error('text')
					<span class="error-message">{{$message}}</span>
					@enderror
				</div>
				<div class="form-group mt-3 mb-3">
				<div id="uploadArea" class="upload-area upload-area--open">
					<div class="upload-area__header">
					  <p class="upload-area__paragraph">Image dimension should be 350x350 px<strong class="upload-area__tooltip"> Like <span class="upload-area__tooltip-data"></span>
						</strong>
					  </p>
					</div>
					<div id="dropZoon" class="upload-area__drop-zoon drop-zoon">
					  <p class="drop-zoon__paragraph">Drop your file here or Click to browse</p>
					  <span id="loadingText" class="drop-zoon__loading-text">Please Wait</span>
					  <img src="{{asset('uploads/offers/images/'.$offer->image)}}" alt="Preview Image" id="previewImage" class="drop-zoon__preview-image" draggable="false" style="display: block;">
					  <input type="file" name="image" id="fileInput" value="{{$offer->image}}" class="drop-zoon__file-input" accept="image/*">
					</div>
					@error('image')
						<span class="error-message">{{$message}}</span>
						@enderror
					<div id="fileDetails" class="upload-area__file-details file-details">
					  <h3 class="file-details__title">Uploaded File</h3>
					  <div id="uploadedFile" class="uploaded-file">
						<div class="uploaded-file__icon-container">
						  <i class='bx bxs-file-blank uploaded-file__icon'></i>
						  <span class="uploaded-file__icon-text"></span>
						</div>
						<div id="uploadedFileInfo" class="uploaded-file__info">
						  <span class="uploaded-file__name">Proejct 1</span>
						  <span class="uploaded-file__counter">0%</span>
						</div>
					  </div>
					</div>
				  </div>
				</div>
				<div class="">
					<input type="submit" class="btn btn-primary btn-block btn-lg" value="Update Offer">
				</div>
			</form>
		</div>
		</div>
	  </div>
	</div>
  </section>
@endsection