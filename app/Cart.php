<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\ProductsAttribute;
use Session;
use Auth;

class Cart extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }

    public static function userCartItems()
    {
        if(Auth::check()) {
            $userCartItems = Cart::with(['product' => function($query){
                $query->select('id', 'product_name', 'product_color', 'product_price', 'product_code', 'main_image');
            }])->where('user_id', Auth::id())->latest()->get()->toArray();
        } else {
            $userCartItems = Cart::with(['product' => function($query){
                $query->select('id', 'product_name', 'product_color', 'product_price', 'product_code', 'main_image');
            }])->where('session_id', Session::get('session_id'))->latest()->get()->toArray();
        }

        return $userCartItems;
    }

    public static function getProductAttrPrice($product_id, $size)
    {
        $attrPrice = ProductsAttribute::select('price')->where(['product_id' => $product_id, 'size' => $size])->first()->toArray();

        return $attrPrice['price'];
    }
}
