<?php

namespace App\Services;
use App\Models\CodeSms;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{

    public function StoreNewUser($data){

        /** @var \App\Models\User $user **/
        $user = User::create([
            'fullname'=>$data['fullname'],
            'password' => bcrypt($data['password']),
            'phone' => $data['phone'] ?? '',
            'phone_verified' => (bool)$data['code'],
            'phone_verified_at' => $data['code'] ? date('Y-m-d H:i:s', time()) : '',
            'role'=>$data['role'],
            'karcher_id'=>$data['karcher_id'],
        ]);

//        $userProfile = UserProfile::create([
//            'user_id'=>$user->id,
//        ]);
        $token =  $this->GetTokenUser($user);
        return [
            'user' => $user,
            'token' => $token,
//            'userProfile'=>$userProfile
        ];
    }

    public function storeSmsCode($data){
        $smsCreate = CodeSms::create([
            'ip'=>request()->ip(),
            'code'=>$data['code'],
            'phone'=>$data['phone'],
            'expires_at'=>date('Y-m-d H:i:s', (time()+5*60))
        ]);

        return $smsCreate;
    }
    public function checkCodeWithPhone($data){
        $info =  CodeSms::where(['phone'=>$data['phone'],'code'=>$data['code']])->orderBy('expires_at', 'DESC')->first();
        return $info;
    }


    public function CreateNewUser($data){
        $user = User::create([
            'fullname'=> $data['fullname'],
            'password' => bcrypt($data['password']),
            'phone' => $data['phone'] ?? '',
            'phone_verified' => true,
            'phone_verified_at' => date('Y-m-d H:i:s', time()),
            'role'=>$data['role'],
            'karcher_id'=>$data['karcher_id'],
        ]);
        return $user;
    }

    public function SignupWithLogin($data){
        /** @var \App\Models\User $user **/
        $user = User::create([
            'fullname'=> $data['fullname'],
            'password' => bcrypt($data['password']),
            'phone' => $data['phone'] ?? '',
            'phone_verified' => true,
            'phone_verified_at' => date('Y-m-d H:i:s', time()),
            'role'=>$data['role'],
            'karcher_id'=>$data['karcher_id'],
        ]);
        $token =  $this->GetTokenUser($user);
        return [
            'user' => $user,
            'token' => $token
        ];
    }

    public function isAuth($credentials, $remember) {

        if(!Auth::attempt($credentials, $remember)) {
            return false;
        }
        return  Auth::user();
    }
    public  function GetTokenUser(User $user){
        $token =  $user->createToken('main')->plainTextToken;
        return $token;
    }
}
