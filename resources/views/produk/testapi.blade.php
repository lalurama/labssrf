<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Stok Produk</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: sans-serif;
        }

        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            text-align: center;
        }

        .btn {
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .result {
            margin-top: 20px;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: left;
        }

        .error {
            color: red;
            font-weight: bold;
        }

        #loading-message {
            display: none;
            color: gray;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Cek Stok Produk</h1>
        <p>Klik tombol di bawah untuk mendapatkan stok produk dari API.</p>

        <button id="check-stock-btn" class="btn">Cek Stok</button>
        <p id="loading-message" style="display: none;">Mengambil data...</p>
        <div id="result-container" class="result" style="display: none;">
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkBtn = document.getElementById('check-stock-btn');
            const resultContainer = document.getElementById('result-container');
            const loadingMessage = document.getElementById('loading-message');

            checkBtn.addEventListener('click', function () {
                loadingMessage.style.display = 'block';
                resultContainer.style.display = 'none';

                // URL API yang akan dipanggil
                const targetUrl = 'http://127.0.0.1:8001/api/products/';

                fetch('/fetchdata', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({ url: targetUrl }),
                })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(errorData => {
                                throw new Error(errorData.error || `HTTP error! status: ${response.status}`);
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        loadingMessage.style.display = 'none';
                        resultContainer.style.display = 'block';

                        if (data.error) {
                            // Jika ada properti error, tampilkan pesan error
                            resultContainer.innerHTML = `<p class="error">${data.error}</p>`;
                        } else if (typeof data.content === 'object' && data.content !== null) {
                            // Jika kontennya JSON, tampilkan dengan rapi
                            resultContainer.innerHTML = `
                            <h3>Konten Ditemukan:</h3>
                            <pre>${JSON.stringify(data.content, null, 2)}</pre>
                        `;
                        } else {
                            // Jika kontennya string (HTML, teks, dll), tampilkan apa adanya
                            resultContainer.innerHTML = `
                            <h3>Konten Ditemukan:</h3>
                            <pre>${data.content}</pre>
                        `;
                        }
                    })
                    .catch(error => {
                        loadingMessage.style.display = 'none';
                        resultContainer.style.display = 'block';
                        resultContainer.innerHTML = `<p class="error">Gagal mengambil konten. ${error.message}</p>`;
                    });
            });
        });

    </script>
</body>

</html>
