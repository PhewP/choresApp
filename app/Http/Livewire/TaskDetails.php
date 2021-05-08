<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\User;
use Illuminate\Validation\Rule;

class TaskDetails extends Component
{
    public $title;
    public $reward;
    public $description;
    public $categoryName;
    public $ini_date;
    public $end_date;

    public $categoryNames = [];
    public $task;
    public $accepted;

    protected function rules()
    {
        return [
            'title' => ['required', 'min:10'],
            'reward' => ['required', 'numeric', 'min:1', 'max:' . auth()->user()->coins],
            'description' => ['required', 'min:20'],
            'categoryName' => ['required', Rule::in($this->categoryNames)],
            'ini_date' => ['required', 'after:' . now()],
            'end_date' => ['required', 'after:' . $this->ini_date]
        ];
    }

    public function render()
    {
        return view('livewire.task-details');
    }

    public function checkAccepted()
    {
        $performerId = $this->task->performer_id;

        if (isset($performerId) && ($performerId == auth()->user()->id)) {
            $this->accepted = true;
        }
    }


    public function mount($task)
    {
        $this->task = $task;
        $this->title = $task->title;
        $this->description = $task->description;
        $this->reward = $task->reward;
        $this->checkAccepted();
        $allCategories = Category::get();
        foreach ($allCategories as $category) {
            $this->categoryNames[] = $category->name;
        }
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function modifyTask()
    {
        $this->validate();
        $id = auth()->user()->id;
        $categoryId = Category::where('name', $this->categoryName)->first()->id;

        $actualReward = $this->task->reward;

        $actualReward -= $this->reward;

        $this->task->title = $this->title;
        $this->task->reward = $this->reward;
        $this->task->description = $this->description;
        $this->task->ini_date = $this->ini_date;
        $this->task->end_date = $this->end_date;
        $this->task->category_id = $categoryId;

        $user = User::find($id);
        $user->coins += $actualReward;
        $user->save();
        $this->task->save();
        session()->flash('message', 'Tarea modificada');
        $this->emit('taskCreated');
    }

    public function acceptTask()
    {
        $this->accepted = true;
        session()->flash('message', 'Tarea Aceptada');
        $this->task->performer_id = auth()->user()->id;
        $this->task->save();
    }
}
