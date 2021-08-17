<header class="flex justify-between items-end my-4 flex-wrap">
    <h1 class="text-gray-300 text-3xl font-bold pl-6">
        <a href="{{ url('/') }}" class="hover:text-yellow-300">CodingStarter</a>
        <span class="block sm:inline text-sm ml-0 mt-2 sm:mt-0 sm:ml-6 font-normal text-gray-500">
            8/17 3:00pm: 新增讚好/差評帖子功能；<a href="https://github.com/stevenlei/codingstarter-forum" target="_blank" class="text-purple-600 underline">歡迎加入開發</a>。
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