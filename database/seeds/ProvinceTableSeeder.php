<?php

use Illuminate\Database\Seeder;
use App\Province;

class ProvinceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Province::create([
            'name' => 'Sài Gòn'
        ]);

        Province::create([
            'name' => 'Hà Nội'
        ]);

        Province::create([
            'name' => 'Vũng Tàu'
        ]);
    }
}
