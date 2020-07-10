<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Admin;
use Image;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.admin_dashboard');
    }

    public function login(Request $request)
    {
        if($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required'
            ];

            $customMessages = [
                'email.required' => 'Email is required.',
                'email.email' => 'Valid email is required.',
                'password.required' => 'Password is required.'
            ];

            $this->validate($request, $rules, $customMessages);

            if(Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                return redirect('admin/dashboard');
            } else {
                Session::flash('error_message', 'Wrong credentials.');

                return redirect()->back();
            }
        }

    	return view('admin.admin_login');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect('/admin');
    }

    public function settings()
    {
        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first();

        return view('admin.admin_settings', compact('adminDetails'));
    }

    public function checkAdminPassword(Request $request)
    {
        $data = $request->all();

        if(Hash::check($data['currentPassword'], Auth::guard('admin')->user()->password)) {
            echo "true";
        } else {
            echo "false";
        }
    }

    public function updateAdminPassword(Request $request)
    {
        if($request->isMethod('post')) {
            $data = $request->all();

            // Check if new password is correct
            if(Hash::check($data['currentPassword'], Auth::guard('admin')->user()->password)) {
                // Check if confirm password match new password
                if($data['newPassword'] == $data['confirmPassword']) {
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password' => bcrypt($data['newPassword'])]);
                    Session::flash('success_message', 'Password has been updated successfully.');
                } else {
                    Session::flash('error_message', 'No match between new password and confirm password.');
                }
            } else {
                Session::flash('error_message', 'Incorrect current password.');
            }
            return redirect()->back();
        }
    }

    public function updateAdminDetails(Request $request)
    {
        if($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'name' => 'required|regex:/^[\pL\s\-]+$/u',
                'mobile' => 'required|numeric',
                'image' => 'image'
            ];

            $customMessages = [
                'name.required' => 'Name is required.',
                'name.alpha' => 'Name is not valid.',
                'mobile.required' => 'Mobile is required.',
                'mobile.numeric' => 'Invalid mobile number',
                'image.image' => 'Invalid image extension.'
            ];

            $this->validate($request, $rules, $customMessages);

            // Upload admin image
            if($request->hasFile('image')) {
                $imageTmp = $request->file('image');
                if($imageTmp->isValid()) {
                    // Get image extension
                    $extension = $imageTmp->getClientOriginalExtension();
                    // New image name
                    $imageName = rand(111,99999).'.'.$extension;
                    $imagePath = 'images/admin_images/admin_photos/'.$imageName;
                    // Upload image
                    Image::make($imageTmp)->save($imagePath);
                } elseif(!empty($data['currentImage'])) {
                    $imageName = $data['currentImage'];
                } else {
                    $imageName = "";
                }
            }

            // Update admin details
            Admin::where('email', Auth::guard('admin')->user()->email)->update([
                'name' => $data['name'],
                'mobile' => $data['mobile'],
                'image' => $imageName
            ]);

            Session::flash('success_message', 'Admin details updated successfully.');
            return redirect()->back();
        }

        return view('admin.update_admin_details');
    }
}
