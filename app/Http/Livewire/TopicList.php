<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Topic;

class TopicList extends Component
{
	public $currentTopicId;

	protected $listeners = [
		'viewTopic' => 'viewTopic',
		'toHome' => 'toHome',
	];

	public function viewTopic($id)
	{
		$this->currentTopicId = $id;

		// Add the view count
		$topic = Topic::find($id);
		$topic->views_count++;
        $topic->timestamps = false;
        $topic->save();
	}

	public function toHome()
	{
		$this->currentTopicId = null;
	}

    public function render()
    {
    	$topics = Topic::orderBy('updated_at', 'DESC')->get();

        return view('livewire.topic-list', [
        	'topics' => $topics,
        ]);
    }
}
