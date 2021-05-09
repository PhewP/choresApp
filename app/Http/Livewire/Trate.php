<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Trating;
use App\Models\Notification as NotificationModel;

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

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function aceptar()
    {
        $this->createRate();
        $performerId = $this->task->performer_id;
        $user = User::find($performerId);
        $user->coins += $this->task->reward;
        $user->save();
        $this->task->approved = 1;
        $this->task->save();

        NotificationModel::Create([
            'type' => 'status',
            'origin_id' => $this->task->creator_id,
            'destination_id' => $performerId,
            'task_id' => $this->task->id,
        ]);
        return redirect()->route('myTask');
    }

    public function rechazar()
    {
        $this->createRate();
        $creatorId = $this->task->creator_id;
        $user = User::find($creatorId);
        $user->coins += $this->task->reward;
        $user->save();
        $this->task->approved = 5;
        $this->task->save();

        NotificationModel::Create([
            'type' => 'status',
            'origin_id' => $creatorId,
            'destination_id' => $this->task->performer_id,
            'task_id' => $this->task->id,
        ]);
        return redirect()->route('myTask');
    }
}
