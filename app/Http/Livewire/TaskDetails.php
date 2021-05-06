<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TaskDetails extends Component
{
    public $task;
    public function render()
    {
        return view('livewire.task-details');
    }

    public function mount($task)
    {
        $this->task = $task;
    }
}
