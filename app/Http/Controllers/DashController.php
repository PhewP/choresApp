<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashController extends Controller
{
    public function render($user_id = null)
    {
        if (!isset($user_id)) {
            $user_id = Auth::id();
        }
        return view('dashboard')->with(['user_id' => $user_id]);
    }
}
