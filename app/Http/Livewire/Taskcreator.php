<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Validation\Rule;


use Livewire\Component;

class Taskcreator extends Component
{
    public $title;
    public $reward;
    public $description;
    public $categoryName;
    public $ini_date;
    public $end_date;

    public $categoryNames = [];


    protected function rules() {
        return [
            'title' => ['required', 'min:10'],
            'reward' => ['required', 'numeric', 'min:1', 'max:'.auth()->user()->coins],
            'description' => ['required', 'min:20'], 
            'categoryName' =>['required', Rule::in([$this->categoryName])],
            'ini_date' => ['required', 'after:'.now()],
            'end_date' => ['required', 'after:'.$this->ini_date]
        ];
    }

    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }

    public function createTask() {
        $this->validate();
        $id = Auth::id();
        $category = Category::where('name', $this->categoryName)->first();

        if(isset($category)) {

        }
    }

    public function mount() {
        $allCategories = Category::get();
        foreach($allCategories as $category) {
            $this->categoryNames[] = $category->name;
        }
    }

    public function render()
    {
        // $task = Task::where('id', id);
        return view('livewire.taskcreator');
    }
}
