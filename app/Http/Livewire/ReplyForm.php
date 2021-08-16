<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Topic;
use App\Models\Post;
use App\Events\PostAdded;

class ReplyForm extends Component
{
	public $topic;
	public $content;

    protected $rules = [
        'content' => 'required',
    ];

	protected $listeners = [
		'viewTopic' => 'viewTopic'
	];

	public function viewTopic($id)
	{
		$this->topic = Topic::find($id);
	}

	public function submit()
    {
        // TODO: Should use AuthorizesRequests trait
        if (!\Auth::check())
        {
            abort(403);
        }

        // Validate the incoming data
        $this->validate();

        // Execution doesn't reach here if validation fails.

        $this->topic->last_post_user_id = \Auth::user()->id;
        $this->topic->posts_count++;
        $this->topic->save();

        $post = new Post;
        $post->topic_id = $this->topic->id;
        $post->user_id = \Auth::user()->id;
        $post->content = $this->content;
        $post->ip = request()->ip();
        $post->save();

        // Clear the textarea
        $this->content = null;

        // Refresh the current page
        $this->emit('viewTopic', $this->topic->id);
        $this->emit('postAdded');

        // Broadcast Event
        event(new PostAdded);
    }

    public function render()
    {
        return view('livewire.reply-form');
    }
}
