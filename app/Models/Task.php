<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public const PAGE_SIZE = 25;

    protected $fillable = [
        'title', 'description', 'customer_id', 'category_id', 'priority', 'status', 'assignee_id', 'due_date'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function scopeSearch($query, string $phrase) {
        if ($phrase ?? false) {
            $query->where('title', 'like', '%' . request('phrase') . '%');
//                ->orWhere('description', 'like', '%' . request('phrase') . '%');
        }
    }
}
