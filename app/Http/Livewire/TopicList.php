<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Topic;
use Livewire\WithPagination;

class TopicList extends Component
{
	use WithPagination;

	public $currentTopicId;
	public $limit = 3;
	public $offset = 0;

	protected $listeners = [
		// 'viewTopic' => 'viewTopic',
		'toHome' => 'toHome',
		'echo:forum,PostAdded' => 'render',
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

	public function loadMore($offset)
	{
		$this->offset = $offset;
	}

    public function render()
    {
		$topics = Topic::orderBy('updated_at', 'DESC')->limit($this->limit * ($this->offset + 1))->get();

		$haveMoreResults = (Topic::count() > $this->limit * ($this->offset + 1));

        return view('livewire.topic-list', [
        	'topics' => $topics,
        	'haveMoreResults' => $haveMoreResults,
        ]);
    }
}
