<?php

use Illuminate\Database\Seeder;
use App\Admin;
use App\Section;
use App\Category;
use App\Product;
use App\ProductsAttribute;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Admin::factory()->create(
            ['id' => 1, 'name' => 'gattsu', 'type' => 'admin', 'mobile' => '0641234567', 'email' => 'gattsu@gmail.com',
                'password' => '$2y$10$mamhAQHIPK92I9vxxTYB/eG0PVsv1hY7M34ge/MRC5aDV2upTbIee', 'image' => '', 'status' => 1]
        );
        \App\Admin::factory()->create(
            ['id' => 2, 'name' => 'user2', 'type' => 'subadmin', 'mobile' => '0641234567', 'email' => 'user2@gmail.com',
                'password' => '$2y$10$mamhAQHIPK92I9vxxTYB/eG0PVsv1hY7M34ge/MRC5aDV2upTbIee', 'image' => '', 'status' => 1]
        );
        \App\Admin::factory()->create(
            ['id' => 3, 'name' => 'user3', 'type' => 'subadmin', 'mobile' => '0641234567', 'email' => 'user3@gmail.com',
                'password' => '$2y$10$mamhAQHIPK92I9vxxTYB/eG0PVsv1hY7M34ge/MRC5aDV2upTbIee', 'image' => '', 'status' => 1]
        );
        \App\Admin::factory()->create(
            ['id' => 4, 'name' => 'user4', 'type' => 'admin', 'mobile' => '0641234567', 'email' => 'user4@gmail.com',
                'password' => '$2y$10$mamhAQHIPK92I9vxxTYB/eG0PVsv1hY7M34ge/MRC5aDV2upTbIee', 'image' => '', 'status' => 1]
        );

        \App\Section::factory()->create(
            ['id' => 1, 'name' => 'Men', 'status' => 1]
        );
        \App\Section::factory()->create(
            ['id' => 2, 'name' => 'Women', 'status' => 1]
        );
        \App\Section::factory()->create(
            ['id' => 3, 'name' => 'Kids', 'status' => 0]
        );

        \App\Category::factory()->create(
            ['id' => 1, 'parent_id' => 0, 'section_id' => 1, 'category_name' => 'T-Shirts', 'category_image' => '', 'category_discount' => 0, 'description' => '', 'url' => 't-shirts', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'status' => 1]
        );
        \App\Category::factory()->create(
            ['id' => 2, 'parent_id' => 1, 'section_id' => 1, 'category_name' => 'Casual T-Shirts', 'category_image' => '', 'category_discount' => 0, 'description' => '', 'url' => 'casual-t-shirts', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'status' => 1]
        );

        \App\Product::factory()->create(
            ['id' => 1, 'category_id' => 1, 'section_id' => 1, 'product_name' => 'Green Casual T-Shirt', 'product_code' => 'GCT01', 
            'product_color' => 'Green', 'product_price' => '1600', 'product_discount' => 10, 'product_weight' => 200, 'product_video' => '', 
            'main_image' => '', 'description' => 'Test product', 'wash_care' => '', 'fabric' => '', 'pattern' => '', 'sleeve' => '', 'fit' => '', 
            'occasion' => '', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'is_featured' => 'No', 'status' => 1
            ]
        );
        \App\Product::factory()->create(
            ['id' => 2, 'category_id' => 2, 'section_id' => 1, 'product_name' => 'Blue Formal T-Shirt', 'product_code' => 'BFT01', 
            'product_color' => 'Blue', 'product_price' => '1300', 'product_discount' => 10, 'product_weight' => 250, 'product_video' => '', 
            'main_image' => '', 'description' => 'Test product', 'wash_care' => '', 'fabric' => '', 'pattern' => '', 'sleeve' => '', 'fit' => '', 
            'occasion' => '', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'is_featured' => 'Yes', 'status' => 1
            ]
        );

        \App\ProductsAttribute::factory()->create(
            ['id' => 1, 'product_id' => 1, 'size' => 'Small', 'price' => 1200, 'stock' => 15, 'sku' => 'GCT01-S', 'status' => 1]
        );
        \App\ProductsAttribute::factory()->create(
            ['id' => 2, 'product_id' => 1, 'size' => 'Medium', 'price' => 1300, 'stock' => 20, 'sku' => 'GCT01-M', 'status' => 1]
        );
        \App\ProductsAttribute::factory()->create(
            ['id' => 3, 'product_id' => 1, 'size' => 'Large', 'price' => 1400, 'stock' => 10, 'sku' => 'GCT01-L', 'status' => 1]
        );
    }
}


