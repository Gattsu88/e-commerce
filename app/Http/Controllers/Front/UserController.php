<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\Cart;

class UserController extends Controller
{
    public function loginRegister()
    {
        return view('front.users.login_register');
    }

    public function registerUser(Request $request)
    {
        if($request->isMethod('post')) {
            $data = $request->all();

            $userCount = User::where('email', $data['email'])->count();
            if($userCount > 0) {
                $message = "User already exists!";
                Session::flash('error_message', $message);
                return back();
            } else {
                $user = new User;
                $user->name = $data['name'];
                $user->mobile = $data['mobile'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->status = 1;
                $user->save();

                if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                    // Update user cart with user_id
                    if(!empty(Session::get('session_id'))) {
                        $user_id = Auth::id();
                        $session_id = Session::get('session_id');
                        Cart::where('session_id', $session_id)->update(['user_id' => $user_id]);
                    }
                    return redirect('cart');
                }
            }
        }
    }

    public function checkEmail(Request $request)
    {
        $data = $request->all();
        $emailCount = User::where('email', $data['email'])->count();
        if($emailCount > 0) {
            return "false";
        } else {
            return "true";
        }
    }

    public function loginUser(Request $request)
    {
        if($request->isMethod('post')) {
            $data = $request->all();
            if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                // Update user cart with user_id
                if(!empty(Session::get('session_id'))) {
                    $user_id = Auth::id();
                    $session_id = Session::get('session_id');
                    Cart::where('session_id', $session_id)->update(['user_id' => $user_id]);
                }
                return redirect('cart');
            } else {
                $message = "Invalid Username or Password.";
                Session::flash('error_message', $message);
                return back();
            }
        }
    }

    public function logoutUser()
    {
        Auth::logout();
        return redirect('/');
    }
}
