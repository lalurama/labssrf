<?php

namespace App\Http\Controllers;

// ... (Kode lain) ...

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class ShowDataApi extends Controller
{
    // ... (Metode lain seperti index, create, dll) ...

    // Fungsi untuk menampilkan data dari API di view
    public function index()
    {
        return view('produk.card');
    }
    public function showdataapi()
    {
        $client = new Client();
        $products = []; // Inisialisasi array kosong

        try {
            // Panggil API yang mengembalikan semua produk
            $response = $client->request('GET', 'http://127.0.0.1:8001/api/products');
            $products = json_decode($response->getBody()->getContents());

        } catch (RequestException $e) {
            $error = 'Gagal mengambil data dari API. Pesan Error: ' . $e->getMessage();
            return view('produk.testapi', ['error' => $error]);
        }

        // Kirim data produk ke view testapi.blade.php
        return view('produk.card', compact('products'));
    }
    public function checkStock(Request $request)
    {
        $client = new Client();
        $productId = $request->input('id');

        // Pastikan ID produk tidak kosong
        if (empty($productId)) {
            return view('produk.card', ['error' => 'ID produk tidak boleh kosong.']);
        }

        $fullUrl = 'http://127.0.0.1:8001/api/products/' . $productId;

        try {
            $response = $client->request('GET', $fullUrl);
            $product = json_decode($response->getBody()->getContents());

            // Cek jika produk ditemukan atau tidak
            if (!is_object($product)) {
                 return view('produk.card', ['error' => 'Produk dengan ID tersebut tidak ditemukan.']);
            }

            // Kirim data produk tunggal ke view card.blade.php
            return view('produk.card', compact('product'));

        } catch (RequestException $e) {
            $error = 'Gagal mengambil data dari API. Pesan Error: ' . $e->getMessage();
            return view('produk.card', ['error' => $error]);
        }
    }
    // ... (Metode lain seperti checkStock, fetchUrl, dll) ...
}
