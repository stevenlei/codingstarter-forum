<header class="flex justify-between items-end my-4 flex-wrap">
    <h1 class="text-gray-300 text-3xl font-bold pl-6">
        <a href="{{ url('/') }}" class="hover:text-yellow-300">CodingStarter</a>
        <span class="block sm:inline text-sm ml-0 mt-2 sm:mt-0 sm:ml-6 font-normal text-gray-500">
            8/15 10:00pm: 完成免刷新跳頁、自動刷新功能 (目前是 long-poll，socket 待處理)，電腦版體驗好一點，手機版待優化。
        </span>
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