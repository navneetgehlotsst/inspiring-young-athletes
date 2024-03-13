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
                <h4 class="page-title">Offers </h4>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card profile-card">
                <div class="card-body  pb-5">
                    <table class="table table-bordered table-centered mb-0 text-center" id="offerTable" data-business="{{$bussiness_id}}" data-offer="">
                        <thead>
                            <tr>
                                <th>Offer</th>
                                <th>Image</th>
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
                <h5 class="modal-title" id="exampleModalLabel">Offer</h5>
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
    var getAllRoute = '{{ route("admin.offers.getall", ":id") }}';
    getAllRoute = getAllRoute.replace(':id', business_id);
$('#offerTable').DataTable({
    processing: true,
    ajax: {
      url: getAllRoute,
    },
    order: [],
    columns: [
        {
            data: "text",
        },
        {
            data: "image",
            render: (data,type,row) => {
                if(row.image){
                    return '<img src="{!!asset("uploads/offers/images/'+row.image+'")!!}" class="user-image">';
                }else{
                    return '<img src="{{asset("assets/admin/images/demo-user.png")}}" class="user-image">';
                }
            }

        },
        {
            data: "status",
            render: (data,type,row) => {
                if(row.status == '1'){
                    return 'Approved';
                }else if(row.status == '2'){
                    return 'Rejected';
                }else{
                    return 'Pending';
                }

            }
        },
        {
            data: "action",
            render: (data,type,row) => {
                var checkedApp = '';
                var checkedRej = '';
                if(row.status == '1'){
                    checkedApp = 'checked';
                    checkedRej = '';
                }else if(row.status == '2'){
                    checkedApp = '';
                    checkedRej = 'checked';
                }
                return '<span><input type="radio" name="status-'+row.id+'" value="1" class="status-'+row.id+'" data-offer="'+row.text+'" onchange="useStatus('+row.id+',1)" '+ checkedApp +' />&nbsp;<label class="custom-radio-label" for="status-'+row.id+'">Approve</label>&nbsp;&nbsp;<input type="radio" name="status-'+row.id+'" value="2" class="status-'+row.id+'" data-offer="'+row.text+'" onchange="useStatus('+row.id+',2)" '+ checkedRej +' />&nbsp;<label class="custom-radio-label" for="status-'+row.id+'">Reject</label></span>&nbsp;&nbsp;<span class="btn btn-sm btn-info" onclick="showDetail('+row.id+')">View</span>&nbsp;<span class="btn btn-sm btn-danger" onclick="useDelete('+row.id+')">Delete</span>';
                
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
    var offer = $('.status-'+id).data('offer');
    let status = val;
    var text = 'You want to approve offer!';
    if(val == '2'){
        text = 'You want to reject offer!';
    }
    console.log(business_id);
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
                url: "{{route('admin.offers.status')}}",
                data: {'id':id,'status':status,'business_id':business_id,'offer':offer,'_token': "{{ csrf_token() }}"},
                success: function(response) {
                    if(response.success){
                        if(status == '1'){
                            setFlesh('success','Offer has been approved successfully');
                        }else{
                            setFlesh('success','Offer has been rejected successfully');
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

function showDetail(id){
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
}

function useDelete(id){
    var business_id = $('#offerTable').data('business');
    var offer = $('.status-'+id).data('offer');
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
            var url = '{{ route("admin.offers.destroy", ":id") }}';
            url = url.replace(':id', id);
            $.ajax({
                type: "DELETE",
                url: url,
                data: {'business_id':business_id,'offer':offer,'_token': "{{ csrf_token() }}"},
                success: function(response) {
                    console.log(response);
                    if(response.success){
                        setFlesh('success','Offer has been deleted successfully');
                        $('#offerTable').DataTable().ajax.reload();
                    }else{
                        setFlesh('error','There is some problem to delete offer! Please contact to your server adminstrator');
                    }
                }
            });
        }
    })
}
</script>
@endsection
