<?php

use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\CustomAuthController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\checkoutController;
use App\Http\Controllers\User\PaymentController;

Route::get('/', [HomeController::class, 'index'])->name('user.home');
Route::get('/shop', [HomeController::class, 'shop'])->name("user.shop");
Route::get('/navShop', [HomeController::class, 'navShop'])->name("user.navShop");
Route::get('/shopdetails', [HomeController::class, 'shopdetails'])->name("user.shopdetails");
Route::get('/checkout', [HomeController::class, 'checkout'])->name("user.checkout");
Route::get('/testimonials', [HomeController::class, 'testimonials'])->name("user.testimonials");
Route::get('/contact', [HomeController::class, 'contact'])->name("user.contact");
Route::get('/products/{id}', [HomeController::class, 'shopdetails'])->name('products.show');
Route::get('/about', [HomeController::class, 'aboutUs'])->name('about.show');

// Authentication Routes
Route::get('/user/register', [CustomAuthController::class, 'showRegisterForm'])->name('register');
Route::post('/user/register', [CustomAuthController::class, 'register'])->name('register.post');
Route::get('/user', [CustomAuthController::class, 'showLoginForm'])->name('user.login');
Route::post('/user', [CustomAuthController::class, 'login'])->name('user.login.post');
Route::post('/user/logout', [CustomAuthController::class, 'logout'])->name('user.logout');

// Cart Routes
Route::middleware(['user'])->group(function () {

    Route::get('/cart', [CartController::class, 'index'])->name('user.modules.cart.index');
    Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('user.cart.add');
    Route::post('/cart/update/{productId}', [CartController::class, 'update'])->name('user.cart.update');
    Route::delete('/cart/remove/{productId}', [CartController::class, 'remove'])->name('user.cart.remove');
    Route::get('/cart/count', [CartController::class, 'getCartCount'])->name('cart.count');
    // Checkout route
    Route::get('/checkout', [CheckoutController::class, 'showCheckoutForm'])->name('checkout.form');
    Route::post('/checkout', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');
    Route::get('/checkout/success', [CheckoutController::class, 'showSuccess'])->name('checkout.success');
    
});
