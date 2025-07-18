<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class HomePageController extends Controller
{
    //
    public function index()
    {
        // Fetch all products to display on the home page
        $produk = Produk::all();
        return view('home.index', compact('produk')); // Assuming you have a view named 'home.index'
    }
    // public function show(Produk $produk)
    // {
    //     // Fetch a single product by its ID
    //     // $produk = Produk::findOrFail($produk->id);
    //     // return view('produk.show', compact('produk')); // Assuming you have a view named 'produk.show'
    // }
   


}
