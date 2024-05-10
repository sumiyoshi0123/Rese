<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ShopsSeeder::class);
        $this->call(AreasSeeder::class);
        $this->call(CategoriesSeeder::class);
    }
}
