<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderController;


Route::apiResource('products', ProductController::class);

Route::patch('products/{product}/enable',[ProductController::class, 'enable']);

Route::patch('products/{product}/disable',[ProductController::class, 'disable']);

Route::get('orders',[OrderController::class, 'index']);