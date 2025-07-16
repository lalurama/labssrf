@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Uji SSRF</h2>
    <form action="{{ route('ssrf.fetch') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="url" class="form-label">Masukkan URL:</label>
            <input type="text" class="form-control" name="url" id="url" placeholder="http://example.com">
        </div>
        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>
</div>
@endsection
