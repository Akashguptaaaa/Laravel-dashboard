<?php

use Illuminate\Support\Facades\Route;
use App\Http\controllers\Category\CategoryController;
use App\Http\controllers\Product\ProductController;
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

Route::get('/', function () {
    return view('Dashboard.master');
});

  
    /*Category Route*/
    Route::controller(CategoryController::class)->group(function () {
		Route::get('view-category','index')->name('view.category');
		Route::get('add-category','create')->name('add.category');
		Route::post('store-category','store')->name('store.category');
		Route::get('edit-category/{id}','edit')->name('edit.category');
		Route::post('update-category','update')->name('update.category');
		Route::get('delete-category/{id}','destroy')->name('destroy.category');
		
	});
    /*Product Route*/
	Route::controller(ProductController::class)->group(function () {
		Route::get('view-product','index')->name('view.product');
		Route::get('add-product','create')->name('add.product');
		Route::post('store-product','store')->name('store.product');
		Route::get('edit-product/{id}','edit')->name('edit.product');
		Route::post('update-product','update')->name('update.product');
		Route::get('delete-product/{id}','destroy')->name('destroy.product');
		
	});
