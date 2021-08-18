<header class="flex justify-between items-end my-4 flex-wrap">
    <h1 class="text-gray-800 dark:text-gray-300 text-3xl font-bold pl-0 sm:pl-6">
        <a href="{{ url('/') }}" class="hover:text-blue-800 dark:hover:text-yellow-300 transition">CodingStarter</a>
        <span class="block sm:inline text-sm ml-0 mt-2 sm:mt-0 sm:ml-6 font-normal text-gray-400 dark:text-gray-500">
            <a href="https://github.com/stevenlei/codingstarter-forum" target="_blank" class="text-purple-500 dark:text-purple-600 border-b-2 border-purple-800 border-opacity-20 dark:border-opacity-80">GitHub Repository</a>
        </span>
    </h1>

    <div class="text-gray-500 dark:text-gray-300 mr-0 sm:mr-6 ml-0 sm:ml-6 sm:ml-0 mt-2 sm:mt-0 flex items-center w-full sm:w-auto justify-between">
        <div class="mr-4">
            @if (Auth::check())
            Hello, <span class="text-blue-600 dark:text-yellow-300">{{ '@' }}{{ Auth::user()->name }}</span>.
            <a href="{{ url('/logout') }}" class="ml-2">(Logout)</a>
            @else
            <a href="{{ url('/auth/github') }}" class="text-blue-600 dark:text-yellow-300">Sign in with Github</a>
            @endif
        </div>

        <div class="bg-gray-200 dark:bg-gray-200 dark:bg-gray-800 rounded-full p-1 flex">
            <a :class="`inline-block rounded-full text-xs sm:text-sm py-1 px-3 cursor-pointer ${(theme === 'light') ? 'bg-gray-300 dark:bg-gray-700' : ''}`" @click="theme = 'light'; localStorage.setItem('theme', 'light');">
                <svg viewBox="0 0 24 24" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg"><g stroke-linecap="round" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linejoin="round"><path d="M12 7.5v0c-2.49 0-4.5 2.01-4.5 4.5 0 2.48 2.01 4.5 4.5 4.5v0c2.48 0 4.5-2.02 4.5-4.5 0-2.49-2.02-4.5-4.5-4.5Z"/><path d="M12 .75V4.5"/><path d="M12 19.5v3.75"/><path d="M23.25 12H19.5"/><path d="M4.5 12H.75"/><path d="M20.25 3.75l-3 3"/><path d="M6.75 17.25l-3 3"/><path d="M20.25 20.25l-3-3"/><path d="M6.75 6.75l-3-3"/></g></svg>
            </a>
            <a :class="`inline-block rounded-full text-xs sm:text-sm ml-0.5 py-1 px-3 cursor-pointer ${(theme === 'dark') ? 'bg-gray-300 dark:bg-gray-700' : ''}`" @click="theme = 'dark'; localStorage.setItem('theme', 'dark');">
                <svg viewBox="0 0 24 24" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="M21.97 14.881v0c-5.19 1.91-10.94-.74-12.86-5.93 -.83-2.24-.83-4.7-.01-6.94v0c.19-.52-.08-1.1-.59-1.29 -.23-.09-.48-.09-.7-.01V.7c-6.22 2.3-9.39 9.2-7.09 15.42 2.3 6.21 9.2 9.38 15.42 7.08 3.28-1.22 5.86-3.81 7.08-7.09v0c.19-.52-.08-1.1-.6-1.29 -.23-.09-.47-.09-.7-.01Z"/></svg>
            </a>
        </div>
    </div>
</header>