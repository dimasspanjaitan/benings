<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Region::truncate();
        $region = array( 
            [
                'id' => 1,
                'name' => 'Medan SUMUT',
                'note' => 'Provinsi'
            ],
            [
                'id' => 2,
                'name' => 'Medan Timur',
                'note' => 'Kecamatan'
            ],
            [
                'id' => 3,
                'name' => 'Medan Perjuangan',
                'note' => 'Kecamatan'
            ],
        );

        Region::insert($region);
    }
}
