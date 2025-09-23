@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Detail Produk</h4>
                <div>
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>ID:</th>
                        <td>{{ $product->id }}</td>
                    </tr>
                    <tr>
                        <th>Nama:</th>
                        <td>{{ $product->name }}</td>
                    </tr>
                    <tr>
                        <th>Harga:</th>
                        <td>Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Stok:</th>
                        <td>{{ $product->stock }}</td>
                    </tr>
                    <tr>
                        <th>Deskripsi:</th>
                        <td>{{ $product->description ?: 'Tidak ada deskripsi' }}</td>
                    </tr>
                    <tr>
                        <th>Dibuat:</th>
                        <td>{{ $product->created_at->format('d-m-Y H:i:s') }}</td>
                    </tr>
                    <tr>
                        <th>Diperbarui:</th>
                        <td>{{ $product->updated_at->format('d-m-Y H:i:s') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection