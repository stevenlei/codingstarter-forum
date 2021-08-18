@extends('layouts.master')

@section('postheader')
{{-- <livewire:back-button :show="isset($topic)" /> --}}
@stop

@section('body')

<livewire:topic-list :currentTopicId="isset($topic) ? $topic->id : null" />
<livewire:show-topic :topic="isset($topic) ? $topic : null" />

@stop

@section('script')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.2.0/styles/default.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.2.0/highlight.min.js"></script>
<link rel="stylesheet" href="{{ asset('css/dracula.css') }}">

<script>
Livewire.on('postAdded', () => {
	// As don't know how to ensure the component is fully loaded yet...
	let scrollToBottomTimer = setInterval(() => {
		let replies = document.querySelector('#replies');
		if (replies.scrollTop != replies.scrollHeight) {
			replies.scrollTop = replies.scrollHeight;
			clearInterval(scrollToBottomTimer);
		}
    }, 500);
});

const changeUrl = (url) => {
	history.pushState(null, null, url);
}

Livewire.on('toHome', () => {
	changeUrl('/');
});

Livewire.on('viewTopic', (id) => {
	// Scroll to top
	let replies = document.querySelector('#replies');
	if (replies !== null) {
		replies.scrollTop = 0;
	}

	changeUrl(`/post/${id}`);
});

const highlightMarkdown = (component) => {
	if (component.fingerprint.name === 'show-topic') {
		document.querySelectorAll('.content pre code:not(.hljs)').forEach((code) => {
		    hljs.highlightElement(code);
		});
	}
}

Livewire.hook('element.initialized', (el, component) => {
	highlightMarkdown(component);
});

Livewire.hook('element.updating', (fromEl, toEl, component) => {
	highlightMarkdown(component);
});
</script>
@stop