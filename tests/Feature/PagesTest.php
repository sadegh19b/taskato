<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class PagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_see_home_page_with_categories(): void
    {
        $category = Category::factory()->create();
        $group = Category::factory()->grouped()->create();
        Category::factory()->inGroup($group->id)->create();

        $this->get(route('home'))
            ->assertInertia(fn (Assert $page) => $page
                ->component('index')
                ->has('categories', 2, fn (Assert $page) => $page
                    ->where('id', $category->id)
                    ->has('children', 0)
                    ->etc()
                )
                ->has('categories.1', fn (Assert $page) => $page
                    ->where('id', $group->id)
                    ->has('children', 1)
                    ->etc()
                )
            )
            ->assertOk();
    }

    public function test_user_can_see_list_page_with_categories_and_todos(): void
    {
        $category = Category::factory()->create();
        $todo1 = Todo::factory()->inCategory($category->id)->create();
        $todo2 = Todo::factory()->done()->inCategory($category->id)->create();

        $this->get(route('todos.show', $category))
            ->assertInertia(fn (Assert $page) => $page
                ->component('todos')
                ->has('categories', 1, fn (Assert $page) => $page
                    ->where('id', $category->id)
                    ->has('children', 0)
                    ->etc()
                )
                ->has('current_list', fn (Assert $page) => $page
                    ->where('id', $category->id)
                    ->etc()
                )
                ->has('todos', 1, fn (Assert $page) => $page
                    ->where('id', $todo1->id)
                    ->etc()
                )
                ->has('todos_done', 1, fn (Assert $page) => $page
                    ->where('id', $todo2->id)
                    ->etc()
                )
            )
            ->assertOk();
    }
}
