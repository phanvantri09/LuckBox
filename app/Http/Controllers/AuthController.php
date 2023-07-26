<?php

namespace App\Http\Controllers;

use Hashids\Hashids;
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
        session(['url.intended' => url()->previous()]);
        return view('auth.login');
    }

    public function login(Request $request)
    {
        
        $intendedUrl = session('url.intended');
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if(Auth::user()->type != ConstCommon::TypeUser){
                if (!$intendedUrl || $intendedUrl == route('login')) {
                    return redirect()->route('amdin');
                }
                return redirect()->intended($intendedUrl);
            } else {
                if (!$intendedUrl || $intendedUrl == route('login')) {
                    return redirect()->route('home');
                }
                return redirect()->intended($intendedUrl);
            }
            return redirect()->intended('login');
        }

        return back()->withErrors([
            'email' => 'Email của bạn không hợp lệ',
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


    public function updateShare($token)
    {
        $hashids = new Hashids('share');
        $decodedData = $hashids->decode($token);
        $userId = $decodedData[0];
        return view('auth.registerShare', compact('userId'));
    }

    public function registerShare(CreateRequestUser $request, $id)
    {
        $request->merge([
            'password' => Hash::make($request->password),
            'id_user_referral' => $id
        ]);
        if (User::create($request->all())) {
            return redirect()->route('login');
        } else {
            return redirect()->back()->with('error', "Đã có 1 lỗi xảy ra vui lòng đăng ký lại!");
        }
    }
}
