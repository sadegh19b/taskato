<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Requests\CategoryTransferToGroupRequest;
use App\Http\Requests\ReorderRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(CategoryStoreRequest $request): void
    {
        Category::create($request->validated());
    }

    public function update(Category $category, CategoryUpdateRequest $request): void
    {
        $category->update($request->validated());
    }

    public function reorder(ReorderRequest $request): void
    {
        Category::setNewOrder($request->input('reorder'));

        cache()->forget('categories');
    }

    public function ungroup(Category $category): void
    {
        Category::whereParentId($category->id)
            ->get(['id', 'sort'])
            ->each(function ($item) {
                $item->update(['parent_id' => null]);
                $item->moveToEnd();
            });
    }

    public function transferToGroup(Category $category, CategoryTransferToGroupRequest $request): void
    {
        $category->update(['parent_id' => $request->input('group_id'),]);
        $category->moveToEnd();
    }

    public function removeFromGroup(Category $category): void
    {
        $category->update(['parent_id' => null]);
        $category->moveToEnd();
    }

    public function destroy(Category $category, Request $request): ?\Illuminate\Http\RedirectResponse
    {
        if ($request->input('mode') === 'delete_without_list') {
            Category::whereParentId($category->id)
                ->get(['id', 'sort'])
                ->each(function ($item) {
                    $item->update(['parent_id' => null]);
                    $item->moveToEnd();
                });
        } elseif ($request->input('mode') === 'delete_with_list') {
            Category::whereParentId($category->id)->delete();
        }

        $category->delete();
        return ($request->input('mode') === 'delete_without_list') ? null : redirect()->route('home');
    }
}
