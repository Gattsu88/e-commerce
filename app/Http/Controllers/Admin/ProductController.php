<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function products()
    {
        Session::put('page', 'products');
        $products = Product::all();

        return view('admin.products.products', compact('products'));
    }

    public function updateProductStatus(Request $request)
    {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }

            Product::where('id', $data['product_id'])->update(['status' => $status]);

            return response()->json(['status' => $status, 'product_id' => $data['product_id']]);
        }
    }

    public function deleteProduct($id)
    {
        $product = Product::where('id', $id)->delete();

        $message = 'Product has been deleted.';

        Session::flash('success_message', $message);

        return redirect()->back();
    }
}
