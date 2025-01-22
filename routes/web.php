<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoriesController;

Route::get('/', function () {
    return redirect('/dashboard-product');
});

Route::get('/dashboard-product', [ProductsController::class,'index']);
Route::get('/product/create', [ProductsController::class,'create']);

Route::get('/dashboard-categories', [CategoriesController::class,'index']);
Route::post('/category/post', [CategoriesController::class,'store']);
