<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Trating extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'score', 'performance', 'speed', 'accuracy', 'comment', 'task_id'
    ];

    public function task()
    {
        $this->BelongsTo(Task::class);
    }
}
