@extends('admin.layouts.app')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Faq List </span></h4>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="d-flex justify-content-between pe-2 pe-lg-4">
                    <h5 class="card-header">Faq</h5>
                    <div class="py-3">
                        <a href="{{ route('admin.faq.create') }}" class="btn btn-primary">Add</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table id="userDataTable" class="table datatables-users border-top">
                            <thead>
                            <tr class="text-nowrap">
                                <th>Question</th>
                                <th>Answer</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($faqs as $faq)
                                    <tr>
                                        <td scope="col">{{$faq->question}}</td>
                                        <td scope="col">{{$faq->answer}}</td>
                                        <td>
                                            <button class="btn btn-danger deleteUser" data-id="{{ $faq->id }}" data-url="{{ route('admin.faq.destroy') }}">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>
        </div>
    </div>
</div>
@endsection
    