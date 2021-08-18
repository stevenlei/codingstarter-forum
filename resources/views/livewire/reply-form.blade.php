<div class="bg-gray-300 text-gray-600 dark:bg-gray-700 h-48 text-gray-200 flex">
	@if (Auth::check())
	<form wire:submit.prevent="submit" class="block w-full m-0 p-0 flex flex-col">
		@csrf
		<textarea wire:model="content" class="flex-1 bg-gray-50 text-gray-800 dark:bg-gray-700 h-32 dark:text-gray-200 w-full outline-none py-4 px-6" placeholder="Say something..."></textarea>
		<button type="submit" class="h-12 flex justify-center items-center block w-full box-border bg-purple-600 dark:bg-purple-700 text-white focus:outline-none focus:ring-4 focus:ring-purple-500 focus:ring-opacity-80">Submit</button>
	</form>
	@else
	<div class="flex justify-center items-center flex-1">
		<div>
			<a href="/auth/github" class="text-blue-700 dark:text-yellow-300">Sign in with Github</a> to continue.
		</div>
	</div>
	@endif
</div>