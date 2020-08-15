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

    $(".updateSectionStatus").click(function() {
       var status = $(this).text();
       var section_id = $(this).attr("section_id");
       $.ajax({
           type:'post',
           url:'/admin/update-section-status',
           data:{status:status,section_id:section_id},
           success:function(resp) {
            if(resp['status'] == 0) {
                $("#section-" + section_id).html("<a href=\"javascript:void(0)\" class=\"updateSectionStatus\">Inactive</a>");
            } else if(resp['status'] == 1) {
                $("#section-" + section_id).html("<a href=\"javascript:void(0)\" class=\"updateSectionStatus\">Active</a>");
           }
           }, error:function() {
               alert("Error.");
           }
       });
    });
	
	$(".updateCategoryStatus").click(function() {
       var status = $(this).text();
       var category_id = $(this).attr("category_id");
       $.ajax({
           type:'post',
           url:'/admin/update-category-status',
           data:{status:status,category_id:category_id},
           success:function(resp) {
            if(resp['status'] == 0) {
                $("#category-" + category_id).html("<a href=\"javascript:void(0)\" class=\"updateCategoryStatus\">Inactive</a>");
            } else if(resp['status'] == 1) {
                $("#category-" + category_id).html("<a href=\"javascript:void(0)\" class=\"updateCategoryStatus\">Active</a>");
           }
           }, error:function() {
               alert("Error.");
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