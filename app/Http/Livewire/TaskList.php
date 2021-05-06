<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TaskList extends Component
{
    public $taskList = [];
    public function render()
    {
        $this->show_task();
        return view('livewire.task-list')->with([$this->taskList]);
    }

    public function show_task()
    {
        $myUser = User::where('id',Auth::id())->first();
        if(isset($myUser))
        {
            $usersSameLocation = User::where('province', $myUser->province)->get();

            foreach($usersSameLocation as $user)
            {
                foreach($user->task_created()->get() as $task)
                {
                    $this->taskList[] = $task;
                }
            }
        }

        //return $this->taskList;
    }
}
