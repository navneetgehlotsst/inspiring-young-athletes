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
                <h4 class="page-title">Business <span class="uil uil-bag"></span></h4>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card profile-card">
                <div class="card-body  pb-5">
                    <table class="table table-bordered table-centered mb-0 text-center" id="businessTable">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Image</th>
                                <th>Plan</th>
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

<div class="modal fade" id="businessmodalId" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Business Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="name" class="col-form-label"><strong>Name:</strong></label>
                            <label for="name" class="col-form-label name"></label>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-form-label"><strong>Email:</strong></label>
                            <label for="email" class="col-form-label email"></label>
                        </div>
                        <div class="form-group">
                            <label for="mobile" class="col-form-label"><strong>Mobile:</strong></label>
                            <label for="email" class="col-form-label mobile"></label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <img src="" class="info-image" width="70px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
$('#businessTable').DataTable({
    processing: true,
    ajax: {
      url: "{{route('admin.business.getall')}}",
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
            data: "plan",
            render: (data,type,row) => {
                if(row.plan != null){
                    return row.plan.plan.toUpperCase();
                }else {
                    return '';
                }
            }
        },
        {
            data: "status",
            render: (data,type,row) => {
                if(row.status == 'active'){
                    return '<div class="custom-control custom-switch"><input type="checkbox" class="custom-control-input" id="status-'+row.id+'" onchange="useStatus('+row.id+')" checked><label class="custom-control-label" for="status-'+row.id+'">Active</label></div>';
                }else{
                    return '<div class="custom-control custom-switch"><input type="checkbox" class="custom-control-input user-status" id="status-'+row.id+'" onchange="useStatus('+row.id+')"><label class="custom-control-label" for="status-'+row.id+'">Inactive</label></div>';
                }
            }
        },
        {
            data: "action",
            render: (data,type,row) => {
                var couponRoute = '{{ route("admin.coupon.index", ":id") }}';
                couponRoute = couponRoute.replace(':id', row.id);
                var goodwillRoute = '{{ route("admin.goodwill.index", ":id") }}';
                goodwillRoute = goodwillRoute.replace(':id', row.id);
                var offerRoute = '{{ route("admin.offers.index", ":id") }}';
                var viewRoute = '{{ route("admin.business.show", ":id") }}';
                viewRoute = viewRoute.replace(':id', row.id);
                if(row.plan != null ){
                    offerRoute = offerRoute.replace(':id', row.id);
                }else {
                    offerRoute = 'javascript:void(0);';
                }

                return '<a href="'+viewRoute+'" class="btn btn-sm btn-info" >View</a>&nbsp;<a href="'+offerRoute+'"  class="btn btn-sm btn-info">Offers</a>&nbsp;<a href="'+couponRoute+'"  class="btn btn-sm btn-info">Tokens</a>&nbsp;<a href="'+goodwillRoute+'"  class="btn btn-sm btn-info">Goodwill Tokens</a>&nbsp;<span class="btn btn-sm btn-danger" onclick="useDelete('+row.id+')">Delete</span>';

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


function useStatus(id){
    let status = 'inactive';
    if($('#status-'+id).prop('checked') == true){
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
                url: "{{route('admin.business.status')}}",
                data: {'id':id,'status':status,'_token': "{{ csrf_token() }}"},
                success: function(response) {
                    if(response.success){
                        if(status == 'active'){
                            setFlesh('success','Business has been activated successfully');
                        }else{
                            setFlesh('success','Business has been inactivated successfully');
                        }
                        $('#businessTable').DataTable().ajax.reload();
                    }else{
                        setFlesh('error','There is some problem to change status! Please contact to your server adminstrator');
                    }
                }
            });
        }else{
            $('#businessTable').DataTable().ajax.reload();
        }
    })
}

/* function showDetail(id){
    var url = '{{ route("admin.business.show", ":id") }}';
    url = url.replace(':id', id);
    $.ajax({
        type: "GET",
        url: url,
        success: function(response) {
            if(response.success){
                $('#businessmodalId').modal('show');
                $('.name').text(response.data.full_name);
                $('.email').text(response.data.email);
                $('.mobile').text(response.data.phone);
                $('.address').text(response.data.address);
                if(response.data.avatar){
                    $('.info-image').attr('src','{!!asset("uploads/business/images/'+response.data.avatar+'")!!}');
                }else{
                    $('.info-image').attr('src','{{asset("assets/admin/images/demo-user.png")}}');
                }
            }else{
                setFlesh('error','There is some problem to show business! Please contact to your server adminstrator');
            }
        }
    });
} */

function useDelete(id){
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to delete this data!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if(result.isConfirmed == true) {
            var url = '{{ route("admin.business.destroy", ":id") }}';
            url = url.replace(':id', id);
            $.ajax({
                type: "DELETE",
                url: url,
                data: {'_token': "{{ csrf_token() }}"},
                success: function(response) {
                    console.log(response);
                    if(response.success){
                        setFlesh('success','Business has been deleted successfully');
                        $('#businessTable').DataTable().ajax.reload();
                    }else{
                        setFlesh('error','There is some problem to delete business! Please contact to your server adminstrator');
                    }
                }
            });
        }
    })
}
</script>
@endsection
