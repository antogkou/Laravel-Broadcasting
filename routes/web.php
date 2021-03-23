<?php

use App\Models\Task;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

// TASKS
Route::get('/tasks', function () {
    return Task::latest()->pluck('body');
});

Route::post('/tasks', function () {
    $task = Task::forceCreate(request(['body']));
    TaskCreated::dispatch($task);
    //event(new TaskCreated($task));
});

// Route::get('/laracast/{id}', function ($id) {
//     OrderStatusUpdated::dispatch(new Order($id));
// });

// // Projects Page
// Route::get('/projects/{id}', function (Project $project) {
//     $project->load('tasks');
//     return Inertia::render('Project', compact('project'));
// })->middleware(['auth', 'verified'])->name('project');
// //return view('projects.show', compact('project'));
// //});

// // API
// Route::get('/api/projects/{project}', function (Project $project) {
//     return $project->tasks->pluck('body');
// });

// Route::post('/api/projects/{project}/tasks', function (Project $project) {
//     $task = $project->tasks()->create(request(['body']));
//     event(new TaskCreated($task));
//     return $task;
// });
