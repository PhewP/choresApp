<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class Rating extends Controller
{
    public function render(Task $task)
    {
        return view('rating')->with(['task' => $task]);;
    }
}
