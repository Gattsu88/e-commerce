$(document).ready(function() {
    // Check Admin Password
    $("#currentPassword").keyup(function() {
        var currentPassword = $("#currentPassword").val();
        //alert(currentPassword);
        $.ajax({
            type:'post',
            url:'/admin/check-admin-password',
            data:{currentPassword:currentPassword},
            success:function(resp) {
                if(resp=="false") {
                    $("#currentPasswordStatus").html("Current password is incorrect.").css("color", "red");
                } else if(resp=="true") {
                    $("#currentPasswordStatus").html("Current password is correct.").css("color", "green");
                }
            },error:function() {
                alert("Error");
            }
        });
    });
});

$(function () {
    $("#sections").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
});