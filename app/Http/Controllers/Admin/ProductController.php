<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Section;
use App\Category;
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
            $product = new Product;
            $message = "Product added succesfully.";
        } else {
            $title = "Edit Product";
        }

        if($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'category_id' => 'required',
                'product_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'product_code' => 'required|alpha_num',
                'product_price' => 'required|numeric',
                'product_color' => 'required|regex:/^[\pL\s\-]+$/u'
            ];

            $customMessages = [
                'category_id.required' => 'Category is required.',
                'product_name.required' => 'Product name is required.',
                'product_name.regex' => 'Product name is not valid.',
                'product_code.required' => 'Product code is required.',
                'product_code.regex' => 'Product code is not valid.',
                'product_price.required' => 'Product price is required.',
                'product_price.regex' => 'Product price is not valid.',
                'product_color.required' => 'Product color is required.',
                'product_color.regex' => 'Product color is not valid.'
            ];

            $this->validate($request, $rules, $customMessages);

            if(empty($data['is_featured'])) {
                $is_featured = 'No';
            } else {
                $is_featured = 'Yes';
            }            

            if(empty($data['main_image'])) {
                $data['main_image'] = "";
            }

            if(empty($data['product_video'])) {
                $data['product_video'] = "";
            }

            if(empty($data['product_discount'])) {
                $data['product_discount'] = 0;
            }

            if(empty($data['product_weight'])) {
                $data['product_weight'] = 0;
            }

            if(empty($data['description'])) {
                $data['description'] = "";
            }

            if(empty($data['wash_care'])) {
                $data['wash_care'] = "";
            }

            if(empty($data['fabric'])) {
                $data['fabric'] = "";
            }

            if(empty($data['pattern'])) {
                $data['pattern'] = "";
            }

            if(empty($data['sleeve'])) {
                $data['sleeve'] = "";
            }

            if(empty($data['fit'])) {
                $data['fit'] = "";
            }

            if(empty($data['occasion'])) {
                $data['occasion'] = "";
            }

            if(empty($data['meta_title'])) {
                $data['meta_title'] = "";
            }

            if(empty($data['meta_keywords'])) {
                $data['meta_keywords'] = "";
            }

            if(empty($data['meta_description'])) {
                $data['meta_description'] = "";
            }

            $categoryDetails = Category::find($data['category_id']);
            $product->section_id = $categoryDetails['section_id'];
            $product->category_id = $data['category_id'];
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_price = $data['product_price'];
            $product->product_color = $data['product_color'];
            $product->product_discount = $data['product_discount'];
            $product->product_weight = $data['product_weight'];
            $product->product_video = $data['product_video'];
            $product->main_image = $data['main_image'];
            $product->description = $data['description'];
            $product->wash_care = $data['wash_care'];
            $product->fabric = $data['fabric'];
            $product->pattern = $data['pattern'];
            $product->sleeve = $data['sleeve'];
            $product->fit = $data['fit'];
            $product->occasion = $data['occasion'];
            $product->meta_title = $data['meta_title'];
            $product->meta_keywords = $data['meta_keywords'];
            $product->meta_description = $data['meta_description'];
            $product->is_featured = $is_featured;
            $product->status = 1;
            $product->save();

            Session::flash('success_message', $message);

            return redirect('admin/products');
        }
        
        // Filter Arrays
        $fabricArray = ['Cotton', 'Polyester', 'Wool'];
        $sleeveArray = ['Full Sleeve', 'Half Sleeve', 'Short Sleeve', 'Sleevless'];
        $patternArray = ['Checked', 'Plain', 'Printed', 'Self', 'Solid'];
        $fitArray = ['Regular', 'Slim', 'Wool'];
        $occasionArray = ['Casual', 'Formal'];

        // Section with categories and subcategories
        $categories = Section::with('categories')->get();

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
