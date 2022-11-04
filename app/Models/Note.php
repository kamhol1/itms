<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    public const LIMIT_DEFAULT = 50;

    protected $fillable = [
        'content', 'task_id', 'user_id'
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeTaskNotes($query, int $id)
    {
        return $query->with('user')
            ->with('task')
            ->where('task_id', $id)
            ->orderBy('id','desc')
            ->paginate(self::LIMIT_DEFAULT);
    }
}
