@extends('layouts.master')

@section('postheader')
<a href="{{ url('/') }}" class="block sm:hidden flex fill-current text-purple-600 opacity-60 text-xl mb-2 mt-6">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-8 h-8">
      <path fill="currentColor" d="M19 11H7.83l4.88-4.88c.39-.39.39-1.03 0-1.42 -.39-.39-1.02-.39-1.41 0l-6.59 6.59c-.39.39-.39 1.02 0 1.41l6.59 6.59c.39.39 1.02.39 1.41 0 .39-.39.39-1.02 0-1.41L7.83 13H19c.55 0 1-.45 1-1s-.45-1-1-1Z"></path>
  </svg>
  <span class="relative top-0.5">Back</span>
</a>
@stop

@section('body')
<div class="w-full hidden sm:block sm:w-1/2 lg:w-1/4 bg-gray-900 h-screen-center-inner overflow-auto">
  <ul>
    <li class="text-yellow-300 bg-gray-800 group border-b border-gray-800">
      <span class="block px-6 py-4">/new</span>
    </li>
    @foreach ($topics as $list_topic)
    <li class="text-purple-400 bg-gray-900 group border-b border-gray-800 opacity-40">
      <a href="{{ url('/post/' . $list_topic->id) }}" class="py-4 px-6 block pointer-events-none">
        <h4 class="font-bold truncate">{{ $list_topic->title }}</h4>
        <p class="text-gray-600 leading-tight break-all">{{ $list_topic->posts->last()->excerpt() }}</p>
        <div class="text-sm mt-1 text-gray-700">Last: {{ '@' }}{{ $list_topic->last_user->name }}, {{ Carbon\Carbon::parse($list_topic->updated_at)->diffForHumans() }}</div>
      </a>
    </li>
    @endforeach
  </ul>
</div>
<div class="w-full sm:w-1/2 lg:w-3/4 bg-gray-800">
  <div class="overflow-auto h-screen-center-inner">
    <form action="{{ url('/new') }}" method="post">
      @csrf
      <input name="title" class="text-gray-200 font-bold text-2xl py-4 px-6 sticky top-0 bg-gray-800 outline-none w-full" placeholder="Title here..." value="{{ old('title') }}">

      <div class="px-6 py-4 pb-8 border-b border-gray-700">
        <div class="flex justify-between">
          <h5 class="text-yellow-300">{{ '@' }}{{ Auth::user()->name }}</h5>
        </div>
        <textarea name="content" class="px-6 py-4 content text-gray-300 mt-3 w-full outline-none bg-gray-700 h-64" placeholder="Contents here...">{{ old('content') }}</textarea>

        <p class="mt-4 text-gray-400 text-sm mb-5">Thank you for posting in CodingStarter. Be polite.</p>

        @if (count($errors) > 0)
        <div class="text-red-700 my-4 text-sm">
          <ul>
            <li class="text-gray-300 mb-1">🧨 Oops, please check...</li>
            @foreach ($errors->all() as $error)
            <li class="list-disc ml-6">{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        <button type="submit" class="rounded shadow bg-purple-700 text-white py-2 px-5 focus:outline-none focus:ring-4 focus:ring-purple-500 focus:ring-opacity-80">Submit</button>
      </div>
    </form>
  </div>
</div>
@stop