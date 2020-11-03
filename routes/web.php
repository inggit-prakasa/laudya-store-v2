<?php

use App\Http\Controllers\HomeController;
use App\Http\Livewire\Home;
use App\Http\Livewire\Product;
use App\Http\Livewire\Product\ProductCategory;
use App\Http\Livewire\Product\ProductCreate;
use App\Http\Livewire\Product\ProductEdit;
use App\Http\Livewire\Product\ProductIndex;
use App\Http\Livewire\Product\ProductSize;
use App\Http\Livewire\Product\TransactionHistory;
use App\Http\Livewire\Product\ProductColor;
use App\Http\Livewire\Transaction\TransactionIndex;
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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', Home::class);
    Route::get('/product/index',ProductIndex::class)->name('product.index');
    Route::get('/product/create',ProductCreate::class)->name('product.create');
    Route::get('/product/edit/{id}}',ProductEdit::class)->name('product.edit');
    Route::get('/transaction',TransactionIndex::class)->name('transaction.index');
    Route::get('/transaction/history',TransactionHistory::class)->name('transaction.history');
    Route::get('/product/category',ProductCategory::class)->name('product.category');
    Route::get('/product/color',ProductColor::class)->name('product.color');
    Route::get('/product/size',ProductSize::class)->name('product.size');
});
