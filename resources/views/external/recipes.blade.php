@extends('layout')

@section('title', 'Inspirasi Menu')
@section('header', 'Cari Inspirasi Menu dari Seluruh Dunia')

@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Temukan Ide Resep untuk Menu Baru Anda</h6>
    </div>
    <div class="card-body">
        <!-- Formulir Pencarian -->
        <form action="{{ route('recipes.external') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari ide untuk Ayam Bakar, Pasta, Sup..." value="{{ $searchQuery ?? '' }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Cari Ide</button>
                </div>
            </div>
        </form>

        <!-- Menampilkan Pesan Error Jika Ada -->
        @if (!empty($error))
            <div class="alert alert-danger text-center">
                <i class="fas fa-exclamation-triangle"></i> {{ $error }}
            </div>
        @endif

        <!-- Hasil Pencarian -->
        <div class="row">
            @if (!empty($recipes))
                @foreach ($recipes as $recipe)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="{{ $recipe['strMealThumb'] }}" class="card-img-top" alt="[Gambar {{ $recipe['strMeal'] }}]">
                            <div class="card-body">
                                <h5 class="card-title">{{ $recipe['strMeal'] }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Kategori: {{ $recipe['strCategory'] }} | Asal: {{ $recipe['strArea'] }}</h6>
                                <p class="card-text">{{ \Illuminate\Support\Str::limit($recipe['strInstructions'], 120) }}</p>
                            </div>
                            <div class="card-footer bg-white border-top-0">
                                 <a href="{{ route('recipes.show.external', $recipe['idMeal']) }}" class="btn btn-sm btn-info">Lihat Resep Lengkap</a>
                                 @if($recipe['strYoutube'])
                                    <a href="{{ $recipe['strYoutube'] }}" target="_blank" class="btn btn-sm btn-danger float-right" title="Tonton Tutorial"><i class="fab fa-youtube"></i></a>
                                 @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @elseif (empty($error))
                <div class="col-12">
                    <div class="alert alert-warning text-center">
                        Tidak ditemukan inspirasi untuk "{{ $searchQuery }}". Coba kata kunci lain.
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
