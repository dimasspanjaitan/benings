<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

        public function run()
    {
        User::truncate();

        $data=array(
            [
                'status'=> 1,
                'name'=>'Admin',
                'email'=>'admin@gmail.com',
                'password'=>Hash::make('admin23'),
                'phone' => '081212121212',
                'role'=> 1,
                'birth_place' => 'Medan',
                'birth_date' => '2001-10-23',
                'gender' => 'Perempuan',
                'sub_district' => 'Medan Timur',
                'city' => 'Medan',
                'address' => 'Jl. Medan',
                'bank_number' => '08080088',
                'level_id' => 6,
                'region_id' => 1,
            ],
            [
                'status'=> 1,
                'name'=>'User',
                'email'=>'user@gmail.com',
                'password'=>Hash::make('user23'),
                'phone' => '081212121212',
                'role'=> 2,
                'birth_place' => 'Medan',
                'birth_date' => '2001-10-23',
                'gender' => 'Perempuan',
                'sub_district' => 'Medan Timur',
                'city' => 'Medan',
                'address' => 'Jl. Medan',
                'bank_number' => '08080088',
                'level_id' => 1,
                'region_id' => 2,
            ]
        );

        User::insert($data);
    }
}
