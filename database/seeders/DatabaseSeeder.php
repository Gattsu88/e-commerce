<?php

use Illuminate\Database\Seeder;
use App\Admin;
use App\Section;
use App\Category;
use App\Product;
use App\ProductsAttribute;
use App\ProductsImage;

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
            ['id' => 3, 'name' => 'Kids', 'status' => 1]
        );

        \App\Brand::factory()->create(
            ['id' => 1, 'name' => 'Everlane', 'status' => 1]
        );
        \App\Brand::factory()->create(
            ['id' => 2, 'name' => 'James Perse', 'status' => 1]
        );
        \App\Brand::factory()->create(
            ['id' => 3, 'name' => 'Carhartt', 'status' => 0]
        );
        \App\Brand::factory()->create(
            ['id' => 4, 'name' => 'Brooklinen', 'status' => 0]
        );
        \App\Brand::factory()->create(
            ['id' => 5, 'name' => 'Uniqlo', 'status' => 0]
        );

        \App\Category::factory()->create(
            ['id' => 1, 'parent_id' => 0, 'section_id' => 1, 'category_name' => 'T-Shirts', 'category_image' => '', 'category_discount' => 0, 'description' => '', 'url' => 't-shirts', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'status' => 1]
        );
        \App\Category::factory()->create(
            ['id' => 2, 'parent_id' => 1, 'section_id' => 1, 'category_name' => 'Casual T-Shirts', 'category_image' => '', 'category_discount' => 0, 'description' => '', 'url' => 'casual-t-shirts', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'status' => 1]
        );
        \App\Category::factory()->create(
            ['id' => 3, 'parent_id' => 1, 'section_id' => 1, 'category_name' => 'Formal T-Shirts', 'category_image' => '', 'category_discount' => 0, 'description' => '', 'url' => 'formal-t-shirts', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'status' => 1]
        );
        \App\Category::factory()->create(
            ['id' => 4, 'parent_id' => 0, 'section_id' => 1, 'category_name' => 'Denims', 'category_image' => '', 'category_discount' => 0, 'description' => '', 'url' => 'denims', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'status' => 1]
        );
        \App\Category::factory()->create(
            ['id' => 5, 'parent_id' => 4, 'section_id' => 1, 'category_name' => 'Partywear Denims', 'category_image' => '', 'category_discount' => 0, 'description' => '', 'url' => 'partywear denims', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'status' => 1]
        );
        \App\Category::factory()->create(
            ['id' => 6, 'parent_id' => 0, 'section_id' => 2, 'category_name' => 'Tops', 'category_image' => '', 'category_discount' => 0, 'description' => '', 'url' => 'tops', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'status' => 1]
        );
        \App\Category::factory()->create(
            ['id' => 7, 'parent_id' => 6, 'section_id' => 2, 'category_name' => 'Casual Tops', 'category_image' => '', 'category_discount' => 0, 'description' => '', 'url' => 'casual tops', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'status' => 1]
        );
        \App\Category::factory()->create(
            ['id' => 8, 'parent_id' => 6, 'section_id' => 2, 'category_name' => 'Formal Tops', 'category_image' => '', 'category_discount' => 0, 'description' => '', 'url' => 'formal tops', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'status' => 1]
        );

        \App\Product::factory()->create(
            ['id' => 1, 'section_id' => 1, 'brand_id' => 1,'category_id' => 2, 'product_name' => 'Green Casual T-Shirt', 'product_code' => 'GCT01', 
            'product_color' => 'Green', 'product_price' => '1600', 'product_discount' => 10, 'product_weight' => 200, 'product_video' => '', 
            'main_image' => 'green-t-shirt -1.jpg-68467.jpg', 'description' => 'Test product', 'wash_care' => '', 'fabric' => '', 
            'pattern' => '', 'sleeve' => '', 'fit' => '', 'occasion' => '', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 
            'is_featured' => 'No', 'status' => 1
            ]
        );
        \App\Product::factory()->create(
            ['id' => 2, 'section_id' => 1, 'brand_id' => 2, 'category_id' => 3, 'product_name' => 'Blue Formal T-Shirt', 'product_code' => 'BFT01', 
            'product_color' => 'Blue', 'product_price' => '1300', 'product_discount' => 10, 'product_weight' => 250, 'product_video' => '', 
            'main_image' => 'blue-t-shirt -1.jpg-59696.jpg', 'description' => 'Test product', 'wash_care' => '', 'fabric' => '', 
            'pattern' => '', 'sleeve' => '', 'fit' => '', 'occasion' => '', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 
            'is_featured' => 'Yes', 'status' => 1
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
        \App\ProductsAttribute::factory()->create(
            ['id' => 4, 'product_id' => 2, 'size' => 'Small', 'price' => 1250, 'stock' => 10, 'sku' => 'BFT01-S', 'status' => 1]
        );
        \App\ProductsAttribute::factory()->create(
            ['id' => 5, 'product_id' => 2, 'size' => 'Medium', 'price' => 1400, 'stock' => 25, 'sku' => 'BFT01-M', 'status' => 1]
        );
        \App\ProductsAttribute::factory()->create(
            ['id' => 6, 'product_id' => 2, 'size' => 'Large', 'price' => 1550, 'stock' => 20, 'sku' => 'BFT01-L', 'status' => 1]
        );
        \App\ProductsAttribute::factory()->create(
            ['id' => 7, 'product_id' => 2, 'size' => 'Extra Large', 'price' => 1700, 'stock' => 15, 'sku' => 'BFT01-XL', 'status' => 1]
        );

        \App\ProductsImage::factory()->create(
            ['id' => 1, 'product_id' => 1, 'image' => '3572161606499567.jpg', 'status' => 1]
        );
        \App\ProductsImage::factory()->create(
            ['id' => 2, 'product_id' => 1, 'image' => '9069481606499567.jpg', 'status' => 1]
        );
        \App\ProductsImage::factory()->create(
            ['id' => 3, 'product_id' => 2, 'image' => '5111651606499607.jpg', 'status' => 1]
        );
        \App\ProductsImage::factory()->create(
            ['id' => 4, 'product_id' => 2, 'image' => '2372301606499607.jpg', 'status' => 1]
        );
        \App\ProductsImage::factory()->create(
            ['id' => 5, 'product_id' => 2, 'image' => '4651821606499607.jpg', 'status' => 1]
        );
    }
}


