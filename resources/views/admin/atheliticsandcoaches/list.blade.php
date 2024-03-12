@extends('admin.layouts.app')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Athlete / Coaches</span> List</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">Athlete / Coaches List</h5>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table id="userDataTable" class="table datatables-users border-top">
                            <thead>
                            <tr class="text-nowrap">
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->phone}}</td>
                                        <td>{{$user->roles}}</td>
                                        <td>
                                            @if($user->user_status == '1' )
                                                <p class="badge bg-label-success">Active</p>
                                            @else
                                                <p class="badge bg-label-success">Inactive</p>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-danger deleteUser" data-id="{{ $user->id }}" data-url="{{ route('admin.user.delete') }}">Delete</button>
                                            <a href="{{ route('admin.athelitics.detail', $user->id ) }}" class="btn btn-info" id="userdetail">User Detail</a>
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
