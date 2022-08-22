<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Todo;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TodoController extends Controller
{
    public function store(Category $category, Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'max:250'],
            'sort' => ['numeric'],
        ]);

        $category->todos()->create($data);
    }

    public function show(Category $category)
    {
        if ($category->is_group) {
            abort(404);
        }

        $todoModels = $category->todos()
            ->latest('is_important')
            ->orderBy('sort')
            ->get();

        // Use collection `values` method for prevent collection returning array with index
        $todos = $todoModels->whereNull('done_at')->values();
        $todosDone = $todoModels->whereNotNull('done_at')->values();

        return Inertia::render('Todos', [
            'list' => $category,
            'todos' => $todos,
            'todos_done' => $todosDone,
        ]);
    }

    public function reorder(Request $request)
    {
        $ids = $request->input('reorder');
        $sorts = array_keys($request->input('reorder'));

        foreach ($sorts as $sort) {
            Todo::find($ids[$sort])->update(['sort' => $sort]);
        }
    }

    public function update(Todo $todo, Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'max:250'],
            'description' => ['nullable'],
        ]);

        $todo->update($data);
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
    }

    public function destroyCompleted(Request $request)
    {
        Todo::whereCategoryId($request->category_id)->whereNotNull('done_at')->delete();
    }

    public function toggleImportant(Todo $todo)
    {
        $todo->update(['is_important' => !$todo->is_important, 'sort' => 0]);

        // Reorder all todos sort by important or not important
        Todo::whereIsImportant($todo->is_important)
            ->whereCategoryId($todo->category_id)
            ->where('id', '!=', $todo->id)
            ->orderBy('sort')
            ->get()
            ->each(function ($item, $index) {
                $item->update(['sort' => $index + 1]);
            });
    }

    public function toggleTodo(Todo $todo)
    {
        $lastTodo = Todo::whereIsImportant($todo->is_important)
            ->whereCategoryId($todo->category_id)
            ->latest('sort');

        if (is_null($todo->done_at)) {
            $lastTodo = $lastTodo->whereNotNull('done_at');
            $updateDoneAt = now();
        } else {
            $lastTodo = $lastTodo->whereNull('done_at');
            $updateDoneAt = null;
        }

        $lastTodo = $lastTodo->first();
        $sort = $lastTodo ? $lastTodo->sort + 1 : 0;

        $todo->update(['done_at' => $updateDoneAt, 'sort' => $sort]);
    }
}
