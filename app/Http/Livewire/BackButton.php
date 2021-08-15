<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BackButton extends Component
{
	public $show = false;

	protected $listeners = [
		'viewTopic' => 'viewTopic',
		'toHome' => 'toHome',
	];

	public function viewTopic($id)
	{
		$this->show = true;
	}

	public function toHome()
	{
		$this->show = false;
	}

    public function render()
    {
        return view('livewire.back-button');
    }
}
