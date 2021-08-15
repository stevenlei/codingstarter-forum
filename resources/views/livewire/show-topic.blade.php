<div class="w-full sm:w-1/2 lg:w-3/4 bg-gray-800 main-content" wire:poll.5000ms>
	@if ($topic)
	<div class="overflow-auto content-area-offset-bottom" id="replies">
		<h4 class="text-gray-200 font-bold text-2xl py-4 px-6 sticky top-0 bg-gray-800 break-all">{{ $topic->title }}</h4>
		@foreach ($topic->posts as $post)
		<div class="px-6 py-4 pb-8 border-b border-gray-700">
			<div class="flex justify-between">
				<h5 class="text-yellow-300">{{ '@' }}{{ $post->user->name }}</h5>
				<span class="text-gray-500 text-sm">{{ Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</span>
			</div>
			<div class="content text-gray-300 mt-3 break-all">
				@markdown($post->content)
			</div>
		</div>
		@endforeach
	</div>
	<livewire:reply-form :topic="$topic" />
	@endif
</div>