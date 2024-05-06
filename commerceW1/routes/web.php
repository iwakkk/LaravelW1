<?php

// use App\Http\Controllers\CobaController;

use App\Http\Controllers\CobaController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'Home']);
Route::get('/product/{id}-{name}', [HomeController::class, 'Product']);

Route::get('/test', [CobaController::class, 'Index']);

Route::get('/contact', [ContactController::class, 'View']);
Route::post('/contact', [ContactController::class, 'ActionContact']);
Route::get('/contact/list', [ContactController::class, 'ContactList']);

Route::view('/cart', 'cart');
Route::view('/product', 'product');
Route::view('/login', 'login');

// web.php or routes.php
Route::delete('/contacts/{index}', [ContactController::class, 'deleteContact'])->name('delete.contact');



// Route::view('/contact', 'contact');
