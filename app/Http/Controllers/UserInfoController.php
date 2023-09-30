<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\InfoUserRequest;

use App\Models\UserInfo;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ConstCommon;

class UserInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $userInfoRepository;

    public function __construct(UserRepositoryInterface $userInfoRepository)
    {

        $this->userInfoRepository = $userInfoRepository;

    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $getInfoUser = $this->userInfoRepository->checkInfoUser($user->id);


        return view('user.InfoUser.Add', compact('getInfoUser','user'));
    }

    public function createPost(InfoUserRequest $request)
    {
        $imageName = null;
        $User = Auth::user();
        $idUser = $User->id;
        $checkInfoUser = $this->userInfoRepository->checkInfoUser($idUser);
        if ($request->has('name')) {
            $User->name = $request->name;
            $User->save();
        }
        if ($request->has('number_phone')) {

            $checkUser = User::where('number_phone', $request->number_phone)->where('id', '!=' , $User->id)->get()->count();

            if(empty($checkInfoUser)){
                $checkUserInfo = UserInfo::where('number_phone', $request->number_phone)->get()->count();
            } else {
                $checkUserInfo = UserInfo::where('number_phone', $request->number_phone)->where('id','!=', $checkInfoUser->id)->get()->count();
            }
            if ($checkUser >= 1 || $checkUserInfo >= 1) {
                return redirect()->back()->with('error', 'Số điện thoại này đã được đăng ký rồi vui lòng đăng ký lại bằng số điện thoại khác!');
            }
            $User->number_phone = $request->number_phone;
            $User->save();
        }
        if(empty($checkInfoUser)){
            if($request->link_image){
                //thời gian upload
                $current_time = time();
                $time_string = date('d-m-Y-H-i-s', $current_time);
                $file = $request->link_image ;
                // lấy tên đuôi của file
                $ext = $file->extension();
                //tên đường dẫn được lưa vào folder và database
                $imageName =  'AVT'.'_user'.'-'.$idUser.'-'. $time_string.'.'.$ext;
                ConstCommon::addImageToStorage($file,$imageName);

            }
            $data = [
                'id_user' => $idUser,
                'name' => $request->name,
                'content' => $request->content,
                'birthdate' => $request->birthdate,
                'number_phone' => $request->number_phone,
                'house_number_street' => $request->house_number_street,
                'neighborhood_village' => $request->neighborhood_village,
                'district' => $request->district,
                'province_city' => $request->province_city,
                'country' => $request->country,
                'link_image' => $imageName,
            ];

            $this->userInfoRepository->createInfo($data);
            return back()->with('success', 'Cập nhập thông tin thành công');
        }else{
            if($request->link_image){
                //thời gian upload
                $current_time = time();
                $time_string = date('d-m-Y-H-i-s', $current_time);
                $file = $request->link_image ;
                // lấy tên đuôi của file
                $ext = $file->extension();
                //tên đường dẫn được lưa vào folder và database
                $imageName =  'AVT'.'_user'.'-'.$idUser.'-'. $time_string.'.'.$ext;
                ConstCommon::addImageToStorage($file,$imageName);
                $data = ['link_image' => $imageName];
                ConstCommon::delImageToStorage($checkInfoUser->link_image);
                $this->userInfoRepository->updateInfoUser($data, $idUser);
            }
            $data = [
                'name' => $request->name,
                'content' => $request->content,
                'birthdate' => $request->birthdate,
                'number_phone' => $request->number_phone,
                'house_number_street' => $request->house_number_street,
                'neighborhood_village' => $request->neighborhood_village,
                'district' => $request->district,
                'province_city' => $request->province_city,
                'country' => $request->country,
            ];
            $this->userInfoRepository->updateInfoUser($data, $idUser);

            return back()->with('success', 'Cập nhập thông tin thành công');
        }

    }

    public function listGT(){
        $user = Auth::user();
        $datas = $this->userInfoRepository->listGT($user->id);
        return view('user.page.listGT', compact('datas'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserInfo  $userInfo
     * @return \Illuminate\Http\Response
     */
    public function show(UserInfo $userInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserInfo  $userInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(UserInfo $userInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserInfo  $userInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserInfo $userInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserInfo  $userInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserInfo $userInfo)
    {
        //
    }
}
