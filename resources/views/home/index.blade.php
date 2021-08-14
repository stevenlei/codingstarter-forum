@extends('layouts.master')

@section('body')
<div class="w-full sm:w-1/2 lg:w-1/4 bg-gray-900 h-screen-center-inner overflow-auto sidebar {{ isset($topic) ? 'topic-page' : '' }}">
	<ul>
		@if (Auth::check())
		<li class="text-yellow-300 bg-gray-900 group border-b border-gray-800">
			<a class="block px-6 py-4 group-hover:bg-gray-800" href="{{ url('/new') }}">/new</a>
		</li>
		@endif
		@foreach ($topics as $list_topic)
		<li class="text-purple-400 bg-gray-900 {{ (isset($topic) && $topic->id === $list_topic->id) ? 'sidebar-active' : '' }} group border-b border-gray-800">
			<a href="{{ url('/post/' . $list_topic->id) }}" class="py-4 px-6 block group-hover:bg-gray-800">
				<h4 class="font-bold truncate">{{ $list_topic->title }}</h4>
				<p class="text-gray-600 leading-tight break-all">{{ $list_topic->posts->last()->excerpt() }}</p>
				<div class="text-sm mt-1 text-gray-700">Last: {{ '@' }}{{ $list_topic->last_user->name }}, {{ Carbon\Carbon::parse($list_topic->updated_at)->diffForHumans() }}</div>
			</a>
		</li>
		@endforeach
	</ul>
</div>
<div class="w-full sm:w-1/2 lg:w-3/4 bg-gray-800 main-content {{ isset($topic) ? 'topic-page' : '' }}">
	@if (isset($topic))
	<div class="overflow-auto content-area-offset-bottom" id="replies">
		<h4 class="text-gray-200 font-bold text-2xl py-4 px-6 sticky top-0 bg-gray-800 break-all">{{ $topic->title }}</h4>
		@foreach ($topic->posts as $post)
		<div class="px-6 py-4 pb-8 border-b border-gray-700">
			<div class="flex justify-between">
				<h5 class="text-yellow-300">{{ '@' }}{{ $post->user->name }}</h5>
				<span class="text-gray-500 text-sm">{{ Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</span>
			</div>
			<div class="content text-gray-300 mt-3 break-all">
				{!! nl2br(e($post->content)) !!}
			</div>
		</div>
		@endforeach
	</div>
	<div class="bg-gray-700 h-32 text-gray-200 flex justify-center items-center">
		@if (Auth::check())
		<form id="reply_form" action="{{ url('/reply/' . $topic->id) }}" method="post" class="w-full m-0 p-0">
			@csrf
			<textarea name="reply_content" class="bg-gray-700 h-32 text-gray-200 w-full outline-none py-4 px-6" placeholder="Say something..."></textarea>
		</form>
		@else
		<div>
			<a href="/auth/github" class="text-yellow-300">Sign in with Github</a> to continue.
		</div>
		@endif
	</div>
	@endif
</div>
@stop

@section('script')
<script>
@if (Auth::check())
if (window.innerWidth >= 640) {
	document.querySelector('[name="reply_content"]').focus();
}

document.querySelector('[name="reply_content"]').addEventListener('keydown', function (e) {
	if (!e.shiftKey && e.keyCode === 13) {
		document.querySelector('#reply_form').submit();
		e.preventDefault();
	}
});
@endif

@if (Request::get('bottom'))
let replies = document.querySelector('#replies');
replies.scrollTop = replies.scrollHeight;
@endif
</script>
@stop