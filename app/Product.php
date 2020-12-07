<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function section()
    {
        return $this->belongsTo('App\Section', 'section_id');
    }

    public function brand()
    {
        return $this->belongsTo('App\Brand', 'brand_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function attributes()
    {
        return $this->hasMany('App\ProductsAttribute');
    }

    public function images()
    {
        return $this->hasMany('App\ProductsImage');
    }

    public static function productFilters()
    {
        $productFilters['fabricArray'] = ['Cotton', 'Polyester', 'Wool'];
        $productFilters['sleeveArray'] = ['Full Sleeve', 'Half Sleeve', 'Short Sleeve', 'Sleevless'];
        $productFilters['patternArray'] = ['Checked', 'Plain', 'Printed', 'Self', 'Solid'];
        $productFilters['fitArray'] = ['Regular', 'Slim', 'Wool'];
        $productFilters['occasionArray'] = ['Casual', 'Formal'];

        return $productFilters;
    }

    // JUST FOR LISTING PAGE
    public static function getDiscountedPrice($product_id)
    {
        $productDetails = Product::select('product_price', 'product_discount', 'category_id')->where('id', $product_id)->first()->toArray();
        $categoryDetails = Category::select('category_discount')->where('id', $productDetails['category_id'])->first()->toArray();

        if($productDetails['product_discount'] > 0) {
            $discountedPrice = $productDetails['product_price'] - $productDetails['product_price'] * $productDetails['product_discount'] / 100;
        } else if($categoryDetails['category_discount'] > 0) {
            $discountedPrice = $productDetails['product_price'] - $productDetails['product_price'] * $categoryDetails['category_discount'] / 100;
        } else {
            $discountedPrice = 0;
        }

        return $discountedPrice;
    }

    public static function getDiscountedAttrPrice($product_id, $size)
    {
        $productAttrPrice = ProductsAttribute::where(['product_id' => $product_id, 'size' => $size])->first()->toArray();
        $productDetails = Product::select('product_discount', 'category_id')->where('id', $product_id)->first()->toArray();
        $categoryDetails = Category::select('category_discount')->where('id', $productDetails['category_id'])->first()->toArray();

        if($productDetails['product_discount'] > 0) {
            $finalPrice = $productAttrPrice['price'] - $productAttrPrice['price'] * $productDetails['product_discount'] / 100;
            $discount = $productAttrPrice['price'] - $finalPrice;
        } else if($categoryDetails['category_discount'] > 0) {
            $finalPrice = $productAttrPrice['price'] - $productAttrPrice['price'] * $categoryDetails['category_discount'] / 100;
            $discount = $productAttrPrice['price'] - $finalPrice;
        } else {
            $finalPrice = $productAttrPrice['price'];
            $discount = 0;
        }

        return ['product_price' => $productAttrPrice['price'], 'finalPrice' => $finalPrice, 'discount' => $discount];
    }
}
