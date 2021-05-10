<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Validation\Rule;


use Livewire\Component;

class Taskcreator extends Component
{
    public $title;
    public $reward;
    public $description;
    public $categoryName;
    public $ini_date;
    public $ini_hour;
    public $end_hour;
    public $end_date;

    public $categoryNames = [];

    public $statusGroupOpen = false;


    protected function rules()
    {
        return [
            'title' => ['required', 'min:10'],
            'reward' => ['required', 'numeric', 'min:1', 'max:' . auth()->user()->coins],
            'description' => ['required', 'min:20'],
            'categoryName' => ['required', Rule::in($this->categoryNames)],
            'ini_date' => ['required', 'after_or_equal:' . now()->format("Y/m/d")],
            'end_date' => ['required', 'after_or_equal:' . ($this->ini_date ? explode(" ", $this->ini_date)[0] : now()->format("Y/m/d"))]
        ];
    }

    public function manageCollapse()
    {
        $this->statusGroupOpen = !$this->statusGroupOpen ? true : false;
        $this->cleanInputs();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function createTask()
    {
        $this->validate();
        $id = auth()->user()->id;
        $categoryId = Category::where('name', $this->categoryName)->first()->id;

        Task::create([
            'title' => $this->title,
            'reward' => $this->reward,
            'description' => $this->description,
            'ini_date' => explode(" ", $this->ini_date)[0] . " " . $this->ini_hour,
            'end_date' => explode(" ", $this->end_date)[0] . " " . $this->end_hour,
            'creator_id' => $id,
            'category_id' => $categoryId,
        ]);

        $user = User::find($id);
        $user->coins -= $this->reward;
        $user->save();
        $this->emit('taskCreated');
        $this->cleanInputs();
    }

    public function cleanInputs()
    {
        $this->reset(['title', 'reward', 'description', 'ini_date', 'end_date', 'categoryName']);
        $this->resetValidation();
    }

    public function mount()
    {
        $allCategories = Category::get();
        foreach ($allCategories as $category) {
            $this->categoryNames[] = $category->name;
        }
    }

    public function render()
    {
        // $task = Task::where('id', id);
        return view('livewire.taskcreator');
    }
}
