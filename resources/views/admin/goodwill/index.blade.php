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
                <h4 class="page-title">Goodwill Tokens </h4>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card profile-card">
                <div class="card-body  pb-5">
                    <table class="table table-bordered table-centered mb-0 text-center" id="offerTable" data-business="{{$bussiness_id}}" >
                        <thead>
                            <tr>
                                <th>User Name</th>
                                <th>Token Code</th>
                                <th>Token Amount</th>
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

<div class="modal fade" id="offermodalId" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Token</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name" class="col-form-label"><strong></strong></label>
                            <label for="name" class="col-form-label name"></label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <img src="" class="info-image" width="100%">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
$(document).ready(function(){
    var business_id = $('#offerTable').data('business');
    var getAllRoute = '{{ route("admin.goodwill.getall", ":id") }}';
    getAllRoute = getAllRoute.replace(':id', business_id);
$('#offerTable').DataTable({
    processing: true,
    ajax: {
      url: getAllRoute,
    },
    order: [],
    columns: [
        {
            data: "createdby",
            render: (data,type,row) => {
                if(row.user != null){
                    return row.user.full_name;
                }else{
                    return '';
                }
            }
        },
        {
            data: "token_code",

        },
        {
            data: "token_amount",

        },
        {
            data: "status",
            /* render: (data,type,row) => {
                if(row.status == '1'){
                    return 'Active';
                }else if(row.status == '2'){
                    return 'Inactive';
                }else{
                    return 'Pending';
                }

            } */
        },
        {
            data: "action",
            render: (data,type,row) => {
                var checkedApp = '';
                var checkedRej = '';
                if(row.status == 'Active'){
                    checkedApp = 'checked';
                    checkedRej = '';
                }else if(row.status == 'Inactive'){
                    checkedApp = '';
                    checkedRej = 'checked';
                }
                return '<span><input type="radio" name="status-'+row.id+'" value="1" class="status-'+row.id+'" data-created="'+row.createdby+'" data-coupon="'+row.token_code+'" onchange="useStatus('+row.id+',1)" '+ checkedApp +' />&nbsp;<label class="custom-radio-label" for="status-'+row.id+'">Active</label>&nbsp;&nbsp;<input type="radio" name="status-'+row.id+'" value="2" class="status-'+row.id+'" data-created="'+row.createdby+'" data-coupon="'+row.token_code+'" onchange="useStatus('+row.id+',2)" '+ checkedRej +' />&nbsp;<label class="custom-radio-label" for="status-'+row.id+'">Inactive</label></span>&nbsp;&nbsp;<span class="btn btn-sm btn-danger" onclick="useDelete('+row.id+')">Delete</span>';

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

});

function useStatus(id,val){
    var business_id = $('#offerTable').data('business');
    var coupon = $('.status-'+id).data('coupon');
    var created = $('.status-'+id).data('created');
    let status = 'Active';
    var text = 'You want to active coupon!';
    if(val == '2'){
        status = 'Inactive';
        text = 'You want to inactive coupon!';
    }

    Swal.fire({
        title: 'Are you sure?',
        text: text,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Okay'
    }).then((result) => {
        if(result.isConfirmed == true) {
            $.ajax({
                type: "POST",
                url: "{{route('admin.goodwill.status')}}",
                data: {'id':id,'status':status,'created':created,'coupon':coupon,'_token': "{{ csrf_token() }}"},
                success: function(response) {
                    if(response.success){
                        if(status == '1'){
                            setFlesh('success','Coupon has been Active successfully');
                        }else{
                            setFlesh('success','Coupon has been Inactive successfully');
                        }
                        $('#offerTable').DataTable().ajax.reload();
                    }else{
                        setFlesh('error','There is some problem to change status! Please contact to your server adminstrator');
                    }
                }
            });
        }else{
            $('#offerTable').DataTable().ajax.reload();
        }
    })
}

/* function showDetail(id){
    var url = '{{ route("admin.offers.show", ":id") }}';
    url = url.replace(':id', id);
    $.ajax({
        type: "GET",
        url: url,
        success: function(response) {
            if(response.success){
                $('#offermodalId').modal('show');
                $('.name').text(response.data.text);
                if(response.data.image){
                    $('.info-image').attr('src','{!!asset("uploads/offers/images/'+response.data.image+'")!!}');
                }else{
                    $('.info-image').attr('src','{{asset("assets/admin/images/demo-user.png")}}');
                }
            }else{
                setFlesh('error','There is some problem to show offer! Please contact to your server adminstrator');
            }
        }
    });
} */

function useDelete(id){
    var business_id = $('#offerTable').data('business');
    var created = $('.status-'+id).data('created');
    var coupon = $('.status-'+id).data('coupon');
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
            var url = '{{ route("admin.goodwill.destroy", ":id") }}';
            url = url.replace(':id', id);
            $.ajax({
                type: "DELETE",
                url: url,
                data: {'created':created,'coupon':coupon,'_token': "{{ csrf_token() }}"},
                success: function(response) {
                    console.log(response);
                    if(response.success){
                        setFlesh('success','Coupon has been deleted successfully');
                        $('#offerTable').DataTable().ajax.reload();
                    }else{
                        setFlesh('error','There is some problem to delete coupon! Please contact to your server adminstrator');
                    }
                }
            });
        }
    })
}
</script>
@endsection
