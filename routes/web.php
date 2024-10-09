<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StateController;

// Main Page Route
Route::get('/', [CountryController::class, 'index'])->name('country.index');

// Produtos
Route::resource('product', ProductController::class);

// Localizações
Route::resource('city', CityController::class);
Route::resource('state', StateController::class);
Route::resource('country', CountryController::class);
