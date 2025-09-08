<!DOCTYPE html>
<html>
<head>
    <title>Tampilkan Gambar</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h2>Tampilkan Gambar Produk</h2>
    <button id="lihat-gambar">Lihat Gambar</button>
    <div id="gambar-area"></div>

    <script>
        $('#lihat-gambar').on('click', function () {
            $.ajax({
                url: "{{ route('produk.showdata') }}?path=resources/img/produk1.png",
                method: 'GET',
                xhrFields: {
                    responseType: 'blob'
                },
                success: function (data) {
                    let url = URL.createObjectURL(data);
                    $('#gambar-area').html('<img src="' + url + '" width="300"/>');
                },
                error: function () {
                    $('#gambar-area').text('Gagal mengambil gambar.');
                }
            });
        });
    </script>
</body>
</html>
