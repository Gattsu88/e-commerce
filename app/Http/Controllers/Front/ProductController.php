<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Product;


class ProductController extends Controller
{
    public function listing($url)
    {
        $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();
        if($categoryCount > 0) {
            $categoryDetails = Category::catDetails($url);
            $categoryProducts = Product::with('brand')->whereIn('category_id', $categoryDetails['catIDs'])->where('status', 1)->get()->toArray();
            
            return view('front.products.listing', compact('categoryDetails', 'categoryProducts'));
        } else {
            abort(404);
        }
    }
}
