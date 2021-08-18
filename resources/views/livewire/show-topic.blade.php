<div class="w-full sm:w-1/2 lg:w-3/4 bg-gray-100 dark:bg-gray-800 main-content relative">
	@if ($topic)
	<div class="overflow-auto content-area-offset-bottom" id="replies">
		<div class="flex justify-between align-first">
			<h4 class="text-gray-900 dark:text-gray-200 font-bold text-2xl py-4 px-6 sticky top-0 dark:bg-gray-800 break-all">
				<span class="inline-block" wire:loading>
					<svg class="animate-spin relative top-0.5 mr-2 h-5 w-5 text-gray-400 dark:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
						<circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
						<path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
					</svg>
				</span>
				{{ $topic->title }}
			</h4>
		</div>
		@foreach ($topic->getOrderedPosts($order) as $index => $post)
		<div wire:key="{{ $post->id }}" class="px-6 py-4 pb-8 border-b dark:border-gray-700">
			
			@if ($index === 1)
			<div class="flex w-full justify-center mx-4 -mt-4">
				<div class="mt-6 relative -top-px mr-2">
					<svg viewBox="0 0 24 24" class="w-5 h-5 sm:w-6 sm:h-6 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg"><g fill="currentColor"><path d="M8.5 15.24H6.75v0c-.14 0-.25-.12-.25-.25V3.73v-.01c0-.56-.45-1-1-1 -.56 0-1 .44-1 1v11.25 0c0 .13-.12.25-.25.25H2.5v0c-.28 0-.5.22-.5.5 0 .13.05.25.14.35l3 3v0c.19.19.51.19.7 0l3-3v0c.19-.2.19-.52-.01-.71 -.1-.1-.22-.15-.36-.15Z"/><path d="M21 8.24h-1.25v0c-.14 0-.25-.12-.25-.25V1.73 1.72c0-.83-.68-1.51-1.5-1.51 -.35-.01-.68.11-.94.32l-1.69 1.35v0c-.43.35-.49.98-.14 1.4 .34.41.95.48 1.38.15l.46-.375v0c.1-.09.26-.07.35.03 .03.04.05.09.05.15v4.69 0c0 .13-.12.25-.25.25h-1.25v0c-.56 0-1 .44-1 1 0 .55.44 1 1 1h5v0c.55 0 1-.45 1-1 0-.56-.45-1-1-1Z"/><path d="M18 13.74l-.01-.01c-1.94-.01-3.51 1.56-3.51 3.49 -.01 1.93 1.56 3.5 3.49 3.5 .25 0 .5-.03.75-.09v0c.13-.03.26.05.29.19 .01.07-.01.16-.06.22v0c-.38.42-.92.67-1.49.67h-.5v0c-.56 0-1 .44-1 1 0 .55.44 1 1 1h.5v0c2.2 0 4-1.8 4-4v-2.5 0c0-1.94-1.57-3.5-3.5-3.5Zm0 5v0c-.83 0-1.5-.68-1.5-1.5 0-.83.67-1.5 1.5-1.5 .82 0 1.5.67 1.5 1.5v0c0 .82-.68 1.5-1.5 1.5Z"/></g></svg>
				</div>
				<div class="my-4 mr-6 self-start flex-shrink-0">
					<div class="bg-gray-200 dark:bg-gray-900 rounded-full p-1 topic-ordering-badge flex">
						<a class="inline-block rounded-full text-xs sm:text-sm py-1 px-3 cursor-pointer {{ ($order === 'default') ? 'active' : '' }}" wire:click="setOrder('default')">Default</a>
						<a class="inline-block rounded-full text-xs sm:text-sm ml-0.5 py-1 px-3 cursor-pointer {{ ($order === 'latest') ? 'active' : '' }}" wire:click="setOrder('latest')">Latest</a>
						<a class="inline-block rounded-full text-xs sm:text-sm ml-0.5 py-1 px-3 cursor-pointer {{ ($order === 'hot') ? 'active' : '' }}" wire:click="setOrder('hot')">Hot</a>
					</div>
				</div>
			</div>
			@endif

			<div class="flex justify-between">
				<h5 class="text-blue-700 dark:text-yellow-300">{{ '@' }}{{ $post->user->name }}</h5>
				<span class="text-gray-400 dark:text-gray-500 text-sm">{{ Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</span>
			</div>
			<div class="content text-gray-700 dark:text-gray-300 mt-3 break-all">
				<div class="the-content">@markdown($post->content)</div>
				<div class="mt-6 flex">
					<a wire:click="toggleReaction('like', {{ $post->id }})" class="reaction-badge flex cursor-pointer group {{ $post->isLiked() ? 'active' : '' }} {{ !\Auth::check() ? 'pointer-events-none' : '' }}">
						<svg viewBox="0 0 24 24" class="w-6 h-6 fill-current text-gray-300 dark:text-gray-600 dark:group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg"><path opacity=".87" fill="none" d="M0 0h24v24H0V0Z"/><path d="M13.12 2.06L7.58 7.6c-.37.37-.58.88-.58 1.41V19c0 1.1.9 2 2 2h9c.8 0 1.52-.48 1.84-1.21l3.26-7.61C23.94 10.2 22.49 8 20.34 8h-5.65l.95-4.58c.1-.5-.05-1.01-.41-1.37 -.59-.58-1.53-.58-2.11.01ZM3 21c1.1 0 2-.9 2-2v-8c0-1.1-.9-2-2-2s-2 .9-2 2v8c0 1.1.9 2 2 2Z"/></svg>
						<span class="inline-block ml-1 text-gray-300 dark:text-gray-400">{{ $post->likes_count }}</span>
					</a>
					<a wire:click="toggleReaction('dislike', {{ $post->id }})" class="reaction-badge flex ml-4 cursor-pointer group {{ $post->isDisliked() ? 'active' : '' }} {{ !\Auth::check() ? 'pointer-events-none' : '' }}">
						<svg viewBox="0 0 24 24" class="w-6 h-6 relative top-1 fill-current text-gray-300 dark:text-gray-600 dark:group-hover:text-gray-500 {{ $post->isDisliked() ? 'text-yellow-300' : '' }}" xmlns="http://www.w3.org/2000/svg"><path opacity=".87" fill="none" d="M0 0h24v24H0V0Z"/><path d="M10.88 21.94l5.53-5.54c.37-.37.58-.88.58-1.41V5c0-1.1-.9-2-2-2H6c-.8 0-1.52.48-1.83 1.21L.91 11.82C.06 13.8 1.51 16 3.66 16h5.65l-.95 4.58c-.1.5.05 1.01.41 1.37 .59.58 1.53.58 2.11-.01ZM21 3c-1.1 0-2 .9-2 2v8c0 1.1.9 2 2 2s2-.9 2-2V5c0-1.1-.9-2-2-2Z"/></svg>
						<span class="inline-block ml-1 text-gray-300 dark:text-gray-400">{{ $post->dislikes_count }}</span>
					</a>
				</div>
			</div>
		</div>
		@endforeach
	</div>
	<livewire:reply-form :topic="$topic" />
	@endif
</div>