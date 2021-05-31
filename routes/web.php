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

Route::get('/make-customer', function () {
    return view('make-customer',[
        "success"=> null
    ]);
})->name('make_customer');


Route::get('/create-product', function () {
    return view('make-product');
})->name('create_product');

Route::get('/update-product', function () {
    return view('update-product');
})->name('update_product');

Route::get('/orders', function () {
    return view('orders');
})->name('orders');

Route::group(['prefix'=>'api','as'=>'api.'], function(){
    Route::post("/customer", [\App\Http\Controllers\CustomerController::class, "make_customer"])->name("make_customer");
    Route::get("/customer", [\App\Http\Controllers\CustomerController::class, "get_customers"])->name("get_customers");

    Route::post("/product", [\App\Http\Controllers\ProductController::class, "create"])->name("create_product");
    Route::get("/product", [\App\Http\Controllers\ProductController::class, "get"])->name("get_products");
    Route::patch("/product", [\App\Http\Controllers\ProductController::class, "update"])->name("update_product");
    Route::delete("/product", [\App\Http\Controllers\ProductController::class, "delete"])->name("delete_product");

    Route::post("/order", [\App\Http\Controllers\OrderController::class, "create"])->name("create_order");
    Route::get("/order", [\App\Http\Controllers\OrderController::class, "get"])->name("get_orders");

    Route::get("/pdf/{id}", [\App\Http\Controllers\OrderController::class, "pdf"])->name("pdf");
});


