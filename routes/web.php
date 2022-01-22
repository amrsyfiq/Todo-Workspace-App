<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\WorkspaceController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::resource('workspace', WorkspaceController::class);

Route::prefix('task')->name('task.')->group(function () {
    Route::get('{workspace}/create', [TaskController::class, 'create'])->name('create');
    Route::get('{workspace}', [TaskController::class, 'index'])->name('index');
    Route::post('{workspace}', [TaskController::class, 'store'])->name('store');
    Route::get('{task}/edit', [TaskController::class, 'edit'])->name('edit');
    Route::put('{task}', [TaskController::class, 'update'])->name('update');
    Route::delete('{task}', [TaskController::class, 'destroy'])->name('destroy');
});
