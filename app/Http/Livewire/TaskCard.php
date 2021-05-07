<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Task;
use App\Models\User;
use PhpOption\None;

class TaskCard extends Component
{
    protected $taskId;
    public $task;
    public $taskDate;
    public $user;
    public $likes = 0;
    public $liked = false;
    public $nComments;
    public $commentText;
    public $comments;

    public function render()
    {
        return view('livewire.task-card');
    }

    public function mount($taskId)
    {
        $this->task = Task::find($taskId);
        $this->user = $this->task->user_creator;
    }

    public function addLike()
    {
        if ($this->liked) {
            $this->likes--;
            $this->liked = false;
            if ($this->liked == 0) {
                $this->liked = null;
            }
        } else {

            $this->likes++;
            $this->liked = true;
        }
    }

    public function clearComment()
    {
        $this->commentText = null;
    }

    public function createComment()
    {
    }

    public function deleteComment()
    {
        echo "borrado";
    }
}
