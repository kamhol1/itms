<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Note\NoteController;
use App\Http\Controllers\Task\TaskController;
use App\Http\Controllers\User\UserController as UserProfileController;
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


Route::group([
    'middleware' => [
        'auth',
        'verified'
    ]
], function () {
    // TASKS
    Route::get('/', [TaskController::class, 'index'])
        ->name('tasks.index');
    Route::resource('/tasks', TaskController::class)
        ->only(['show', 'create', 'store', 'update', 'destroy']);


    // USER TASKS LIST
    Route::get('/user/tasks', [UserTaskController::class, 'index'])
        ->name('user.tasks.index');


    // NOTES
    Route::resource('/notes', NoteController::class)
        ->only(['show', 'store', 'update', 'destroy']);


    // ADMIN OPTIONS
    Route::group([
        'middleware' => [
            'admin'
        ],
        'prefix' => '/admin',
        'as' => 'admin.',
    ], function () {
        Route::resource('customers', CustomerController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('users', AdminUserController::class);
    });


    // USER PROFILE
    Route::get('user/show', [UserProfileController::class, 'show'])
        ->name('user.show');
});


require __DIR__.'/auth.php';
