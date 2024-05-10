<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => '寿司'
        ]);

        Category::create([
            'name' => '焼肉'
        ]);

        Category::create([
            'name' => '居酒屋'
        ]);

        Category::create([
            'name' => 'イタリアン'
        ]);

        Category::create([
            'name' => 'ラーメン'
        ]);
    }
}
