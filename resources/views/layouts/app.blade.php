<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>@yield('title', 'Aplikasi Akuntansi')</title>
</head>
<body class="bg-gray-100">
    
    {{-- Navbar --}}
    @include('layouts.navigation')

    {{-- Content --}}
    <main class="p-6">
        @yield('content')
    </main>

</body>
</html>