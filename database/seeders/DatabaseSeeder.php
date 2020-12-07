<?php

use Illuminate\Database\Seeder;
use App\Admin;
use App\Section;
use App\Category;
use App\Product;
use App\ProductsAttribute;
use App\ProductsImage;
use App\Banner;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // ADMINS
        \App\Admin::factory()->create(
            ['id' => 1, 'name' => 'gattsu', 'type' => 'admin', 'mobile' => '0641234567', 'email' => 'gattsu@gmail.com',
                'password' => '$2y$10$mamhAQHIPK92I9vxxTYB/eG0PVsv1hY7M34ge/MRC5aDV2upTbIee', 'image' => '25918.png', 'status' => 1]
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

        // SECTIONS
        \App\Section::factory()->create(
            ['id' => 1, 'name' => 'Men', 'status' => 1]
        );
        \App\Section::factory()->create(
            ['id' => 2, 'name' => 'Women', 'status' => 1]
        );
        \App\Section::factory()->create(
            ['id' => 3, 'name' => 'Kids', 'status' => 1]
        );

        // BRANDS
        \App\Brand::factory()->create(
            ['id' => 1, 'name' => 'Everlane', 'status' => 1]
        );
        \App\Brand::factory()->create(
            ['id' => 2, 'name' => 'James Perse', 'status' => 1]
        );
        \App\Brand::factory()->create(
            ['id' => 3, 'name' => 'Carhartt', 'status' => 1]
        );
        \App\Brand::factory()->create(
            ['id' => 4, 'name' => 'Brooklinen', 'status' => 1]
        );
        \App\Brand::factory()->create(
            ['id' => 5, 'name' => 'Uniqlo', 'status' => 0]
        );

        // MEN CATEGORIES
        \App\Category::factory()->create(
            ['id' => 1, 'parent_id' => 0, 'section_id' => 1, 'category_name' => 'T-Shirts', 'category_image' => '', 'category_discount' => 0, 'description' => 'T-Shirts category with various brands.', 'url' => 't-shirts', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'status' => 1]
        );
        \App\Category::factory()->create(
            ['id' => 2, 'parent_id' => 1, 'section_id' => 1, 'category_name' => 'Casual T-Shirts', 'category_image' => '', 'category_discount' => 10, 'description' => 'Casual T-Shirts category with various brands.', 'url' => 'casual-t-shirts', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'status' => 1]
        );
        \App\Category::factory()->create(
            ['id' => 3, 'parent_id' => 1, 'section_id' => 1, 'category_name' => 'Formal T-Shirts', 'category_image' => '', 'category_discount' => 0, 'description' => 'Formal T-Shirts category with various brands.', 'url' => 'formal-t-shirts', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'status' => 1]
        );
        \App\Category::factory()->create(
            ['id' => 4, 'parent_id' => 0, 'section_id' => 1, 'category_name' => 'Denims', 'category_image' => '', 'category_discount' => 0, 'description' => 'Denims category with various brands.', 'url' => 'denims', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'status' => 0]
        );
        \App\Category::factory()->create(
            ['id' => 5, 'parent_id' => 4, 'section_id' => 1, 'category_name' => 'Partywear Denims', 'category_image' => '', 'category_discount' => 0, 'description' => 'Partywear Denims category with various brands.', 'url' => 'partywear denims', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'status' => 0]
        );
        // WOMEN CATEGORIES
        \App\Category::factory()->create(
            ['id' => 6, 'parent_id' => 0, 'section_id' => 2, 'category_name' => 'Dresses', 'category_image' => '', 'category_discount' => 0, 'description' => 'Dresses category with various brands.', 'url' => 'dresses', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'status' => 1]
        );
        \App\Category::factory()->create(
            ['id' => 7, 'parent_id' => 0, 'section_id' => 2, 'category_name' => 'Tops', 'category_image' => '', 'category_discount' => 0, 'description' => 'Tops category with various brands.', 'url' => 'tops', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'status' => 0]
        );
        \App\Category::factory()->create(
            ['id' => 8, 'parent_id' => 7, 'section_id' => 2, 'category_name' => 'Casual Tops', 'category_image' => '', 'category_discount' => 0, 'description' => 'Casual Tops category with various brands.', 'url' => 'casual tops', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'status' => 0]
        );
        \App\Category::factory()->create(
            ['id' => 9, 'parent_id' => 7, 'section_id' => 2, 'category_name' => 'Formal Tops', 'category_image' => '', 'category_discount' => 0, 'description' => 'Formal Tops category with various brands.', 'url' => 'formal tops', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'status' => 0]
        );

        // BANNERS
        \App\Banner::factory()->create(
            ['id' => 1, 'image' => 'banner-1.png', 'link' => '', 'title' => 'Black Jacket', 'alt' => 'Black Jacket', 'status' => 1]
        );
        \App\Banner::factory()->create(
            ['id' => 2, 'image' => 'banner-2.png', 'link' => '', 'title' => 'Half Sleeve T-Shirt', 'alt' => 'Half Sleeve T-Shirt', 'status' => 1]
        );
        \App\Banner::factory()->create(
            ['id' => 3, 'image' => 'banner-3.png', 'link' => '', 'title' => 'Full Sleeve T-Shirt', 'alt' => 'Full Sleeve T-Shirt', 'status' => 1]
        );

        // PRODUCTS
        \App\Product::factory()->create(
            ['id' => 1, 'section_id' => 1, 'brand_id' => 1,'category_id' => 2, 'product_name' => 'Green Casual T-Shirt', 'product_code' => 'GCT01', 
            'product_color' => 'Green', 'product_price' => '1200', 'product_discount' => 10, 'product_weight' => 200, 'product_video' => '', 
            'main_image' => 'green-t-shirt -1.jpg-68467.jpg', 'description' => 'Lorem ipsum dolor sit amet, cum id nemore quodsi insolens, labore aperiri ne usu. Ne quem mutat delicata pro, mea probo utamur necessitatibus ne. In alia wisi etiam cum. Ei tantas ullamcorper pro. Vero constituto sea id, ut qui nonumes percipit.', 'wash_care' => '', 'fabric' => 'Cotton', 
            'pattern' => '', 'sleeve' => '', 'fit' => '', 'occasion' => 'Casual', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 
            'is_featured' => 'Yes', 'status' => 1
            ]
        );
        \App\Product::factory()->create(
            ['id' => 2, 'section_id' => 1, 'brand_id' => 2, 'category_id' => 3, 'product_name' => 'Blue Formal T-Shirt', 'product_code' => 'BFT01', 
            'product_color' => 'Blue', 'product_price' => '1250', 'product_discount' => 0, 'product_weight' => 250, 'product_video' => '', 
            'main_image' => 'blue-t-shirt -1.jpg-59696.jpg', 'description' => 'Eu cum euismod comprehensam, ei mei laboramus disputando repudiandae. Dico habeo euripidis ea vis. His cu vide verear, tollit lucilius perfecto et eum. Prodesset deseruisse ad vix. Omnis causae officiis sit eu. Cum eu legimus molestiae omittantur.', 'wash_care' => '', 'fabric' => 'Polyester', 
            'pattern' => '', 'sleeve' => '', 'fit' => '', 'occasion' => 'Formal', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 
            'is_featured' => 'Yes', 'status' => 1
            ]
        );
        \App\Product::factory()->create(
            ['id' => 3, 'section_id' => 2, 'brand_id' => 3, 'category_id' => 6, 'product_name' => 'Stars Dress', 'product_code' => 'BSD01', 
            'product_color' => 'Blue', 'product_price' => '1700', 'product_discount' => 0, 'product_weight' => 250, 'product_video' => '', 
            'main_image' => 'dress-1-1.jpg-12226.jpg', 'description' => 'Labore aliquando reprehendunt nam cu, quod case intellegam duo ex. Zril nostrum erroribus nam ut, has ea option sanctus. Mazim noluisse ad mel, ad pri tota dictas recteque. Eum vidit maiestatis mnesarchum ei, tota pericula usu et.', 'wash_care' => '', 'fabric' => '', 
            'pattern' => '', 'sleeve' => '', 'fit' => '', 'occasion' => 'Casual', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 
            'is_featured' => 'No', 'status' => 1
            ]
        );
        \App\Product::factory()->create(
            ['id' => 4, 'section_id' => 2, 'brand_id' => 3, 'category_id' => 6, 'product_name' => 'Graphic Dress', 'product_code' => 'BGD01', 
            'product_color' => 'Black', 'product_price' => '1900', 'product_discount' => 0, 'product_weight' => 240, 'product_video' => '', 
            'main_image' => 'dress-2-1.jpg-71796.jpg', 'description' => 'Sed purto noster in. Tamquam cotidieque quo id, ea nam mundi vituperatoribus, sed iusto iuvaret ei. Cum delicata constituam te. Id eos facer apeirian, pro sumo saepe conceptam et. Eos iisque iracundia signiferumque an.', 'wash_care' => '', 'fabric' => '', 
            'pattern' => '', 'sleeve' => '', 'fit' => '', 'occasion' => 'Casual', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 
            'is_featured' => 'Yes', 'status' => 1
            ]
        );
        \App\Product::factory()->create(
            ['id' => 5, 'section_id' => 2, 'brand_id' => 4, 'category_id' => 6, 'product_name' => 'Nocturne Dress', 'product_code' => 'GND01', 
            'product_color' => 'Green', 'product_price' => '1800', 'product_discount' => 0, 'product_weight' => 220, 'product_video' => '', 
            'main_image' => 'dress-3-1.jpg-37759.jpg', 'description' => 'Quas regione accommodare mea te. Sea diam nihil consequat eu, eam senserit necessitatibus te. Laoreet gubergren per ex. In per iisque dolores volutpat. Dicat voluptatum mea ad, harum saepe delicatissimi pro te.', 'wash_care' => '', 'fabric' => '', 
            'pattern' => '', 'sleeve' => '', 'fit' => '', 'occasion' => 'Casual', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 
            'is_featured' => 'Yes', 'status' => 1
            ]
        );
        \App\Product::factory()->create(
            ['id' => 6, 'section_id' => 2, 'brand_id' => 4, 'category_id' => 6, 'product_name' => 'Whimsy Dress', 'product_code' => 'MWD01', 
            'product_color' => 'Multicolor', 'product_price' => '2000', 'product_discount' => 0, 'product_weight' => 230, 'product_video' => '', 
            'main_image' => 'dress-4-1.jpg-35544.jpg', 'description' => 'Ne nam philosophia theophrastus, errem decore equidem id usu. Suas atomorum definiebas ne mel, aeterno invidunt abhorreant per ex.', 'wash_care' => '', 'fabric' => '', 
            'pattern' => '', 'sleeve' => '', 'fit' => '', 'occasion' => 'Casual', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 
            'is_featured' => 'Yes', 'status' => 1
            ]
        );
        \App\Product::factory()->create(
            ['id' => 7, 'section_id' => 1, 'brand_id' => 2,'category_id' => 2, 'product_name' => 'Red Casual T-Shirt', 'product_code' => 'RCT01', 
            'product_color' => 'Red', 'product_price' => '1750', 'product_discount' => 0, 'product_weight' => 220, 'product_video' => '', 
            'main_image' => 'red-casual-t-shirt-1.jpg-4497.jpg', 'description' => 'Ius ne viderer democritum, aliquando democritum usu ut, pro no meliore nominavi. Utinam dolore blandit te est, simul mucius admodum quo et, sensibus iracundia cum cu.', 'wash_care' => '', 'fabric' => 'Polyester', 
            'pattern' => '', 'sleeve' => '', 'fit' => '', 'occasion' => 'Casual', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 
            'is_featured' => 'No', 'status' => 1
            ]
        );
        \App\Product::factory()->create(
            ['id' => 8, 'section_id' => 1, 'brand_id' => 1,'category_id' => 3, 'product_name' => 'Yellow Formal T-Shirt', 'product_code' => 'YFT01', 
            'product_color' => 'Yellow', 'product_price' => '1950', 'product_discount' => 10, 'product_weight' => 240, 'product_video' => '', 
            'main_image' => 'yellow-formal-t-shirt-1.jpg-18228.jpg', 'description' => 'Vidit utamur forensibus te pro. Mollis platonem recteque mel ea, assum intellegat omittantur te vim. Prompta erroribus liberavisse et ius, ad quo assum consul.', 'wash_care' => '', 'fabric' => 'Cotton', 
            'pattern' => '', 'sleeve' => '', 'fit' => '', 'occasion' => 'Formal', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 
            'is_featured' => 'Yes', 'status' => 1
            ]
        );

        // PRODUCTS ATTRIBUTES
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
        \App\ProductsAttribute::factory()->create(
            ['id' => 8, 'product_id' => 3, 'size' => 'Small', 'price' => 1700, 'stock' => 15, 'sku' => 'BSD01-S', 'status' => 1]
        );
        \App\ProductsAttribute::factory()->create(
            ['id' => 9, 'product_id' => 4, 'size' => 'Small', 'price' => 1900, 'stock' => 10, 'sku' => 'BGD01-S', 'status' => 1]
        );
        \App\ProductsAttribute::factory()->create(
            ['id' => 10, 'product_id' => 5, 'size' => 'Small', 'price' => 1800, 'stock' => 20, 'sku' => 'GND01-S', 'status' => 1]
        );
        \App\ProductsAttribute::factory()->create(
            ['id' => 11, 'product_id' => 6, 'size' => 'Small', 'price' => 2000, 'stock' => 25, 'sku' => 'MWD01-S', 'status' => 1]
        );

        // PRODUCTS IMAGES
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
        \App\ProductsImage::factory()->create(
            ['id' => 6, 'product_id' => 3, 'image' => '9776811606757011.jpg', 'status' => 1]
        );
        \App\ProductsImage::factory()->create(
            ['id' => 7, 'product_id' => 3, 'image' => '437091606757011.jpg', 'status' => 1]
        );
        \App\ProductsImage::factory()->create(
            ['id' => 8, 'product_id' => 4, 'image' => '4483401606757026.jpg', 'status' => 1]
        );
        \App\ProductsImage::factory()->create(
            ['id' => 9, 'product_id' => 4, 'image' => '6940501606757027.jpg', 'status' => 1]
        );
        \App\ProductsImage::factory()->create(
            ['id' => 10, 'product_id' => 5, 'image' => '4554451606757039.jpg', 'status' => 1]
        );
        \App\ProductsImage::factory()->create(
            ['id' => 11, 'product_id' => 5, 'image' => '6126091606757039.jpg', 'status' => 1]
        );
        \App\ProductsImage::factory()->create(
            ['id' => 12, 'product_id' => 6, 'image' => '8490651606757053.jpg', 'status' => 1]
        );
        \App\ProductsImage::factory()->create(
            ['id' => 13, 'product_id' => 6, 'image' => '8366621606757053.jpg', 'status' => 1]
        );
        \App\ProductsImage::factory()->create(
            ['id' => 14, 'product_id' => 7, 'image' => '1172561606763073.jpg', 'status' => 1]
        );
        \App\ProductsImage::factory()->create(
            ['id' => 15, 'product_id' => 7, 'image' => '6098241606763074.jpg', 'status' => 1]
        );
        \App\ProductsImage::factory()->create(
            ['id' => 16, 'product_id' => 8, 'image' => '7740411606763112.jpg', 'status' => 1]
        );
        \App\ProductsImage::factory()->create(
            ['id' => 17, 'product_id' => 8, 'image' => '2280631606763112.jpg', 'status' => 1]
        );
    }
}


