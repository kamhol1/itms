<?php

use App\Http\Controllers\Admin\AdminController;
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

//Route::resource('tasks', TaskController::class);

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



Route::get('/admin/customers', [AdminController::class, 'customers'])
    ->name('admin.customers');

Route::get('/admin/categories', [AdminController::class, 'categories'])
    ->name('admin.categories');

Route::get('/admin/users', [AdminController::class, 'users'])
    ->name('admin.users');

//Route::get('/', function () {
//    return view('tasks.index');
//})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
