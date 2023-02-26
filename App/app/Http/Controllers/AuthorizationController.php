<?php

namespace App\Http\Controllers;

use App\Actions\SendSms;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\LoginWithCodeRequest;
use App\Http\Requests\PhoneSmsRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models;
use Illuminate\Support\Facades\Auth;

class AuthorizationController extends Controller
{
    public function showLoginForm(){
        //instead of middlewares we can use if statement to every public functions
        //EXAMPLE->        if (auth("web")->check()){}

        return view("auth.login");
    }

//    public function logout(){
//        auth("web")->logout();
//        return redirect(route("home"));
//    }
    public function logout()
    {
        /** @var User $user **/
        $user = Auth::user();

        $user->currentAccessToken()->delete();

        return response([
            'success' => true
        ]);
    }


    public function login(UserLoginRequest $request, AuthService $service){
        $credentials=$request->validated();
        $remember=$credentials['remember'] ?? false;
        unset($credentials['remember']);

        if(!($user=$service->isAuth($credentials,$remember))){
            return response([
                'error'=>'Credentials are not correct or Not found data !' .
                    'Just Register'
            ],401);
        }

        $token=$service->GetTokenUser($user);

        return response([
            'user'=>$user,
            'token'=>$token
        ]);

    }
//    public function login(Request $request){
//        $data = $request->validate([
//            "phone"=>["required","phone","string"],
//            "password"=>["required"]
//        ]);
//
//        if (auth("web")->attempt($data)){
//            return redirect(route("home"));
//        }
//
//        return redirect(route("login"))->withErrors(["email"=>"User not found Or your data is incorrect"]);
//    }

//    public function showRegisterForm(){
//        return view("auth.register");
//    }
//
//    public function showForgotForm(){
//        return view("auth.forgetPass");
//    }

    public function forgot(Request $request){
        $data = $request->validate([
            "email"=>["required","email","string","exists:users"]
        ]);

        $user = Models\User::query()->where(["email" => $data["email"]])->first();

        $password=uniqid();

        $user->password=bcrypt($password);
        $user->save();

//        Mail::to($user)->send(new ForgotPassword($password));

        return redirect(route("login"));
    }

    public function register(UserRegisterRequest $request, AuthService $service)
    {
        $user=$service->SignupWithLogin($request->validated());
//        if ($user) auth("web")->login($user);
        return response($user);
//        return redirect(route("home"));
    }

//    public function registerw(UserRegisterRequest $request){
//        $data = $request->validate([
//            "name"=>["required","string"],
//            "email"=>["required","email","unique:users,email"],
//            "password"=>["required","confirmed"],
//            "role"=>["required","string"],
//            "karcher_id"=>["required"],
//        ]);
////        dd($data);
//        $user=Models\User::create([
//            "fullname"=>$data["name"],
//            "email"=>$data["email"],
//            "password"=>bcrypt($data["password"]),
//            "role"=>$data["role"],
//            "karcher_id"=>$data["karcher_id"],
//        ]);
//
//        if ($user) auth("web")->login($user);//login($user);
//
//        return redirect(route("home"));
//    }

    public function loginWithSms(LoginWithCodeRequest $request, AuthService $service){
//        dd($request->validationData());
        $data = $request->validated();
        $result = $service->checkCodeWithPhone($data);
        if($result){
            $checkIsNew = User::query()->where(['fullname'=>$data['phone']])->first();
            if(empty($checkIsNew)){
                $data['fullname'] = $data['phone'];
                $data['password'] = $data['code'];
                return  $service->StoreNewUser($data);
            }else{
                return ['user'=>$checkIsNew, 'token'=>$service->GetTokenUser($checkIsNew)];
            }
        }else{
            return ['success'=>0, 'code'=>'Code not valid'];
        }

    }

    public function sendSms(PhoneSmsRequest $request, SendSms $action, AuthService $service){
        $phone = $request->validated();

        $checkUser = User::where(['phone'=>$phone['phone']])->first();
        $code = rand(pow(10, 3), pow(10, 4)-1);
        if(empty($checkUser)){
//            $action->sendSms('998935594334','Code: '.$code.' ');
            $isSave = $service->storeSmsCode(['code'=>$code, 'phone'=>$phone['phone']]);
            return ['success'=>1, 'test_code'=>$code,'test_phone'=>$phone['phone'], 'isSave'=>$isSave];
        }else{
            return $service->storeSmsCode(['code'=>$code, 'phone'=>$phone['phone']]);
        }
    }
}
