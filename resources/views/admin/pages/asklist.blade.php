@extends('admin.layouts.app')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Ask Questions </span></h4>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">Ask Questions</h5>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table id="userDataTable" class="table datatables-users border-top">
                            <thead>
                            <tr class="text-nowrap">
                                <th>Name</th>
                                <th>Email</th>
                                <th>Athletes & Coaches Name</th>
                                <th>Message</th>
                            </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($asks as $ask)
                                    <tr>
                                        <td>{{$ask->full_name}}</td>
                                        <td>{{$ask->email}}</td>
                                        <td>{{$ask->coachandatheletes}}</td>
                                        <td>{{$ask->description}}</td>
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
    