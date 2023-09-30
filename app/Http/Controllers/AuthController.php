<?php

namespace App\Http\Controllers;

use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\CreateRequestUser;
use App\Http\Requests\Auth\ChangPassOTP;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ConstCommon;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ChangPassOTPDone;
use App\Http\Requests\Auth\ChangPass;
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
        if (Auth::check()) {
            return redirect()->route('home')->with('info','Bạn đã đăng nhập rồi');
        }
        session(['url.intended' => url()->previous()]);
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $intendedUrl = session('url.intended');

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
                if (!$intendedUrl || $intendedUrl == route('login') || $intendedUrl == route('register') || $intendedUrl == route('register', ['type'=>'number_phone'])) {
                    return redirect()->route('home')->with('message',"Đăng nhập thành công");
                } else {
                    return redirect()->intended($intendedUrl)->with('message',"Đăng nhập thành công");
                }
                // return redirect()->route('login')->with('error', "Đã có 1 lỗi xảy ra vui lòng đăng nhập lại!");
            }
        } else {
            return redirect()->back()->with('error',"Sai thông tin đăng nhập, vui lòng nhập lại");
        }
    }
    public function showRegistrationForm(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('home')->with('info','Bạn đã đăng nhập rồi');
        }
        if ($request->has('type')){
            $type = $request->type;
            return view('auth.register', compact(['type']));
        }
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


    public function updateShare(Request $request, $token)
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        $hashids = new Hashids('share', 12);
        $decodedData = $hashids->decode($token);
        $userId = $decodedData[0];
        if ($request->has('type')){
            $type = $request->type;
            return view('auth.registerShare', compact(['type', 'token', 'userId']));
        }
        return view('auth.registerShare', compact('userId','token'));
    }

    public function registerShare(RegisterRequest $request, $id)
    {
        $code = Str::random(8);

        while (User::where('code', $code)->exists()) {
            $code = Str::random(8);
        }

        $request->merge([
            'name' => $request->name ?? null,
            'code' => $code,
            'password' => Hash::make($request->password),
            'id_user_referral' => $id
        ]);
        if (User::create($request->all())) {
            return redirect()->route('login')->with('message',"Đăng ký thành công, hãy đăng nhập ngay.");
        } else {
            return redirect()->back()->with('error', "Đã có 1 lỗi xảy ra vui lòng đăng ký lại!");
        }

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
    public function updatePassword(ChangPass $request)
    {
        $user = Auth::user();

        if (Hash::check($request->password, $user->password)) {

            $user->password = Hash::make($request->passwordNew);
            $user->save();

            return redirect()->back()->with('success', 'Mật khẩu đã được thay đổi thành công.');
        } else {
            return redirect()->back()->with('error', 'Mật khẩu hiện tại không chính xác.');
        }
    }

    public function showLinkRequestForm()
    {
        return view('auth.email');
    }

    public function sendResetLinkEmail(ChangPassOTP $request)
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        $emailOrPhone = $request->input('email');
        if (filter_var($emailOrPhone, FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $emailOrPhone;
            $checkEmail = $this->userRepository->checkByEmail($emailOrPhone);
            if (!empty($checkEmail)) {
                $userId = $checkEmail->id;
                $dataToEncode = [
                    $userId
                ];

                $hashids = new Hashids('share', 16);
                $encodedData = $hashids->encode($dataToEncode);
                $sharedLink = route('password.reset', ['id_user'=>$encodedData]);

                if (ConstCommon::sendMailLinkPass($checkEmail->email,
                    ['email' => $checkEmail->email,
                    'type'=>"Đổi mật khẩu",
                    'status'=> "Thành công",
                    'link'=>$sharedLink ]
                )) {
                    return redirect()->back()->with('error', 'Email này chưa được đăng ký!');
                } else {
                    return redirect()->back()->with('success', 'Đã gửi liên kết đổi mật khẩu của bạn về mail, vui lòng mở mail để kiểm tra, và nhấn vào link để đổi mật khẩu.');
                }
            } else {
                return redirect()->back()->with('error', 'Email này chưa được đăng ký!');
            }
        } else {
            return redirect()->back()->with('error', ' Chức năng này chưa cập nhật cho Điện thoại. Chúng tôi sẽ cập nhật sớm nhất có thể. Xin lỗi bạn vì sự bất tiện này!');
            // code cho số didenj thoại ở đây
            $checkNumberPhone = $this->userRepository->checkByNumberPhone($emailOrPhone);
            if (!empty($checkNumberPhone)) {
                // ở đây là phải gửi OTP về sđt trước nè xong mới chuyển hướng về DB
                $otp = mt_srand(6);
                return view('auth.OTP', compact(['checkNumberPhone','otp']));
            } else {
                return redirect()->back()->with('error', ' Số điện thoại này chưa được đăng ký!');
            }
            // $credentials['number_phone'] = $emailOrPhone;
        }


    }
    public function showResetForm(Request $request, $id_user = null)
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('auth.reset')->with(
            ['id_user' => $id_user]
        );
    }
    public function reset(ChangPassOTPDone $request){
        $hashids = new Hashids('share', 16);
        $decodedData = $hashids->decode($request->id_user);
        $userId = $decodedData[0];

        $user = User::findOrFail($userId);

        if (!empty($user)) {
            $user->password = Hash::make($request->passwordNew);
            if ($user->save()) {
                return redirect()->route('login')->with('success','Đổi mật khẩu thành công hãy đăng nhập.');
            }

        }

    }

}
