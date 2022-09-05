<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Todo;
use Illuminate\Database\Eloquent\Factories\Factory;

class TodoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'sort' => Todo::max('sort') + 1,

            'category_id' => Category::factory(),
        ];
    }

    public function withDescription(): TodoFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'description' => $this->faker->text(),
            ];
        });
    }

    public function done(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'done_at' => now(),
            ];
        });
    }

    public function important(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'is_important' => true,
            ];
        });
    }

    public function inCategory(int $category_id = null): self
    {
        return $this->state(function (array $attributes) use ($category_id) {
            return [
                'category_id' => is_null($category_id)
                    ? Category::factory()
                    : $category_id
            ];
        });
    }
}
