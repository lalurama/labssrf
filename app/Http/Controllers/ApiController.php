<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    //
    public function index()
    {
        return response()->json(Produk::all());
    }
    public function store(Request $request)
    {
        $produk = Produk::create($request->all());
        return response()->json($produk, 201);
    }

    public function show($id)
    {
        return response()->json(Produk::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $produk->update($request->all());
        return response()->json($produk);
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();
        return response()->json(null, 204);
    }

}
