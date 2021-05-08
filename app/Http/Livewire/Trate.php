<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class Trate extends Component
{
    public $score;
    public $speed;
    public $accuracy;
    public $performance;

    public $task;

    public function render()
    {
        return view('livewire.urate');
    }

    protected function rules()
    {
        return [
            'score' => ['required', 'numeric', 'min:1', 'max:10'],
            'speed' => ['required', 'numeric', 'min:1', 'max:10'],
            'accuracy' => ['required', 'numeric', 'min:1', 'max:10'],
            'performance' => ['required', 'numeric', 'min:1', 'max:10'],
        ];
    }

    public function createRate()
    {
        $this->validate();
        $userId = $this->task->performer_id;

        Trate::create([
            'score' => $this->score,
            'speed' => $this->speed,
            'accuracy' => $this->accuracy,
            'performance' => $this->performance,
            'task_id' => $this->task->id
        ]);

        $user = User::find($userId);
        $user->coins += $this->task->reward;
        $user->save();
        //session()->flash('message', 'Tarea creada');
        //$this->emit('taskCreated');
    }
}
