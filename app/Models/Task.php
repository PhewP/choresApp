<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'title',
        'reward',
        'description',
        'ini_date',
        'end_date',
        'done_date',
        'status',
        'creator_id',
        'performer_id',
        'approved',
        'category_id',
    ];

    public function user_creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function user_performer()
    {
        return $this->belongsTo(User::class, 'performer_id');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function trating()
    {
        return $this->hasOne(Trating::class);
    }

    public function notification()
    {
        return $this->hasOne(Notification::class);
    }
}
