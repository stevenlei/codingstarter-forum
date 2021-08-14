@extends('layouts.master')

@section('body')
<div class="w-full sm:w-1/4 bg-gray-800 h-screen-center-inner overflow-auto">
	<ul>
		@for ($i = 0; $i < 12; $i++)
		<li class="text-purple-400 bg-gray-900 {{ ($i == 2) ? 'sidebar-active' : '' }} group">
			<a href="#" class="py-4 px-6 block group-hover:bg-gray-800">
				<h4 class="font-bold">Lorem ipsum dolor sit amet</h4>
				<p class="text-gray-600 leading-tight">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua</p>
			</a>
		</li>
		@endfor
	</ul>
</div>
<div class="w-full sm:w-3/4 bg-gray-800">
	<div class="overflow-auto content-area-offset-bottom">
		<h4 class="text-gray-200 font-bold text-2xl py-4 px-6 sticky top-0 bg-gray-800">Title title title...</h4>
		@for ($i = 0; $i < 20; $i++)
		<div class="px-6 py-4 pb-8 border-b border-gray-700">
			<div class="flex justify-between">
				<h5 class="text-yellow-300">@stevenlei</h5>
				<span class="text-gray-500">2021/08/14 15:32pm</span>
			</div>
			<div class="content text-gray-300 mt-3">
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			</div>
		</div>
		@endfor
	</div>
	<div class="bg-gray-700 h-32 text-gray-200">
		<textarea class="bg-gray-700 h-32 text-gray-200 w-full outline-none py-4 px-6" placeholder="Say something..."></textarea>
	</div>
</div>
@stop