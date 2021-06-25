@extends('template')
@section('content')
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">Titre : {{ $film->title }}</p>
        </header>
        <div class="card-content">
            <div class="content">
                <p>Année de sortie : {{ $film->year }}</p>
                <hr>
                <p>Catégories :</p>
                <ul>
                    @foreach($film->categories as $category)
                        <li>{{ $category->name }}</li>
                    @endforeach
                </ul>
                <hr>
                <p>Description :</p>
                <p>{{ $film->description }}</p>
            </div>
        </div>
    </div>
@endsection