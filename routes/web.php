<?php

use App\Http\Controllers\AccountPayableController;
use App\Http\Controllers\AccountReceivableController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MeasureController;
use App\Http\Controllers\PaymentFormController;
use App\Http\Controllers\PaymentTermController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\SupplierController;
use App\Models\AccountReceivable;

// use App\Models\AccountReceivable;v

// Main Page Route
Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/api/vendas/chart/{days}', [DashboardController::class, 'getChartData']);
Route::get('/api/vendas/contadores', [DashboardController::class, 'getCounters']);


// Contas a receber
Route::resource('account_receivable', AccountReceivableController::class);
Route::put('/account_receivable/receive/{id}', [AccountReceivableController::class, 'receive'])->name('account_receivable.receive');
Route::put('/account_receivable/cancel/{id}', [AccountReceivableController::class, 'cancel'])->name('account_receivable.cancel');

// Compras
Route::resource('sale', SaleController::class)->except(['show']);
Route::get('/sales/export', [SaleController::class, 'export'])->name('sale.export');
Route::post('/check-sale', [SaleController::class, 'checkSale'])->name('sale.check');
Route::get('/sale/{numeroNota}/{modelo}/{serie}/{customer_id}', [SaleController::class, 'show'])->name('sale.show');
Route::get('/sale/cancel/{numeroNota}/{modelo}/{serie}/{customer_id}', [SaleController::class, 'cancel'])->name('sale.cancel');


// Contas a receber
Route::resource('account_payable', AccountPayableController::class);
Route::put('/account_payable/pay/{id}', [AccountPayableController::class, 'pay'])->name('account_payable.pay');
Route::put('/account_payable/cancel/{id}', [AccountPayableController::class, 'cancel'])->name('account_payable.cancel');

// Compras
Route::resource('purchase', PurchaseController::class)->except(['show']);
Route::get('/purchases/export', [PurchaseController::class, 'export'])->name('purchase.export');
Route::post('/check-purchase', [PurchaseController::class, 'checkPurchase'])->name('purchase.check');
Route::get('/purchase/{numeroNota}/{modelo}/{serie}/{supplier_id}', [PurchaseController::class, 'show'])->name('purchase.show');


// Clientes
Route::resource('customer', CustomerController::class);
Route::get('/customers/export', [CustomerController::class, 'export'])->name('customer.export');
Route::get('/customers/findId/{id}', [CustomerController::class, 'findId'])->name('customer.findId');



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
