<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{
    Category,
    Product,
    ProductCategory,
    ProductDetail,
    ProductDiscount
};

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();
        ProductDetail::truncate();
        ProductDiscount::truncate();
        Category::truncate();

        $product_details = [];
        $prodcut_discounts = [];
        $categories = array(
            [
                'id' => 1,
                'name' => 'Paket Dasar',
                'note' => ''
            ],
            [
                'id' => 2,
                'name' => 'Serum',
                'note' => ''
            ],
            [
                'id' => 3,
                'name' => 'Body Care',
                'note' => ''
            ],
            [
                'id' => 4,
                'name' => 'Mother Edition',
                'note' => ''
            ],
            [
                'id' => 5,
                'name' => 'Item Satuan',
                'note' => ''
            ],
        );
        $product = array(
            [  
                'id' => 1,
                'status' => 1,
                'name' => 'Facial Wash Brightening',
                'slug' => 'facial-wash-brightening',
                'summary' => 'ringkasan facial wash brightening',
                'photo' => '',
                'product_type' => 1,
                'category_id' => 7,
                'min_order' => 1,
                'weight' => 10,
                'description' => 'testing deskripsi'
            ],
            [  
                'id' => 2,
                'status' => 1,
                'name' => 'Facial Wash Acne',
                'slug' => 'facial-wash-acne',
                'summary' => 'ringkasan facial wash acne',
                'photo' => '',
                'product_type' => 1,
                'category_id' => 7,
                'min_order' => 1,
                'weight' => 10,
                'description' => 'testing deskripsi'
            ],
        );

        foreach ($product as $key => $p) {
            if($p['product_type'] == 2){
                array_push($product_details,[
                    // 'product_group_id' => $p['id'],
                    'product_id' => 1,
                    'unit' => 'pcs',
                    'qty' => 1
                ]);

                array_push($product_details,[
                    // 'product_group_id' => $p['id'],
                    'product_id' => 3,
                    'unit' => 'pcs',
                    'qty' => 1
                ]);


            }

            array_push($prodcut_discounts,[
                'product_id' => $p['id'],
                'discount' => 5,
                'from' => date('y-m-d'),
                'to' => date('y-m-d')
            ]);
        }


        Product::insert($product);
        ProductDetail::insert($product_details);
        ProductDiscount::insert($prodcut_discounts);
        Category::insert($categories);
    }
}
