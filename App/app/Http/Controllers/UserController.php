<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserChangePasswordRequest;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserDeleteRequest;
use App\Http\Requests\UserProfileRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
    public function create(UserRegisterRequest $request, AuthService $service)
    {
        $data=$request->validated();
        if ($data){
//            echo "if statement";
            $user=$service->CreateNewUser($data);
//            dd($user);
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
    public function edit(UserEditRequest $request,User $user)
    {
        $data=$request->validated();
//        echo $data;
        $updateInfo = User::query()->where('id', auth()->user()->id)->update($data);
//        echo $updateInfo;
        return $updateInfo;
//
//        if (!empty(auth()->user()->phone)) {
//            $user=User::query()->where(['phone'=>auth()->user()->phone])->first();
//            if ($data) $user->fill(request()->post());
//            if ($user){
//                $user->save();
//                return ['success', 'User successfully updated'];
//            }else{
//                return error_get_last();
//            }
//        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatepassword(UserChangePasswordRequest $request):JsonResponse
    {
        $data = $request->validated();
        $user = User::query()->where('id',auth()->user()->id)->first();
        if (!Hash::check($data['oldPassword'],$user->password))
        {
            abort(401, 'password not corret');
        }
        $user->password = $data['password'];
        $user->save();



        return response()->json("Password changed successfully!",200);
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
