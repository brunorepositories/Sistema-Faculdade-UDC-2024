<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\MeasureController;
use App\Http\Controllers\PaymentFormController;
use App\Http\Controllers\PaymentTermController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\SupplierController;

// Main Page Route
Route::get('/', [SupplierController::class, 'index'])->name('supplier.index');


// Funcionários
// Route::resource('employee', EmployeeController::class);


// Clientes
// Route::resource('client', ClientController::class);


// Fornecedores
Route::resource('supplier', SupplierController::class);


// Condição de Pagamento
Route::resource('payment_term', PaymentTermController::class);
// Forma de Pagamento
Route::resource('payment_form', PaymentFormController::class);


// Produtos
Route::resource('product', ProductController::class);
// Unidade de Medida
Route::resource('measure', MeasureController::class);


// Localidade
Route::resource('city', CityController::class);
Route::resource('state', StateController::class);
Route::resource('country', CountryController::class);
