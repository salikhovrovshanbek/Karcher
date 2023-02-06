<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $email="salikhovrovshanbek@gmail.com";
        $password=1;
        $data=$request->validate([
            "email"=>["required","email","string"],
            "password"=>["required"]
        ]);
        if ($data["email"]==$email && $data["password"]==$password){
            return view("auth.admin");
        } return redirect(route("login"))->withErrors(["email"=>"User not found Or your data is incorrect"]);

    }
}
