<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Kasir')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>
<body>
    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            @auth
                <h4><a href="{{ Auth::user()->isAdmin() ? route('admin.dashboard') : route('products.index') }}" class="sidebar-brand">Sistem Kasir</a></h4>
            @else
                <h4><a href="{{ route('login') }}" class="sidebar-brand">Sistem Kasir</a></h4>
            @endauth
        </div>
        <ul class="sidebar-nav">
            @auth
                @if(Auth::user()->isAdmin())
                    <!-- Admin Menu -->
                    <li class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
                            <i class="icon">📊</i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('products.*') ? 'active' : '' }}">
                        <a href="{{ route('products.index') }}" class="sidebar-link">
                            <i class="icon">📦</i>
                            <span>Kelola Produk</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                        <a href="{{ route('admin.users') }}" class="sidebar-link">
                            <i class="icon">👥</i>
                            <span>Kelola User</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('admin.transactions') ? 'active' : '' }}">
                        <a href="{{ route('admin.transactions') }}" class="sidebar-link">
                            <i class="icon">📊</i>
                            <span>Laporan Transaksi</span>
                        </a>
                    </li>
                @endif
                
                <!-- User Menu (available to all authenticated users) -->
                <li class="sidebar-item {{ request()->routeIs('products.index') && !request()->routeIs('products.create') && !request()->routeIs('products.edit') ? 'active' : '' }}">
                    <a href="{{ route('products.index') }}" class="sidebar-link">
                        <i class="icon">📦</i>
                        <span>Produk</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('sales.cashier') ? 'active' : '' }}">
                    <a href="{{ route('sales.cashier') }}" class="sidebar-link">
                        <i class="icon">💰</i>
                        <span>Kasir</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('sales.index') ? 'active' : '' }}">
                    <a href="{{ route('sales.index') }}" class="sidebar-link">
                        <i class="icon">📊</i>
                        <span>Riwayat Penjualan</span>
                    </a>
                </li>
                
                <!-- User Info and Logout -->
                <li class="sidebar-item mt-3" style="border-top: 1px solid rgba(255,255,255,0.1); padding-top: 1rem;">
                    <div class="sidebar-link">
                        <i class="icon">👤</i>
                        <div>
                            <small>{{ Auth::user()->name }}</small><br>
                            <small class="text-muted">{{ Auth::user()->role === 'admin' ? 'Administrator' : 'User' }}</small>
                        </div>
                    </div>
                </li>
                <li class="sidebar-item">
                    <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                        @csrf
                        <button type="submit" class="sidebar-link btn btn-link text-start w-100" style="border: none; background: none; color: #DBE2EF;">
                            <i class="icon">🚪</i>
                            <span>Logout</span>
                        </button>
                    </form>
                </li>
            @else
                <!-- Guest Menu -->
                <li class="sidebar-item {{ request()->routeIs('login') ? 'active' : '' }}">
                    <a href="{{ route('login') }}" class="sidebar-link">
                        <i class="icon">🔐</i>
                        <span>Login</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('register') ? 'active' : '' }}">
                    <a href="{{ route('register') }}" class="sidebar-link">
                        <i class="icon">📝</i>
                        <span>Register</span>
                    </a>
                </li>
            @endauth
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Mobile Toggle Button -->
        <button class="mobile-toggle d-md-none" id="sidebarToggle">
            <span></span>
            <span></span>
            <span></span>
        </button>
        
        <div class="content-wrapper">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mobile sidebar toggle
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            if (sidebarToggle && sidebar && overlay) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                    overlay.classList.toggle('show');
                });
                
                // Close sidebar when clicking overlay
                overlay.addEventListener('click', function() {
                    sidebar.classList.remove('show');
                    overlay.classList.remove('show');
                });
                
                // Close sidebar on window resize if desktop
                window.addEventListener('resize', function() {
                    if (window.innerWidth > 768) {
                        sidebar.classList.remove('show');
                        overlay.classList.remove('show');
                    }
                });
            }
        });
    </script>
    @yield('scripts')
</body>
</html>