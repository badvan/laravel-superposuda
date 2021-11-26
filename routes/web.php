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

Auth::routes();

Route::get('/home', function () {
    return view('welcome');
});

Route::get('/', [App\Http\Controllers\OrderController::class, 'index'])->name('order');
Route::post('/create', [App\Http\Controllers\OrderController::class, 'create'])->name('order.create');
