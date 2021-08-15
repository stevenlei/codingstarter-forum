<div class="w-full sm:w-1/2 lg:w-1/4 bg-gray-900 h-screen-center-inner overflow-auto sidebar {{ $currentTopicId ? 'topic-page' : '' }}" wire:poll.5000ms>
	<ul>
		@if (Auth::check())
		<li class="text-yellow-300 bg-gray-900 group border-b border-gray-800">
			<a class="block px-6 py-4 group-hover:bg-gray-800" href="{{ url('/new') }}">/new</a>
		</li>
		@endif
		@foreach ($topics as $topic)
		<li class="text-purple-400 bg-gray-900 {{ ($currentTopicId === $topic->id) ? 'sidebar-active' : '' }} group border-b border-gray-800">
			<a wire:click.prevent="$emit('viewTopic', {{ $topic->id }})" href="{{ url('/post/' . $topic->id) }}" class="py-4 px-6 block group-hover:bg-gray-800">
				<h4 class="font-bold truncate">{{ $topic->title }}</h4>
				<p class="text-gray-600 leading-tight break-all">{{ $topic->posts->last()->excerpt() }}</p>
				<div class="text-sm mt-1 text-gray-700">Last: {{ '@' }}{{ $topic->last_user->name }}, {{ Carbon\Carbon::parse($topic->updated_at)->diffForHumans() }}</div>
			</a>
		</li>
		@endforeach
	</ul>
</div>