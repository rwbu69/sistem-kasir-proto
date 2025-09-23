@extends('layouts.app')

@section('title', 'Struk Belanja')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card receipt">
            <div class="card-header text-center">
                <h4>Struk Belanja</h4>
                <span class="badge bg-primary fs-6">Struk #{{ str_pad($sale->id, 6, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    <p class="mb-1"><strong>Tanggal:</strong> {{ $sale->created_at->format('d F Y') }}</p>
                    <p class="mb-1"><strong>Waktu:</strong> {{ $sale->created_at->format('H:i') }} WIB</p>
                </div>
                
                <hr>
                
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Qty</th>
                                <th>Harga</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sale->saleItems as $item)
                            <tr>
                                <td><strong>{{ $item->product->name }}</strong></td>
                                <td><span class="badge bg-light text-dark">{{ $item->quantity }}</span></td>
                                <td>Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                                <td><strong>Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</strong></td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="table-success">
                                <th colspan="3" class="text-end">Total Pembayaran:</th>
                                <th class="product-price">Rp{{ number_format($sale->total_amount, 0, ',', '.') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                <hr>
                
                <div class="text-center mb-2">
                    <div class="cart-total">
                        <div class="mb-2">Terima Kasih!</h5>
                        <div class="mb-3">Atas kepercayaan Anda berbelanja di toko kami.</p>
                    </div>
                    
                    <div class="d-flex gap-2 justify-content-center flex-wrap mt-3">
                        <a href="{{ route('sales.cashier') }}" class="btn btn-primary">Penjualan Baru</a>
                        <a href="{{ route('sales.index') }}" class="btn btn-secondary">Riwayat Penjualan</a>
                        <button onclick="window.print()" class="btn btn-info">Cetak Struk</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    .navbar, .btn, .alert {
        display: none !important;
    }
    .container {
        margin: 0 !important;
        padding: 0 !important;
    }
    .receipt {
        max-width: 80mm;
        margin: 0 auto;
    }
}
</style>
@endsection