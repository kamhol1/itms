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

    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');
        .font-family-karla { font-family: karla; }
        .bg-sidebar { background: #000000; }
        .active-nav-link { background: #3f3f3f; }
        .bg-button { background: #000000; }
        .bg-button:hover { background: #4f4f4f; }
        .nav-item:hover { background: #4f4f4f; }
        .button:hover { background: #4f4f4f; }
        .account-link:hover { background: #3a3a3a; }
    </style>
</head>

<body class="bg-gray-100 font-family-karla flex">
    <aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
        <div class="p-6">
            <a href="{{ route('tasks.index') }}">
                <x-application-logo class="px-1 !text-white" />
            </a>
        </div>
        <nav class="text-white text-base font-semibold pt-3">
            <a href="{{ route('tasks.index') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-list mr-3"></i>
                All Tasks
            </a>
            <a href="{{ route('user.tasks.index') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-chalkboard-user mr-3"></i>
                My Tasks
            </a>
            <a href="{{ route('tasks.create') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-plus mr-3"></i>
                New Task
            </a>
            @if(auth()->user()->admin == 1)
                <h1 class=" text-white opacity-75 mt-16 mb-4 flex justify-center">ADMIN OPTIONS</h1>

                <a href="{{ route('admin.customers.index') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                    <i class="fas fa-tools mr-3"></i>
                    Customers
                </a>
                <a href="{{ route('admin.categories.index') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                    <i class="fas fa-tools mr-3"></i>
                    Categories
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                    <i class="fas fa-tools mr-3"></i>
                    Users
                </a>
            @endif
        </nav>
    </aside>

    <div class="w-full flex flex-col h-screen overflow-y-hidden">
        <!-- Desktop Header -->
        <header class="w-full items-center bg-white py-2 px-6 hidden sm:flex">
            <div class="w-1/2">
            </div>
            <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
                <p class="my-auto mx-2">{{ auth()->user()->name }}</p>
                <button @click="isOpen = !isOpen" class="relative z-10 w-12 h-12 rounded-full overflow-hidden border-2 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
                    @if(auth()->user()->avatar)
                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}">
                    @else
                        <img src="/images/default_avatar.png" alt="Avatar">
                    @endif
                </button>
                <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>
                <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
                    <a href="{{ route('user.show') }}" class="block px-4 py-2 account-link hover:text-white">My Account</a>
                    <a href="" class="block px-4 py-2 account-link hover:text-white" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Logout</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                </div>
            </div>
        </header>

        <!-- Mobile Header & Nav -->
        <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 sm:hidden">
            <div class="flex items-center justify-between">
                <a href="/"><x-application-logo class="px-1 !text-white" /></a>
                <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
                    <i x-show="!isOpen" class="fas fa-bars"></i>
                    <i x-show="isOpen" class="fas fa-times"></i>
                </button>
            </div>

            <!-- Dropdown Nav -->
            <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">
                <a href="{{ route('tasks.index') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                    <i class="fas fa-list mr-3"></i>
                    All Tasks
                </a>
                <a href="{{ route('user.tasks.index') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                    <i class="fas fa-chalkboard-user mr-3"></i>
                    My Tasks
                </a>
                <a href="{{ route('tasks.create') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                    <i class="fas fa-plus mr-3"></i>
                    New Task
                </a>
                @if(auth()->user()->admin == 1)
                    <h1 class=" text-white opacity-75 mt-16 mb-4 flex justify-center">ADMIN OPTIONS</h1>

                    <a href="{{ route('admin.customers.index') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                        <i class="fas fa-tools mr-3"></i>
                        Customers
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                        <i class="fas fa-tools mr-3"></i>
                        Categories
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                        <i class="fas fa-tools mr-3"></i>
                        Users
                    </a>
                @endif
                <a href="" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    Logout
                </a>
            </nav>
        </header>

        <div class="w-full overflow-x-hidden border-t">
            <main class="w-full lg:flex p-6">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
