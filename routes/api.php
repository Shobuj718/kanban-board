<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\TaskController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('employees', EmployeeController::class);

Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');


Route::get('/to-do-tasks', [TaskController::class, 'toDoTaskList'])->name('todo.task.list');
Route::get('/in-progress-tasks', [TaskController::class, 'progressTaskList'])->name('progress.task.list');
Route::get('/complete-tasks', [TaskController::class, 'doneTaskList'])->name('done.task.list');



Route::put('/task-move/to/progress/{id}', [TaskController::class, 'moveToProgress']);
Route::put('/task-move/to/done/{id}', [TaskController::class, 'moveToDone']);
Route::delete('/task-delete/{id}', [TaskController::class, 'taskDelete']);

