<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('custom_auth.login');
    }

    public function login(Request $request){
        $this->validate($request, [
            'users_id' => 'required',
            'password' => 'required',
        ]);
        if (\Auth::attempt([
            'users_id' => $request->users_id,
            'password' => $request->password])){

            if (Auth::user()->role == 'Super Admin'){
                return redirect('admins/super/admin');
            }
            elseif (Auth::user()->role == 'Admin'){
                return redirect('admins/admin/all-course');
            }
            else{
                return redirect('admins/teacher/my-course');
            }

        }
        return redirect('/login')->with('error', 'Invalid Credentials Given!');
    }

    public function logout(Request $request)
    {
        if(\Auth::check())
        {
            \Auth::logout();
            $request->session()->invalidate();
        }
        return  redirect('/login');
    }
}
