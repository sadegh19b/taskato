<?php

namespace App\Providers;

use App\Models\Category;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class InertiaServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $getCategoryColumns = ['id', 'parent_id', 'title', 'is_group', 'sort'];

        Inertia::share('current_list', fn(Request $request) => $request->route()?->parameter('category')?->only($getCategoryColumns));

        Inertia::share('categories', fn() =>
            Cache::rememberForever('categories', fn() =>
                Category::count()
                    ? Category::whereParentId(null)
                        ->with('children', fn ($query) => $query->select($getCategoryColumns))
                        ->ordered()
                        ->get($getCategoryColumns)
                    : []
            )
        );
    }
}
