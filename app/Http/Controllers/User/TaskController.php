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
        $user = auth()->user();

        $tasks = Task::with('category')
            ->with('customer')
            ->with('assignee')
            ->where('assignee_id', $user->id)
            ->orderBy('id', 'DESC')
            ->paginate(Task::PAGE_SIZE_DEFAULT);

        return view('user.tasks.index', [
            'tasks' => $tasks
        ]);
    }
}
