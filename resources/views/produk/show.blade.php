@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="card mt-4">
            <img src="{{ url('image/' . ($produk->foto ?? 'nophoto.jpg')) }}" class="card-img-top" alt="{{ $produk->nama }}"
                style="height:400px;object-fit:contain;">
            <div class="card-body">
                <h3 class="card-title">{{ $produk->nama }}</h3>
                <p class="card-text">Harga: Rp {{ number_format($produk->hargabeli, 0, ',', '.') }}</p>
                <p class="card-text">{{ $produk->stock }}</p>

                {{-- Tombol cek stok --}}
                {{-- <button id="cek-stok" class="btn btn-primary">Cek Stok</button> --}}
                {{-- <a href="{{ route('produk.show', $item->id) }}" class="btn btn-primary mt-2">Cek stock</a> --}}
                {{-- Tempat muncul stok --}}
                {{-- <div id="stock-result-{{ $produk->id }}" class="mt-2 text-muted"></div> --}}
                {{-- <p id="stok-info" class="mt-3 text-success"></p> --}}
            </div>
        </div>
    </div>
@endsection
{{-- @section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.getElementById('cek-stok').addEventListener('click', function () {
        const stockDataContainer = document.getElementById('stock-result-{{ $produk->id }}');
        stockDataContainer.innerHTML = '<h3>Data Stok:</h3><p>Memuat data...</p>'; // Tampilkan pesan loading

        // Menggunakan Fetch API untuk permintaan AJAX
        fetch('{{ route('produk.show') }}', {
            method: 'GET', // Metode GET karena kita hanya mengambil data
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest', // Memberi tahu Laravel ini adalah permintaan AJAX
                // 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Tidak wajib untuk GET request
            }
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json(); // Menguraikan respons JSON
            })
            .then(data => {
                // Hapus pesan loading
                stockDataContainer.innerHTML = '<h3>Data Stok:</h3>';

                if (data.length > 0) {
                    data.forEach(product => {
                        const productItem = document.createElement('div');
                        productItem.classList.add('product-item');
                        productItem.innerHTML = `<strong>Nama:</strong> ${product.name}, <strong>Stok:</strong> ${product.stock}`;
                        stockDataContainer.appendChild(productItem);
                    });
                } else {
                    stockDataContainer.innerHTML += '<p>Tidak ada data stok yang tersedia.</p>';
                }
            })
            .catch(error => {
                console.error('Ada masalah dengan operasi fetch:', error);
                stockDataContainer.innerHTML = '<h3>Data Stok:</h3><p style="color: red;">Gagal memuat data stok. Silakan coba lagi nanti.</p>';
            });
    });
</script>
@endsection

 --}}
