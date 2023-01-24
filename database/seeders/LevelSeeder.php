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
                'name' => 'Newbie',
                'note' => 'Item Satuan'
            ],
            [
                'id' => 2,
                'name' => 'Junior Reseller',
                'note' => 'Item Satuan'
            ],
            [
                'id' => 3,
                'name' => 'Senior Reseller',
                'note' => 'Item Satuan'
            ],
            [
                'id' => 4,
                'name' => 'Junior Agen',
                'note' => 'Item Satuan'
            ],
            [
                'id' => 5,
                'name' => 'Senior Agen',
                'note' => 'Item Satuan'
            ],
            [
                'id' => 6,
                'name' => 'Distributor',
                'note' => 'Item Satuan'
            ],
            [
                'id' => 7,
                'name' => 'Distributor Plus',
                'note' => 'Item Satuan'
            ],
            [
                'id' =>8,
                'name' => 'Senior Distributor',
                'note' => 'Item Satuan'
            ],
            [
                'id' => 9,
                'name' => 'Master Distributor',
                'note' => 'Item Satuan'
            ],
            [
                'id' => config('benings.customer_level_id'),
                'name' => 'Customer',
                'note' => 'Item Satuan'
            ],
        );

        Level::insert($level);
    }
}
