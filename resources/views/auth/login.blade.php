@extends('layouts.auth')

@section('title', 'Login - Sistem Kasir')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="mb-0 text-center">
            Login ke Sistem
        </h4>
    </div>
    <div class="card-body">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input 
                    type="text" 
                    class="form-control @error('username') is-invalid @enderror" 
                    id="username" 
                    name="username" 
                    value="{{ old('username') }}" 
                    required
                    placeholder="Masukkan username Anda"
                >
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input 
                    type="password" 
                    class="form-control @error('password') is-invalid @enderror" 
                    id="password" 
                    name="password" 
                    required
                    placeholder="Masukkan password Anda"
                >
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">
                    Ingat saya
                </label>
            </div>

            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary">
                    Login
                </button>
            </div>
        </form>

        <div class="text-center">
            <p class="mb-0">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="text-decoration-none">
                    Daftar sekarang
                </a>
            </p>
        </div>
    </div>
</div>

<!-- Demo Accounts Info -->
<!-- <div class="card mt-3">
    <div class="card-header">
        <h6 class="mb-0 text-center">
            Akun Demo
        </h6>
    </div>
    <div class="card-body">
        <small class="text-muted">
            <strong>Admin:</strong> username: admin, password: admin123<br>
            <strong>User:</strong> username: user, password: user123
        </small>
    </div>
</div> -->
@endsection