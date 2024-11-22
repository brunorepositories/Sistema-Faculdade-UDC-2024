<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MeasureController;
use App\Http\Controllers\PaymentFormController;
use App\Http\Controllers\PaymentTermController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\SupplierController;

// Main Page Route
Route::get('/', [PurchaseController::class, 'dashboard'])->name('dash.index');



// Funcionários
// Route::resource('employee', EmployeeController::class);

// Compras
Route::resource('purchase', PurchaseController::class);
Route::get('/purchases/export', [PurchaseController::class, 'export'])->name('purchase.export');
Route::post('/check-purchase', [PurchaseController::class, 'checkPurchase'])->name('purchase.check');


// Clientes
Route::resource('customer', CustomerController::class);
Route::get('/customers/export', [CustomerController::class, 'export'])->name('customer.export');



// Fornecedores
Route::resource('supplier', SupplierController::class);
Route::get('/suppliers/export', [SupplierController::class, 'export'])->name('supplier.export');
Route::get('/suppliers/findId/{id}', [SupplierController::class, 'findId'])->name('supplier.findId');


// Condição de Pagamento
Route::resource('payment_term', PaymentTermController::class);
Route::get('/payment_term/installments/{id}', [PaymentTermController::class, 'getInstallments'])->name('payment_term.installments');


// Forma de Pagamento
Route::resource('payment_form', PaymentFormController::class);


// Produtos
Route::resource('product', ProductController::class);
Route::get('/products/export', [ProductController::class, 'export'])->name('product.export');

// Unidade de Medida
Route::resource('measure', MeasureController::class);


// Localidade
Route::resource('city', CityController::class);
Route::resource('state', StateController::class);
Route::resource('country', CountryController::class);
