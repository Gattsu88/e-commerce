<?php
    use App\Product;
?>

<table class="table table-bordered">
    <thead>
        <tr>
          <th>Product</th>
          <th colspan="2">Description</th>
          <th>Quantity/Update</th>
          <th>Unit Price</th>
          <th>Category/Product<br>Discount</th>
          <th>Sub Total</th>
        </tr>
    </thead>
    <tbody>
        <?php $totalPrice = 0; ?>
        @foreach($userCartItems as $userCartItem)
        <?php $attrPrice = Product::getDiscountedAttrPrice($userCartItem['product_id'], $userCartItem['size']); ?>
        <tr>
            <td> <img width="60" src="{{ asset('images/product_images/small/'.$userCartItem['product']['main_image']) }}" alt=""/></td>
            <td colspan="2">
            {{ $userCartItem['product']['product_name'] }} ({{ $userCartItem['product']['product_code'] }})<br>
            Color : {{ $userCartItem['product']['product_color'] }}<br>
            Size: {{ $userCartItem['size'] }}
            </td>
            <td>
                <div class="input-append">
                    <input class="span1" style="max-width:34px" placeholder="1" id="appendedInputButtons" size="16" type="text" value="{{ $userCartItem['quantity'] }}">
                    <button class="btn btnItemUpdate quantityMinus" data-cartid="{{ $userCartItem['id'] }}" type="button"><i class="icon-minus"></i></button>
                    <button class="btn btnItemUpdate quantityPlus" data-cartid="{{ $userCartItem['id'] }}" type="button"><i class="icon-plus"></i></button>
                    <button class="btn btn-danger" type="button"><i class="icon-remove icon-white"></i></button>
                </div>
            </td>
            <td>{{ $attrPrice['product_price'] }} rsd</td>
            <td>{{ $attrPrice['discount'] }} rsd</td>
            <td>{{ $attrPrice['finalPrice'] * $userCartItem['quantity'] }} rsd</td>
        </tr>

        <?php $totalPrice = $totalPrice + ($attrPrice['finalPrice'] * $userCartItem['quantity']); ?>
        @endforeach
        <tr>
            <td colspan="6" style="text-align:right">Sub Total: </td>
            <td>{{ $totalPrice }} rsd</td>
        </tr>
        <tr>
            <td colspan="6" style="text-align:right">Voucher Discount: </td>
            <td>0.00 rsd</td>
        </tr>
        <tr>
            <td colspan="6" style="text-align:right"><strong>GRAND TOTAL ({{ $totalPrice }} rsd - 0 rsd) =</strong></td>
            <td class="label label-important" style="display:block"><strong> {{ $totalPrice }} rsd</strong></td>
        </tr>       
    </tbody>
</table>