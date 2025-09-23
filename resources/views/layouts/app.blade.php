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
            <h4><a href="{{ route('products.index') }}" class="sidebar-brand">Sistem Kasir</a></h4>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-item {{ request()->routeIs('products.*') ? 'active' : '' }}">
                <a href="{{ route('products.index') }}" class="sidebar-link">
                    <span>Produk</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('sales.cashier') ? 'active' : '' }}">
                <a href="{{ route('sales.cashier') }}" class="sidebar-link">
                    <span>Kasir</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('sales.index') ? 'active' : '' }}">
                <a href="{{ route('sales.index') }}" class="sidebar-link">
                    <span>Riwayat Penjualan</span>
                </a>
            </li>
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