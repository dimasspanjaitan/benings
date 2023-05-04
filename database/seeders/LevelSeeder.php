<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Level::truncate();
        $level = array( 
            [
                'id' => 1,
                'status' => 1,
                'name' => 'Newbie',
                'description' => '-'
            ],
            [
                'id' => 2,
                'status' => 1,
                'name' => 'Junior Reseller',
                'description' => '-'
            ],
            [
                'id' => 3,
                'status' => 1,
                'name' => 'Senior Reseller',
                'description' => '-'
            ],
            [
                'id' => 4,
                'status' => 1,
                'name' => 'Junior Agen',
                'description' => '-'
            ],
            [
                'id' => 5,
                'status' => 1,
                'name' => 'Senior Agen',
                'description' => '-'
            ],
            [
                'id' => 6,
                'status' => 1,
                'name' => 'Distributor',
                'description' => '-'
            ],
            [
                'id' => 7,
                'status' => 1,
                'name' => 'Distributor Plus',
                'description' => '-'
            ],
            [
                'id' =>8,
                'status' => 1,
                'name' => 'Senior Distributor',
                'description' => '-'
            ],
            [
                'id' => 9,
                'status' => 1,
                'name' => 'Master Distributor',
                'description' => '-'
            ],
            [
                'id' => config('benings.customer_level_id'),
                'status' => 1,
                'name' => 'Customer',
                'description' => '-'
            ],
        );

        Level::insert($level);
    }
}
