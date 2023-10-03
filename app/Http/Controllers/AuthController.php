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
use GuzzleHttp\Client;
use Illuminate\Support\Facades\URL;

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
            // return redirect()->back()->with('error', ' Chức năng này chưa cập nhật cho Điện thoại. Chúng tôi sẽ cập nhật sớm nhất có thể. Xin lỗi bạn vì sự bất tiện này!');
            // code cho số didenj thoại ở đây
            $checkNumberPhone = $this->userRepository->checkByNumberPhone($emailOrPhone);
            if (!empty($checkNumberPhone)) {
                // ở đây là phải gửi OTP về sđt trước nè xong mới chuyển hướng về DB


                $APIKey="E380B685A2C342929EC9F4710231FB";
                $SecretKey="40A94EE4EA5E4C0D663D3AB482577E";
                $YourPhone="0372868775";
                $ch = curl_init();
                // $Content="1133 la ma xac minh dang ky Baotrixemay cua ban
                // Cam on quy khach da su dung dich vu cua chung toi. Chuc quy khach mot ngay tot lanh!
                // Trong đó 1133 là biến, quý khách có thể thay đổi";
                // $brand = "Baotrixemay";
                // $SendContent=urlencode($Content);
                // $data="http://rest.esms.vn/MainService.svc/json/SendMultipleMessage_V4_get?Phone=$YourPhone&ApiKey=$APIKey&SecretKey=$SecretKey&Content=$SendContent&Brandname=$brand&SmsType=2";
                // //De dang ky brandname rieng vui long lien he hotline 0901.888.484 hoac nhan vien kinh Doanh cua ban
                // $curl = curl_init($data);
                // curl_setopt($curl, CURLOPT_FAILONERROR, true);
                // curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
                // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                // $result = curl_exec($curl);

                // $obj = json_decode($result,true);
                // if($obj['CodeResult']==100)
                // {
                //     print "<br>";
                //     print "CodeResult:".$obj['CodeResult'];
                //     print "<br>";
                //     print "CountRegenerate:".$obj['CountRegenerate'];
                //     print "<br>";
                //     print "SMSID:".$obj['SMSID'];
                //     print "<br>";
                //     dd("Thành công");
                // }
                // else
                // {
                //     dd("ErrorMessage:".$obj['ErrorMessage'], $result);
                // }

                $SampleXml = "<RQST>"
                                    . "<APIKEY>". $APIKey ."</APIKEY>"
                                    . "<SECRETKEY>". $SecretKey ."</SECRETKEY>"
                                    . "<ISFLASH>0</ISFLASH>"
                                    . "<SMSTYPE>2</SMSTYPE>"
                                    . "<CONTENT>". '1234 la ma xac minh dang ky Baotrixemay cua ban' ."</CONTENT>"
                                    . "<BRANDNAME>Baotrixemay</BRANDNAME>"//De dang ky brandname rieng vui long lien he hotline 0902435340 hoac nhan vien kinh Doanh cua ban
                                    . "<CONTACTS>"
                                    . "<CUSTOMER>"
                                    . "<PHONE>". $YourPhone ."</PHONE>"
                                    . "</CUSTOMER>"
                                    . "</CONTACTS>"
                                    . "</RQST>";


                curl_setopt($ch, CURLOPT_URL,            "http://api.esms.vn/MainService.svc/xml/SendMultipleMessage_V4/" );
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
                curl_setopt($ch, CURLOPT_POST,           1 );
                curl_setopt($ch, CURLOPT_POSTFIELDS,     $SampleXml );
                curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Content-Type: text/plain'));

                $result=curl_exec ($ch);
                $xml = simplexml_load_string($result);

                if ($xml === false) {
                    dd('Error parsing XML');
                }

                //now we can loop through the xml structure
                //Tham khao them ve SMSTYPE de gui tin nhan hien thi ten cong ty hay gui bang dau so 8755... tai day :http://esms.vn/SMSApi/ApiSendSMSNormal

                dd("Ket qua goi API: " . $xml->CodeResult );


                $this->sendOTP($emailOrPhone);
                // $otp = mt_srand(6);
                // return view('auth.OTP', compact(['checkNumberPhone','otp']));
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
    public function sendOTP($phoneNumber)
    {
        $code = [
            random_int(100000, 999999)
        ];
        $hashids = new Hashids('share', 32);
        $encodedData = $hashids->encode($code);
        $content = 'Mã của bạn là: '. $encodedData; // Nội dung OTP

        $client = new Client();

        $response = $client->post('https://api.speedsms.vn/index.php/sms/send', [
            'form_params' => [
                'to' => $phoneNumber,
                'content' => $content,
                'type' => 2, // Loại tin nhắn OTP
                'brandname' => 'LuckBoxVN', // Tên thương hiệu của bạn
                'signature' => 'LuckBoxVN', // Chữ ký của bạn
                'unicode' => 0 // Sử dụng Unicode hay không
            ],
            'headers' => [
                'Authorization' => 'dkPfn5zEAf0iZqgIXiISGLP1tZ9Qdr2K' // Thay 'your-api-key' bằng API key của bạn
            ]
        ]);

        $statusCode = $response->getStatusCode();

        if ($statusCode === 200) {
            // Gửi OTP thành công
            // URL::temporarySignedRoute('route.name', now()->addSeconds(60), compact('params'));
            return view('auth.OTP', compact(['checkNumberPhone','otp']));
        } else {
            return redirect()->back()->with('error','Không thành công vui lòng thực hiện lại.');
            // Gửi OTP thất bại
            // return response()->json(['message' => 'Failed to send OTP'], $statusCode);
        }
    }

    public function GetOTP($number_phone, $token){
        if (!empty($number_phone) || !empty($token)) {
            return redirect()->back()->with('error','Không thể truy cập liên kết này!');
        }

    }

}
