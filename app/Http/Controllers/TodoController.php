<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompletedTodosDestroyRequest;
use App\Http\Requests\TodoStoreRequest;
use App\Http\Requests\TodoUpdateRequest;
use App\Models\Category;
use App\Models\Todo;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TodoController extends Controller
{
    public function store(Category $category, TodoStoreRequest $request)
    {
        $category->todos()->create($request->validated());
    }

    public function show(Category $category)
    {
        if ($category->is_group) {
            abort(404);
        }

        $todoModels = $category->todos()
            ->orderByDesc('is_important')
            ->ordered()
            ->get();

        // Use collection `values` method for prevent collection returning array with index
        $todos = $todoModels->whereNull('done_at')->values();
        $todosDone = $todoModels->whereNotNull('done_at')->values();

        return Inertia::render('todos', [
            'list' => $category,
            'todos' => $todos,
            'todos_done' => $todosDone,
        ]);
    }

    public function reorder(Request $request)
    {
        Todo::setNewOrder($request->input('reorder'));
    }

    public function update(Todo $todo, TodoUpdateRequest $request)
    {
        $todo->update($request->validated());
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
    }

    public function destroyCompleted(CompletedTodosDestroyRequest $request)
    {
        Todo::whereCategoryId($request->input('category_id'))
            ->whereNotNull('done_at')
            ->delete();
    }

    public function toggleImportant(Todo $todo)
    {
        ($todo->is_important)
            ? $todo->moveToStart()
            : $todo->moveToEnd();

        $todo->update(['is_important' => !$todo->is_important]);
    }

    public function toggleTodo(Todo $todo)
    {
        if (is_null($todo->done_at)) {
            $todo->update(['done_at' => now()]);
            $todo->moveToStart();
        } else {
            $todo->update(['done_at' => null]);
            $todo->moveToEnd();
        }
    }
}
