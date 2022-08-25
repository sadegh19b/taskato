<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TodoController;

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

Route::inertia('/', 'index')->name('home');

Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
    Route::post('/', [CategoryController::class, 'store'])->name('store');
    Route::put('{category}', [CategoryController::class, 'update'])->name('update');
    Route::delete('{category}', [CategoryController::class, 'destroy'])->name('destroy');
    Route::post('reorder', [CategoryController::class, 'reorder'])->name('reorder');
    Route::post('ungroup/{category}', [CategoryController::class, 'ungroup'])->name('ungroup');
    Route::post('remove-from-group/{category}', [CategoryController::class, 'removeFromGroup'])->name('remove_from_group');
    Route::post('transfer-to-group/{category}', [CategoryController::class, 'transferToGroup'])->name('transfer_to_group');
});

Route::get('list/{category}', [TodoController::class, 'show'])->name('todos.show');
Route::group(['prefix' => 'todos', 'as' => 'todos.'], function () {
    Route::post('reorder', [TodoController::class, 'reorder'])->name('reorder');
    Route::post('{category}', [TodoController::class, 'store'])->name('store');
    Route::put('{todo}', [TodoController::class, 'update'])->name('update');
    Route::delete('completed', [TodoController::class, 'destroyCompleted'])->name('destroy_completed');
    Route::delete('{todo}', [TodoController::class, 'destroy'])->name('destroy');
    Route::post('toggle-important/{todo}', [TodoController::class, 'toggleImportant'])->name('toggle_important');
    Route::post('toggle-todo/{todo}', [TodoController::class, 'toggleTodo'])->name('toggle_todo');
});
