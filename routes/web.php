<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\MeasureController;
use App\Http\Controllers\PaymentFormController;
use App\Http\Controllers\PaymentTermController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StateController;


// Main Page Route
Route::get('/', [CountryController::class, 'index'])->name('country.index');


// Condição de Pagamento
Route::resource('payment_term', PaymentTermController::class);
// Forma de Pagamento
Route::resource('payment_form', PaymentFormController::class);


// Produtos
Route::resource('product', ProductController::class);
Route::resource('measure', MeasureController::class);


// Localidade
Route::resource('city', CityController::class);
Route::resource('state', StateController::class);
Route::resource('country', CountryController::class);
