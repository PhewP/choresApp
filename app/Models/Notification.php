<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'read',
        'task_id',
        'origin_id',
        'destination_id',
        'type',
    ];

    public function user_origin()
    {
        return $this->belongsTo(User::class, 'origin_id');
    }

    public function user_destination()
    {
        return $this->belongsTo(User::class, 'destination_id');
    }
    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }
}
