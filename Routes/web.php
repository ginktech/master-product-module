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

use Modules\MasterProduct\Http\Controllers\MasterProductController;
use Modules\MasterProduct\Http\Controllers\HelperController;
use Modules\MasterProduct\Http\Controllers\BrandController;
use Modules\MasterProduct\Http\Controllers\CategoryController;


Route::name('master-product.')->prefix('master-product')->group(function () {
    Route::get('/', [MasterProductController::class, 'index'])->name('index');
    Route::get('helpers/select2', [HelperController::class, 'select2'])->name('helpers.select2');
    Route::resource('brands', BrandController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
});
