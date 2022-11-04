<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\TaskController;
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

Route::get('/', [TaskController::class, 'index'])
    ->name('tasks.index')
    ->middleware(['auth', 'verified']);

//Route::resource('tasks', TaskController::class);

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


//Route::get('/', function () {
//    return view('tasks.index');
//})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
