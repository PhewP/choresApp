<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Trating;
use App\Models\Notification;

class Trate extends Component
{
    public $score;
    public $speed;
    public $accuracy;
    public $performance;
    public $comment;

    public $task;

    public function render()
    {
        return view('livewire.trate');
    }

    protected function rules()
    {
        return [
            'score' => ['required', 'numeric', 'min:1', 'max:10'],
            'speed' => ['required', 'numeric', 'min:1', 'max:10'],
            'accuracy' => ['required', 'numeric', 'min:1', 'max:10'],
            'performance' => ['required', 'numeric', 'min:1', 'max:10'],
            'comment' => ['min:20'],
        ];
    }

    public function createRate()
    {
        $this->validate();

        Trating::create([
            'score' => $this->score,
            'speed' => $this->speed,
            'accuracy' => $this->accuracy,
            'performance' => $this->performance,
            'comment' => $this->comment,
            'task_id' => $this->task->id,
        ]);

        //session()->flash('message', 'Tarea creada');
        //$this->emit('taskCreated');
    }

    public function aceptar()
    {
        $performerId = $this->task->performer_id;
        $user = User::find($performerId);
        $user->coins += $this->task->reward;
        $user->save();
        $this->task->approved = 1;
        $this->task->save();
        $this->emit(
            'createNotification',
            $this->task->creator_id,
            $performerId,
            $this->task->id
        );
    }

    public function rechazar()
    {
        $creatorId = $this->task->creator_id;
        $user = User::find($creatorId);
        $user->coins += $this->task->reward;
        $user->save();
        $this->task->approved = 5;
        $this->task->save();
        $this->emit(
            'createNotification',
            $creatorId,
            $this->task->performer_id,
            $this->task->id
        );
    }
}
