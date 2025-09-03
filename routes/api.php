<?php
use App\Http\Controllers\Api\ProdukController;
use Illuminate\Support\Facades\Route;


Route::apiResource('produk', ProdukController::class);