<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

class Mycreatedtasks extends Component
{
    public $taskCreatedList;
    public $taskAceptedList;
    public $active = 'in_progress';

    public $tasks;

    public function render()
    {
        $this->refreshTask();
        $this->showCreatedtask();
        $this->showAceptedtask();
        return view('livewire.mycreatedtasks');
    }

    public function showCreatedtask()
    {
        $myUser = User::where('id', Auth::id())->first();
        if (isset($myUser)) {
            $this->taskCreatedList = DB::table('tasks')
                ->join('users', 'tasks.creator_id', '=', 'users.id')
                ->where('tasks.creator_id', $myUser->id)
                ->select('tasks.*')->get();
        }
    }
    public function showAceptedtask()
    {
        $myUser = User::where('id', Auth::id())->first();
        if (isset($myUser)) {
            $this->taskAceptedList = DB::table('tasks')
                ->join('users', 'tasks.performer_id', '=', 'users.id')
                ->where('tasks.performer_id', $myUser->id)
                ->select('tasks.*')->get();
        }
    }

    public function deleteTask($taskId)
    {
        $task = DB::table('tasks')
            ->where('tasks.id', $taskId)
            ->first();
        $task->reward;
        $user = User::find(Auth::id());
        $user->coins += $task->reward;
        $user->save();
        Task::destroy($taskId);
        $this->refreshTask();
    }

    public function refreshTask()
    {
        $this->taskCreatedList = [];
        $this->tasks = Task::where('creator_id', Auth::id())->get();
        foreach ($this->tasks as $task) {
            if ($task->end_date < now()) {
                $task->status = 'done';
                $task->save();
            }
            $this->taskCreatedList = $task;
        }
    }
}
