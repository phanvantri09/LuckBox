<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepositoryInterface;
use App\Http\Requests\User\CreateRequestUser;
use App\Repositories\TransactionRepositoryInterface;
use App\Repositories\CartRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use App\Helpers\ConstCommon;
use App\Models\User;

class UserController extends Controller
{
    protected $userRepository;
    protected $transactionRepository;
    protected $cartRepository;
    public function __construct(UserRepositoryInterface $userRepository,TransactionRepositoryInterface $transactionRepository, CartRepositoryInterface $cartRepository)
    {

        $this->userRepository = $userRepository;
        $this->transactionRepository = $transactionRepository;
        $this->cartRepository = $cartRepository;
    }

    public function list($type)
    {
        $userGTs = [];
        if ($type == 3) {
            $users = $this->userRepository->getUserByTypeGT();
            $userGTs = [];

            foreach ($users as $key => $user) {
                if (!empty($user->id_user_referral)) {
                    $userRef = $user->id_user_referral;
                    $user = User::find($userRef);
                    $userGTs[$key] = $user->getAllReferringUsersGT();
                }
            }
        } else {
            $users = $this->userRepository->getUserByType($type);
        }

        return view('admin.user.list',compact(['userGTs', 'users']));
    }
    public function transaction($id)
    {
        $data = $this->transactionRepository->listForUserAdmin($id);
        return view('admin.user.transaction', compact(['id', 'data']));
    }
    public function transactionCart($id, $id_cart_old){
        $cartCurrent = $this->cartRepository->show($id);
        $cartOld = $this->cartRepository->show($id_cart_old);
        return view('admin.user.infoCart', compact(['cartCurrent', 'cartOld']));
    }
    public function listCartMarket($id){
        $user = User::find($id);
        $cart =  $this->cartRepository->getAllByIDUser($id);
        return view('admin.user.listCartMarket', compact(['cart', 'user']));
    }
    public function checkcart($id){
        $cart =  $this->cartRepository->show($id);
        dd($cart);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.add');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequestUser $request)
    {
        $request->merge(['password' => Hash::make($request->password)]);
        $type = $request->type;
        $data = $request->all();
        $this->userRepository->create($data);
        return redirect()->route('user.list', ['type' => $type])->with('success', 'Thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserInfo  $userInfo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::find($id);
        $user = $this->userRepository->showUpdate($data->id);
        return view('admin.user.show', compact(['data', 'user']));
    }

    public function edit($id)
    {

        $user = $this->userRepository->edit($id);
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserInfo  $userInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(empty($request->password)){
            $data = [
                'email' => $request->email,
                'type' => $request->type,
                'balance' => $request->balance
            ];
        }else{
            $data = [
                'email' => $request->email,
                'password' =>  Hash::make($request->password),
                'type' => $request->type,
                'balance' => $request->balance
            ];
        }

        $this->userRepository->update($data, $id);
        return back()->with('success', 'Thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserInfo  $userInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->userRepository->delete($id);
        return back()->with('success', 'Thành công');
    }
    public function deletecart($id)
    {
        $this->cartRepository->delete($id);
        return back()->with('success', 'Thành công');
    }
    public function deletetransaction($id)
    {
        $this->transactionRepository->delete($id);
        return back()->with('success', 'Thành công');
    }

}
