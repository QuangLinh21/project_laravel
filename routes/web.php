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
Route::post('/save-category-product', 'App\Http\Controllers\CategoryProduct@save_category');
Route::post('/unactive-category/{category_id}', 'App\Http\Controllers\CategoryProduct@unactive_category');
Route::post('/active-category/{category_id}', 'App\Http\Controllers\CategoryProduct@active_category');