@extends('layouts.master')

@section('body')
<div class="w-full sm:w-1/4 bg-gray-900 h-screen-center-inner overflow-auto">
  <ul>
    @foreach ($topics as $list_topic)
    <li class="text-purple-400 bg-gray-900 group border-b border-gray-800 opacity-40">
      <a href="{{ url('/post/' . $list_topic->id) }}" class="py-4 px-6 block pointer-events-none">
        <h4 class="font-bold">{{ $list_topic->title }}</h4>
        <p class="text-gray-600 leading-tight">{{ $list_topic->posts->last()->content }}</p>
        <div class="text-sm mt-1 text-gray-700">Last: {{ '@' }}{{ $list_topic->last_user->name }}, {{ Carbon\Carbon::parse($list_topic->created_at)->diffForHumans() }}</div>
      </a>
    </li>
    @endforeach
  </ul>
</div>
<div class="w-full sm:w-3/4 bg-gray-800">
  <div class="overflow-auto h-screen-center-inner">
    <form action="{{ url('/new') }}" method="post">
      @csrf
      <input name="title" class="text-gray-200 font-bold text-2xl py-4 px-6 sticky top-0 bg-gray-800 outline-none w-full" placeholder="Title here...">

      <div class="px-6 py-4 pb-8 border-b border-gray-700">
        <div class="flex justify-between">
          <h5 class="text-yellow-300">@stevenlei</h5>
          <!-- <span class="text-gray-500">2021/08/14 15:32pm</span> -->
        </div>
        <textarea name="content" class="px-6 py-4 content text-gray-300 mt-3 w-full outline-none bg-gray-700 h-64" placeholder="Contents here..."></textarea>

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