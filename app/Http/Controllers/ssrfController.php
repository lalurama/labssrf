<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ssrfController extends Controller
{
    // Menampilkan halaman form input URL
    public function index()
    {
        return view('ssrf.index');
    }

    // Menangani request dari form dan ambil isi dari URL
    public function fetch(Request $request)
    {
        $request->validate([
            'url' => 'required|url'
        ]);

        // Ambil URL dari user
        $url = $request->input('url');

        // Request ke URL tersebut (raw SSRF, rentan)
        try {
            $response = file_get_contents($url); // VULNERABLE
        } catch (\Exception $e) {
            $response = "Error saat mengambil URL: " . $e->getMessage();
        }

        // Kirim kembali ke view dengan hasil
        return view('ssrf.result', compact('url', 'response'));
    }
}
