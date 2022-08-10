<?php

namespace Database\Seeders;

use App\Models\CategoryProducts;
use Illuminate\Database\Seeder;

class CategoryProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        CategoryProducts::factory(500)->create();
    }
}
