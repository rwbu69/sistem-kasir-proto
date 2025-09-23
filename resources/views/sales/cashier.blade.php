@extends('layouts.app')

@section('title', 'Kasir')

@section('content')
<h2>Kasir</h2>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Produk Tersedia</h5>
            </div>
            <div class="card-body">
                <div class="row" id="product-list">
                    @foreach($products as $product)
                    <div class="col-md-4 mb-3">
                        <div class="card product-card" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $product->price }}" data-stock="{{ $product->stock }}">
                            <div class="card-body text-center">
                                <h6 class="card-title">{{ $product->name }}</h6>
                                <p class="product-price mb-1">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                                <p class="product-stock mb-3">
                                    @if($product->stock > 0)
                                        Stok: {{ $product->stock }}
                                    @else
                                        <span class="text-danger">Stok Habis</span>
                                    @endif
                                </p>
                                <button class="btn btn-sm btn-primary add-to-cart" {{ $product->stock == 0 ? 'disabled' : '' }}>
                                    Tambah ke Keranjang
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Keranjang Belanja</h5>
            </div>
            <div class="card-body">
                <form id="sale-form" action="{{ route('sales.process') }}" method="POST">
                    @csrf
                    <div id="cart-items">
                        <p class="text-muted">Keranjang kosong</p>
                    </div>
                    
                    <hr>
                    <div class="cart-total text-center">
                        <strong>Total: Rp<span id="total-amount">0</span></strong>
                    </div>
                    
                    <button type="submit" class="btn btn-success w-100 mt-3" id="process-sale" disabled>Proses Penjualan</button>
                    <button type="button" class="btn btn-secondary w-100 mt-2" id="clear-cart">Kosongkan Keranjang</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
let cart = [];
let totalAmount = 0;

document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', function() {
        const card = this.closest('.product-card');
        const productId = card.dataset.id;
        const productName = card.dataset.name;
        const productPrice = parseFloat(card.dataset.price);
        const productStock = parseInt(card.dataset.stock);
        
        addToCart(productId, productName, productPrice, productStock);
    });
});

function addToCart(id, name, price, stock) {
    const existingItem = cart.find(item => item.id === id);
    
    if (existingItem) {
        if (existingItem.quantity < stock) {
            existingItem.quantity++;
        } else {
            alert('Tidak dapat menambah item lagi. Stok tidak mencukupi.');
            return;
        }
    } else {
        cart.push({
            id: id,
            name: name,
            price: price,
            quantity: 1,
            maxStock: stock
        });
    }
    
    updateCartDisplay();
}

function updateCartDisplay() {
    const cartContainer = document.getElementById('cart-items');
    const totalSpan = document.getElementById('total-amount');
    const processSaleBtn = document.getElementById('process-sale');
    
    if (cart.length === 0) {
        cartContainer.innerHTML = '<p class="text-muted">Keranjang kosong</p>';
        totalAmount = 0;
        processSaleBtn.disabled = true;
    } else {
        let html = '';
        totalAmount = 0;
        
        cart.forEach((item, index) => {
            const itemTotal = item.price * item.quantity;
            totalAmount += itemTotal;
            
            html += `
                <div class="cart-item mb-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <strong>${item.name}</strong><br>
                            <small>Rp${item.price.toLocaleString('id-ID')} x ${item.quantity} = Rp${itemTotal.toLocaleString('id-ID')}</small>
                        </div>
                        <div>
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="decreaseQuantity(${index})">-</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="increaseQuantity(${index})">+</button>
                            <button type="button" class="btn btn-sm btn-danger" onclick="removeFromCart(${index})">×</button>
                        </div>
                    </div>
                    <input type="hidden" name="items[${index}][product_id]" value="${item.id}">
                    <input type="hidden" name="items[${index}][quantity]" value="${item.quantity}">
                </div>
            `;
        });
        
        cartContainer.innerHTML = html;
        processSaleBtn.disabled = false;
    }
    
    totalSpan.textContent = totalAmount.toLocaleString('id-ID');
}

function increaseQuantity(index) {
    if (cart[index].quantity < cart[index].maxStock) {
        cart[index].quantity++;
        updateCartDisplay();
    } else {
        alert('Tidak dapat menambah jumlah. Stok tidak mencukupi.');
    }
}

function decreaseQuantity(index) {
    if (cart[index].quantity > 1) {
        cart[index].quantity--;
        updateCartDisplay();
    }
}

function removeFromCart(index) {
    cart.splice(index, 1);
    updateCartDisplay();
}

document.getElementById('clear-cart').addEventListener('click', function() {
    cart = [];
    updateCartDisplay();
});
</script>
@endsection