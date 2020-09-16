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

    // Update section status
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
	
  // Update category status
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

  // Append categories level
  $("#section_id").change(function() {
    var section_id = $(this).val();
    $.ajax({
      type:'post',
      url:'/admin/append-categories-level',
      data:{section_id:section_id},
      success:function(resp) {
        $("#appendCategoriesLevel").html(resp);
      }, error:function() {
        alert('Error.');
      }
    });
  });

  // Confirm deletion of record

  /*$(".confirmDelete").click(function(){
    var name = $(this).attr("name");
    if(confirm("Are you sure to delete this " + name + "?")) {
      return true;
    } else {
      return false;
    }
  });*/

  // Confirm deletion of record with Sweet Alert 2

  $(".confirmDelete").click(function(){
    var record = $(this).attr("record");
    var recordid = $(this).attr("recordid");
    
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.value) {
        window.location.href = "/admin/delete-" + record + "/" +recordid;
      }
    });

  });
});

$(function () {
  $("#sections").DataTable();
	$("#categories").DataTable();
	$('.select2').select2();
});