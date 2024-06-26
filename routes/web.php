<?php

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\InvoiceController::class, 'index'])->name('home');

Route::get('/sign-in/github', [App\Http\Controllers\Auth\LoginController::class, 'github']);
Route::get('/sign-in/github/redirect', [App\Http\Controllers\Auth\LoginController::class, 'githubRedirect']);

Route::middleware(['auth'])->group(function () {
    // Route::get('invoices/create', [App\Http\Controllers\InvoicesController::class,'create'])->name('invoices.create');
    Route::resource('invoices', App\Http\Controllers\InvoiceController::class);
    Route::get('invoices/{id}/download', [App\Http\Controllers\InvoiceController::class,'download'])->name('invoices.download');

    Route::resource('customers', App\Http\Controllers\CustomerController::class);
    Route::resource('products', App\Http\Controllers\ProductController::class);
});
