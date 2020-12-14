<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

use App\Category;

// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('/admin')->namespace('Admin')->group(function() {
	Route::match(['get' ,'post'] ,'/', 'AdminController@login');

	Route::group(['middleware' => ['admin']], function() {

        // DASHBOARD
        Route::get('dashboard', 'AdminController@dashboard');
        Route::get('logout', 'AdminController@logout');
        Route::get('settings', 'AdminController@settings');
        Route::post('check-admin-password', 'AdminController@checkAdminPassword');
        Route::post('update-admin-password', 'AdminController@updateAdminPassword');
        Route::match(['get', 'post'], 'update-admin-details', 'AdminController@updateAdminDetails');

        // SECTIONS
        Route::get('sections', 'SectionController@sections');
        Route::post('update-section-status', 'SectionController@updateSectionStatus');

        // BRANDS
        Route::get('brands', 'BrandController@brands');
        Route::match(['get', 'post'], 'add-edit-brand/{id?}', 'BrandController@addEditBrand');
        Route::post('update-brand-status', 'BrandController@updateBrandStatus');
        Route::get('delete-brand/{id}', 'BrandController@deleteBrand');
		
        // CATEGORIES
		Route::get('categories', 'CategoryController@categories');
        Route::post('update-category-status', 'CategoryController@updateCategoryStatus');
		Route::match(['get', 'post'], 'add-edit-category/{id?}', 'CategoryController@addEditCategory');
        Route::post('append-categories-level', 'CategoryController@appendCategoryLevel');
        Route::get('delete-category-image/{id}', 'CategoryController@deleteCategoryImage');
        Route::get('delete-category/{id}', 'CategoryController@deleteCategory');

        // PRODUCTS
        Route::get('products', 'ProductController@products');
        Route::post('update-product-status', 'ProductController@updateProductStatus');
        Route::match(['get', 'post'], 'add-edit-product/{id?}', 'ProductController@addEditProduct');
        Route::get('delete-product/{id}', 'ProductController@deleteProduct');
        Route::get('delete-product-image/{id}', 'ProductController@deleteProductImage');
        Route::get('delete-product-video/{id}', 'ProductController@deleteProductVideo');

        // PRODUCTS ATTRIBUTES
        Route::match(['get', 'post'], 'add-attributes/{id}', 'ProductController@addAttributes');
        Route::post('edit-attributes/{id}', 'ProductController@editAttributes');
        Route::post('update-attribute-status', 'ProductController@updateAttributeStatus');
        Route::get('delete-attribute/{id}', 'ProductController@deleteAttribute');

        // PRODUCTS IMAGES
        Route::match(['get', 'post'], 'add-images/{id}', 'ProductController@addImages');
        Route::post('update-image-status', 'ProductController@updateImageStatus');
        Route::get('delete-image/{id}', 'ProductController@deleteImage');

        // BANNERS
        Route::get('banners', 'BannerController@banners');
        Route::post('update-banner-status', 'BannerController@updateBannerStatus');
        Route::match(['get', 'post'], 'add-edit-banner/{id?}', 'BannerController@addEditBanner');
        Route::get('delete-banner/{id}', 'BannerController@deleteBanner');
    });
});

Route::namespace('Front')->group(function() {

    // HOMEPAGE
    Route::get('/', 'IndexController@index');

    // LISTING / CATEGORIES
    $catURLs = Category::select('url')->where('status', 1)->get()->pluck('url')->toArray();
    foreach($catURLs as $url) {
        Route::get('/'.$url, 'ProductController@listing');
    }

    // PRODUCT DETAILS
    Route::get('product/{id}', 'ProductController@productDetails');
    Route::post('get-product-price-stock', 'ProductController@getProductPriceStock');
    Route::post('add-to-cart', 'ProductController@addToCart');
    Route::get('cart', 'ProductController@cart');
    Route::post('update-cart-item-quantity', 'ProductController@updateCartItemQuantity');
    Route::post('delete-cart-item', 'ProductController@deleteCartItem');

    // USERS
    Route::get('login-register', 'UserController@loginRegister');
    Route::post('register', 'UserController@registerUser');    
    Route::post('login', 'UserController@loginUser');
    Route::get('logout', 'UserController@logoutUser');
    Route::match(['get', 'post'], 'check-email', 'UserController@checkEmail');
});