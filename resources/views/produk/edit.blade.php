@extends('layouts.main')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
 
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Edit data
            </div>
            <div class="card-body">
                <form action="{{ route('index.update', $id->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="nama">Nama:</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ $id->nama }}">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jenis">Jenis:</label>
                        <input type="text" class="form-control @error('jenis') is-invalid @enderror" id="jenis" name="jenis" value="{{ $id->jenis  }}">
                        @error('jenis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="hargajual">Harga Jual:</label>
                        <input type="text" class="form-control @error('hargajual') is-invalid @enderror" id="hargajual" name="hargajual" value="{{  $id->hargajual }}">
                        @error('hargajual')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="hargabeli">Harga Beli:</label>
                        <input type="text" class="form-control @error('hargabeli') is-invalid @enderror" id="hargabeli" name="hargabeli" value="{{ $id->hargabeli }}">
                        @error('hargabeli')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi:</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi">{{ $id->id }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto Produk:</label>
                        <input type="file" class="form-control" id="foto" name="foto">
 
                        {{-- @if(!empty($id->foto))
                        <img src="{{url('image')}}/{{$id->foto}}" alt=""class="rounded" style="width: 100%; max-width: 100px; height: auto;">
                        @endif --}}
                        @if(isset($id->foto) && !empty($id->foto))
                            <img src="{{ url('image/' . $id->foto) }}" alt="Foto Produk" class="rounded" style="width: 100%; max-width: 100px; height: auto;">
                        @else
                            <img src="{{ url('image/nophoto.jpg') }}" alt="No Foto" class="rounded" style="width: 100%; max-width: 100px; height: auto;">
                        @endif
 
                    </div>
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection