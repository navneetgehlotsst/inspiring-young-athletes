@extends('admin.layouts.app')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">User /</span> List</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">User List</h5>
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
                                <th>Subscribed</th>
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
                                                <p class="btn btn-success">Active</p>
                                            @else
                                                <p class="btn btn-danger">Inactive</p>
                                            @endif
                                        </td>
                                        <td>
                                            @if(count($user->usersubciption) == '0' )
                                                <p class="btn btn-danger">Not Subscribed</p>
                                            @else
                                                <p class="btn btn-success">Subscribed</p>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-danger" id="deleteUser" data-id="{{ $user->id }}" data-url="{{ route('admin.user.delete') }}">Delete</button>
                                            <a href="{{ route('admin.user.detail', $user->id ) }}" class="btn btn-info" id="userdetail">User Detail</a>
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
    