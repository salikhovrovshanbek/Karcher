@extends('layout.app')
@section('title','Register')
@section('content')
    <div class="h-screen bg-white flex flex-col space-y-10 justify-center items-center">
        <div class="bg-white w-96 shadow-xl rounded p-5">
            <h1 class="text-3xl font-medium">Регистрация</h1>

            <form action="{{route("register_process")}}" class="space-y-5 mt-5" method="POST">
                @csrf

                <input name="name" type="text" class="w-full h-12 border border-gray-800 rounded px-3 @error('name') border-red-700 @enderror" placeholder="Name" />
                @error('name')
                    <p class="text-red-500">{{$message}}</p>
                @enderror

                <input name="email" type="text" class="w-full h-12 border border-gray-800 rounded px-3 @error('email') border-red-700 @enderror" placeholder="Email" />
                @error('email')
                    <p class="text-red-500">{{$message}}</p>
                @enderror

                <input name="password" type="password" class="w-full h-12 border border-gray-800 rounded px-3 @error('password') border-red-700 @enderror" placeholder="Password" />
                @error('password')
                    <p class="text-red-500">{{$message}}</p>
                @enderror

                <input name="password_confirmation" type="password" class="w-full h-12 border border-gray-800 rounded px-3 @error('password_confirmation') border-red-700 @enderror" placeholder="confirm password" />
                @error('password_confirmation')
                    <p class="text-red-500">{{$message}}</p>
                @enderror

                <input name="role" type="text" class="w-full h-12 border border-gray-800 rounded px-3 @error('role') border-red-700 @enderror" placeholder="Role" />
                @error('role')
                <p class="text-red-500">{{$message}}</p>
                @enderror

                <input name="karcher_id" type="integer" class="w-full h-12 border border-gray-800 rounded px-3 @error('karcher_id') border-red-700 @enderror" placeholder="karcher id" />
                @error('karcher_id')
                <p class="text-red-500">{{$message}}</p>
                @enderror

                <div>
                    <a href="{{route("login")}}" class="font-medium text-blue-900 hover:bg-blue-300 rounded-md p-2">Есть аккаунт?</a>
                </div>

                <a href="{{url('login')}}" type="submit" class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">Зaрегистрация</a>
            </form>
        </div>
    </div>
@endsection
