<?php

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
        $this->call(UsersTableSeeder::class);
        $this->call(RulesTableSeeder::class);
        $this->call(ProvinceTableSeeder::class);
        $this->call(ProductCategoryTableSeeder::class);
        $this->call(ProductTableSeeder::class);
    }
}
