<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{
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
