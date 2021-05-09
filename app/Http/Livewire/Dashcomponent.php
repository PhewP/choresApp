<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Dashcomponent extends Component
{
    public $user;
    public $trateList = [];
    public $score;
    public $speed;
    public $accuracy;
    public $performance;

    public function render()
    {
        return view('livewire.dashcomponent');
    }

    public function getTrating()
    {
        $this->trateList = [];

        $this->trateList = DB::table('tratings')
            ->join('tasks', 'tratings.task_id', '=', 'tasks.id')
            ->where('tasks.performer_id', $this->user)
            ->select('tratings.*')->get();
    }

    public function mount($user_id)
    {
        $this->user = $user_id;
        $this->getTrating();
        $this->avgScore();
        $this->avgSpeed();
        $this->avgAccuracy();
        $this->avgPerformance();
    }

    public function avgScore()
    {

        if (isset($this->trateList) && !$this->trateList->isEmpty()) {
            foreach ($this->trateList as $rate) {
                $this->score += $rate->score;
            }
            $this->score = $this->score / count($this->trateList);
        } else
            $this->score = 0;
    }
    public function avgSpeed()
    {
        if (isset($this->trateList) && !$this->trateList->isEmpty()) {
            foreach ($this->trateList as $rate) {
                $this->speed = $rate->speed;
            }
            $this->speed = $this->speed / count($this->trateList);
        } else
            $this->speed = 0;
    }
    public function avgAccuracy()
    {
        if (isset($this->trateList) && !$this->trateList->isEmpty()) {
            foreach ($this->trateList as $rate) {
                $this->accuracy = $rate->accuracy;
            }
            $this->accuracy = $this->accuracy / count($this->trateList);
        } else
            $this->accuracy = 0;
    }
    public function avgPerformance()
    {
        if (isset($this->trateList) && !$this->trateList->isEmpty()) {
            foreach ($this->trateList as $rate) {
                $this->performance = $rate->performance;
            }
            $this->performance = $this->performance / count($this->trateList);
        } else
            $this->performance = 0;
    }
}
