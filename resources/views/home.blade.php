@extends('layouts.app')

@section('title', 'Homepage')

@section('content')
    <div class="max-w-lg mx-auto bg-white p-9 rounded-xl shadow">
        <div class="w-full block justify-items-center my-5">
            <h1 class="text-2xl my-2">Selamat datang di Aplikasi Akuntansi</h1>
            <p>by Wishy</p>
        </div>
        @guest    
        <div class="w-full flex justify-center items-center">
            <a href="/register"
                class="bg-blue-500 mx-2 border px-3 py-2 shadow-md rounded-md text-white hover:bg-blue-800">Register</a>
            <a href="/login"
                class="bg-blue-500 mx-2 border px-3 py-2 shadow-md rounded-md text-white hover:bg-blue-800">Login</a>
        </div>
        @endguest
    </div>
@endsection