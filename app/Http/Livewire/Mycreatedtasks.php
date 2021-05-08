<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Mycreatedtasks extends Component
{
    public $taskCreatedList;
    public $taskAceptedList;

    public function render()
    {
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
}
