@extends('layout.app')
@section('title','Login')
@section('content')
    <div class="h-screen bg-white flex flex-col space-y-10 justify-center items-center">
        <div class="bg-white w-96 shadow-xl rounded p-5">
            <h1 class="text-3xl font-medium">Вход</h1>

            <form method="POST" action="{{route("login_process")}}" class="space-y-5 mt-5">
                @csrf

                <label>Email</label></br>
                <input name="email" type="text" class="w-full h-12 border border-gray-800 rounded px-3 @error('email') border-red-700 @enderror" placeholder="Email" /><br><br>
                @error('email')
                    <p class="text-red-500">{{$message}}</p>
                @enderror

                <label>Password</label></br>
                <input name="password" type="password" class="w-full h-12 border border-gray-800 rounded px-3 @error('password') border-red-700 @enderror" placeholder="Password" /><br><br>
                @error('password')
                    <p class="text-red-500">{{$message}}</p>
                @enderror

                <div>
                    <a href="{{route("forgot")}}" class="font-medium text-blue-900 hover:bg-blue-300 rounded-md p-2">Забыли пароль?</a><br><br>
                </div>

                <div>
                    <a href="{{route("register")}}" class="font-medium text-blue-900 hover:bg-blue-300 rounded-md p-2">Регистрация</a><br><br>
                </div>

                <button  type="submit" class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">Войти</button><br><br>

            </form>
        </div>
    </div>
@endsection
