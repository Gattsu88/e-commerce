<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productRecords = [
            ['id' => 1, 'category_id' => 4, 'section_id' => 1, 'product_name' => 'Green Casual T-Shirt', 'product_code' => 'GR001', 
            'product_color' => 'green', 'product_price' => '1600', 'product_discount' => 10, 'product_weight' => 200, 'product_video' => '', 
            'main_image' => '', 'description' => 'Test product', 'wash_care' => '', 'fabric' => '', 'pattern' => '', 'sleeve' => '', 'fit' => '', 
            'occasion' => '', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'is_featured' => 'No', 'status' => 1
            ],
            ['id' => 2, 'category_id' => 4, 'section_id' => 1, 'product_name' => 'Blue Casual T-Shirt', 'product_code' => 'BL001', 
            'product_color' => 'blue', 'product_price' => '1300', 'product_discount' => 10, 'product_weight' => 250, 'product_video' => '', 
            'main_image' => '', 'description' => 'Test product', 'wash_care' => '', 'fabric' => '', 'pattern' => '', 'sleeve' => '', 'fit' => '', 
            'occasion' => '', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'is_featured' => 'Yes', 'status' => 1
            ]
        ];

        Product::insert($productRecords);
    }
}
