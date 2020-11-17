<?php

use Illuminate\Database\Seeder;
use App\Admin;
use App\Section;
use App\Category;
use App\Product;

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
            ['id' => 1, 'category_id' => 4, 'section_id' => 1, 'product_name' => 'Green Casual T-Shirt', 'product_code' => 'GR001', 
            'product_color' => 'green', 'product_price' => '1600', 'product_discount' => 10, 'product_weight' => 200, 'product_video' => '', 
            'main_image' => '', 'description' => 'Test product', 'wash_care' => '', 'fabric' => '', 'pattern' => '', 'sleeve' => '', 'fit' => '', 
            'occasion' => '', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'is_featured' => 'No', 'status' => 1
            ]
        );
        \App\Product::factory()->create(
            ['id' => 2, 'category_id' => 4, 'section_id' => 1, 'product_name' => 'Blue Casual T-Shirt', 'product_code' => 'BL001', 
            'product_color' => 'blue', 'product_price' => '1300', 'product_discount' => 10, 'product_weight' => 250, 'product_video' => '', 
            'main_image' => '', 'description' => 'Test product', 'wash_care' => '', 'fabric' => '', 'pattern' => '', 'sleeve' => '', 'fit' => '', 
            'occasion' => '', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'is_featured' => 'Yes', 'status' => 1
            ]
        );
    }
}


