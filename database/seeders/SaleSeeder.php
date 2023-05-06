<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{
    Sale,
    SaleDetail
};

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sale::truncate();
        SaleDetail::truncate();

        Sale::factory()->count(1000)->create();
        SaleDetail::factory()->count(3000)->create();
    }
}
