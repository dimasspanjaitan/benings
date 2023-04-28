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
                'name' => 'Facial Wash Brightening',
                'product_type' => 1,
                'category_id' => 7,
                'min_order' => 1,
                'unit_height' => 10,
                'note' => 'testing'
            ],
            [  
                'id' => 2,
                'name' => 'Facial Wash Acne',
                'product_type' => 1,
                'category_id' => 7,
                'min_order' => 1,
                'unit_height' => 10,
                'note' => 'testing'
            ],
            [  
                'id' => 3,
                'name' => 'Facial Wash Exclusive',
                'product_type' => 1,
                'category_id' => 7,
                'min_order' => 1,
                'unit_height' => 10,
                'note' => 'testing'
            ],
            [  
                'id' => 4,
                'name' => 'Toner Brightening',
                'product_type' => 1,
                'category_id' => 7,
                'min_order' => 1,
                'unit_height' => 10,
                'note' => 'testing'
            ],
            [  
                'id' => 5,
                'name' => 'Toner Acne',
                'product_type' => 1,
                'category_id' => 7,
                'min_order' => 1,
                'unit_height' => 10,
                'note' => 'testing'
            ],
            [  
                'id' => 6,
                'name' => 'Toner Exclusive',
                'product_type' => 1,
                'category_id' => 7,
                'min_order' => 1,
                'unit_height' => 10,
                'note' => 'testing'
            ],
            [  
                'id' => 7,
                'name' => 'Day Cream Brightening',
                'product_type' => 1,
                'category_id' => 7,
                'min_order' => 1,
                'unit_height' => 10,
                'note' => 'testing'
            ],
            [  
                'id' => 8,
                'name' => 'Day Cream Acne',
                'product_type' => 1,
                'category_id' => 7,
                'min_order' => 1,
                'unit_height' => 10,
                'note' => 'testing'
            ],
            [  
                'id' => 9,
                'name' => 'Day Cream Exclusive',
                'product_type' => 1,
                'category_id' => 7,
                'min_order' => 1,
                'unit_height' => 10,
                'note' => 'testing'
            ],
            [  
                'id' => 10,
                'name' => 'Night Cream Brightening',
                'product_type' => 1,
                'category_id' => 7,
                'min_order' => 1,
                'unit_height' => 10,
                'note' => 'testing'
            ],
            [  
                'id' => 11,
                'name' => 'Night Cream Acne',
                'product_type' => 1,
                'category_id' => 7,
                'min_order' => 1,
                'unit_height' => 10,
                'note' => 'testing'
            ],
            [  
                'id' => 12,
                'name' => 'Night Cream Exclusive',
                'product_type' => 1,
                'category_id' => 7,
                'min_order' => 1,
                'unit_height' => 10,
                'note' => 'testing'
            ],
            [  
                'id' => 13,
                'name' => 'Night Cream Brightening (BPOM)',
                'product_type' => 1,
                'category_id' => 7,
                'min_order' => 1,
                'unit_height' => 10,
                'note' => 'testing'
            ],
            [  
                'id' => 14,
                'name' => 'Night Cream Acne (BPOM)',
                'product_type' => 1,
                'category_id' => 7,
                'min_order' => 1,
                'unit_height' => 10,
                'note' => 'testing'
            ],
            [  
                'id' => 15,
                'name' => 'Night Cream Exclusive (BPOM)',
                'product_type' => 1,
                'category_id' => 7,
                'min_order' => 1,
                'unit_height' => 10,
                'note' => 'testing'
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
