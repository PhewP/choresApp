<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public $timestamps = false;


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
        'performer_id',
        'approved',
    ];

    public function user_creator() {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function user_performer() {
        return $this->belongsTo(User::class, 'performer_id');
    }

}
