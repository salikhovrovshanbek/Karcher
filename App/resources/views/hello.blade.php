@extends('layout.app')

@section('title','Main page')

@section('content')
    @include('partials.header')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mt-10 mb-20">
        @include("karcher.list",'karcher')
    </div>
@endsection
