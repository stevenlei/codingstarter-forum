<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Post;
use App\Events\PostAdded;

class HomeController extends Controller
{
    //
    public function index(Request $request)
    {
        $topics = Topic::orderBy('updated_at', 'DESC')->get();

        return view('home.index', ['topics' => $topics]);
    }

    public function new(Request $request)
    {
        $topics = Topic::orderBy('updated_at', 'DESC')->get();

        return view('home.new', ['topics' => $topics]);
    }

    public function store(Request $request)
    {
        request()->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $topic = new Topic;
        $topic->title = request('title');
        $topic->user_id = \Auth::user()->id;
        $topic->ip = request()->ip();
        $topic->last_post_user_id = \Auth::user()->id;
        $topic->save();

        $post = new Post;
        $post->topic_id = $topic->id;
        $post->user_id = \Auth::user()->id;
        $post->content = request('content');
        $post->ip = request()->ip();
        $post->save();

        // Broadcast Event
        event(new PostAdded);

        return redirect()->to('/post/' . $topic->id);
    }

    public function view(Request $request, $id)
    {
        $topic = Topic::find($id);

        if (!$topic)
        {
            return redirect()->to('/');
        }

        $topic->views_count++;
        $topic->timestamps = false;
        $topic->save();

        $topics = Topic::orderBy('updated_at', 'DESC')->get();

        return view('home.index', ['topic' => $topic, 'topics' => $topics]);
    }

    public function storeReply(Request $request, $id)
    {
        $topic = Topic::find($id);

        if (!$topic)
        {
            return redirect()->to('/');
        }

        request()->validate([
            'reply_content' => 'required',
        ]);

        $topic->last_post_user_id = \Auth::user()->id;
        $topic->posts_count++;
        $topic->save();

        $post = new Post;
        $post->topic_id = $topic->id;
        $post->user_id = \Auth::user()->id;
        $post->content = request('reply_content');
        $post->ip = request()->ip();
        $post->save();

        return redirect()->to('/post/' . $topic->id . '?bottom=1');
    }
}
