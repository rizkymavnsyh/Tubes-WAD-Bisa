@extends('layout')

@section('title', 'Cari Resep Eksternal')
@section('header', 'Pencarian Resep dari TheMealDB')

@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Cari Resep Makanan Internasional</h6>
    </div>
    <div class="card-body">
        <!-- Formulir Pencarian -->
        <form action="{{ route('recipes.external') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Contoh: Chicken, Pasta, Soup..." value="{{ $searchQuery }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </div>
        </form>

        <!-- Hasil Pencarian -->
        <div class="row">
            @if (!empty($recipes))
                @foreach ($recipes as $recipe)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="{{ $recipe['strMealThumb'] }}" class="card-img-top" alt="{{ $recipe['strMeal'] }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $recipe['strMeal'] }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Kategori: {{ $recipe['strCategory'] }} | Asal: {{ $recipe['strArea'] }}</h6>
                                <p class="card-text">{{ \Illuminate\Support\Str::limit($recipe['strInstructions'], 150) }}</p>
                            </div>
                            <div class="card-footer bg-white border-top-0">
                                 <a href="{{ $recipe['strSource'] }}" target="_blank" class="btn btn-sm btn-info">Lihat Resep Lengkap</a>
                                 @if($recipe['strYoutube'])
                                    <a href="{{ $recipe['strYoutube'] }}" target="_blank" class="btn btn-sm btn-danger">Tonton di YouTube</a>
                                 @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <div class="alert alert-warning text-center">
                        Resep untuk "{{ $searchQuery }}" tidak ditemukan. Coba kata kunci lain.
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
