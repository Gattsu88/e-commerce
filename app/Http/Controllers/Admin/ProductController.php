<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Section;
use App\Category;
use App\Brand;
use App\ProductsAttribute;
use App\ProductsImage;
use Illuminate\Support\Facades\Session;
use Image;

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
            $productData = [];
            $message = "Product added successfully.";
        } else {
            $title = "Edit Product";
            $productData = Product::find($id);
            $product = Product::find($id);
            $message = "Product updated successfully.";
        }

        if($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'category_id' => 'required',
                'brand_id' => 'required',
                'product_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'product_code' => 'required|alpha_num',
                'product_price' => 'required|numeric',
                'product_color' => 'required|regex:/^[\pL\s\-]+$/u'
            ];

            $customMessages = [
                'category_id.required' => 'Category is required.',
                'brand_id.required' => 'Brand is required.',
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
                $is_featured = "No";
            } else {
                $is_featured = "Yes";
            }            

            if(empty($data['main_image'])) {
                $data['main_image'] = "";
            }

            if(empty($data['product_video'])) {
                $data['product_video'] = "";
            }

            // Upload Product Image
            if($request->hasFile('main_image')) {
                $image_tmp = $request->file('main_image');
                if($image_tmp->isValid()) {                    
                    $image_name = $image_tmp->getClientOriginalName();
                    $extension = $image_tmp->getClientOriginalExtension();
                    // Generate new image name
                    $imageName = $image_name.'-'.rand(111, 99999).'.'.$extension;
                    // Set paths
                    $large_image_path = 'images/product_images/large/'.$imageName;
                    $medium_image_path = 'images/product_images/medium/'.$imageName;
                    $small_image_path = 'images/product_images/small/'.$imageName;
                    // Upload large image
                    Image::make($image_tmp)->save($large_image_path); // W:1040, H:1200
                    // Upload medium and small images after resize
                    Image::make($image_tmp)->resize(520, 600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(260, 300)->save($small_image_path);
                    // Save Product Main Image in products table
                    $product->main_image = $imageName;
                }
            }

            // Upload Product Video
            if($request->hasFile('product_video')) {
                $video_tmp = $request->file('product_video');
                if($video_tmp->isValid()) {
                    // Upload Video
                    $video_name = $video_tmp->getClientOriginalName();
                    $extension = $video_tmp->getClientOriginalExtension();
                    $videoName = $video_name.'-'.rand().'.'.$extension;
                    $video_path = 'videos/product_videos/';
                    $video_tmp->move($video_path, $videoName);
                    // Save Product Video in products table
                    $product->product_video = $videoName;
                }
            }

            $categoryDetails = Category::find($data['category_id']);
            $product->section_id = $categoryDetails['section_id'];
            $product->brand_id = $data['brand_id'];
            $product->category_id = $data['category_id'];
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_price = $data['product_price'];
            $product->product_color = $data['product_color'];
            $product->product_discount = $data['product_discount'];
            $product->product_weight = $data['product_weight'];
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
        
        // Product Filters
        $productFilters = Product::productFilters();
        
        $fabricArray = $productFilters['fabricArray'];
        $sleeveArray = $productFilters['sleeveArray'];
        $patternArray = $productFilters['patternArray'];
        $fitArray = $productFilters['fitArray'];
        $occasionArray = $productFilters['occasionArray'];

        // Section with categories and subcategories
        $categories = Section::with('categories')->get();

        // Get All Active Brands
        $brands = Brand::where('status', 1)->get();

        return view('admin.products.add_edit_product', compact('title', 'fabricArray', 'sleeveArray', 'patternArray', 'fitArray', 'occasionArray', 'categories', 'productData', 'brands'));
    }

    public function deleteProductImage($id)
    {
        $productImage = Product::select('main_image')->where('id', $id)->first();

        $small_image_path = 'images/product_images/small/';
        $medium_image_path = 'images/product_images/medium/';
        $large_image_path = 'images/product_images/large/';

        if(file_exists($small_image_path.$productImage->main_image)) {
            unlink($small_image_path.$productImage->main_image);
        }
        if(file_exists($medium_image_path.$productImage->main_image)) {
            unlink($medium_image_path.$productImage->main_image);
        }
        if(file_exists($large_image_path.$productImage->main_image)) {
            unlink($large_image_path.$productImage->main_image);
        }

        Product::where('id', $id)->update(['main_image' => '']);

        $message = 'Product image has been deleted.';

        Session::flash('success_message', $message);

        return back();
    }

    public function deleteProductVideo($id)
    {
        $productVideo = Product::select('product_video')->where('id', $id)->first();

        $product_video_path = 'videos/product_videos/';

        if(file_exists($product_video_path.$productVideo->product_video)) {
            unlink($product_video_path.$productVideo->product_video);
        }

        Product::where('id', $id)->update(['product_video' => '']);

        $message = 'Product video has been deleted.';

        Session::flash('success_message', $message);

        return back();
    }

    public function deleteProduct($id)
    {
        $product = Product::where('id', $id)->delete();

        $message = 'Product has been deleted.';

        Session::flash('success_message', $message);

        return back();
    }

    public function addAttributes(Request $request, $id)
    {   
        if($request->isMethod('post')) {
            $data = $request->all();
            foreach($data['sku'] as $key => $value) {
                if(!empty($value)) {

                    $attrCountSKU = ProductsAttribute::where(['sku' => $value])->count();
                    if($attrCountSKU > 0) {
                        $message = 'SKU already exists.';
                        Session::flash('error_message', $message);
                        return back();
                    }

                    $attrCountSize = ProductsAttribute::where(['product_id' => $id, 'size' => $data['size'][$key]])->count();
                    if($attrCountSize > 0) {
                        $message = 'Size already exists.';
                        Session::flash('error_message', $message);
                        return back();
                    }

                    $attribute = new ProductsAttribute;
                    $attribute->product_id = $id;
                    $attribute->sku = $value;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->status = 1;
                    $attribute->save();
                }
            }

            $message = 'Product attributes has been added successfully.';

            Session::flash('success_message', $message);
        }

        $title = "Product Attributes"; 
        $productData = Product::select('id', 'product_name', 'product_code', 'product_color', 'product_price', 'main_image')->with('attributes')->find($id);

        return view('admin.products.add_attributes', compact('title', 'productData'));
    }

    public function editAttributes(Request $request, $id)
    {
        if($request->isMethod('post')) {
            $data = $request->all();

            foreach($data['attrId'] as $key => $attr) {
                if(!empty($attr)) {
                    ProductsAttribute::where(['id' => $data['attrId'][$key]])->update(['price' => $data['price'][$key], 'stock' => $data['stock'][$key]]);
                }
            }

            $message = 'Product attributes has been updated successfully.';
            Session::flash('success_message', $message);
            return back();
        }
    }

    public function updateAttributeStatus(Request $request)
    {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }

            ProductsAttribute::where('id', $data['attribute_id'])->update(['status' => $status]);

            return response()->json(['status' => $status, 'attribute_id' => $data['attribute_id']]);
        }
    }

    public function deleteAttribute($id)
    {
        ProductsAttribute::where('id', $id)->delete();

        $message = 'Product attribute has been deleted.';

        Session::flash('success_message', $message);

        return back();
    }

    public function addImages(Request $request, $id)
    {
        if($request->isMethod('post')) {
            $data = $request->all();
            if($request->hasFile('images')) {
                $images = $request->file('images');
                foreach($images as $key => $image) {
                    $productImage = new ProductsImage;
                    $image_tmp = Image::make($image);
                    $extension = $image->getClientOriginalExtension();
                    $imageName = rand(1111, 999999).time().".".$extension;
                    // Set paths
                    $large_image_path = 'images/product_images/large/'.$imageName;
                    $medium_image_path = 'images/product_images/medium/'.$imageName;
                    $small_image_path = 'images/product_images/small/'.$imageName;
                    // Upload large image
                    Image::make($image_tmp)->save($large_image_path); // W:1040, H:1200
                    // Upload medium and small images after resize
                    Image::make($image_tmp)->resize(520, 600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(260, 300)->save($small_image_path);
                    // Save Product Images in products table
                    $productImage->image = $imageName;
                    $productImage->product_id = $id;
                    $productImage->status = 1;
                    $productImage->save();
                }

                $message = 'Product images has been added successfully.';
                Session::flash('success_message', $message);
                return back();                
            }

        }
        $title = "Product Images";
        $productData = Product::with('images')->select('id', 'product_name', 'product_code', 'product_color', 'main_image')->find($id);

        return view('admin.products.add_images', compact('title', 'productData'));
    }

    public function updateImageStatus(Request $request)
    {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }

            ProductsImage::where('id', $data['image_id'])->update(['status' => $status]);

            return response()->json(['status' => $status, 'image_id' => $data['image_id']]);
        }
    }

    public function deleteImage($id)
    {
        $productImage = ProductsImage::select('image')->where('id', $id)->first();

        $small_image_path = 'images/product_images/small/';
        $medium_image_path = 'images/product_images/medium/';
        $large_image_path = 'images/product_images/large/';

        if(file_exists($small_image_path.$productImage->image)) {
            unlink($small_image_path.$productImage->image);
        }
        if(file_exists($medium_image_path.$productImage->image)) {
            unlink($medium_image_path.$productImage->image);
        }
        if(file_exists($large_image_path.$productImage->image)) {
            unlink($large_image_path.$productImage->image);
        }

        ProductsImage::where('id', $id)->delete();

        $message = 'Product image has been deleted successfully.';

        Session::flash('success_message', $message);

        return back();
    }
}