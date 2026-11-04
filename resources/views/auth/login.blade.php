@extends('layouts.app')
@section('title', 'Login')
@section('content')
<div class="row justify-content-center"><div class="col-md-7 col-lg-5">
    <div class="card border-0 shadow-sm rounded-4"><div class="card-body p-4 p-md-5">
        <h1 class="h3 fw-bold mb-2">Selamat datang kembali</h1>
        <p class="text-secondary mb-4">Masuk untuk mengatur resep dan menu mingguanmu.</p>
        <form action="{{ route('login') }}" method="POST">@csrf
            <div class="mb-3"><label for="email" class="form-label">Email</label><input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="email" required autofocus class="form-control @error('email') is-invalid @enderror">@error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
            <div class="mb-3"><label for="password" class="form-label">Password</label><input id="password" type="password" name="password" autocomplete="current-password" required class="form-control @error('password') is-invalid @enderror">@error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
            <div class="form-check mb-4"><input class="form-check-input" type="checkbox" name="remember" value="1" id="remember"><label class="form-check-label" for="remember">Ingat saya</label></div>
            <button type="submit" class="btn btn-success w-100 py-2">Login</button>
        </form>
        <p class="text-center mt-4 mb-0">Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a></p>
    </div></div>
</div></div>
@endsection
