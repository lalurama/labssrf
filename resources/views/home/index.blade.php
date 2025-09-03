@extends('layouts.main')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Daftar Produk</h2>
    <div class="row">
        @foreach($produk as $item)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="{{ url('image/' . ($item->foto ?? 'nophoto.jpg')) }}" class="card-img-top" alt="{{ $item->nama }}" style="height:200px;object-fit:cover;">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->nama }}</h5>
                    <p class="card-text">Harga: Rp {{ number_format($item->hargajual, 0, ',', '.') }}</p>
                    <a href="{{ route('produk.show', $item->id) }}" class="btn btn-primary mt-2">Lihat Detail</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
