<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\ProductsAttribute;
use App\Cart;
use Illuminate\Support\Facades\Session;
use Auth;

class ProductController extends Controller
{
    public function listing(Request $request)
    {
        Paginator::useBootstrap();
        if($request->ajax()) {
            $data = $request->all();            
            $url = $data['url'];

            $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();
            if($categoryCount > 0) {
                $categoryDetails = Category::catDetails($url);
                $categoryProducts = Product::with('brand')->whereIn('category_id', $categoryDetails['catIDs'])->where('status', 1);

                // If fabric filter is select
                if(isset($data['fabric']) && !empty($data['fabric'])) {
                    $categoryProducts->whereIn('products.fabric', $data['fabric']);
                }
                // If sleeve filter is select
                if(isset($data['sleeve']) && !empty($data['sleeve'])) {
                    $categoryProducts->whereIn('products.sleeve', $data['sleeve']);
                }
                // If pattern filter is select
                if(isset($data['pattern']) && !empty($data['pattern'])) {
                    $categoryProducts->whereIn('products.pattern', $data['pattern']);
                }
                // If fit filter is select
                if(isset($data['fit']) && !empty($data['fit'])) {
                    $categoryProducts->whereIn('products.fit', $data['fit']);
                }
                // If occasion filter is select
                if(isset($data['occasion']) && !empty($data['occasion'])) {
                    $categoryProducts->whereIn('products.occasion', $data['occasion']);
                }

                // If sort option is selected by user
                if(isset($data['sort']) && !empty($data['sort'])) {
                    if($data['sort'] == "latest_products") {
                        $categoryProducts->orderBy('id', 'Desc');
                    } else if ($data['sort'] == "product_name_a_z") {
                        $categoryProducts->orderBy('product_name', 'Asc');
                    } else if ($data['sort'] == "product_name_z_a") {
                        $categoryProducts->orderBy('product_name', 'Desc');
                    } else if ($data['sort'] == "lowest_price") {
                        $categoryProducts->orderBy('product_price', 'Asc');
                    } else if ($data['sort'] == "highest_price") {
                        $categoryProducts->orderBy('product_price', 'Desc');
                    }
                } else {
                    $categoryProducts->orderBy('id', 'Desc');
                }

                $categoryProducts = $categoryProducts->paginate(6);

                return view('front.products.ajax_products_listing', compact('categoryDetails', 'categoryProducts', 'url'));
            } else {
                abort(404);
            }

        } else {
            $url = Route::getFacadeRoot()->current()->uri();
            $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();
            if($categoryCount > 0) {
                $categoryDetails = Category::catDetails($url);
                $categoryProducts = Product::with('brand')->whereIn('category_id', $categoryDetails['catIDs'])->where('status', 1)->paginate(6);
                
                // Product Filters
                $productFilters = Product::productFilters();
                
                $fabricArray = $productFilters['fabricArray'];
                $sleeveArray = $productFilters['sleeveArray'];
                $patternArray = $productFilters['patternArray'];
                $fitArray = $productFilters['fitArray'];
                $occasionArray = $productFilters['occasionArray'];

                $page_name = "listing";

                return view('front.products.listing', compact('categoryDetails', 'categoryProducts', 'url', 'fabricArray', 'sleeveArray', 'patternArray', 'fitArray', 'occasionArray', 'page_name'));
            } else {
                abort(404);
            }
        }     
    }

    public function productDetails($id)
    {
        $productDetails = Product::with(['category', 'brand', 'attributes' => function($query){
            $query->where('status', 1);
        }, 'images'])->find($id)->toArray();
        $totalStock = ProductsAttribute::where('product_id', $id)->sum('stock');
        $relatedProducts = Product::where('category_id', $productDetails['category']['id'])->where('id', '!=', $id)->limit(3)->inRandomOrder()->get()->toArray();

        return view('front.products.product_details', compact('productDetails', 'totalStock', 'relatedProducts'));
    }

    public function getProductPriceStock(Request $request)
    {
        if($request->ajax()) {
            $data = $request->all();
            $getDiscountedAttrPrice = Product::getDiscountedAttrPrice($data['product_id'], $data['size']);
            $getStock = ProductsAttribute::select('stock')->where(['product_id' => $data['product_id'], 'size' => $data['size']])->first()->toArray();

            return [$getDiscountedAttrPrice, $getStock['stock']];           
        }
    }

    public function addToCart(Request $request)
    {
        if($request->isMethod('post')) {
            $data = $request->all();
            
            // CHECK FOR PRODUCT STOCK
            $getProductStock = ProductsAttribute::where(['product_id' => $data['product_id'], 'size' => $data['size']])->first()->toArray();
            if($getProductStock['stock'] < $data['quantity']) {                
                $message = "Required Quantity is not available.";
                Session::flash('error_message', $message);
                return back();
            }

            // GET OR CREATE SESSION ID
            $session_id = Session::get('session_id');
            if(empty($session_id)) {
                $session_id = Session::getId();
                Session::put('session_id', $session_id);
            }

            // IF PRODUCT EXISTS IN USER CART
            if(Auth::check()) {
                $countProducts = Cart::where(['product_id' => $data['product_id'], 'size' => $data['size'], 'user_id' => Auth::id()])->count();
            } else {
                $countProducts = Cart::where(['product_id' => $data['product_id'], 'size' => $data['size'], 'session_id' => Session::get('session_id')])->count();
            }
            
            if($countProducts > 0) {
                $message = "Product exists in Cart.";
                Session::flash('error_message', $message);
                return back();
            }

            // SAVE PRODUCT TO CART
            $cart = new Cart;
            $cart->session_id = $session_id;
            $cart->product_id = $data['product_id'];
            $cart->size = $data['size'];
            $cart->quantity = $data['quantity'];
            $cart->save();

            $message = "Product has been added to Cart.";
            Session::flash('success_message', $message);
            return redirect('cart');
        }
    }

    public function cart()
    {
        $userCartItems = Cart::userCartItems();

        return view('front.products.cart', compact('userCartItems'));
    }

    public function updateCartItemQuantity(Request $request)
    {
        if($request->ajax()) {
            $data = $request->all();
            Cart::where('id', $data['cartid'])->update(['quantity' => $data['quantity']]);
            $userCartItems = Cart::userCartItems();

            return response()->json(['view' => (String)View::make('front.products.cart_items', compact('userCartItems'))]);
        }
    }
}
