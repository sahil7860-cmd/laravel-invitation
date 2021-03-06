<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('users')->insert([
                'name' => 'Megan fox',
                'email' => 'meganfox@gmail.com',
                'password' => Hash::make('password'),
                'role' =>'A',
            ]);
    }
}
