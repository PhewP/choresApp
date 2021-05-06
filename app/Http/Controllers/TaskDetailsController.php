<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskDetailsController extends Controller
{
    public function render(Task $task)
    {
        return view('task-detail')->with(['task' => $task]);
    }
}
