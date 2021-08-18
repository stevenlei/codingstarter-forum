<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{theme: localStorage.getItem('theme') || 'dark'}" :class="`${theme}`" x-cloak>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CodingStarter</title>

    <link href="{{ asset('css/app.css') }}?{{ time() }}" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>

    @livewireStyles
</head>
<body class="bg-gray-100 dark:bg-gray-900 p-4 pt-4 sm:p-16 sm:pt-12">
    
    <livewire:header />

    @yield('postheader')

    <div class="mx-auto dark:bg-gray-800 border border-purple-200 dark:border-blue-900 rounded shadow-2xl flex flex-wrap sm:overflow-hidden h-screen-center">
        @yield('body')
    </div>

    <footer class="text-center text-gray-500 w-full sm:fixed sm:bottom-6 sm:left-0 mt-6 sm:mt-0">
        Made with ❤️ in Macao
    </footer>

    <script src="{{ asset('js/app.js') }}?v1"></script>

    @livewireScripts
    @yield('script')

    @if (env('GOOGLE_ANALYTICS_CODE'))
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ env('GOOGLE_ANALYTICS_CODE') }}"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', '{{ env('GOOGLE_ANALYTICS_CODE') }}');
    </script>
    @endif
</body>
</html>