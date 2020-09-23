<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Section;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function products()
    {
        Session::put('page', 'products');
        $products = Product::with(['category' => function($query) {
            $query->select('id', 'category_name');
        }, 'section' => function($query) {
            $query->select('id', 'name');
        }])->get();

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

    public function addEditProduct(Request $request, $id = null)
    {
        if($id == "") {
            $title = "Add Product";
        } else {
            $title = "Edit Product";
        }
        
        // Filter Arrays
        $fabricArray = ['Cotton', 'Polyester', 'Wool'];
        $sleeveArray = ['Full Sleeve', 'Half Sleeve', 'Short Sleeve', 'Sleevless'];
        $patternArray = ['Checked', 'Plain', 'Printed', 'Self', 'Solid'];
        $fitArray = ['Regular', 'Slim', 'Wool'];
        $occasionArray = ['Casual', 'Formal'];

        // Section with categories and subcategories
        $categories = Section::with('categories')->get();
        $categories = json_decode(json_encode($categories), true);
        //echo "<pre>";print_r($categories);die;

        return view('admin.products.add_edit_product', compact('title', 'fabricArray', 'sleeveArray', 'patternArray', 'fitArray', 'occasionArray', 'categories'));
    }

    public function deleteProduct($id)
    {
        $product = Product::where('id', $id)->delete();

        $message = 'Product has been deleted.';

        Session::flash('success_message', $message);

        return redirect()->back();
    }
}
