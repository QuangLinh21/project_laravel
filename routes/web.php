<?php

use Illuminate\Support\Facades\Route;


//frontend
Route::get('/', 'App\Http\Controllers\Homecontroller@index');
Route::get('/trang-chu', 'App\Http\Controllers\Homecontroller@index');
//tìm kiếm sp
Route::post('/search', 'App\Http\Controllers\Homecontroller@search_product');

//danh mục sp trang chủ
Route::get('/category-product-user/{category_id}', 'App\Http\Controllers\CategoryProduct@show_category_user');

//thương hiệu sản phẩm
Route::get('/brand-product-user/{category_id}', 'App\Http\Controllers\BrandProduct@show_brand_user');
//chi tiet sp
Route::get('/product-details/{product_id}', 'App\Http\Controllers\ProductController@product_details');
//add-to cart
Route::post('/save-cart', 'App\Http\Controllers\CartController@add_to_cart');
Route::post('/add-cart-ajax', 'App\Http\Controllers\CartController@add_cart_ajax');
Route::get('/giohang', 'App\Http\Controllers\CartController@giohang');
Route::get('/cart-product', 'App\Http\Controllers\CartController@show_cart');
Route::get('/delete-to-cart/{rowId}', 'App\Http\Controllers\CartController@delete_to_cart');
Route::post('/update-cart-quantity', 'App\Http\Controllers\CartController@update_cart_quantity');

//backend 
Route::get('/admin', 'App\Http\Controllers\Admincontroller@index');
Route::get('/dashboard', 'App\Http\Controllers\Admincontroller@show_dashboard');
Route::get('/logout', 'App\Http\Controllers\Admincontroller@logout');
Route::post('/admin_dashboard', 'App\Http\Controllers\Admincontroller@dashboard');

//category product 
Route::get('/add-category-product', 'App\Http\Controllers\CategoryProduct@add_category');
Route::get('/all-category-product', 'App\Http\Controllers\CategoryProduct@all_category');
Route::get('/edit-category-product/{category_id}', 'App\Http\Controllers\CategoryProduct@edit_category');
Route::post('/update-category-product/{category_id}', 'App\Http\Controllers\CategoryProduct@update_category');
Route::get('/delete-category-product/{category_id}', 'App\Http\Controllers\CategoryProduct@remove_category');
Route::post('/save-category-product', 'App\Http\Controllers\CategoryProduct@save_category');
Route::get('/unactive-category/{category_id}', 'App\Http\Controllers\CategoryProduct@unactive_category');
Route::get('/active-category/{category_id}', 'App\Http\Controllers\CategoryProduct@active_category');

//brand products
Route::get('/add-brand-product', 'App\Http\Controllers\BrandProduct@add_brand');
Route::get('/all-brand-product', 'App\Http\Controllers\BrandProduct@all_brand');
Route::get('/edit-brand-product/{brand_id}', 'App\Http\Controllers\BrandProduct@edit_brand');
Route::post('/update-brand-product/{brand_id}', 'App\Http\Controllers\BrandProduct@update_brand');
Route::get('/delete-brand-product/{brand_id}', 'App\Http\Controllers\BrandProduct@remove_brand');
Route::post('/save-brand-product', 'App\Http\Controllers\BrandProduct@save_brand');
Route::get('/unactive-brand/{brand_id}', 'App\Http\Controllers\BrandProduct@unactive_brand');
Route::get('/active-brand/{brand_id}', 'App\Http\Controllers\BrandProduct@active_brand');

//product 
Route::get('/add-product','App\Http\Controllers\ProductController@add_product');
Route::get('/all-product','App\Http\Controllers\ProductController@all_product');
Route::post('/save-product','App\Http\Controllers\ProductController@save_product');
Route::get('/edit-product/{product_id}', 'App\Http\Controllers\ProductController@edit_product');
Route::post('/update-product/{product_id}', 'App\Http\Controllers\ProductController@update_product');
Route::get('/delete-product/{product_id}', 'App\Http\Controllers\ProductController@remove_product');
Route::get('/unactive-product/{product_id}', 'App\Http\Controllers\ProductController@unactive_product');
Route::get('/active-product/{product_id}', 'App\Http\Controllers\ProductController@active_product');

//checkout 
Route::get('/login-checkout', 'App\Http\Controllers\CheckoutController@login_checkout');
Route::post('/add-customer', 'App\Http\Controllers\CheckoutController@add_customer');
Route::post('/login-customer', 'App\Http\Controllers\CheckoutController@login_customer');
Route::get('/checkout', 'App\Http\Controllers\CheckoutController@checkout');

//payment
Route::get('/payment', 'App\Http\Controllers\PaymentController@show_payment');
Route::get('/end-payment', 'App\Http\Controllers\PaymentController@end_payment');
Route::get('/delete-address-ship/{shipping_id}', 'App\Http\Controllers\PaymentController@delete_address_ship');
Route::post('/info-payment-product', 'App\Http\Controllers\PaymentController@info_payment_product');
Route::post('/oder-product', 'App\Http\Controllers\PaymentController@order_product');

//admin-order 
Route::get('/manager-order', 'App\Http\Controllers\PaymentController@manager_order');
Route::get('/view-order/{order_id}', 'App\Http\Controllers\PaymentController@view_order');

//send mail 
Route::get('/send-email', 'App\Http\Controllers\Homecontroller@send_mail');