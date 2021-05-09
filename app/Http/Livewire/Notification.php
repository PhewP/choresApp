<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Notification as NotificationModel;
use App\Models\Task;

class Notification extends Component
{
    public $nNotifications = 0;
    public $n = 1;
    public $notifications;
    public $users;
    public $tasks;

    protected $listeners = ['createNotification'];


    public function createNotification($originId, $creatorId, $taskId)
    {
        NotificationModel::Create([
            'type' => 'status',
            'origin_id' => $originId,
            'destination_id' => $creatorId,
            'task_id' => $taskId,
        ]);
    }

    public function updated()
    {
        $this->refresh();
    }

    public function hydrated()
    {
        $this->refresh();
    }

    public function mount()
    {
        $this->refresh();
    }

    public function render()
    {
        $this->refresh();
        return view('livewire.notification');
    }

    public function fetchNotifications()
    {
        $this->users = [];
        $this->tasks = [];

        $this->notifications = NotificationModel::where('destination_id', auth()->user()->id)->orderByDesc('created_at')->get();

        foreach ($this->notifications as $notification) {
            $this->users[$notification->id] = $notification->user_origin;
            $this->tasks[$notification->id] = $notification->task;
        }
    }

    public function refresh()
    {
        $this->fetchNotifications();
        $this->nNotifications = isset($this->notifications) ? count($this->notifications) : 0;
    }

    public function deleteNotification($notificationId)
    {
        NotificationModel::destroy($notificationId);
        $this->refresh();
    }

    public function deleteAllNotifications()
    {
        NotificationModel::where('destination_id', auth()->user()->id)->delete();
        $this->refresh();
    }
}
