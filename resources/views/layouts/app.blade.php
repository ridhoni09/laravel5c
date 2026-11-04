<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Mealmate') · Mealmate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('css/mealmate.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">
        <div class="container py-2">
            <a class="navbar-brand fw-bold text-success" href="{{ auth()->check() ? route('dashboard') : route('login') }}"><i class="bi bi-egg-fried me-2"></i>Mealmate</a>
            <div class="ms-auto d-flex align-items-center gap-3">
                @auth
                    <span class="text-secondary d-none d-sm-inline">Hai, {{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="m-0">@csrf<button type="submit" class="btn btn-outline-success btn-sm">Logout</button></form>
                @else
                    <a class="text-decoration-none text-success" href="{{ route('login') }}">Login</a>
                    <a class="btn btn-success btn-sm" href="{{ route('register') }}">Daftar</a>
                @endauth
            </div>
        </div>
    </nav>
    <main class="container py-5">
        @if (session('success')) <div class="alert alert-success" role="alert">{{ session('success') }}</div> @endif
        @yield('content')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
