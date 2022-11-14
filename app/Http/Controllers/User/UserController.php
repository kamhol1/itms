<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function show()
    {
        $user = auth()->user();

        return view('user.show', [
            'user' => $user
        ]);
    }

    public function update(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'avatar' => 'nullable'
        ]);

        if (isset($request->old_password) || isset($request->new_password)) {
            $request->validate([
                'old_password' => 'required',
                'new_password' => ['required', 'confirmed', Rules\Password::defaults()]
            ]);

            if (!Hash::check($request->old_password, auth()->user()->password)) {
                return back()->with("error", "Old password doesn't match.");
            }

            $formFields['password'] = Hash::make($request->new_password);
        }

        auth()->user()->update($formFields);

        return redirect(route('user.show'));
    }
}
