<?php

namespace App\Http\Controllers;

use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\CreateRequestUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ConstCommon;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use App\Repositories\UserRepositoryInterface;

class AuthController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    //
    public function showLoginForm()
    {
        session(['url.intended' => url()->previous()]);
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $intendedUrl = session('url.intended');

        // $credentials = [
        //     'email' => $request->email,
        //     'password' => $request->password,
        // ];

        $credentials = [
            'password' => $request->input('password')
        ];
        
        $emailOrPhone = $request->input('email');
        if (filter_var($emailOrPhone, FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $emailOrPhone;
        } else {
            $credentials['number_phone'] = $emailOrPhone;
        }
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if(Auth::user()->type != ConstCommon::TypeUser){
                // if (!$intendedUrl || $intendedUrl == route('login') || $intendedUrl == route('register') || $intendedUrl == route('home')) {
                    return redirect()->route('admin')->with('message',"Đăng nhập thành công");
                // }
                // return redirect()->intended($intendedUrl)->with('message',"Đăng nhập thành công");
            } else {
                if (!$intendedUrl || $intendedUrl == route('login') || $intendedUrl == route('register')) {
                    return redirect()->route('home')->with('message',"Đăng nhập thành công");
                }
                return redirect()->intended($intendedUrl)->with('message',"Đăng nhập thành công");
            }
            return redirect()->intended('login')->with('error', "Đã có 1 lỗi xảy ra vui lòng đăng nhập lại!");
        } else {
            return redirect()->back()->with('error',"Sai thông tin đăng nhập, vui lòng nhập lại");
        }
    }
    public function showRegistrationForm(Request $request)
    {
        return view('auth.register');
    }
    public function register(RegisterRequest $request)
    {
        $userGT = $id_user_GT = null;
        if ($request->has('code') && $request->code != null ) {
            $userGT = $this->userRepository->findUserByCode($request->code);
        }
        if (!empty($userGT)) {
            $id_user_GT = $userGT->id;
        }
        $request->merge(['password' => Hash::make($request->password)]);
        $code = Str::random(8); 

        while (User::where('code', $code)->exists()) {
            $code = Str::random(8);
        }

        $request->merge([
            'name' => $request->name ?? null,
            'code' => $code,
            'id_user_referral' => $id_user_GT
        ]);
        if (User::create($request->all())) {
            return redirect()->route('login')->with('message',"Đăng ký thành công, hãy đăng nhập ngay.");
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

    public function redirectToGoogle()
    {
        return redirect()->back()->with('info',"Chức năng này đang được bảo trì");
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        return redirect()->back()->with('info',"Chức năng này đang được bảo trì");
        $googleUser = Socialite::driver('google')->user();

        // Kiểm tra xem người dùng đã đăng nhập bằng Google trước đó chưa
        $user = User::where('google_id', $googleUser->id)->first();

        if (!$user) {
            // Nếu người dùng chưa đăng nhập bằng Google trước đó, tạo một tài khoản mới
            $user = User::create([
                'email' => $googleUser->email,
                'social_id' => $googleUser->id,
                'social_type' => "Mail",
                // Xử lý các trường thông tin khác của người dùng nếu cần thiết
            ]);
        }

        // Đăng nhập người dùng vào ứng dụng Laravel của bạn
        auth()->login($user);

        // Chuyển hướng người dùng đến trang chủ của ứng dụng sau khi đăng nhập thành công
        return redirect()->route('home')->with('message',"Thành công");
    }
}
