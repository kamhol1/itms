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

Route::group([
    'middleware' => 'admin',
    'prefix' => '/admin',
    'as' => 'admin.'
], function () {
    Route::resource('customers', Admin\CustomerController::class);
    Route::resource('categories', Admin\CustomerController::class);
    Route::resource('users', Admin\CustomerController::class)->only([
        'index', 'update', 'destroy'
    ]);
//    Route::get('', [Admin\CustomerController::class, 'index'])
//        ->name('index');
//
//    Route::get('create', [Admin\CustomerController::class, 'create'])
//        ->name('create');
//
//    Route::post('', [Admin\CustomerController::class, 'store'])
//        ->name('store');
//
//    Route::put('{customer}', [Admin\CustomerController::class, 'update'])
//        ->name('update');
//
//    Route::put('{customer}', [Admin\CustomerController::class, 'destroy'])
//        ->name('destroy');
});



Route::get('/admin/categories', [Admin\CustomerController::class, 'index'])
    ->name('admin.categories');

Route::get('/admin/users', [Admin\CustomerController::class, 'index'])
    ->name('admin.users');



require __DIR__.'/auth.php';
