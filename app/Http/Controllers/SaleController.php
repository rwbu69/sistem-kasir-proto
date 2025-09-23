<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('saleItems.product')->latest()->get();
        return view('sales.index', compact('sales'));
    }

    public function cashier()
    {
        $products = Product::where('stock', '>', 0)->get();
        return view('sales.cashier', compact('products'));
    }

    public function processSale(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1'
        ], [
            'items.required' => 'Keranjang belanja tidak boleh kosong.',
            'items.min' => 'Setidaknya harus ada satu item dalam keranjang.',
            'items.*.product_id.required' => 'ID produk wajib diisi.',
            'items.*.product_id.exists' => 'Produk tidak ditemukan.',
            'items.*.quantity.required' => 'Jumlah item wajib diisi.',
            'items.*.quantity.integer' => 'Jumlah item harus berupa angka bulat.',
            'items.*.quantity.min' => 'Jumlah item minimal 1.'
        ]);

        $totalAmount = 0;
        $saleItems = [];

        // Calculate total and validate stock
        foreach ($request->items as $item) {
            $product = Product::find($item['product_id']);
            
            if ($product->stock < $item['quantity']) {
                return back()->withErrors(['error' => "Stok tidak mencukupi untuk {$product->name}"]);
            }

            $itemTotal = $product->price * $item['quantity'];
            $totalAmount += $itemTotal;

            $saleItems[] = [
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'price' => $product->price,
                'product' => $product
            ];
        }

        // Create sale
        $sale = Sale::create(['total_amount' => $totalAmount]);

        // Create sale items and update stock
        foreach ($saleItems as $item) {
            SaleItem::create([
                'sale_id' => $sale->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);

            // Update product stock
            $item['product']->decrement('stock', $item['quantity']);
        }

        return redirect()->route('sales.receipt', $sale->id)->with('success', 'Penjualan berhasil diproses!');
    }

    public function receipt(Sale $sale)
    {
        $sale->load('saleItems.product');
        return view('sales.receipt', compact('sale'));
    }
}
