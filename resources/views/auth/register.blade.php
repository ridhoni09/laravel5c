@extends('layouts.app')
@section('title', 'Daftar')
@section('content')
<div class="row justify-content-center"><div class="col-md-7 col-lg-5">
    <div class="card border-0 shadow-sm rounded-4"><div class="card-body p-4 p-md-5">
        <h1 class="h3 fw-bold mb-2">Buat akun Mealmate</h1><p class="text-secondary mb-4">Mulai koleksi resep favoritmu.</p>
        <form action="{{ route('register') }}" method="POST">@csrf
            <div class="mb-3"><label for="name" class="form-label">Nama</label><input id="name" name="name" value="{{ old('name') }}" autocomplete="name" required maxlength="255" class="form-control @error('name') is-invalid @enderror">@error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
            <div class="mb-3"><label for="email" class="form-label">Email</label><input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="email" required class="form-control @error('email') is-invalid @enderror">@error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
            <div class="mb-3"><label for="password" class="form-label">Password (minimal 8 karakter)</label><input id="password" type="password" name="password" autocomplete="new-password" minlength="8" required class="form-control @error('password') is-invalid @enderror">@error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
            <div class="mb-4"><label for="password_confirmation" class="form-label">Konfirmasi password</label><input id="password_confirmation" type="password" name="password_confirmation" autocomplete="new-password" minlength="8" required class="form-control"></div>
            <button type="submit" class="btn btn-success w-100 py-2">Buat Akun</button>
        </form>
        <p class="text-center mt-4 mb-0">Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
    </div></div>
</div></div>
@endsection
