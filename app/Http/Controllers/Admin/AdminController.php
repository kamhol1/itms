<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function customers()
    {
        return view('admin.customers');
    }

    public function categories()
    {
        return view('admin.categories');
    }

    public function users()
    {
        return view('admin.users');
    }
}
