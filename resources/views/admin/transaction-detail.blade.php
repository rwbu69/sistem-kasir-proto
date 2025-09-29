@extends('layouts.app')

@section('title', 'Detail Transaksi - Admin')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0">
                <i class="icon">🔍</i>
                Detail Transaksi #{{ $sale->id }}
            </h4>
            <a href="{{ route('admin.transactions') }}" class="btn btn-secondary">
                <i class="icon">🔙</i>
                Kembali
            </a>
        </div>
    </div>
    <div class="card-body">
        <!-- Transaction Info -->
        <div class="row mb-4">
            <div class="col-md-6">
                <h6>Informasi Transaksi</h6>
                <table class="table table-borderless">
                    <tr>
                        <td><strong>ID Transaksi:</strong></td>
                        <td>#{{ $sale->id }}</td>
                    </tr>
                    <tr>
                        <td><strong>Tanggal:</strong></td>
                        <td>{{ $sale->created_at->format('d F Y, H:i') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Total Amount:</strong></td>
                        <td class="text-success"><strong>Rp {{ number_format($sale->total_amount, 0, ',', '.') }}</strong></td>
                    </tr>
                    <tr>
                        <td><strong>Jumlah Item:</strong></td>
                        <td>{{ $sale->saleItems->count() }} item</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Items Purchased -->
        <h6>Item yang Dibeli</h6>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga Satuan</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sale->saleItems as $item)
                    <tr>
                        <td>
                            <strong>{{ $item->product->name }}</strong><br>
                            <small class="text-muted">{{ Str::limit($item->product->description, 50) }}</small>
                        </td>
                        <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <th colspan="3">Total Pembayaran</th>
                        <th>Rp {{ number_format($sale->total_amount, 0, ',', '.') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Actions -->
        <div class="text-center mt-4">
            <a href="{{ route('sales.receipt', $sale->id) }}" class="btn btn-info" target="_blank">
                <i class="icon">🧾</i>
                Lihat Struk
            </a>
            <a href="{{ route('admin.transactions') }}" class="btn btn-secondary">
                <i class="icon">📊</i>
                Kembali ke Daftar Transaksi
            </a>
        </div>
    </div>
</div>
@endsection