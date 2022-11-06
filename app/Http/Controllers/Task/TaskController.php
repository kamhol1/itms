<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Note;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('category')
            ->with('customer')
            ->with('assignee')
            ->orderBy('id', 'DESC')
            ->paginate(Task::LIMIT_DEFAULT);

        return view('tasks.index', [
            'tasks' => $tasks
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        $customers = Customer::all();
        $users = User::all();

        return view('tasks.create', [
            'categories' => $categories,
            'customers' => $customers,
            'users' => $users
        ]);
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'customer_id' => 'nullable',
            'category_id' => 'required',
            'priority' => 'required',
            'assignee_id' => 'nullable',
            'due_date' => 'nullable|date',
        ]);

        Task::create($formFields);

        return redirect(route('tasks.index'));
    }

    public function show(Task $task)
    {
        $notes = Note::TaskNotes($task->id);
        $categories = Category::all();
        $customers = Customer::all();
        $users = User::all();
        $statuses = [
            'assigned',
            'in progress',
            'pending',
            'closed'
        ];
        $priorityLevels = [
            'low',
            'medium',
            'high'
        ];

        return view('tasks.show', [
            'task' => $task,
            'notes' => $notes,
            'categories' => $categories,
            'customers' => $customers,
            'users' => $users,
            'statuses' => $statuses,
            'priorityLevels' => $priorityLevels
        ]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('edit', $task);

        $formFields = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'customer_id' => 'nullable',
            'category_id' => 'required',
            'priority' => 'required',
            'status' => 'nullable',
            'assignee_id' => 'nullable',
            'due_date' => 'nullable|date',
        ]);

        $task->update($formFields);

        return redirect(route('tasks.show', $task->id));
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect(route('tasks.index'));
    }
}
