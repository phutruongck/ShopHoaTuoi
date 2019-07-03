<?php

use Illuminate\Database\Seeder;
use App\Rule;
class RulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rule::create([
            'name' => 'admin'
        ]);

        Rule::create([
            'name' => 'mod'
        ]);

        Rule::create([
            'name' => 'member'
        ]);
    }
}
