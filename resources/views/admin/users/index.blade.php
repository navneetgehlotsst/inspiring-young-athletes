@extends('admin.layouts.app')
@section('style')
<style>
.user-image{
    height: 50px;
    width: 50px;
    border:1px dotted lightgray;
    padding:2px;
 }
 .modal-body label{
    padding: 5px;
 }
 .user-info-image{
    height: 100px;
    max-width: 100%;
    border:1px dotted lightgray;
    padding:2px;
 }
</style>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right mr-2" style="display: block">

                </div>
                <h4 class="page-title">Users <span class="uil uil-users-alt"></span></h4>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card profile-card">
                <div class="card-body  pb-5">
                    <table class="table table-bordered table-centered mb-0 text-center" id="usersTable">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Avatar</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">User Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form style="margin:auto;width: 80%;">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="name" class="col-form-label"><strong>Name:</strong></label>
                                <label for="name" class="col-form-label user-name"></label>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-form-label"><strong>Email:</strong></label>
                                <label for="email" class="col-form-label user-email"></label>
                            </div>
                            <div class="form-group">
                                <label for="mobile" class="col-form-label"><strong>Mobile:</strong></label>
                                <label for="email" class="col-form-label user-mobile"></label>
                            </div>
                            <div class="form-group">
                                <label for="alternate_mobile" class="col-form-label"><strong>Alternate Mobile:</strong></label>
                                <label for="alternate_mobile" class="col-form-label user-alternate-mobile"></label>
                            </div>
                            <div class="form-group">
                                <label for="bio" class="col-form-label"><strong>Bio:</strong></label>
                                <label for="bio" class="col-form-label user-bio"></label>
                            </div>
                            <div class="form-group">
                                <label for="address" class="col-form-label"><strong>Address:</strong></label>
                                <label for="address" class="col-form-label user-address"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <img src="" class="user-info-image">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
$('#usersTable').DataTable({
    processing: true,
    ajax: {
      url: "{{route('admin.users.alluser')}}",
    },
    order: [],
    columns: [
        {
            data: "full_name",
        },
        {
            data: "email",
        },
        {
            data: "phone",
        },
        {
            data: "avatar",
            render: (data,type,row) => {
                if(row.avatar){
                    return '<img src="{!!asset("'+row.avatar+'")!!}" class="user-image">';
                }else{
                    return '<img src="{{asset("assets/admin/images/demo-user.png")}}" class="user-image">';
                }
            }

        },
        {
            data: "status",
            render: (data,type,row) => {
                if(row.status == 'active'){
                    return '<div class="custom-control custom-switch"><input type="checkbox" class="custom-control-input" id="status-'+row.id+'" onchange="userStatus('+row.id+')" checked><label class="custom-control-label" for="status-'+row.id+'">Active</label></div>';
                }else{
                    return '<div class="custom-control custom-switch"><input type="checkbox" class="custom-control-input user-status" id="status-'+row.id+'" onchange="userStatus('+row.id+')"><label class="custom-control-label" for="status-'+row.id+'">Inactive</label></div>';
                }
            }
        },
        {
            data: "action",
            render: (data,type,row) => {
                var viewRoute = '{{ route("admin.users.show", ":id") }}';
                viewRoute = viewRoute.replace(':id', row.id);
                return '<a href="'+viewRoute+'" class="btn btn-sm btn-info" >View</a>&nbsp;<span class="btn btn-sm btn-danger" onclick="deleteUser('+row.id+')">Delete</span>';

            }
        },
    ],
    keys: !0,
    language: {
        paginate: {
            previous: "<i class='mdi mdi-chevron-left'>",
            next: "<i class='mdi mdi-chevron-right'>"
        }
    },
});



function userStatus(userid){
    let status = 'inactive';
    if($('#status-'+userid).prop('checked') == true){
        status = 'active';
    }
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to change status!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Okay'
    }).then((result) => {
        if(result.isConfirmed == true) {
            $.ajax({
                type: "POST",
                url: "{{route('admin.users.status')}}",
                data: {'userid':userid,'status':status,'_token': "{{ csrf_token() }}"},
                success: function(response) {
                    if(response.success){
                        if(status == 'active'){
                            setFlesh('success','User has been activated successfully');
                        }else{
                            setFlesh('success','User has been inactivated successfully');
                        }
                        $('#usersTable').DataTable().ajax.reload();
                    }else{
                        setFlesh('error','There is some problem to change status! Please contact to your server adminstrator');
                    }
                }
            });
        }else{
            $('#usersTable').DataTable().ajax.reload();
        }
    })
}

function showUserDetail(userid){
    var url = '{{ route("admin.users.show", ":userid") }}';
    url = url.replace(':userid', userid);
    $.ajax({
        type: "GET",
        url: url,
        success: function(response) {
            if(response.success){
                $('#userModal').modal('show');
                $('.user-name').text(response.user.full_name);
                $('.user-email').text(response.user.email);
                $('.user-mobile').text(response.user.mobile);
                $('.user-alterante-mobile').text(response.user.alternate_mobile);
                $('.user-bio').text(response.user.bio);
                $('.user-address').text(response.user.address);
                if(response.user.avatar != null){
                    $('.user-info-image').attr('src','{!!asset("'+response.user.avatar+'")!!}');
                }else{
                    $('.user-info-image').attr('src','{{asset("assets/admin/images/demo-user.png")}}');
                }
            }else{
                setFlesh('error','There is some problem to show user! Please contact to your server adminstrator');
            }
        }
    });
}

function deleteUser(userid){
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to delete this user!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if(result.isConfirmed == true) {
            var url = '{{ route("admin.users.destroy", ":userid") }}';
            url = url.replace(':userid', userid);
            $.ajax({
                type: "DELETE",
                url: url,
                data: {'_token': "{{ csrf_token() }}"},
                success: function(response) {
                    if(response.success){
                        setFlesh('success','User has been deleted successfully');
                        $('#usersTable').DataTable().ajax.reload();
                    }else{
                        setFlesh('error','There is some problem to delete user! Please contact to your server adminstrator');
                    }
                }
            });
        }
    })
}
</script>
@endsection
