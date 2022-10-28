<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Note;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::with('category')
            ->with('customer')
            ->with('assignee')
            ->orderBy('id', 'DESC')
            ->paginate(25);

        return view('tasks.index', [
            'tasks' => $tasks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $categories = Category::all();
        $customers = Customer::all();
        $users = User::all();
        $statuses = ['assigned', 'in progress', 'pending', 'closed'];
        $notes = Note::where('task_id', $task->id)
            ->get();

        return view('tasks.show', [
            'task' => $task,
            'categories' => $categories,
            'customers' => $customers,
            'users' => $users,
            'statuses' => $statuses,
            'notes' => $notes
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
