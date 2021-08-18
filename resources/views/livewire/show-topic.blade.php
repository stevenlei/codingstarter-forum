<div class="w-full sm:w-1/2 lg:w-3/4 bg-gray-800 main-content relative">
	<div class="absolute top-5 left-6" wire:loading>
        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
	</div>

	@if ($topic)
	<div class="transition" wire:loading.class="opacity-0">
		<div class="overflow-auto content-area-offset-bottom" id="replies">
			<div class="flex justify-between align-first">
				<h4 class="text-gray-200 font-bold text-2xl py-4 px-6 sticky top-0 bg-gray-800 break-all">{{ $topic->title }}</h4>
				<div class="my-4 mr-6 self-start flex-shrink-0">
					<div class="bg-gray-900 rounded-full p-1 topic-ordering-badge flex">
						<a class="inline-block rounded-full text-xs sm:text-sm py-1 px-3 cursor-pointer {{ ($order === 'time') ? 'active' : '' }}" wire:click="setOrder('time')">Time</a>
						<a class="inline-block rounded-full text-xs sm:text-sm ml-0.5 py-1 px-3 cursor-pointer {{ ($order === 'hot') ? 'active' : '' }}" wire:click="setOrder('hot')">Hot</a>
					</div>
				</div>
			</div>
			@foreach ($topic->getOrderedPosts($order) as $index => $post)
			<div wire:key="{{ $post->id }}" class="px-6 py-4 pb-8 border-b border-gray-700">
				<div class="flex justify-between">
					<h5 class="text-yellow-300">{{ '@' }}{{ $post->user->name }}</h5>
					<span class="text-gray-500 text-sm">{{ Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</span>
				</div>
				<div class="content text-gray-300 mt-3 break-all">
					<div class="the-content">@markdown($post->content)</div>
					<div class="mt-6 flex">
						<a wire:click="toggleReaction('like', {{ $post->id }})" class="reaction-badge inline-block flex cursor-pointer group {{ $post->isLiked() ? 'active' : '' }} {{ !\Auth::check() ? 'pointer-events-none' : '' }}">
							<svg viewBox="0 0 24 24" class="w-6 h-6 fill-current text-gray-600 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg"><path opacity=".87" fill="none" d="M0 0h24v24H0V0Z"/><path d="M13.12 2.06L7.58 7.6c-.37.37-.58.88-.58 1.41V19c0 1.1.9 2 2 2h9c.8 0 1.52-.48 1.84-1.21l3.26-7.61C23.94 10.2 22.49 8 20.34 8h-5.65l.95-4.58c.1-.5-.05-1.01-.41-1.37 -.59-.58-1.53-.58-2.11.01ZM3 21c1.1 0 2-.9 2-2v-8c0-1.1-.9-2-2-2s-2 .9-2 2v8c0 1.1.9 2 2 2Z"/></svg>
							<span class="inline-block ml-1 text-gray-400">{{ $post->likes_count }}</span>
						</a>
						<a wire:click="toggleReaction('dislike', {{ $post->id }})" class="reaction-badge inline-block flex ml-4 cursor-pointer group {{ $post->isDisliked() ? 'active' : '' }} {{ !\Auth::check() ? 'pointer-events-none' : '' }}">
							<svg viewBox="0 0 24 24" class="w-6 h-6 relative top-1 fill-current text-gray-600 group-hover:text-gray-500 {{ $post->isDisliked() ? 'text-yellow-300' : '' }}" xmlns="http://www.w3.org/2000/svg"><path opacity=".87" fill="none" d="M0 0h24v24H0V0Z"/><path d="M10.88 21.94l5.53-5.54c.37-.37.58-.88.58-1.41V5c0-1.1-.9-2-2-2H6c-.8 0-1.52.48-1.83 1.21L.91 11.82C.06 13.8 1.51 16 3.66 16h5.65l-.95 4.58c-.1.5.05 1.01.41 1.37 .59.58 1.53.58 2.11-.01ZM21 3c-1.1 0-2 .9-2 2v8c0 1.1.9 2 2 2s2-.9 2-2V5c0-1.1-.9-2-2-2Z"/></svg>
							<span class="inline-block ml-1 text-gray-400">{{ $post->dislikes_count }}</span>
						</a>
					</div>
				</div>
			</div>
			@endforeach
		</div>
		<livewire:reply-form :topic="$topic" />
	</div>
	@endif
</div>