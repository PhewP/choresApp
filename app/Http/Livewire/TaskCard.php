<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Task;
use App\Models\User;
use App\Models\Comment;

class TaskCard extends Component
{
    public $taskId;
    public $task;
    public $taskDate;
    public $user;
    public $likes = 0;
    public $liked = false;
    public $nComments;
    public $commentText;
    public $comments;
    public $commentUsers = [];

    public function render()
    {
        return view('livewire.task-card');
    }


    public function mount($taskId)
    {
        $this->taskId = $taskId;
        if ($this->taskId) {
            $this->task = Task::find($this->taskId);
            $this->user = $this->task->user_creator;
            $this->refreshComments();
        }
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
        $this->refreshComments();
    }

    public function clearComment()
    {
        $this->commentText = null;
    }

    public function updated()
    {
        $this->refreshComments();
    }


    public function createComment()
    {
        Comment::create(['description' => $this->commentText, 'user_id' => auth()->user()->id, 'task_id' => $this->taskId]);
        $this->refreshComments();
    }

    public function deleteComment($commentId)
    {
        Comment::destroy($commentId);
        $this->refreshComments();
    }

    public function refreshComments()
    {
        $this->commentUsers = [];
        $this->comments = Comment::where('task_id', $this->taskId)->get();
        foreach ($this->comments as $comment) {
            $this->commentUsers[$comment->id] = $comment->user;
        }

        $this->nComments = $this->comments->count();
    }
}