<?php
namespace App\Repositories;

use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    public function all()
    {
        return User::all();
    }

    public function create(array $data)
    {
        return User::create($data);
    }
    public function find($id)
    {
        return User::find($id);
    }
    public function findUserByCode($code)
    {
        return User::where('code',$code)->first();
    }
    public function update(array $data, $id)
    {
        $user = User::findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }

    public function edit($id)
    {
        return User::findOrFail($id);
    }

    public function show($id)
    {
        return UserInfo::leftjoin('users','user_infos.id_user', '=','users.id' )
        ->select('user_infos.*','users.*')
        ->where('user_infos.id', $id)
        ->first();
    }

    public function showUpdate($id)
    {
        return UserInfo::where('id_user',$id)->first();
    }

    public function getUserByType($type)
    {
        return User::leftjoin('user_infos', 'users.id', '=', 'user_infos.id_user')
        ->select('user_infos.*','users.*','user_infos.id as id_info_users' )
        ->where('users.type', $type)
        ->orderByDesc('users.created_at')
        ->get();
    }
    public function getUserByTypeGT()
    {
        return User::leftjoin('user_infos', 'users.id', '=', 'user_infos.id_user')
        ->select('user_infos.*','users.*','user_infos.id as id_info_users' )
        ->whereNotNull('id_user_referral')
        ->orderByDesc('users.created_at')
        ->get();
    }
    public function checkInfoUser($id){
        return UserInfo::where('id_user', $id)->first();
    }
    public function createInfo($data)
    {
        return UserInfo::create($data);
    }
    public function updateInfoUser($data, $id){
        $infoUser = UserInfo::where('id_user', $id)->first();

        $infoUser->update($data);
        return $infoUser;
    }

    public function listGT($id){
        return User::where('id_user_referral', $id)->orderBy('updated_at', 'desc')->get();
    }

    public function checkByEmail($email){
        return User::where('email', $email)->first();
    }

    public function checkByNumberPhone($numberPhone){
        return User::where('number_phone', $numberPhone)->first();
    }
}
