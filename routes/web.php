<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoriesController;

Route::get('/', function () {
    return redirect('/dashboard-product');
});

Route::view('/index', 'admin/index');

// Dashboard | Product
Route::get('/dashboard-product', [ProductsController::class,'index']);
Route::get('/product/create', [ProductsController::class,'create']);

// Dashboard | Category
Route::get('/dashboard-categories', [CategoriesController::class,'index']);
Route::post('/category/post', [CategoriesController::class,'store']);
Route::get('/category/{name}/edit', [CategoriesController::class,'edit']);
Route::post('/category/{id_category}/update', [CategoriesController::class, 'update']);
// Route::post('/category/{id_category}/delete', [CategoriesController::class, 'destroy']);
Route::delete('/category/{id_category}/delete', [CategoriesController::class, 'destroy']);

