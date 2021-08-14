<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CodingStarter</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @livewireStyles
</head>
<body class="bg-gray-900 p-16 pt-12">
    
    <header class="flex justify-between items-end my-4">
        <h1 class="text-gray-300 text-3xl font-bold pl-6">CodingStarter</h1>
        <a href="#" class="text-yellow-300 mr-6">Sign in with Github</a>
    </header>

    <div class="mx-auto bg-gray-800 border border-blue-900 rounded shadow-2xl flex overflow-auto h-screen-center">
        @yield('body')
    </div>

    <footer class="text-center text-gray-500 w-full fixed bottom-6 left-0">
        Made with ❤️ in Macao
    </footer>

    @livewireScripts
</body>
</html>