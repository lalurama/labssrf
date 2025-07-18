<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ssrfController;
use App\Http\Controllers\HomePageController;

route::get('/', [ProdukController::class, 'index'])->name('index.index');
route::get('/produk/create', [ProdukController::class, 'create'])->name('index.create');
route::post('/produk/store', [ProdukController::class, 'store'])->name('index.store');
route::get('/produk/edit/{id}', [ProdukController::class, 'edit'])->name('index.edit');
route::put('/produk/update/{id}', [ProdukController::class, 'update'])->name('index.update');
route::delete('/produk/delete/{id}', [ProdukController::class, 'destroy'])->name('index.destroy');
route::get('/ssrf', [ssrfController::class, 'index'])->name('ssrf.index');
route::post('/ssrf/result', [ssrfController::class, 'fetch'])->name('ssrf.fetch');
route::get('/home', [HomePageController::class, 'index'])->name('home.index');
route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');
