<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'status',
        'balance',
        'id_user_referral',
        'social_id',
        'social_type',
        'id_user_referral',
        'number_phone',
        'code'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $cascadeDeletes = true;
    public function UserInfo(){
        return $this->hasOne(UserInfo::class, 'id');
    }
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
    public function Transaction(){
        return $this->hasMany(Transaction::class,'id_user','id');
    }
    public function referredUser()
    {
        return $this->belongsTo(User::class, 'id_user_referral', 'id');
    }
    public function referredUserGT($id_user_referral)
    {
        return DB::table('users')->where('id','=', $id_user_referral)->first();
    }
    public function getAllReferringUsers()
    {
        $referringUsers = [];

        $currentUser = $this;
        while ($currentUser->referredUser) {
            $referringUsers[] = $currentUser->referredUser;
            $currentUser = $currentUser->referredUser;
        }

        return $referringUsers;
    }
    public function getAllReferringUsersGT()
    {
        $referringUsers = [];
        $i = 1;
        $currentUser = $this;
        $referringUsers[0] = $this;
        while ($currentUser->id_user_referral) {
            if (!empty($currentUser->id_user_referral)) {
                $currentUser = self::referredUserGT($currentUser->id_user_referral);
                $referringUsers[$i] = $currentUser;
                $i++;
            }

        }

        return $referringUsers;
    }

}
