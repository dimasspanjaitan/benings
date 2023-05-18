<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();
        // $this->call(ProductSeeder::class);
        // $this->call(LevelSeeder::class);
        $this->call(PriceSeeder::class);
        // $this->call(UserSeeder::class);
        // $this->call(RegionSeeder::class);
        // $this->call(SaleSeeder::class);
        // $this->call(SettingSeeder::class);
    }
}
