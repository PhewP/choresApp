<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

class TaskList extends Component
{
    public $taskListId = [];
    protected $listeners = ['taskCreated' => 'show_task'];

    public function render()
    {
        $this->show_task();
        return view('livewire.task-list');
    }

    public function show_task()
    {
        $this->taskListId = [];
        $myUser = User::where('id', Auth::id())->first();
        if (isset($myUser)) {
            $taskList = DB::table('tasks')
                ->join('users', 'tasks.creator_id', '=', 'users.id')
                ->where('users.province', $myUser->province)
                ->select('tasks.*')->where('status', 'pending')->orderByDesc('created_at')->get();

            foreach ($taskList as $task) {
                $this->taskListId[] = $task->id;
            }
        }
    }
}
