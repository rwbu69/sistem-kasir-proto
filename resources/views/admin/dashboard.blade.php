@extends('layouts.app')

@section('title', 'Dashboard Admin - Sistem Kasir')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <h4 class="mb-0">
                    <i class="icon">📊</i>
                    Dashboard Admin
                </h4>
            </div>
            <div class="card-body">
                <p>Selamat datang, <strong>{{ Auth::user()->name }}</strong>! Anda masuk sebagai Administrator.</p>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body text-center">
                <h3 class="text-primary">{{ $totalProducts }}</h3>
                <p class="mb-0">
                    <i class="icon">📦</i>
                    Total Produk
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body text-center">
                <h3 class="text-success">{{ $totalUsers }}</h3>
                <p class="mb-0">
                    <i class="icon">👥</i>
                    Total User
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body text-center">
                <h3 class="text-info">{{ $totalSales }}</h3>
                <p class="mb-0">
                    <i class="icon">🛒</i>
                    Total Transaksi
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body text-center">
                <h3 class="text-warning">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                <p class="mb-0">
                    <i class="icon">💰</i>
                    Total Pendapatan
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Sales -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="icon">🕒</i>
                    Transaksi Terbaru
                </h5>
            </div>
            <div class="card-body">
                @if($recentSales->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Total</th>
                                    <th>Item</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentSales as $sale)
                                <tr>
                                    <td>#{{ $sale->id }}</td>
                                    <td>Rp {{ number_format($sale->total_amount, 0, ',', '.') }}</td>
                                    <td>{{ $sale->saleItems->count() }} item</td>
                                    <td>{{ $sale->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.transaction.detail', $sale->id) }}" class="btn btn-sm btn-info">
                                            Lihat Detail
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-3">
                        <a href="{{ route('admin.transactions') }}" class="btn btn-primary">
                            Lihat Semua Transaksi
                        </a>
                    </div>
                @else
                    <div class="text-center py-4">
                        <p class="text-muted">Belum ada transaksi.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Top Products -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="icon">🏆</i>
                    Produk Terlaris
                </h5>
            </div>
            <div class="card-body">
                @if($topProducts->count() > 0)
                    @foreach($topProducts as $product)
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h6 class="mb-1">{{ $product->name }}</h6>
                            <small class="text-muted">Stok: {{ $product->stock }}</small>
                        </div>
                        <div class="text-end">
                            <strong>{{ $product->total_sold ?? 0 }} terjual</strong><br>
                            <small>Rp {{ number_format($product->price, 0, ',', '.') }}</small>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="text-center py-4">
                        <p class="text-muted">Belum ada data penjualan.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="icon">⚡</i>
                    Aksi Cepat
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <a href="{{ route('products.create') }}" class="btn btn-success w-100">
                            <i class="icon">➕</i>
                            Tambah Produk
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <a href="{{ route('products.index') }}" class="btn btn-info w-100">
                            <i class="icon">📦</i>
                            Kelola Produk
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <a href="{{ route('admin.users') }}" class="btn btn-secondary w-100">
                            <i class="icon">👥</i>
                            Kelola User
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <a href="{{ route('admin.transactions') }}" class="btn btn-warning w-100">
                            <i class="icon">📊</i>
                            Laporan Penjualan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection