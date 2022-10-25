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
    <body class="font-sans antialiased bg-white ">

        <main class="min-h-screen w-full bg-white">
            <nav class="h-[8vh] px-6 bg-gray-800 text-white flex justify-between sticky top-0">
                <ul class="flex items-center">
                    <li>
                        <a href="/">
                            <x-application-logo class="!text-2xl text-black px-1 !text-white" />
                        </a>
                    </li>
                </ul>

                <ul class="flex items-center">
                    @auth
                        <li>
                            <a href="/" class="p-3 ">{{ auth()->user()->name }}</a>
                        </li>
                        <li>
                            <a href="" class="text-white hover:bg-gray-700 px-3 py-2 rounded-md text-sm font-medium" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="fa-solid fa-right-from-bracket"></i> Logout
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

            <div class="flex">
                <!-- aside -->
                <aside class="flex h-[92vh] overscroll-contain w-56 flex-col space-y-2 bg-gray-800 px-2 sticky top-[8vh]">
                    <a href="{{ route('tasks.index') }}" class="text-white hover:bg-gray-700 px-3 py-2 rounded-md text-sm font-medium">
                        <i class="fa-solid fa-list"></i> All Tasks
                    </a>
                    <a href="#" class="text-white hover:bg-gray-700 px-3 py-2 rounded-md text-sm font-medium">
                        <i class="fa-solid fa-plus"></i> New Task
                    </a>
                    <a href="#" class="text-white hover:bg-gray-700 px-3 py-2 rounded-md text-sm font-medium">
                        <i class="fa-solid fa-right-from-bracket"></i> Projects
                    </a>
                    <a href="#" class="text-white hover:bg-gray-700 px-3 py-2 rounded-md text-sm font-medium">
                        <i class="fa-solid fa-right-from-bracket"></i> Calendar
                    </a>
                </aside>

                <!-- main content page -->
                <div class="!overflow-auto flex-auto flex px-8 py-6 rounded">
                    {{ $slot }}
                </div>
            </div>
        </main>
    </body>
</html>
