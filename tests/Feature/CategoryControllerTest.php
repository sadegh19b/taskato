<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_store_a_new_category_group_or_list(): void
    {
        $requestData = [
            'title' => fake()->word(),
            'is_group' => fake()->boolean(),
        ];

        $this->post(route('categories.store'), $requestData)
            ->assertOk();

        $this->assertCount(1, Category::get());
        $this->assertDatabaseHas('categories', $requestData);
    }

    public function test_user_can_store_a_new_sub_category_only_list(): void
    {
        $group = Category::factory()->grouped()->create();

        $requestData = [
            'title' => fake()->word(),
            'is_group' => false,
            'parent_id' => $group->id,
        ];

        $this->post(route('categories.store'), $requestData)
            ->assertOk();

        $this->assertCount(2, Category::get());
        $this->assertDatabaseHas('categories', $requestData);
    }

    public function test_user_can_update_category_only_title(): void
    {
        $category = Category::factory()->create();

        $requestData = [
            'title' => 'Update Category'
        ];

        $this->put(route('categories.update', $category), $requestData)
            ->assertOk();

        $this->assertDatabaseHas('categories', $requestData + ['id' => $category->id]);
    }

    public function test_user_can_reorder_sorting_of_categories_and_categories_cache_should_be_forgotten(): void
    {
        $category1 = Category::factory()->create();
        $category2 = Category::factory()->create();
        $category3 = Category::factory()->create();

        $requestData = [
            'reorder' => [$category3->id, $category2->id, $category1->id]
        ];

        \Cache::spy();

        $this->post(route('categories.reorder'), $requestData)
            ->assertOk();

        $this->assertDatabaseHas('categories', ['id' => $category3->id, 'sort' => 1]);
        $this->assertDatabaseHas('categories', ['id' => $category2->id, 'sort' => 2]);
        $this->assertDatabaseHas('categories', ['id' => $category1->id, 'sort' => 3]);

        \Cache::shouldHaveReceived('forget')->once();
    }

    public function test_user_can_ungroup_categories_and_categories_must_be_reordered_sorting(): void
    {
        $group = Category::factory()->grouped()->create();
        $inGroupCategory = Category::factory()->inGroup($group->id)->create();
        $nonGroupCategory = Category::factory()->create();

        $this->post(route('categories.ungroup', $group))
            ->assertOk();

        $this->assertDatabaseHas('categories', ['id' => $inGroupCategory->id, 'parent_id' => null, 'sort' => 3]);
        $this->assertDatabaseHas('categories', ['id' => $nonGroupCategory->id, 'parent_id' => null, 'sort' => 2]);
    }

    public function test_user_can_category_transfer_to_group_and_category_must_be_reordered_to_end_of_the_group_sorting(): void
    {
        $group = Category::factory()->grouped()->create();
        $nonGroupCategory = Category::factory()->create();
        $inGroupCategory = Category::factory()->inGroup($group->id)->create();

        $this->post(route('categories.transfer_to_group', $nonGroupCategory), ['group_id' => $group->id])
            ->assertOk();

        $this->assertDatabaseHas('categories', ['id' => $nonGroupCategory->id, 'parent_id' => $group->id, 'sort' => 3]);
        $this->assertDatabaseHas('categories', ['id' => $inGroupCategory->id, 'parent_id' => $group->id, 'sort' => 2]);
    }

    public function test_user_can_remove_category_from_group_and_category_must_be_reordered_to_end_of_categories_sorting(): void
    {
        $group = Category::factory()->grouped()->create();
        $inGroupCategory = Category::factory()->inGroup($group->id)->create();
        Category::factory()->create();

        $this->post(route('categories.remove_from_group', $inGroupCategory))
            ->assertOk();

        $this->assertDatabaseHas('categories', ['id' => $inGroupCategory->id, 'parent_id' => null, 'sort' => 3]);
    }

    public function test_user_can_delete_group_without_list_and_lists_must_be_reordered_to_end_of_categories_sorting(): void
    {
        $group = Category::factory()->grouped()->create();
        $inGroupCategory = Category::factory()->inGroup($group->id)->create();
        Category::factory()->create();

        $this->delete(route('categories.destroy', $group), ['mode' => 'delete_without_list'])
            ->assertOk();

        $this->assertDatabaseHas('categories', ['id' => $inGroupCategory->id, 'parent_id' => null, 'sort' => 3]);
        $this->assertDatabaseMissing('categories', ['id' => $group->id]);
    }

    public function test_user_can_delete_group_with_lists(): void
    {
        $group = Category::factory()->grouped()->create();
        $inGroupCategory = Category::factory()->inGroup($group->id)->create();
        Category::factory()->create();

        $this->delete(route('categories.destroy', $group), ['mode' => 'delete_with_list'])
            ->assertRedirect(route('home'));

        $this->assertDatabaseMissing('categories', ['id' => $group->id]);
        $this->assertDatabaseMissing('categories', ['id' => $inGroupCategory->id]);
        $this->assertDatabaseCount('categories', 1);
    }

    public function test_user_can_delete_category_or_group(): void
    {
        $group = Category::factory()->grouped()->create();
        $category = Category::factory()->create();

        $this->delete(route('categories.destroy', $group))
            ->assertRedirect(route('home'));

        $this->assertDatabaseMissing('categories', ['id' => $group->id]);

        $this->delete(route('categories.destroy', $category))
            ->assertRedirect(route('home'));

        $this->assertDatabaseMissing('categories', ['id' => $category->id]);

        $this->assertDatabaseCount('categories', 0);
    }
}
