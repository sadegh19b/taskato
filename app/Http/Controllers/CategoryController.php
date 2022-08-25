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
        $ids = $request->input('reorder');
        $sorts = array_keys($request->input('reorder'));

        foreach ($sorts as $sort) {
            Category::find($ids[$sort])->update(['sort' => $sort]);
        }

        Cache::forget('categories');
    }

    public function ungroup(Category $category)
    {
        $lastList = Category::latestParent()->first();

        Category::whereParentId($category->id)->get()
            ->each(function ($item, $index) use ($lastList) {
                $item->update(['parent_id' => null, 'sort' => $lastList ? $lastList->sort + $index + 1 : 0]);
            });
    }

    public function transferToGroup(Category $category, CategoryTransferToGroupRequest $request)
    {
        $lastList = Category::latestParent($request->input('group_id'))->first();

        $category->update([
            'parent_id' => $request->input('group_id'),
            'sort' => $lastList ? $lastList->sort + 1 : 0
        ]);
    }

    public function removeFromGroup(Category $category)
    {
        $lastList = Category::latestParent()->first();

        $category->update(['parent_id' => null, 'sort' => $lastList ? $lastList->sort + 1 : 0]);
    }

    public function destroy(Category $category, Request $request)
    {
        if ($request->input('mode') === 'delete_without_list') {
            $lastList = Category::latestParent()->first();

            Category::whereParentId($category->id)->get()
                ->each(function ($item, $index) use ($lastList) {
                    $item->update(['parent_id' => null, 'sort' => $lastList ? $lastList->sort + $index : 0]);
                });
        } elseif ($request->input('mode') === 'delete_with_list') {
            Category::whereParentId($category->id)->delete();
        }

        $category->delete();
        return ($request->input('mode') === 'delete_without_list') ? null : redirect()->route('home');
    }
}
