<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hash_password = \Hash::make('12345678');
        User::create([
            'name' => 'Phan Quoc Huy',
            'email' => 'phanqhuy199@gmail.com',
            'password' => $hash_password,
            'address' => 'Sài Gòn',
            'province_id' => 1,
            'cellphone' => '012345678',
            'rule' => 1,
            'status' => true
        ]);
    }
}
