<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DiscountController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// Authentication Routes
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('admin')->middleware('admin')->group(function () {

    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::get('/products/{product}/images', [ProductController::class, 'showImages'])->name('products.images');
    Route::delete('/products/{product}/images/{picture}', [ProductController::class, 'deleteImage'])->name('products.images.delete');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/contact', [ContactController::class, 'index'])->name('contactus.index');
    Route::post('/contact', [ContactController::class, 'store'])->name('contactus.store');
    Route::resource('discounts', DiscountController::class);
});


Route::get('/welcome',function(){
    return view('welcome'); 
});