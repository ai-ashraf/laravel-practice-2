<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';


Route::middleware('auth')->group(function(){


    Route::get('/home', function () {
        return view('home');
    });

    Route::get('category-trash', [CategoryController::class, 'trash'])->name('categories.trash');
    Route::patch('category-trash/{id}', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::delete('category-trash/{id}', [CategoryController::class, 'delete'])->name('categories.delete');
    Route::get('categories/pdf', [CategoryController::class, 'downloadPdf'])->name('categories.pdf');

    Route::resource('categories', CategoryController::class);


    Route::resource('colors', ColorController::class);
    Route::get('color-trash', [ColorController::class, 'trash'])->name('colors.trash');
    Route::patch('color-trash/{id}', [ColorController::class, 'restore'])->name('colors.restore');
    Route::delete('color-trash/{id}', [ColorController::class, 'delete'])->name('colors.delete');
    // Route::get('categories/pdf', [CategoryController::class, 'downloadPdf'])->name('categories.pdf');

    Route::resource('brands', BrandController::class);
    Route::get('brand-trash', [BrandController::class, 'trash'])->name('brands.trash');
    Route::patch('brand-trash/{id}', [BrandController::class, 'restore'])->name('brands.restore');
    Route::delete('brand-trash/{id}', [BrandController::class, 'delete'])->name('brands.delete');

    Route::get('products-trash', [ProductController::class, 'trash'])->name('products.trash');
    Route::patch('products-trash/{id}', [ProductController::class, 'restore'])->name('products.restore');
    Route::delete('products-trash/{id}', [ProductController::class, 'delete'])->name('products.delete');
    Route::get('products/pdf', [ProductController::class, 'downloadPdf'])->name('products.pdf');
    
    Route::resource('products', ProductController::class);

    Route::get('/profile', function () {
        return view('users.profile');
    });

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/{user}', [UserController::class, 'show'])->name('show');
    });
});



Route::fallback(function () {
    dd('Tomar chaoa puron korte parbona.....');
});
