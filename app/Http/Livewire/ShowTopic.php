<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Topic;
use App\Models\Post;

class ShowTopic extends Component
{
	public $topic;
	public $order = 'default';

	protected $listeners = [
		'viewTopic' => 'viewTopic',
		'toHome' => 'toHome',
		'echo:forum,PostAdded' => 'render',
	];

	public function viewTopic($id)
	{
		$this->topic = Topic::find($id);
	}

	public function toHome()
	{
		$this->topic = null;
	}

	public function setOrder($order)
	{
		$this->order = $order;
	}

	public function toggleReaction($type, $post_id)
	{
		$post = Post::find($post_id);
		
		if (!$post) return;

		$post->toggleReaction($type); // Auth check handles inside

		$this->topic = $this->topic->fresh(); // Refresh the fetched topic to tell livewire for updates. Is there anyway to do this better?
	}

    public function render()
    {
        return view('livewire.show-topic');
    }
}
