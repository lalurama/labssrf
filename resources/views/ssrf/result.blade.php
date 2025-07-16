@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Hasil Fetch URL</h2>

    <p><strong>URL:</strong> {{ $url }}</p>
    <hr>
    <pre>{{ $response }}</pre>

    <a href="{{ route('ssrf.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
