<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/ajax', [App\Http\Controllers\AjaxController::class, 'movies']);

Route::get('/', [App\Http\Controllers\ProductsController::class, 'home'])->name('home-page');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    Route::get('/create', [App\Http\Controllers\CreateController::class, 'index'])->name('create');
    Route::post('/create', [App\Http\Controllers\CreateController::class, 'add'])->name('create-post');
    Route::get('/modify/{id}', [App\Http\Controllers\ModifyController::class, 'index'])->name('modify');
    Route::post('/modify/{id}', [App\Http\Controllers\ModifyController::class, 'update'])->name('modify-post');
});

Auth::routes();


Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile-update');


Route::get('/categories', [\App\Http\Controllers\CategoriesController::class, 'index'])->name('categories');
Route::get('/all-products', [App\Http\Controllers\ProductsController::class, 'index'])->name('all-products');

Route::get('/shopping-cart', [App\Http\Controllers\CartController::class, 'index'])->name('shopping-cart');
Route::post('/shopping-cart', [App\Http\Controllers\CartController::class, 'store'])->name('shopping-cart-store');
Route::delete('/shopping-cart/{product}', [App\Http\Controllers\CartController::class, 'destroy'])->name('shopping-cart-destroy');


Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout-store');
Route::post('/paypayl-checkout', [App\Http\Controllers\CheckoutController::class, 'paypalCheckout'])->name('paypal-checkout');
Route::get('/thankyou', [App\Http\Controllers\ConfirmationController::class, 'index'])->name('confirmation');
Route::get('/search', [\App\Http\Controllers\SearchController::class, 'search'])->name('search');
Route::post('/delete-product', [App\Http\Controllers\DeleteController::class, 'remove'])->name('delete-product');

Route::get('/movie', function () {
    return view('video');
})->name('movie');

Route::get('/{product}', [App\Http\Controllers\ProductsController::class, 'product'])->name('product');
Route::get('/categories/{category}', [\App\Http\Controllers\CategoriesController::class, 'category'])->name('category');





