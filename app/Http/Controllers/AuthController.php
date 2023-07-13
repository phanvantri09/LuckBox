<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\CreateRequestUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ConstCommon;
class AuthController extends Controller
{
    //
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if(Auth::user()->type != ConstCommon::TypeUser){
                return redirect()->route('admin');
            } else {
                return redirect()->route('home');
            }
            return redirect()->intended('login');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    public function showRegistrationForm(Request $request)
    {
        return view('auth.register');
    }
    public function register(CreateRequestUser $request)
    {
        $request->merge(['password' => Hash::make($request->password)]);
        if (User::create($request->all())) {
            return redirect()->route('login');
        } else {
            return redirect()->back()->with('error', "Đã có 1 lỗi xảy ra vui lòng đăng ký lại!");
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
