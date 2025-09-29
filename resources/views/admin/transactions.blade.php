@extends('layouts.app')

@section('title', 'Kelola Transaksi - Admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="mb-0">
            <i class="icon">📊</i>
            Semua Transaksi
        </h4>
    </div>
    <div class="card-body">
        @if($sales->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID Transaksi</th>
                            <th>Total Amount</th>
                            <th>Jumlah Item</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sales as $sale)
                        <tr>
                            <td>#{{ $sale->id }}</td>
                            <td>Rp {{ number_format($sale->total_amount, 0, ',', '.') }}</td>
                            <td>{{ $sale->saleItems->count() }} item</td>
                            <td>{{ $sale->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.transaction.detail', $sale->id) }}" class="btn btn-sm btn-info">
                                    <i class="icon">👁️</i>
                                    Detail
                                </a>
                                <a href="{{ route('sales.receipt', $sale->id) }}" class="btn btn-sm btn-secondary" target="_blank">
                                    <i class="icon">🧾</i>
                                    Struk
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $sales->links() }}
            </div>
        @else
            <div class="text-center py-4">
                <p class="text-muted">Belum ada transaksi.</p>
            </div>
        @endif
    </div>
</div>
@endsection