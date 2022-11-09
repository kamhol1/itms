<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();

        return view('admin.customers.index', [
            'customers' => $customers
        ]);
    }

    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required|max:255',
            'phone' => 'nullable',
            'email' => 'nullable|email'
        ]);

        Customer::create($formFields);

        return redirect(route('admin.customers.index'));
    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
