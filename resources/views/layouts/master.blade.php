<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CodingStarter</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @livewireStyles
</head>
<body class="bg-gray-900 p-4 pt-4 sm:p-16 sm:pt-12">
    
    <header class="flex justify-between items-end my-4 flex-wrap">
        <h1 class="text-gray-300 text-3xl font-bold pl-6">
            <a href="{{ url('/') }}" class="hover:text-yellow-300">CodingStarter</a>
        </h1>
        @if (Auth::check())
        <div class="text-gray-300 mr-0 sm:mr-6 ml-6 sm:ml-0 mt-2 sm:mt-0">
            Hello, <span class="text-yellow-300">{{ '@' }}{{ Auth::user()->name }}</span>.
            <a href="{{ url('/logout') }}" class="ml-2">(Logout)</a>
        </div>
        @else
        <a href="{{ url('/auth/github') }}" class="text-yellow-300 mr-0 sm:mr-6 ml-6 sm:ml-0 mt-2 sm:mt-0">Sign in with Github</a>
        @endif
    </header>

    <div class="mx-auto bg-gray-800 border border-blue-900 rounded shadow-2xl flex flex-wrap sm:overflow-hidden h-screen-center">
        @yield('body')
    </div>

    <footer class="text-center text-gray-500 w-full sm:fixed sm:bottom-6 sm:left-0 mt-6 sm:mt-0">
        Made with ❤️ in Macao
    </footer>

    @yield('script')

    @livewireScripts
</body>
</html>