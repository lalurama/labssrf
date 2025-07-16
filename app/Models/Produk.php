<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk'; // Specify the table name if it differs from the model name
    protected $fillable = [
        'nama',
        'jenis',
        'deskripsi',
        'harga_jual',
        'harga_beli',
        'foto'
    ];
}
