<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;

class AuthorizationController extends Controller
{
    public function showLoginForm(){
        //instead of middlewares we can use if statement to every public functions
        //EXAMPLE->        if (auth("web")->check()){}

        return view("auth.login");
    }

    public function logout(){
        auth("web")->logout();
        return redirect(route("home"));
    }

    public function login(Request $request){
        $data = $request->validate([
            "email"=>["required","email","string"],
            "password"=>["required"]
        ]);

        if (auth("web")->attempt($data)){
            return redirect(route("home"));
        }

        return redirect(route("login"))->withErrors(["email"=>"User not found Or your data is incorrect"]);
    }

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

        $user = Models\User::where(["email" => $data["email"]])->first();

        $password=uniqid();

        $user->password=bcrypt($password);
        $user->save();

//        Mail::to($user)->send(new ForgotPassword($password));

        return redirect(route("login"));
    }

    public function register(Request $request){
        $data = $request->validate([
            "name"=>["required","string"],
            "email"=>["required","email","string","unique:users,email"],
            "password"=>["required","confirmed"]
        ]);

        $user=Models\User::create([
            "name"=>$data["name"],
            "email"=>$data["email"],
            "password"=>bcrypt($data["password"])
        ]);

        if ($user){
            auth("web")->login($user);
        }

        return redirect(route("home"));
    }

}
