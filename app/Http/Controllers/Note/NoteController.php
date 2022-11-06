<?php

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\Task;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        //
    }

    public function store(Request $request, Task $task)
    {
        $formFields = $request->validate([
            'content' => 'required',
            'task_id' => 'required',
            'user_id' => 'required'
        ]);

        Note::create($formFields);

        return back();
    }

    public function show(Note $note)
    {
        return view('notes.show', [
            'note' => $note
        ]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, Note $note)
    {
        $this->authorize('edit', $note);

        $formFields = $request->validate([
            'content' => 'required',
        ]);

        $note->update($formFields);

        return redirect(route('tasks.show', $note->task->id));
    }

    public function destroy(Note $note)
    {
        $this->authorize('delete', $note);

        $note->delete();

        return redirect(route('tasks.show', $note->task->id));
    }
}
