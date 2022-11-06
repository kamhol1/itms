<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    public const PAGE_SIZE_DEFAULT = 25;

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
            ->paginate(self::PAGE_SIZE_DEFAULT);
    }
}
