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

Route::get('/',[App\Http\Controllers\MainController::class, 'index'])->name('main');;
Route::get('/catalog',[App\Http\Controllers\CatalogController::class, 'index'])->name('catalog');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['role:admin'])->prefix('admin')->group(function () {
    Route::get('/',[App\Http\Controllers\Admin\HomeController::class, 'index'])->name('mainAdmin');;
});
