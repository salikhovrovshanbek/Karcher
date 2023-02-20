<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\UserDeleteRequest;
use App\Http\Requests\UserProfileRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserProfileRequest $request)
    {
//        $phone=$request['phone'];
//        dd($request);
        $phone =$request['phone'];
//        dd($phone);
        $userProfile = User::query()->where(['phone'=>auth()->user()->$phone])->first();
        return new UserResource($userProfile);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(RegisterUserRequest $request,AuthService $service)
    {
        $data=$request->validated();
        if ($data){
            $user=$service->CreateNewUser($data);
            dd($user);
            $user->save();
            return ['success','Karcher Added Successfully'];
        } else{
            return error_get_last();
        }
    }

//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
//     */
//    public function store(Request $request)
//    {
//        //
//    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return User::all();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return ["msg"];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserDeleteRequest $request)
    {
        $id=$request['id'];
        $user = User::query()->find($id);
        if($user){
            $user->delete();
            return ['success','User successfully deleted'];
        }
        return ['error','User not found'];
    }
}
