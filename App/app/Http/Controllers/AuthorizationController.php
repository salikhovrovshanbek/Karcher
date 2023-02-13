<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
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


    public function login(){
        
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

    public function showRegisterForm(){
        return view("auth.register");
    }

    public function showForgotForm(){
        return view("auth.forgetPass");
    }

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

    public function register(RegisterUserRequest $request, AuthService $service)
    {
        $user=$service->SignupWithLogin($request->validated());
        if ($user) auth("web")->login($user[]);
        return response($user);
//        return redirect(route("home"));
    }

//    public function registerw(RegisterUserRequest $request){
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

}
