<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;


use Livewire\Component;

class Navbar extends Component
{
    public $coins;

    protected $listeners = ['taskCreated' => 'updateCoins'];

    public function updateCoins()
    {
        $this->coins = auth()->user()->coins;
    }

    public function mount()
    {
        $this->updateCoins();
    }

    public function render()
    {
        return view('livewire.navbar');
    }
}
