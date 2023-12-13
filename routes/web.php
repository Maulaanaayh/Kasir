<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\itemcontroller;
use App\Http\Controllers\homecontroller;
use App\Http\Controllers\transactioncontroller;
use App\Http\Controllers\categorycontroller;

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

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('home', homecontroller::class);
Route::get('/category', [categorycontroller::class, 'index'])->name('category');
Route::resource('item', itemcontroller::class);
Route::resource('category', categorycontroller::class);
Route::resource('transaction', transactioncontroller::class);
Route::get('/transaction/hapus/{id}', [transactionController::class, 'hapus'])->name('transaction.hapus');
Route::post('transaction/checkout', [transactionController::class, 'checkout'])
    ->name('transaction.checkout');
Route::get('history', [transactioncontroller::class, 'history']);
