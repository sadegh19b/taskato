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
        Inertia::share('current_list', function (Request $request) {
            return optional( $request->route()->parameter('category') )->makeVisible('parent_id');
        });
        Inertia::share('categories', function () {
            return Cache::rememberForever('categories', function () {
                return Category::count() ?
                    Category::whereParentId(null)
                    ->with('children')
                    ->orderBy('sort')
                    ->get()
                    : [];
            });
        });
    }
}
