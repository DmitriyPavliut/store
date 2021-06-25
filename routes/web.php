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

Auth::routes();

Route::get('/',[App\Http\Controllers\MainController::class, 'index'])->name('main');
Route::get('/catalog',[App\Http\Controllers\CatalogController::class, 'index'])->name('catalog');
Route::get('/cart',[App\Http\Controllers\CartController::class, 'index'])->name('cart');
Route::get('/catalog/{cat}', [App\Http\Controllers\CatalogController::class, 'showCategory'])->name('showCategory');
Route::get('/catalog/{cat}/{product_name}_{product_id}', [App\Http\Controllers\ProductController::class, 'show'])->name('showProduct');

Route::get('/sort',[App\Http\Controllers\AjaxController::class, 'sort']);

Route::middleware(['role:admin'])->prefix('admin')->group(function () {
    Route::get('/',[App\Http\Controllers\Admin\HomeController::class, 'index'])->name('homeAdmin');

    Route::resource('category', App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    Route::resource('product', App\Http\Controllers\Admin\ProductController::class);
});
