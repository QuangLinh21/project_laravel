<?php

use Illuminate\Support\Facades\Route;

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

//frontend
Route::get('/', 'App\Http\Controllers\Homecontroller@index');
Route::get('/trang-chu', 'App\Http\Controllers\Homecontroller@index');

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