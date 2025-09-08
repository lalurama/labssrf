<!DOCTYPE html>
<html>
<head>
    <title>Detail Produk</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Detail Produk</h1>
    <h2>{{ $produk['name'] }}</h2>
    <p>Harga Jual: Rp {{ number_format($produk['hargajual'], 0, ',', '.') }}</p>
    {{-- <p>Deskripsi: {{ $produk['deskripsi'] }}</p> --}}

    {{-- Tombol cek stok --}}
    <button id="cek-stok" data-id="{{ $produk['id'] }}">Cek Stok</button>
    <p id="stok-info" style="margin-top:10px; font-weight:bold;"></p>

    <br>
    <a href="{{ route('home.show') }}">Kembali ke daftar</a>

    <script>
        $('#cek-stok').on('click', function () {
            let id = $(this).data('id');

            $.ajax({
                url: "http://127.0.0.1:8001/api/products/" + id, // Panggil API dari App2
                method: 'GET',
                success: function (data) {
                    $('#stok-info').text("Stok tersedia: " + data.stock);
                },
                error: function () {
                    $('#stok-info').text("Gagal mengambil data stok.");
                }
            });
        });
    </script>
</body>
</html>
