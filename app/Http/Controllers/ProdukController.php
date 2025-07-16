<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $produk = Produk::all(); // Fetch all products from the database
        return view('produk.index',compact('produk')); // Assuming you have a view named 'produk.index'
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
    $request->validate([
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
    ]);
    
    //jika file foto ada yang terupload
    if(!empty($request->foto)){
        //maka proses berikut yang dijalankan
        $fileName = 'foto-'.uniqid().'.'.$request->foto->extension();
        //setelah tau fotonya sudah masuk maka tempatkan ke public
        $request->foto->move(public_path('image'), $fileName);
    } else {
        $fileName = 'nophoto.jpg';
    }
    
    //tambah data produk
    DB::table('produk')->insert([
        'nama'=>$request->nama,
        'jenis'=>$request->jenis,
        'hargajual'=>$request->hargajual,
        'hargabeli'=>$request->hargabeli,
        'deskripsi' => $request->deskripsi,
        'foto'=>$fileName,
    ]);
    
    return redirect()->route('index.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $request->validate([
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
    ]);
 
 
    //foto lama
    $fotoLama = DB::table('produk')->select('foto')->where('id',$id)->get();
    foreach($fotoLama as $f1){
        $fotoLama = $f1->foto;
    }
 
    //jika foto sudah ada yang terupload
    if(!empty($request->foto)){
        //maka proses selanjutnya
        if(!empty($fotoLama->foto)) unlink(public_path('image'.$fotoLama->foto));
        //proses ganti foto
        $fileName = 'foto-'.$request->id.'.'.$request->foto->extension();
        //setelah tau fotonya sudah masuk maka tempatkan ke public
        $request->foto->move(public_path('image'), $fileName);
    } else{
        $fileName = $fotoLama;
    }
 
    //update data produk
    DB::table('produk')->where('id',$id)->update([
        'nama'=>$request->nama,
        'jenis'=>$request->jenis,
        'hargajual'=>$request->hargajual,
        'hargabeli'=>$request->hargabeli,
        'deskripsi' => $request->deskripsi,
        'foto'=>$fileName,
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
}
