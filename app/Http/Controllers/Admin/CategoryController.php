<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Section;
use Illuminate\Support\Facades\Session;
use Image;

class CategoryController extends Controller
{
    public function categories()
    {
        Session::put('page', 'categories');
        $categories = Category::all();

        return view('admin.categories.categories', compact('categories'));
    }
	
	public function updateCategoryStatus(Request $request)
    {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }

            Category::where('id', $data['category_id'])->update(['status' => $status]);

            return response()->json(['status' => $status, 'category_id' => $data['category_id']]);
        }
    }
	
	public function addEditCategory(Request $request, $id = null)
	{
		if($id == "") {
			$title = "Add Category";
			$category = new Category;
		} else {
			$title = "Edit Category";
		}

		if($request->isMethod('post')) {
		    $data = $request->all();

            $rules = [
                'category_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'section_id' => 'required',
                'url' => 'required',
                'category_image' => 'image'
            ];

            $customMessages = [
                'category_name.required' => 'Category name is required.',
                'category_name.regex' => 'Category name is not valid.',
                'section_id.required' => 'Section is required.',
                'url.required' => 'Category URL is required.',
                'category_image.image' => 'Invalid category image extension.'
            ];

            $this->validate($request, $rules, $customMessages);

            // Upload categgory image
            if($request->hasFile('category_image')) {
                $imageTmp = $request->file('category_image');
                if ($imageTmp->isValid()) {
                    // Get image extension
                    $extension = $imageTmp->getClientOriginalExtension();
                    // New image name
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $imagePath = 'images/category_images/' . $imageName;
                    // Upload image
                    Image::make($imageTmp)->save($imagePath);
                    // Save category image
                    $category->category_image = $imageName;
                }
            }

            if(empty($data['category_discount'])) {
                $data['category_discount'] = 0.00;
		    }

            if(empty($data['description'])) {
                $data['description'] = '';
            }

            if(empty($data['meta_title'])) {
                $data['meta_title'] = '';
		    }

            if(empty($data['meta_description'])) {
                $data['meta_description'] = '';
		    }

            if(empty($data['meta_keywords'])) {
                $data['meta_keywords'] = '';
		    }

		    $category->parent_id = $data['parent_id'];
            $category->section_id = $data['section_id'];
            $category->category_name = $data['category_name'];
            $category->category_discount = $data['category_discount'];
            $category->description = $data['description'];
            $category->url = $data['url'];
            $category->meta_title = $data['meta_title'];
            $category->meta_description = $data['meta_description'];
            $category->meta_keywords = $data['meta_keywords'];
            $category->status = 1;
            $category->save();

            Session::flash('success_message', 'Category added succesfully.');

            return redirect('admin/categories');
        }
		
		$sections = Section::all();
		
		return view('admin.categories.add_edit_category', compact('title', 'sections'));
	}
}
