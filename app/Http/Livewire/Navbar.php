<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Auth;


use Livewire\Component;

class Navbar extends Component
{
    public $coins;

    public function render()
    {
        $this->coins = auth()->user()->coins;
        return view('livewire.navbar');
    }
}
