<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cek Stok Produk</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <h1>Cek Stok Produk</h1>
    <button id="cek-stok">Cek Stok</button>
    <div id="stok-info" style="margin-top:20px; font-weight:bold;"></div>
    <script>
        $('#cek-stok').on('click', function () {
            // let url = "http://localhost:8000/produk/17"

            $.ajax({
                url: "http://localhost:8000/produk/17", // ini ke /cek-stok
                method: 'GET',
                data: { url: url },
                success: function (data) {
                    $('#stok-info').text('Response dari server: ' + data);
                },
                error: function () {
                    $('#stok-info').text('Gagal mengambil data stok.');
                }
            });

        });
    </script>
</body>

</html>