@extends('layouts.app')

@section('title', 'Riwayat Penjualan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Riwayat Penjualan</h2>
    <a href="{{ route('sales.cashier') }}" class="btn btn-primary">Penjualan Baru</a>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Daftar Transaksi</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID Penjualan</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Jumlah Item</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sales as $sale)
                    <tr>
                        <td><span class="badge bg-primary">#{{ str_pad($sale->id, 4, '0', STR_PAD_LEFT) }}</span></td>
                        <td>
                            <strong>{{ $sale->created_at->format('d M Y') }}</strong><br>
                            <small class="text-muted">{{ $sale->created_at->format('H:i') }}</small>
                        </td>
                        <td><span class="product-price">Rp{{ number_format($sale->total_amount, 0, ',', '.') }}</span></td>
                        <td>
                            <span class="badge bg-info">{{ $sale->saleItems->count() }} jenis</span>
                            <br><small class="text-muted">({{ $sale->saleItems->sum('quantity') }} total)</small>
                        </td>
                        <td>
                            <a href="{{ route('sales.receipt', $sale) }}" class="btn btn-sm btn-info">Lihat Struk</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">
                            <strong>Tidak ada penjualan yang ditemukan.</strong><br>
                            <a href="{{ route('sales.cashier') }}" class="btn btn-primary mt-2">Mulai Penjualan</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection