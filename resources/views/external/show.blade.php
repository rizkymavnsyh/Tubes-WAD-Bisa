@extends('layout')

@section('title', 'Detail Resep')
@section('header', 'Detail Inspirasi Menu')

@section('content')

@if (!empty($error))
    <div class="alert alert-danger text-center">
        <i class="fas fa-exclamation-triangle"></i> {{ $error }}
    </div>
@elseif (!empty($recipe))
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $recipe['strMeal'] }}</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ $recipe['strMealThumb'] }}" class="img-fluid rounded mb-3" alt="[Gambar {{ $recipe['strMeal'] }}]">
                    <h5>Kategori: <span class="badge badge-primary">{{ $recipe['strCategory'] }}</span></h5>
                    <h5>Asal: <span class="badge badge-success">{{ $recipe['strArea'] }}</span></h5>
                    @if($recipe['strTags'])
                        <h5 class="mt-2">Tags:
                            @foreach(explode(',', $recipe['strTags']) as $tag)
                                <span class="badge badge-info mr-1">{{ $tag }}</span>
                            @endforeach
                        </h5>
                    @endif
                     @if($recipe['strYoutube'])
                        <a href="{{ $recipe['strYoutube'] }}" target="_blank" class="btn btn-danger btn-block mt-3"><i class="fab fa-youtube"></i> Tonton Video Tutorial</a>
                     @endif
                </div>
                <div class="col-md-8">
                    <h4>Bahan-bahan</h4>
                    <ul class="list-group list-group-flush mb-4">
                        @for ($i = 1; $i <= 20; $i++)
                            @if (!empty(trim($recipe['strIngredient'.$i])))
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $recipe['strIngredient'.$i] }}
                                    <span class="badge badge-secondary badge-pill">{{ $recipe['strMeasure'.$i] }}</span>
                                </li>
                            @endif
                        @endfor
                    </ul>

                    <h4>Instruksi Memasak</h4>
                    <p style="white-space: pre-wrap; text-align: justify;">{{ $recipe['strInstructions'] }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer">
             <a href="{{ url()->previous() }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
@endif

@endsection
