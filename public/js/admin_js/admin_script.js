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
    $(document).on("click", ".updateSectionStatus", function() {
       var status = $(this).children("i").attr("status");
       var section_id = $(this).attr("section_id");
       $.ajax({
           type:'post',
           url:'/admin/update-section-status',
           data:{status:status,section_id:section_id},
           success:function(resp) {
            if(resp['status'] == 0) {
                $("#section-" + section_id).html("<i class='fas fa-toggle-off fa-lg' aria-hidden='true' status='Inactive'></i>");
            } else if(resp['status'] == 1) {
                $("#section-" + section_id).html("<i class='fas fa-toggle-on fa-lg' aria-hidden='true' status='Active'></i>");
           }
           }, error:function() {
               alert("Error.");
           }
       });
    });
	
    // Update category status
	  $(document).on("click", ".updateCategoryStatus", function() {
       var status = $(this).children("i").attr("status");
       var category_id = $(this).attr("category_id");
       $.ajax({
           type:'post',
           url:'/admin/update-category-status',
           data:{status:status,category_id:category_id},
           success:function(resp) {
            if(resp['status'] == 0) {
                $("#category-" + category_id).html("<i class='fas fa-toggle-off fa-lg' aria-hidden='true' status='Inactive'></i>");
            } else if(resp['status'] == 1) {
                $("#category-" + category_id).html("<i class='fas fa-toggle-on fa-lg' aria-hidden='true' status='Active'></i>");
           }
           }, error:function() {
               alert("Error.");
           }
       });
    });

    // Update product status
    $(document).on("click", ".updateProductStatus", function() {
         var status = $(this).children("i").attr("status");
         var product_id = $(this).attr("product_id");
         $.ajax({
             type:'post',
             url:'/admin/update-product-status',
             data:{status:status,product_id:product_id},
             success:function(resp) {
              if(resp['status'] == 0) {
                  $("#product-" + product_id).html("<i class='fas fa-toggle-off fa-lg' aria-hidden='true' status='Inactive'></i>");
              } else if(resp['status'] == 1) {
                  $("#product-" + product_id).html("<i class='fas fa-toggle-on fa-lg' aria-hidden='true' status='Active'></i>");
             }
             }, error:function() {
                 alert("Error.");
             }
         });
      });

    // Update attribute status
    $(document).on("click", ".updateAttributeStatus", function() {
         var status = $(this).children("i").attr("status");
         var attribute_id = $(this).attr("attribute_id");
         $.ajax({
             type:'post',
             url:'/admin/update-attribute-status',
             data:{status:status,attribute_id:attribute_id},
             success:function(resp) {
              if(resp['status'] == 0) {
                  $("#attribute-" + attribute_id).html("<i class='fas fa-toggle-off fa-lg' aria-hidden='true' status='Inactive'></i>");
              } else if(resp['status'] == 1) {
                  $("#attribute-" + attribute_id).html("<i class='fas fa-toggle-on fa-lg' aria-hidden='true' status='Active'></i>");
             }
             }, error:function() {
                 alert("Error.");
             }
         });
      });

    // Update image status
    $(document).on("click", ".updateImageStatus", function() {
         var status = $(this).children("i").attr("status");
         var image_id = $(this).attr("image_id");
         $.ajax({
             type:'post',
             url:'/admin/update-image-status',
             data:{status:status,image_id:image_id},
             success:function(resp) {
              if(resp['status'] == 0) {
                  $("#image-" + image_id).html("<i class='fas fa-toggle-off fa-lg' aria-hidden='true' status='Inactive'></i>");
              } else if(resp['status'] == 1) {
                  $("#image-" + image_id).html("<i class='fas fa-toggle-on fa-lg' aria-hidden='true' status='Active'></i>");
             }
             }, error:function() {
                 alert("Error.");
             }
         });
      });

    // Update brand status
    $(document).on("click", ".updateBrandStatus", function() {
         var status = $(this).children("i").attr("status");
         var brand_id = $(this).attr("brand_id");
         $.ajax({
             type:'post',
             url:'/admin/update-brand-status',
             data:{status:status,brand_id:brand_id},
             success:function(resp) {
              if(resp['status'] == 0) {
                  $("#brand-" + brand_id).html("<i class='fas fa-toggle-off fa-lg' aria-hidden='true' status='Inactive'></i>");
              } else if(resp['status'] == 1) {
                  $("#brand-" + brand_id).html("<i class='fas fa-toggle-on fa-lg' aria-hidden='true' status='Active'></i>");
             }
             }, error:function() {
                 alert("Error.");
             }
         });
      });

    // Update banner status
    $(document).on("click", ".updateBannerStatus", function() {
         var status = $(this).children("i").attr("status");
         var banner_id = $(this).attr("banner_id");
         $.ajax({
             type:'post',
             url:'/admin/update-banner-status',
             data:{status:status,banner_id:banner_id},
             success:function(resp) {
              if(resp['status'] == 0) {
                  $("#banner-" + banner_id).html("<i class='fas fa-toggle-off fa-lg' aria-hidden='true' status='Inactive'></i>");
              } else if(resp['status'] == 1) {
                  $("#banner-" + banner_id).html("<i class='fas fa-toggle-on fa-lg' aria-hidden='true' status='Active'></i>");
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

  $(document).on("click", ".confirmDelete", function() {
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

  // Products Attributes Add/Remove script 
  var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><div style="height:10px;"></div><input type="text" name="size[]" placeholder="Size" required style="width:120px;">&nbsp;<input type="text" name="sku[]" placeholder="SKU" required style="width:120px;">&nbsp;<input type="number" name="price[]" placeholder="Price" required style="width:120px;">&nbsp;<input type="number" name="stock[]" placeholder="Stock" required style="width:120px;"><a href="javascript:void(0);" class="remove_button">&nbsp;Remove</a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});

$(function () {
  $("#sections").DataTable();
	$("#categories").DataTable();
  $("#products").DataTable();
	$('.select2').select2();
});