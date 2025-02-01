<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoriesController;

Route::get('/', function () {
    return redirect('/index');
});

Route::resource('/index', IndexController::class);

Route::view('/dashboard', 'admin/index');

// Dashboard | Product
Route::get('/dashboard-products', [ProductsController::class,'index']);
Route::get('/product/create', [ProductsController::class,'create']);
Route::post('/product/post', [ProductsController::class,'store']);
Route::get('/product/{id}/edit', [ProductsController::class,'edit']);
Route::post('/product/{id}/update', [ProductsController::class, 'update']);
Route::delete('/product/{id}/delete', [ProductsController::class, 'destroy']);



// Dashboard | Category
Route::get('/dashboard-categories', [CategoriesController::class,'index']);
Route::post('/category/post', [CategoriesController::class,'store']);
Route::get('/category/{name}/edit', [CategoriesController::class,'edit']);
Route::post('/category/{id_category}/update', [CategoriesController::class, 'update']);
// Route::post('/category/{id_category}/delete', [CategoriesController::class, 'destroy']);
Route::delete('/category/{id_category}/delete', [CategoriesController::class, 'destroy']);

