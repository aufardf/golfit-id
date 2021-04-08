<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('/category', CategoryController::class);
    Route::resource('/tag', TagController::class);
    Route::get('/product/tampil_hapus', [ProductController::class, 'tampil_hapus'])->name('product.tampil_hapus');
    Route::get('/product/restore/{id}', [ProductController::class, 'restore'])->name('product.restore');
    Route::delete('/product/kill/{id}', [ProductController::class, 'kill'])->name('product.kill');
    Route::resource('/product', ProductController::class);
    Route::resource('/user', UserController::class);
});





