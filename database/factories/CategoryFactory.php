<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'sort' => Category::max('sort') + 1,
        ];
    }

    public function grouped(): CategoryFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'is_group' => true
            ];
        });
    }

    public function inGroup(int|null $group_id = null): CategoryFactory
    {
        return $this->state(function (array $attributes) use ($group_id) {
            return [
                'parent_id' => is_null($group_id)
                    ? Category::factory()
                    : $group_id
            ];
        });
    }
}
