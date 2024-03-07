$(document).ready( function () {

    // User Data Table
    $('#userDataTable').DataTable();

    //user Income
    $('#userIncomeDataTable').DataTable();

    // Delete User Script
    $(".deleteUser").click(function(){
        var id = $(this).data("id");
        var token = $("meta[name='csrf-token']").attr("content");
        var url = $(this).data("url");
    
        Swal.fire({
            title: "Do you want to Delete User?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Yes",
            denyButtonText: "No"
        }).then((result) => {
            if (result.isConfirmed) {
                deleteRecord(url, id, token);
            } else if (result.isDenied) {
                Swal.fire("Record Not Deleted", "", "info");
            }
        });
    });
    
    function deleteRecord(url, id, token) {
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                "id": id,
                "_token": token,
            },
            success: function (){
                Swal.fire("Record Deleted Successfully", "", "success");
                location.reload();
            },
            error: function(xhr, status, error) {
                Swal.fire("Error Deleting Record", error, "error");
            }
        });
    }
    

    // // Change Status For Video
    // $(".reject").click(function(){
    //     var id = $(this).data("videoid");
    //     var token = $("meta[name='csrf-token']").attr("content");
    //     var url = $(this).data("url");

    //     Swal.fire({
    //         title: "Video Status Update?",
    //         type: "input",
    //         showDenyButton: true,
    //         showCancelButton: true,
    //         confirmButtonText: "Yes",
    //         denyButtonText: `No`,
    //     }).then((result) => {
    //         /* Read more about isConfirmed, isDenied below */
    //         if (result.isConfirmed) {
    //             $.ajax({
    //                 url: url,
    //                 type: "POST",
    //                 data: {
    //                     id: id,
    //                     _token: token,
    //                 },
    //                 success: function (response) {
    //                     //location.reload();
    //                     console.log(response.success);
    //                     if (response.success == false) {
    //                         Swal.fire("User Have not Given answere for this question", "", "info");
    //                     } else {
    //                         Swal.fire("Record Status Change Succesfully", "", "success");
    //                         $("#changestatus-" + id).addClass("bg-label-danger");
    //                         $("#changestatus-" + id).removeClass("bg-label-success");
    //                         $("#changestatus-" + id).text("Rejected");
    //                         $("#changestatus-" + id).addClass("bg-label-danger");
    //                         $("#changestatus-" + id).removeClass("bg-label-success");
    //                         $("#rejected-" + id).addClass("d-none");
    //                         $("#approved-" + id).removeClass("d-none");
                            
    //                     }
    //                 },
    //             });
    //         } else if (result.isDenied) {
    //             Swal.fire("Record Status Not Changed", "", "info");
    //         }
    //     });
    // });

    //show Video
    $(".showvideo").click(function(){
        var $this = $(this);
        var id = $this.data("videoid");
        var url = $this.data("url");
        var token = $("meta[name='csrf-token']").attr("content");

        $.post(url, { id: id, _token: token })
        .done(function(response) {
            console.log(response);
            if (response.success) {
            $('#modalVideo').modal('show');
            $('#viewVideo').attr('src', response.data.video);
            $('#VideoTitle').text(response.data.video_title);
            } else {
            Swal.fire("No Video Found", "", "info");
            }
        })
        .fail(function() {
            Swal.fire("Error", "Failed to retrieve video data", "error");
        });
    });

    // Show Status Change Pop
    $(".aproved").click(function(){
        var id = $(this).data("videoid");
        var url = $(this).data("url");
        var token = $("meta[name='csrf-token']").attr("content");
    
        $.ajax({
            url: url ,
            type: "POST",
            data: {
                id: id,
                _token: token,
            },
            success: function (response) {
                //location.reload();
                console.log(response.data.video);
                if(response.success == true){
                    $('#changeStatus').modal('show');
                    $('#videoId').val(response.data.video_id);
                    $('#type').val(response.data.video_type);
                    $('#status').val(response.data.video_status);
                }else{
                    Swal.fire("No Video Found", "", "info");
                }
                
            },
        });
    });

    // Show Status Change Pop
    $(".reject").click(function(){
        var id = $(this).data("videoid");
        $('#rejectmodel').modal('show');
        $('#videoId').val(id);
    });


    // Approve Video
    $(".SaveChanges").click(function(){
        var id = $("#videoId").val();
        var url = $(this).data("url");
        var token = $("meta[name='csrf-token']").attr("content");
        var type = $('#type').find(":selected").val();
    
        $.ajax({
            url: url ,
            type: "POST",
            data: {
                id: id,
                type:type,
                _token: token,
            },
            success: function (response) {
                //location.reload();
                console.log(response);
                if (response.success == false) {
                    Swal.fire("User Have not Given answere for this question", "", "info");
                } else {
                    Swal.fire("Status Change Succesfully", "", "success");
                    $('#changeStatus').modal('hide');
                    $("#changestatus-" + id).addClass("bg-label-success");
                    $("#changestatus-" + id).removeClass("bg-label-warning");
                    $("#changestatus-" + id).removeClass("bg-label-danger");
                    $("#changestatus-" + id).text("Approved");
                    if(type == 1){
                        $("#changetype-" + id).addClass("bg-label-danger");
                        $("#changetype-" + id).removeClass("bg-label-warning");
                        $("#changetype-" + id).removeClass("bg-label-success");
                        $("#changetype-" + id).text("Paid");
                    }else{
                        $("#changetype-" + id).addClass("bg-label-success");
                        $("#changetype-" + id).removeClass("bg-label-warning");
                        $("#changetype-" + id).removeClass("bg-label-danger");
                        $("#changetype-" + id).text("Free");
                    }

                    $("#approved-" + id).addClass("d-none");
                    $("#rejected-" + id).removeClass("d-none");
                }
            },
        });
    });


    // Reject Video
    $(".Savecomment").click(function(){
        var id = $("#videoId").val();
        var url = $(this).data("url");
        var token = $("meta[name='csrf-token']").attr("content");
        var comment = $("#comment").val();
    
        $.ajax({
            url: url,
            type: "POST",
            data: {
                id: id,
                comment:comment,
                _token: token,
            },
            success: function (response) {
                //location.reload();
                console.log(response.success);
                if (response.success == false) {
                    Swal.fire("User Have not Given answere for this question", "", "info");
                } else {
                    Swal.fire("Status Change Succesfully", "", "success");
                    $("#changestatus-" + id).addClass("bg-label-danger");
                    $("#changestatus-" + id).removeClass("bg-label-success");
                    $("#changestatus-" + id).text("Rejected");
                    $("#changestatus-" + id).addClass("bg-label-danger");
                    $("#changestatus-" + id).removeClass("bg-label-success");
                    $("#rejected-" + id).addClass("d-none");
                    $("#approved-" + id).removeClass("d-none");
                    
                }
            },
        });
    });
});
