<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::query()->insert([
            [
                'title' => 'برنامه ریزی',
                'is_group' => true,
                'parent_id' => null,
                'sort' => 0,
                'created_at' => now()
            ],
            [
                'title' => 'برنامه روزانه',
                'is_group' => false,
                'parent_id' => 1,
                'sort' => 0,
                'created_at' => now()
            ],
            [
                'title' => 'برنامه هفتگی',
                'is_group' => false,
                'parent_id' => 1,
                'sort' => 1,
                'created_at' => now()
            ],
            [
                'title' => 'برنامه ماهیانه',
                'is_group' => false,
                'parent_id' => 1,
                'sort' => 2,
                'created_at' => now()
            ],
            [
                'title' => 'پروژه ها',
                'is_group' => true,
                'parent_id' => null,
                'sort' => 1,
                'created_at' => now()
            ],
            [
                'title' => 'متفرقه',
                'is_group' => false,
                'parent_id' => null,
                'sort' => 2,
                'created_at' => now()
            ],
        ]);
    }
}
