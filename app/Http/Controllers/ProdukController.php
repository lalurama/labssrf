<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $produk = Produk::all(); // Fetch all products from the database
        return view('produk.index', compact('produk')); // Assuming you have a view named 'produk.index'
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('produk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // melakukan validasi data
        $request->validate(
            [
                'nama' => 'required|max:45',
                'jenis' => 'required|max:45',
                'hargajual' => 'required|numeric',
                'hargabeli' => 'required|numeric',
                'foto' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ],
            [
                'nama.required' => 'Nama wajib diisi',
                'nama.max' => 'Nama maksimal 45 karakter',
                'jenis.required' => 'jenis wajib diisi',
                'jenis.max' => 'jenis maksimal 45 karakter',
                'foto.max' => 'Foto maksimal 2 MB',
                'foto.mimes' => 'File ekstensi hanya bisa jpg,png,jpeg,gif, svg',
                'foto.image' => 'File harus berbentuk image'
            ]
        );

        //jika file foto ada yang terupload
        if (!empty($request->foto)) {
            //maka proses berikut yang dijalankan
            $fileName = 'foto-' . uniqid() . '.' . $request->foto->extension();
            //setelah tau fotonya sudah masuk maka tempatkan ke public
            $request->foto->move(public_path('image'), $fileName);
        } else {
            $fileName = 'nophoto.jpg';
        }

        //tambah data produk
        DB::table('produk')->insert([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'hargajual' => $request->hargajual,
            'hargabeli' => $request->hargabeli,
            'deskripsi' => $request->deskripsi,
            'foto' => $fileName,
        ]);

        return redirect()->route('index.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $produk = Produk::find($id); // Mencari produk berdasarkan ID

        if (!$produk) {
            // Jika produk tidak ditemukan, kembalikan response 404 (Not Found)
            // Ini penting untuk AJAX agar client tahu data tidak ditemukan
            if (request()->expectsJson()) {
                return response()->json(['message' => 'Produk tidak ditemukan.'], 404);
            }
            // Atau, jika ini request non-AJAX, redirect ke halaman daftar atau tampilkan error
            abort(404); // Tampilkan halaman 404 Laravel
        }

        // --- Bagian Penting untuk AJAX dan Non-AJAX ---
        if (request()->expectsJson()) {
            // Jika request datang dari AJAX (expectsJson() akan true jika header X-Requested-With: XMLHttpRequest ada)
            // Kembalikan data produk dalam format JSON
            return response()->json([
                'id' => $produk->id,
                'nama' => $produk->nama,
                'hargajual' => $produk->hargajual,
                'stock' => $produk->stock, // Pastikan Anda mengambil kolom 'stock'
                'foto' => $produk->foto,
                // Anda bisa menambahkan data lain yang ingin ditampilkan
            ]);
        } else {
            // Jika request adalah kunjungan halaman biasa (bukan AJAX)
            // Tampilkan view detail produk Anda
            return view('produk.show', compact('produk')); // Ganti 'produk.show' dengan nama view detail Anda
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $id)
    {
        return view('produk.edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'nama' => 'required|max:45',
                'jenis' => 'required|max:45',
                'hargajual' => 'required|numeric',
                'hargabeli' => 'required|numeric',
                'foto' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'stock' => 'required|integer|min:0', // Pastikan ada validasi untuk stok


            ],
            [
                'nama.required' => 'Nama wajib diisi',
                'nama.max' => 'Nama maksimal 45 karakter',
                'jenis.required' => 'jenis wajib diisi',
                'jenis.max' => 'jenis maksimal 45 karakter',
                'foto.max' => 'Foto maksimal 2 MB',
                'foto.mimes' => 'File ekstensi hanya bisa jpg,png,jpeg,gif, svg',
                'foto.image' => 'File harus berbentuk image'
            ]
        );


        //foto lama
        $fotoLama = DB::table('produk')->select('foto')->where('id', $id)->get();
        foreach ($fotoLama as $f1) {
            $fotoLama = $f1->foto;
        }

        //jika foto sudah ada yang terupload
        if (!empty($request->foto)) {
            //maka proses selanjutnya
            if (!empty($fotoLama->foto)) unlink(public_path('image' . $fotoLama->foto));
            //proses ganti foto
            $fileName = 'foto-' . $request->id . '.' . $request->foto->extension();
            //setelah tau fotonya sudah masuk maka tempatkan ke public
            $request->foto->move(public_path('image'), $fileName);
        } else {
            $fileName = $fotoLama;
        }

        //update data produk
        DB::table('produk')->where('id', $id)->update([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'hargajual' => $request->hargajual,
            'hargabeli' => $request->hargabeli,
            'deskripsi' => $request->deskripsi,
            'foto' => $fileName,
        ]);

        return redirect()->route('index.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $id)
    {
        $id->delete();
        return redirect()->route('index.index')->with('success', 'Produk berhasil dihapus');
    }

    public function indexdata()
    {
        //
        // $produk = Produk::all(); // Fetch all products from the database
        return view('produk.showdata'); // Assuming you have a view named 'produk.index'
    }

    public function showImage(Request $request)
    {
        // Ambil path dari query string (?path=...)
        $path = $request->query('path');

        // Coba ambil file dari path tersebut
        $filePath = base_path($path);

        if (file_exists($filePath)) {
            return response(file_get_contents($filePath))
                ->header('Content-Type', mime_content_type($filePath));
        } else {
            return response("File not found: " . $filePath, 404);
        }
    }

    public function cekStok(Request $request)
    {
        // User bisa input "url" lewat query param
        $url = $request->query('url');

        // Server akan melakukan request GET ke URL arbitrary
        $response = Http::get($url);

        // Balikin response langsung ke client
        return $response->body();
    }

    // Request data api dari app2
    //logic ssrf
    public function showdataapi()
    {
        return view('produk.testapi');
    }
    // Fungsi ini yang akan dipanggil saat tombol Cek Stok diklik
    public function checkStock(Request $request)
    {
        $client = new Client();

        // Ambil URL lengkap dari input 'url' yang dikirim dari form
        $fullUrl = $request->input('url');

        try {
            $response = $client->request('GET', $fullUrl);
            $product = json_decode($response->getBody()->getContents());

            return response()->json(['product' => $product]);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $error = 'Gagal mengambil data dari API. Pesan Error: ' . $e->getMessage();
            return response()->json(['error' => $error], 500);
        }
    }
    //logic ssrf
    public function fetchUrl(Request $request)
    {
        $client = new Client();

        $targetUrl = $request->query('url');

        // Pastikan URL tidak kosong sebelum diproses
        if (empty($targetUrl)) {
            return response()->json(['error' => 'URL tidak boleh kosong.'], 400);
        }

        try {
            // Guzzle akan mengambil konten dari URL yang diberikan
            $response = $client->request('GET', $targetUrl);
            $content = $response->getBody()->getContents();

            // Cek apakah responsnya berupa JSON atau HTML/lainnya
            if (json_decode($content) !== null) {
                // Jika isinya JSON, kirimkan sebagai objek
                return response()->json(['content' => json_decode($content)]);
            } else {
                // Jika bukan JSON, kirimkan sebagai string
                return response()->json(['content' => $content]);
            }
        } catch (RequestException $e) {
            $error = 'Gagal mengambil konten. Pesan Error: ' . $e->getMessage();
            return response()->json(['error' => $error], 500);
        }
    }
    //endlogic ssrf
    public function listProduk()
    {
        $response = Http::get('http://127.0.0.1:8001/api/products');
        $produks = $response->json();

        return view('home.show', compact('produks'));
    }

    public function detailProduk($id)
    {
        $response = Http::get("http://127.0.0.1:8001/api/products/{$id}");
        $produk = $response->json();

        return view('home.detail', compact('produk'));
    }
}
