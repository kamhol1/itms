<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show()
    {
        $user = auth()->user();

        return view('user.show', [
            'user' => $user
        ]);
    }

    public function edit()
    {

    }
}
