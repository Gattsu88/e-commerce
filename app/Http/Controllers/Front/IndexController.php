<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Banner;

class IndexController extends Controller
{
    public function index()
    {   
        // Get Featured Items
        $featuredItemsCount = Product::where('is_featured', 'Yes')->where('status', 1)->count();
        $featuredItems = Product::where('is_featured', 'Yes')->get()->toArray();
        $featuredItemsChunk = array_chunk($featuredItems, 4);

        $newProducts = Product::latest('id')->where('status', 1)->limit(6)->get()->toArray();

        $page_name = "index";

        return view('front.index', compact('page_name', 'featuredItemsCount', 'featuredItemsChunk', 'newProducts'));
    }
}
