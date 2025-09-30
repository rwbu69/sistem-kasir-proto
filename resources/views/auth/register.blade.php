@extends('layouts.auth')

@section('title', 'Registrasi - Sistem Kasir')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="mb-0 text-center">
            Daftar Akun Baru
        </h4>
    </div>
    <div class="card-body">
        <form action="{{ route('register') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input 
                    type="text" 
                    class="form-control @error('name') is-invalid @enderror" 
                    id="name" 
                    name="name" 
                    value="{{ old('name') }}" 
                    required
                    placeholder="Masukkan nama lengkap Anda"
                >
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input 
                    type="text" 
                    class="form-control @error('username') is-invalid @enderror" 
                    id="username" 
                    name="username" 
                    value="{{ old('username') }}" 
                    required
                    placeholder="Pilih username unik"
                >
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input 
                    type="email" 
                    class="form-control @error('email') is-invalid @enderror" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    required
                    placeholder="contoh@email.com"
                >
                @error('email')
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
                    placeholder="Minimal 8 karakter"
                >
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input 
                    type="password" 
                    class="form-control" 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    required
                    placeholder="Ulangi password"
                >
            </div>

            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-success">
                    Daftar Sekarang
                </button>
            </div>
        </form>

        <div class="text-center">
            <p class="mb-0">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="text-decoration-none">
                    Login di sini
                </a>
            </p>
        </div>
    </div>
</div>
@endsection