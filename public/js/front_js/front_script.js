$(document).ready(function() {
    /*$("#sortProducts").on('change', function() {
        this.form.submit();
    });*/

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#sort").on("change", function() {
        var sort = $(this).val();
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattern = get_filter('pattern');
        var fit = get_filter('fit');
        var occasion = get_filter('occasion');
        var url = $("#url").val();
        $.ajax({
            url:url,
            method:"post",
            data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion,sort:sort,url:url},
            success:function(data) {
                $('.filter_products').html(data);
            }
        });
    });

    $(".fabric").on("click", function() {
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattern = get_filter('pattern');
        var fit = get_filter('fit');
        var occasion = get_filter('occasion');
        var sort = $("#sort option:selected").val();
        var url = $("#url").val();
        $.ajax({
            url:url,
            method:"post",
            data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion,sort:sort,url:url},
            success:function(data) {
                $('.filter_products').html(data);
            }
        });
    });

    $(".sleeve").on("click", function() {
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattern = get_filter('pattern');
        var fit = get_filter('fit');
        var occasion = get_filter('occasion');
        var sort = $("#sort option:selected").val();
        var url = $("#url").val();
        $.ajax({
            url:url,
            method:"post",
            data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion,sort:sort,url:url},
            success:function(data) {
                $('.filter_products').html(data);
            }
        });
    });

    $(".pattern").on("click", function() {
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattern = get_filter('pattern');
        var fit = get_filter('fit');
        var occasion = get_filter('occasion');
        var sort = $("#sort option:selected").val();
        var url = $("#url").val();
        $.ajax({
            url:url,
            method:"post",
            data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion,sort:sort,url:url},
            success:function(data) {
                $('.filter_products').html(data);
            }
        });
    });

    $(".fit").on("click", function() {
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattern = get_filter('pattern');
        var fit = get_filter('fit');
        var occasion = get_filter('occasion');
        var sort = $("#sort option:selected").val();
        var url = $("#url").val();
        $.ajax({
            url:url,
            method:"post",
            data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion,sort:sort,url:url},
            success:function(data) {
                $('.filter_products').html(data);
            }
        });
    });

    $(".occasion").on("click", function() {
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattern = get_filter('pattern');
        var fit = get_filter('fit');
        var occasion = get_filter('occasion');
        var sort = $("#sort option:selected").val();
        var url = $("#url").val();
        $.ajax({
            url:url,
            method:"post",
            data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion,sort:sort,url:url},
            success:function(data) {
                $('.filter_products').html(data);
            }
        });
    });

    function get_filter(class_name) {
        var filter = [];
        $("."+class_name+":checked").each(function() {
            filter.push($(this).val());
        });
        return filter;
    }

    $("#getPrice").change(function() {
        var size = $(this).val();
        if(size == "") {
            alert("Please select size.");
            return false;
        }
        var product_id = $(this).attr("product-id");
        $.ajax({
            url:"/get-product-price-stock",
            data:{size:size,product_id:product_id},
            type:"post",
            success:function(resp) {
                $(".getAttrStock").html(resp[1] + " items in stock.");
                if(resp[0]['discount'] > 0) {
                    $(".getAttrPrice").html("<del>" + resp[0]['product_price'] + " rsd</del> <font color='red'>" + resp[0]['finalPrice'] + " rsd</font>");
                } else {
                    $(".getAttrPrice").html(resp[0]['product_price'] + " rsd");
                }
            },error:function() {
                alert("Error");
            }
        });
    });

    // UPDATE CART ITEMS
    $(document).on("click", ".btnItemUpdate", function() {
        if($(this).hasClass("quantityMinus")) {
            var quantity = $(this).prev().val();
            if(quantity <= 1) {
                alert("Item quantity must be at least 1.");
                return false;
            } else {
                newQuantity = parseInt(quantity) - 1;                
            }
        }
        if($(this).hasClass("quantityPlus")) {
            var quantity = $(this).prev().prev().val();
            newQuantity = parseInt(quantity) + 1;   
        }        
        var cartid = $(this).data("cartid");
        $.ajax({
            data:{"cartid":cartid,"quantity":newQuantity},
            url:"/update-cart-item-quantity",
            type:"post",
            success:function(resp) {
                $("#appendCartItems").html(resp.view);
            },error:function() {
                alert("Error");
            }
        });
    });
});