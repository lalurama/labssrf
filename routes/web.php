<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ssrfController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\ShowDataApi;
use Illuminate\Support\Facades\Http;

// route::get('/', [ProdukController::class, 'index'])->name('index.index');
// route::get('/', [HomePageController::class, 'index'])->name('home.index');
// route::get('/produk/create', [ProdukController::class, 'create'])->name('index.create');
// route::post('/produk/store', [ProdukController::class, 'store'])->name('index.store');
// route::get('/produk/edit/{id}', [ProdukController::class, 'edit'])->name('index.edit');
// route::put('/produk/update/{id}', [ProdukController::class, 'update'])->name('index.update');
// route::delete('/produk/delete/{id}', [ProdukController::class, 'destroy'])->name('index.destroy');
// route::get('/ssrf', [ssrfController::class, 'index'])->name('ssrf.index');
// route::post('/ssrf/result', [ssrfController::class, 'fetch'])->name('ssrf.fetch');
// route::get('/dashboard', [ProdukController::class, 'index'])->name('index.index');
// route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');
// route::get('/test', [ProdukController::class, 'indexdata'])->name('produk.showdata');
// route::get('/showdata', [ProdukController::class, 'showImage'])->name('produk.showdata');
// route::get('/cek-stok', [ProdukController::class, 'cekStok'])->name('produk.cekstok');
// route::get('/stokview', [ProdukController::class, 'stokView'])->name('produk.cekstok');


// api route
//endpointssrf
Route::get('/showapi', [ProdukController::class, 'showdataapi']);
Route::post('/checkdataapi', [ProdukController::class, 'checkStock']);
Route::post('/fetchdata', [ProdukController::class, 'fetchUrl']);

//api route 9/6/2025
// route::get('/produkcard', [ShowDataApi::class, 'index'])->name('produk.card');
route::get('/carddata', [ShowDataApi::class, 'showdataapi'])->name('produk.card');
Route::get('/check-stock', [ShowDataApi::class, 'checkStock'])->name('produk.cekdata');

//new struktur
Route::get('/produk', [ProdukController::class, 'listProduk'])->name('home.show');
Route::get('/produk/{id}', [ProdukController::class, 'detailProduk'])->name('home.detail');
