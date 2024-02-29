@extends('admin.layouts.app')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Faq Create </span></h4>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">Faq</h5>
                <div class="card-body">
                    <form role="form" action="{{ route('admin.faq.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="">Question</label>
                            <input type="text" class="form-control" name="question" placeholder="Question">
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Answer</label>
                            <textarea class="form-control" name="answer" id="" cols="30" rows="10"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">save</button>
                    </form>
                </div>
              </div>
        </div>
    </div>
</div>
@endsection
    