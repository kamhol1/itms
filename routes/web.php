<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Note\NoteController;
use App\Http\Controllers\Task\TaskController;
use App\Http\Controllers\User\TaskController as UserTaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// TASKS

Route::get('/', [TaskController::class, 'index'])
    ->name('tasks.index')
    ->middleware(['auth', 'verified']);

Route::get('/tasks/create', [TaskController::class, 'create'])
    ->name('tasks.create');

Route::post('/tasks', [TaskController::class, 'store'])
    ->name('tasks.store');

Route::put('/tasks/{task}/edit', [TaskController::class, 'update'])
    ->name('tasks.update');

Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])
    ->name('tasks.destroy');

Route::get('/tasks/{task}', [TaskController::class, 'show'])
    ->name('tasks.show');



// NOTES

Route::post('/notes', [NoteController::class, 'store'])
    ->name('notes.store');

Route::put('/notes/{note}/edit', [NoteController::class, 'update'])
    ->name('notes.update');

Route::delete('/notes/{note}', [NoteController::class, 'destroy'])
    ->name('notes.destroy');

Route::get('/notes/{note}', [NoteController::class, 'show'])
    ->name('notes.show');



Route::get('/user/tasks', [UserTaskController::class, 'index'])
    ->name('user.tasks.index');



// ADMIN ROUTES - dodać middleware, który sprawdza czy user jest adminem

Route::get('/admin/customers', [Admin\CustomerController::class, 'index'])
    ->name('admin.customers.index');

Route::get('/admin/customers/create', [Admin\CustomerController::class, 'create'])
    ->name('admin.customers.create');

Route::post('/admin/customers', [Admin\CustomerController::class, 'store'])
    ->name('admin.customers.store');

Route::put('/admin/customers/{customer}', [Admin\CustomerController::class, 'update'])
    ->name('admin.customers.update');

Route::put('/admin/customers/{customer}', [Admin\CustomerController::class, 'destroy'])
    ->name('admin.customers.destroy');



Route::get('/admin/categories', [Admin\CustomerController::class, 'index'])
    ->name('admin.categories');

Route::get('/admin/users', [Admin\CustomerController::class, 'index'])
    ->name('admin.users');

//Route::get('/', function () {
//    return view('tasks.index');
//})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
