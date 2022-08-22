<?php

namespace Database\Seeders;

use App\Models\Todo;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Todo::query()->create([
            'title' => 'این یک تسک تستی است.',
            'category_id' => 6,
            'created_at' => now()
        ]);
    }
}
