<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Taskcreator extends Component
{
    public $task='';
    public function createTask() {
        $this->task='creado';
        echo('creado');
    }

    public function render()
    {
        return view('livewire.taskcreator');
    }
}
