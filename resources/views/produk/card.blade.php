<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk dari API</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-card {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Daftar Produk</h1>
        <div class="row justify-content-center mb-4">
            <div class="col-md-6">
                <form action="{{ route('produk.cekdata') }}" method="GET">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control" name="id" placeholder="Masukkan ID Produk..." required>
                        <button class="btn btn-primary" type="submit">Cek Stok</button>
                    </div>
                </form>
            </div>
        </div>

        @isset($error)
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @else
            <div class="row">
                @if (isset($products) && is_array($products) && count($products) > 0)
                    @foreach ($products as $product)
                        <div class="col-md-4">
                            <div class="card product-card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text"><strong>ID:</strong> {{ $product->id }}</p>
                                    <p class="card-text"><strong>Stok:</strong> {{ $product->stock }}</p>
                                    <p class="card-text"><strong>Harga:</strong> Rp
                                        {{ number_format($product->hargajual, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="alert alert-warning" role="alert">
                            Tidak ada produk yang tersedia.
                        </div>
                    </div>
                @endif
            </div>
        @endisset
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
