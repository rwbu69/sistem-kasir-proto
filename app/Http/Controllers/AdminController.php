<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function dashboard()
    {
        // Statistics
        $totalProducts = Product::count();
        $totalUsers = User::where('role', 'user')->count();
        $totalSales = Sale::count();
        $totalRevenue = Sale::sum('total_amount');
        
        // Recent sales
        $recentSales = Sale::with('saleItems.product')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
            
        // Top products
        $topProducts = Product::select('products.*', DB::raw('SUM(sale_items.quantity) as total_sold'))
            ->leftJoin('sale_items', 'products.id', '=', 'sale_items.product_id')
            ->groupBy('products.id', 'products.name', 'products.price', 'products.stock', 'products.description', 'products.created_at', 'products.updated_at')
            ->orderBy('total_sold', 'desc')
            ->limit(5)
            ->get();
        
        // Monthly revenue (last 6 months)
        $monthlyRevenue = Sale::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('YEAR(created_at) as year'),
            DB::raw('SUM(total_amount) as revenue')
        )
        ->where('created_at', '>=', now()->subMonths(6))
        ->groupBy(DB::raw('MONTH(created_at)'), DB::raw('YEAR(created_at)'))
        ->orderBy('year', 'desc')
        ->orderBy('month', 'desc')
        ->get();

        return view('admin.dashboard', compact(
            'totalProducts', 
            'totalUsers', 
            'totalSales', 
            'totalRevenue',
            'recentSales',
            'topProducts',
            'monthlyRevenue'
        ));
    }

    /**
     * Show all users
     */
    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users', compact('users'));
    }

    /**
     * Show all transactions
     */
    public function transactions()
    {
        $sales = Sale::with('saleItems.product')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('admin.transactions', compact('sales'));
    }

    /**
     * Show transaction details
     */
    public function transactionDetail($id)
    {
        $sale = Sale::with('saleItems.product')->findOrFail($id);
        return view('admin.transaction-detail', compact('sale'));
    }
}
