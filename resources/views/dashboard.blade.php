@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-4">
    <div>
        <p class="text-success fw-semibold mb-1"><i class="bi bi-sun me-1"></i> Selamat datang di Mealmate</p>
        <h1 class="fw-bold mb-1">Halo, {{ $user->name }}!</h1>
        <p class="text-secondary mb-0">Ringkasan aktivitas masak dan rencana makanmu.</p>
    </div>
    <span class="badge text-bg-light border px-3 py-2">{{ now()->locale('id')->translatedFormat('l, d F Y') }}</span>
</div>

<div class="row g-3 mb-5">
    @foreach ([
        ['label' => 'Resep Saya', 'value' => $stats['recipes'], 'icon' => 'book', 'color' => 'success'],
        ['label' => 'Favorit', 'value' => $stats['favorites'], 'icon' => 'heart', 'color' => 'danger'],
        ['label' => 'Ulasan Saya', 'value' => $stats['reviews'], 'icon' => 'star', 'color' => 'warning'],
        ['label' => 'Meal Plans', 'value' => $stats['meal_plans'], 'icon' => 'calendar-week', 'color' => 'primary'],
    ] as $stat)
        <div class="col-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100 rounded-4">
                <div class="card-body p-4">
                    <div class="text-{{ $stat['color'] }} mb-2"><i class="bi bi-{{ $stat['icon'] }} fs-3"></i></div>
                    <div class="fs-2 fw-bold">{{ number_format($stat['value']) }}</div>
                    <div class="text-secondary small">{{ $stat['label'] }}</div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="d-flex align-items-center justify-content-between mb-3">
    <h2 class="h4 fw-bold mb-0">Rencana Makan Minggu Ini</h2>
</div>
<div class="card border-0 shadow-sm rounded-4 mb-5">
    <div class="card-body p-3 p-md-4">
        @if ($activePlan)
            <p class="text-secondary mb-3">Plan aktif: <strong class="text-dark">{{ $activePlan->name }}</strong></p>
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-3">
                @foreach ($weekDays as $day)
                    @php($meals = $weekMeals->get($day->toDateString(), collect()))
                    <div class="col">
                        <div class="border rounded-3 p-3 h-100">
                            <div class="fw-semibold mb-2">{{ $day->locale('id')->translatedFormat('l, d M') }}</div>
                            @forelse ($meals as $meal)
                                <div class="small mb-2">
                                    <span class="badge text-bg-success">{{ ucfirst($meal->pivot->meal_type) }}</span>
                                    <div class="mt-1">{{ $meal->title }} <span class="text-secondary">({{ $meal->pivot->servings }} porsi)</span></div>
                                </div>
                            @empty
                                <span class="text-secondary small">Belum ada menu</span>
                            @endforelse
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-4">
                <i class="bi bi-calendar2-week fs-1 text-success"></i>
                <h3 class="h5 mt-3">Belum ada meal plan aktif</h3>
                <p class="text-secondary mb-0">Saat fitur Meal Planner tersedia, jadwal makan mingguan akan muncul di sini.</p>
            </div>
        @endif
    </div>
</div>

<h2 class="h4 fw-bold mb-3">Resep Terbaru</h2>
<div class="row g-3">
    @forelse ($recentRecipes as $recipe)
        <div class="col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm h-100 rounded-4">
                <div class="card-body p-4">
                    <span class="badge text-bg-light border mb-3">{{ $recipe->category?->name ?? 'Tanpa kategori' }}</span>
                    <h3 class="h5 fw-bold">{{ $recipe->title }}</h3>
                    <p class="text-secondary small mb-3">{{ \Illuminate\Support\Str::limit($recipe->description, 100) }}</p>
                    <div class="d-flex justify-content-between small text-secondary">
                        <span><i class="bi bi-person me-1"></i>{{ $recipe->user?->name ?? 'Pengguna' }}</span>
                        <span><i class="bi bi-clock me-1"></i>{{ ($recipe->prep_minutes ?? 0) + ($recipe->cook_minutes ?? 0) }} menit</span>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="bg-white text-center rounded-4 p-5 border">
                <i class="bi bi-journal-text fs-1 text-success"></i>
                <h3 class="h5 mt-3">Belum ada resep</h3>
                <p class="text-secondary mb-0">Resep publik dan resep milikmu akan ditampilkan di sini.</p>
            </div>
        </div>
    @endforelse
</div>
@endsection
