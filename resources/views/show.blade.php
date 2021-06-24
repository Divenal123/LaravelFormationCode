@extends('template')
@section('content')
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">Titre : {{ $film->title }}</p>
        </header>
        <div class="card-content">
            <div class="content">
                <p>Année de sortie : {{ $film->year }}</p>
                <p>Catégorie : {{ $category }}</p>
                <p>{{ $film->description }}</p>
            </div>
        </div>
    </div>
@endsection
