<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Requests\CategoryTransferToGroupRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    public function store(CategoryStoreRequest $request)
    {
        Category::create($request->validated());
    }

    public function update(Category $category, CategoryUpdateRequest $request)
    {
        $category->update($request->validated());
    }

    public function reorder(Request $request)
    {
        Category::setNewOrder($request->input('reorder'));

        Cache::forget('categories');
    }

    public function ungroup(Category $category)
    {
        Category::whereParentId($category->id)
            ->get('id')
            ->each(function ($query) {
                $query->update(['parent_id' => null]);
                $query->moveToEnd();
            });
    }

    public function transferToGroup(Category $category, CategoryTransferToGroupRequest $request)
    {
        $category->update(['parent_id' => $request->input('group_id'),]);
        $category->moveToEnd();
    }

    public function removeFromGroup(Category $category)
    {
        $category->update(['parent_id' => null]);
        $category->moveToEnd();
    }

    public function destroy(Category $category, Request $request)
    {
        if ($request->input('mode') === 'delete_without_list') {
            Category::whereParentId($category->id)
                ->get('id')
                ->each(function ($query) {
                    $query->update(['parent_id' => null]);
                    $query->moveToEnd();
                });
        } elseif ($request->input('mode') === 'delete_with_list') {
            Category::whereParentId($category->id)->delete();
        }

        $category->delete();
        return ($request->input('mode') === 'delete_without_list') ? null : redirect()->route('home');
    }
}
