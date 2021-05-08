<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyTask extends Controller
{
    public function render()
    {
        return view('myTask');
    }
}
