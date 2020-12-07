<?php
    use App\Product;
?>

@extends('layouts.front_layout.front_layout')

@section('content')

<div class="span9">
    <div class="well well-small">
        <h4>Featured Products <small class="pull-right">{{ $featuredItemsCount }} featured products</small></h4>
        <div class="row-fluid">
            <div id="featured" @if($featuredItemsCount > 4) class="carousel slide" @endif>
                <div class="carousel-inner">
                    @foreach($featuredItemsChunk as $key => $featuredItem)
                    <div class="item @if($key == 1) active @endif">
                        <ul class="thumbnails">
                            @foreach($featuredItem as $item)
                            <li class="span3">
                                <div class="thumbnail">
                                    <i class="tag"></i>
                                    <a href="{{ url('product/'.$item['id']) }}">
                                    <?php $product_image_path = 'images/product_images/small/'.$item['main_image']; ?>
                                    @if(!empty($item['main_image']) && file_exists($product_image_path))
                                        <img style="width: 100px;" src="{{ asset('images/product_images/small/'.$item['main_image']) }}" alt="">
                                    @else
                                        <img style="width: 100px;" src="{{ asset('images/product_images/small/no-image.png') }}" alt="">
                                    @endif
                                    <div class="caption">
                                        <h5>{{ $item['product_name'] }}</h5>

                                        <?php $discountedPrice = Product::getDiscountedPrice($item['id']); ?>

                                        <h4><a class="btn" href="{{ url('product/'.$item['id']) }}">VIEW</a> 
                                            <span class="pull-right" style="font-size: 12px;">
                                                @if($discountedPrice > 0)
                                                    <del>{{ $item['product_price'] }} rsd</del>
                                                    <font color="red">{{ $discountedPrice }} rsd</font>
                                                @else
                                                    {{ $item['product_price'] }} rsd
                                                @endif
                                            </span>
                                        </h4>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endforeach
                </div>
                <a class="left carousel-control" href="#featured" data-slide="prev">‹</a>
                <a class="right carousel-control" href="#featured" data-slide="next">›</a>
            </div>
        </div>
    </div>
    <h4>Latest Products </h4>
    <ul class="thumbnails">
        @foreach($newProducts as $newProduct)
        <li class="span3">
            <div class="thumbnail">
                <a  href="{{ url('product/'.$newProduct['id']) }}">
                <?php $product_image_path = 'images/product_images/small/'.$newProduct['main_image']; ?>
                @if(!empty($newProduct['main_image']) && file_exists($product_image_path))
                    <img style="width: 150px;" src="{{ asset('images/product_images/small/'.$newProduct['main_image']) }}" alt="">
                @else
                    <img style="width: 150px;" src="{{ asset('images/product_images/small/no-image.png') }}" alt="">
                @endif
                <div class="caption">
                    <h5>{{ $newProduct['product_name'] }}</h5>
                    <p>
                        {{ $newProduct['product_code'] }} | {{ $newProduct['product_color'] }}
                    </p>

                    <?php $discountedPrice = Product::getDiscountedPrice($newProduct['id']); ?>
                    
                    <h4 style="text-align:center"><!--<a class="btn" href="{{ url('product/'.$newProduct['id']) }}"> <i class="icon-zoom-in"></i></a>--> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">
                    @if($discountedPrice > 0)
                        <del>{{ $newProduct['product_price'] }} rsd</del>
                        <font color="yellow">{{ $discountedPrice }} rsd</font>                   
                    @else
                        {{ $newProduct['product_price'] }} rsd
                    @endif
                    </a></h4>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
</div>

@endsection