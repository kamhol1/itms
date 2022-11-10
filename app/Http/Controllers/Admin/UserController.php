<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:5', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5'],
            'admin' => 'nullable'
        ]);

        $formFields['password'] = bcrypt($formFields['password']);
        $formFields['admin'] = isset($formFields['admin']) && $formFields['admin'];

        User::create($formFields);

        return redirect(route('admin.users.index'));
    }

    public function update(Request $request, User $user)
    {
        $formFields = $request->validate([
            'name' => [
                'required',
                'min:5',
                'max:255'
            ],
            'email' => [
                'required',
                'max:255',
                'email',
                Rule::unique('users', 'email')->ignore($user->id)
            ]
        ]);

        $formFields['admin'] = (boolean) $request->admin;

        $user->update($formFields);

        return redirect(route('admin.users.index'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect(route('admin.users.index'));
    }
}
