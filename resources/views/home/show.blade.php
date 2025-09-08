<!DOCTYPE html>
<html>
<head>
    <title>Daftar Produk</title>
    <style>
        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 16px;
            margin: 10px;
            width: 200px;
            float: left;
        }
        .btn {
            display: inline-block;
            margin-top: 10px;
            padding: 6px 12px;
            background: blue;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn:hover { background: darkblue; }
    </style>
</head>
<body>
    <h1>Daftar Produk</h1>
    <div>
        @foreach($produks as $produk)
            <div class="card">
                <h3>{{ $produk['name'] }}</h3>
                <p>Harga: Rp {{ number_format($produk['hargajual'], 0, ',', '.') }}</p>
                <a href="{{ route('produk.detail', $produk['id']) }}" class="btn">Cek Produk</a>
            </div>
        @endforeach
    </div>
</body>
</html>
