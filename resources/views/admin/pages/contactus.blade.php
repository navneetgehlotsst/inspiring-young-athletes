@extends('admin.layouts.app')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Contact Us </span></h4>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">Contact Us List</h5>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table id="newsDataTable" class="table datatables-users border-top">
                            <thead>
                            <tr class="text-nowrap">
                                <th>Name</th>
                                <th>Email</th>
                                <th>Numbers</th>
                                <th>Organisation</th>
                                <th>Message</th>
                            </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($contacts as $contact)
                                    <tr>
                                        <td>{{$contact->name}}</td>
                                        <td>{{$contact->email}}</td>
                                        <td>{{$contact->number}}</td>
                                        <td>{{$contact->organisation}}</td>
                                        <td>{{$contact->message}}</td>
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
    