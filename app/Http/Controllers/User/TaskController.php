<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('category')
            ->with('customer')
            ->with('assignee')
            ->where('assignee_id', auth()->user()->id)
            ->where(function ($query) {
                $query->where('status', '!=', 'closed')
                ->orWhereNull('status');
            })
            ->orderBy('id', 'DESC')
            ->paginate(Task::PAGE_SIZE);

        return view('user.tasks.index', [
            'tasks' => $tasks
        ]);
    }
}
