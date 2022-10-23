<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'ITMS') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100">
    <nav class="p-6 bg-gray-100 flex justify-between mb-6">
        <ul class="flex items-center">
            <li>
                <a href="/" class="p-3">ITMS</a>
            </li>
        </ul>

        <ul class="flex items-center">
            @auth
                <li>
                    <a href="/" class="p-3">{{ auth()->user()->name }}</a>
                </li>
                <li>
                    <a href="" class="p-3" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                </li>
            @endauth

            @guest
                <li>
                    <a href="{{ route('login') }}" class="p-3">Login</a>
                </li>
                <li>
                    <a href="{{ route('register') }}" class="p-3">Register</a>
                </li>
            @endguest
        </ul>
    </nav>

    <div class="m-5 flex bg-white p-5 rounded">
        {{ $slot }}
    </div>

    </body>
</html>
