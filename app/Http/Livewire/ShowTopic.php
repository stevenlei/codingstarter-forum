<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Topic;

class ShowTopic extends Component
{
	public $topic;

	protected $listeners = [
		'viewTopic' => 'viewTopic',
		'toHome' => 'toHome',
	];

	public function viewTopic($id)
	{
		$this->topic = Topic::find($id);
	}

	public function toHome()
	{
		$this->topic = null;
	}

    public function render()
    {
        return view('livewire.show-topic');
    }
}
