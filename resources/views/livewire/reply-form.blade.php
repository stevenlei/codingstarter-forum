<div class="bg-gray-700 h-48 text-gray-200 flex">
	@if (Auth::check())
	<form wire:submit.prevent="submit" class="block w-full m-0 p-0 flex flex-col">
		@csrf
		<textarea wire:model="content" class="flex-1 bg-gray-700 h-32 text-gray-200 w-full outline-none py-4 px-6" placeholder="Say something..."></textarea>
		<button type="submit" class="h-12 flex justify-center items-center block w-full box-border bg-purple-700 text-white focus:outline-none focus:ring-4 focus:ring-purple-500 focus:ring-opacity-80">Submit</button>
	</form>
	@else
	<div>
		<a href="/auth/github" class="text-yellow-300">Sign in with Github</a> to continue.
	</div>
	@endif
</div>