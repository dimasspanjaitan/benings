<?php

namespace Database\Seeders;

use App\Models\Level;
use App\Models\PriceLevel;
use App\Models\Product;
use Illuminate\Database\Seeder;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PriceLevel::truncate();

        $levels = Level::all();
        $products = Product::all();
        $price_levels = [];
        $price_level_customers = [];

        $prices = [
            [74,74,74,70,70,70,95,95,95,120,120,140,145,145,160], // Newbie
            [71,71,71,67,67,67,92,92,92,115,115,135,140,140,155], // Junior Reseller
            [68,68,68,64,64,64,89,89,89,112,112,132,135,135,150], // Senior Reseller
            [65,65,65,61,61,61,86,86,86,109,109,129,128,128,142], // Junior Agen
            [62,62,62,58,58,58,83,83,83,106,106,126,121,121,134], // Senior Agen
            [57,57,57,53,53,53,78,78,78,101,101,121,112,112,125], // Distributor
            [53,53,53,50,50,50,75,75,75,96,96,117,105,105,120], // Distributor Plus
            [49,49,49,47,47,47,72,72,72,91,91,113,98,98,115], // Senior Distributor
            [45,45,45,44,44,44,69,69,69,86,86,109,91,91,110] // Master Distributor
        ];

        $price_customers = [79,79,79,75,75,75,100,100,100,125,125,145,150,150,165];

        foreach ($levels as $keyl => $level) {
            if ($level->id == config('benings.customer_level_id')) continue;
            foreach ($products as $keyp => $product) {
                array_push($price_levels, [
                    'price_type' => config('benings.price_type.mitra'),
                    'level_id' => $level->id,
                    'product_id' => $product->id,
                    'price' => isset($prices[$keyl][$keyp]) ? (int) $prices[$keyl][$keyp].'000' : 0
                ]);
            }
        }

        foreach ($products as $key => $product) {
            array_push($price_level_customers, [
                'price_type' => config('benings.price_type.customer'),
                'level_id' => config('benings.customer_level_id'),
                'product_id' => $product->id,
                'price' => isset($price_customers[$key]) ? (int) $price_customers[$key].'000' : 0
            ]);
        }

        // dd(count($price_levels));
        PriceLevel::insert($price_levels);
        PriceLevel::insert($price_level_customers);
    }
}
