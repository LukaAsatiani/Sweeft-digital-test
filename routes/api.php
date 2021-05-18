<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::resources([
  'products' => ProductController::class
], [
  'only' => [
    'index', 
    'store', 
    'destroy',
    'update'
  ]
]);
