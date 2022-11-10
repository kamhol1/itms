<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required|max:255'
        ]);

        Category::create($formFields);

        return redirect(route('admin.categories.index'));
    }

    public function update(Request $request, Category $category)
    {
        $formFields = $request->validate([
            'name' => 'required|max:255'
        ]);

        $category->update($formFields);

        return redirect(route('admin.categories.index'));
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect(route('admin.categories.index'));
    }
}
