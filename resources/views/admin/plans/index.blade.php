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
                    <a href="{{route('admin.plans.create')}}" class="btn btn-sm btn-primary" >Create</a>
                </div>
                <h4 class="page-title">Plans </h4>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card profile-card">
                <div class="card-body  pb-5">
                    <table class="table table-bordered table-centered mb-0 text-center" id="pagesTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Discount%</th>
                                <th>Total Amount</th>
                                <th>Total Offer</th>
                                <th>Valid Days</th>
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


@endsection
@section('script')
<script>
$('#pagesTable').DataTable({
    processing: true,
    ajax: {
      url: "{{route('admin.plans.getall')}}",
    },
    order: [],
    columns: [
        {
            data: "name",
        },
        {
            data: "amount",
        },
        {
            data: "discount_percent",
        },
        {
            data: "total_amount",
        },
        {
            data: "total_offer",
        },
        {
            data: "valid_days",
        },
        {
            data: "status",
            render: (data,type,row) => {
                if(row.status == 'Active'){
                    return '<div class="custom-control custom-switch"><input type="checkbox" class="custom-control-input" id="status-'+row.id+'" onchange="userStatus('+row.id+')" checked><label class="custom-control-label" for="status-'+row.id+'">Active</label></div>';
                }else{
                    return '<div class="custom-control custom-switch"><input type="checkbox" class="custom-control-input user-status" id="status-'+row.id+'" onchange="userStatus('+row.id+')"><label class="custom-control-label" for="status-'+row.id+'">Inactive</label></div>';
                }
            }
        },
        {
            data: "action",
            render: (data,type,row) => {
                var url = "{{route('admin.plans.edit',':id')}}";
                url = url.replace(':id',row.id);
                return '<a href="'+url+'" class="btn btn-sm btn-info">Edit</a>&nbsp;<span class="btn btn-sm btn-danger" onclick="deleteUser('+row.id+')">Delete</span>';
                
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



function userStatus(id){
    let status = 'Inactive';
    if($('#status-'+id).prop('checked') == true){
        status = 'Active';
    }
    Swal.fire({
        title: 'Are you sure?',
        text: "you want to change status!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Okay'
    }).then((result) => {
        if(result.isConfirmed == true) {
            $.ajax({
                type: "POST",
                url: "{{route('admin.plans.status')}}",
                data: {'id':id,'status':status,'_token': "{{ csrf_token() }}"},
                success: function(response) {
                    if(response.success){
                        if(status == 'Active'){
                            setFlesh('success','Plan has been activated successfully');
                        }else{
                            setFlesh('success','Plan has been inactivated successfully');
                        }
                        $('#pagesTable').DataTable().ajax.reload();
                    }else{
                        setFlesh('error','There is some problem to change status! Please contact to your server adminstrator');
                    }
                }
            });
        }else{
            $('#pagesTable').DataTable().ajax.reload();
        }
    })
}

/* function showUserDetail(userid){
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
                    $('.user-info-image').attr('src','{!!asset("uploads/user/'+response.user.avatar+'")!!}');
                }else{
                    $('.user-info-image').attr('src','{{asset("assets/admin/images/demo-user.png")}}');
                }
            }else{
                setFlesh('error','There is some problem to show user! Please contact to your server adminstrator');
            }
        }
    });
} */

function deleteUser(id){
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to delete this plan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if(result.isConfirmed == true) {
            var url = '{{ route("admin.plans.destroy", ":id") }}';
            url = url.replace(':id', id);
            $.ajax({
                type: "DELETE",
                url: url,
                data: {'_token': "{{ csrf_token() }}"},
                success: function(response) {
                    if(response.success){
                        setFlesh('success','Plan has been deleted successfully');
                        $('#pagesTable').DataTable().ajax.reload();
                    }else{
                        setFlesh('error','There is some problem to delete plan! Please contact to your server adminstrator');
                    }
                }
            });
        }
    })
}
</script>
@endsection
