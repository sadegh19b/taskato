<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_store_a_new_todo(): void
    {
        $category = Category::factory()->create();

        $requestData = [
            'title' => fake()->sentence(),
        ];

        $this->post(route('todos.store', $category), $requestData)
            ->assertOk();

        $this->assertCount(1, $category->todos);
        $this->assertDatabaseHas('todos', $requestData + ['category_id' => $category->id]);
    }

    public function test_user_can_update_todo(): void
    {
        $todo = Todo::factory()->create();

        $requestData = [
            'title' => 'Update Todo'
        ];

        $this->put(route('todos.update', $todo), $requestData)
            ->assertOk();

        $this->assertDatabaseHas('todos', $requestData + ['id' => $todo->id]);
    }

    public function test_user_can_update_todo_with_description(): void
    {
        $todo = Todo::factory()->create();

        $requestData = [
            'title' => 'Update Todo',
            'description' => 'Update Description'
        ];

        $this->put(route('todos.update', $todo), $requestData)
            ->assertOk();

        $this->assertDatabaseHas('todos', $requestData + ['id' => $todo->id]);
    }

    public function test_user_can_reorder_sorting_of_todos(): void
    {
        $category = Category::factory()->create();
        $todo1 = Todo::factory()->inCategory($category->id)->create();
        $todo2 = Todo::factory()->inCategory($category->id)->create();
        $todo3 = Todo::factory()->inCategory($category->id)->create();

        $requestData = [
            'reorder' => [$todo3->id, $todo2->id, $todo1->id]
        ];

        $this->post(route('todos.reorder'), $requestData)
            ->assertOk();

        $this->assertDatabaseHas('todos', ['id' => $todo3->id, 'sort' => 1]);
        $this->assertDatabaseHas('todos', ['id' => $todo2->id, 'sort' => 2]);
        $this->assertDatabaseHas('todos', ['id' => $todo1->id, 'sort' => 3]);
    }

    public function test_user_can_todo_toggle_to_done_and_todos_must_be_reordered_sorting(): void
    {
        Todo::factory()->create();
        $todo = Todo::factory()->create();

        $this->post(route('todos.toggle_todo', $todo))
            ->assertOk();

        $this->assertDatabaseHas('todos', ['id' => $todo->id, 'sort' => 1]);
        $this->assertNotNull($todo->refresh()->done_at);
    }

    public function test_user_can_todo_toggle_to_undone_and_todos_must_be_reordered_sorting(): void
    {
        $todo = Todo::factory()->done()->create();
        Todo::factory()->create();

        $this->post(route('todos.toggle_todo', $todo))
            ->assertOk();

        $this->assertDatabaseHas('todos', ['id' => $todo->id, 'sort' => 2]);
        $this->assertNull($todo->refresh()->done_at);
    }

    public function test_user_can_todo_toggle_to_is_important_and_the_todo_must_be_reordered_first_item_in_sorting(): void
    {
        Todo::factory()->create();
        $todo = Todo::factory()->create();

        $this->post(route('todos.toggle_important', $todo))
            ->assertOk();

        $this->assertDatabaseHas('todos', ['id' => $todo->id, 'sort' => 1]);
        $this->assertTrue($todo->fresh()->is_important);
    }

    public function test_user_can_todo_toggle_to_is_not_important_and_the_todo_must_be_reordered_first_item_in_sorting(): void
    {
        $todo = Todo::factory()->important()->create();
        Todo::factory()->create();

        $this->post(route('todos.toggle_important', $todo))
            ->assertOk();

        $this->assertDatabaseHas('todos', ['id' => $todo->id, 'sort' => 1]);
        $this->assertFalse($todo->fresh()->is_important);
    }

    public function test_user_can_delete_completed_todos_in_list(): void
    {
        $category = Category::factory()->create();
        Todo::factory()->done()->inCategory($category->id)->create();
        Todo::factory()->inCategory($category->id)->create();

        $this->delete(route('todos.destroy_completed'), ['category_id' => $category->id])
            ->assertOk();

        $this->assertCount(1, $category->todos);
    }

    public function test_user_can_delete_todo(): void
    {
        $todo = Todo::factory()->create();

        $this->delete(route('todos.destroy', $todo))
            ->assertOk();

        $this->assertDatabaseMissing('todos', ['id' => $todo->id]);
    }
}
