<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Banner;
use Illuminate\Support\Facades\Session;
use Image;

class BannerController extends Controller
{
    public function banners()
    {
        Session::put('page', 'banners');
        $banners = Banner::get()->toArray();

        return view('admin.banners.banners', compact('banners'));
    }

    public function updateBannerStatus(Request $request)
    {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }

            Banner::where('id', $data['banner_id'])->update(['status' => $status]);

            return response()->json(['status' => $status, 'banner_id' => $data['banner_id']]);
        }
    }

    public function addEditBanner(Request $request, $id = null)
    {
        if($id == "") {
            $title = "Add Banner";
            $banner = new Banner;
            $message = "Banner added successfully.";
        } else {
            $title = "Edit Banner";
            $banner = Banner::find($id);
            $message = "Banner updated successfully.";
        }

        if($request->isMethod('post')) {
            $data = $request->all();

            $banner->link = $data['link'];
            $banner->title = $data['title'];
            $banner->alt = $data['alt'];

            // Upload Banner Image
            if($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if($image_tmp->isValid()) {                    
                    $image_name = $image_tmp->getClientOriginalName();
                    $extension = $image_tmp->getClientOriginalExtension();
                    // Generate new image name
                    $imageName = $image_name.'-'.rand(111, 99999).'.'.$extension;
                    // Set path
                    $banner_image_path = 'images/banner_images/'.$imageName;
                    // Upload banner image
                    Image::make($image_tmp)->resize(1170, 480)->save($banner_image_path);
                    // Save Banner Image in products table
                    $banner->image = $imageName;
                }
            }

            $banner->status = 1;
            $banner->save();

            Session::flash('success_message', $message);

            return redirect('admin/banners');
        }

        return view('admin.banners.add_edit_banner', compact('title', 'banner'));
    }

    public function deleteBanner($id)
    {
        $bannerImage = Banner::where('id', $id)->first();

        $banner_image_path = 'images/banner_images/';

        if(file_exists($banner_image_path.$bannerImage->image)) {
            unlink($banner_image_path.$bannerImage->image);
        }

        Banner::where('id', $id)->delete();

        $message = 'Banner has been deleted successfully.';

        Session::flash('success_message', $message);

        return redirect()->back();
    }
}
