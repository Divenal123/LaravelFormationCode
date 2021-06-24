@extends('template')

@section('css')
    <style>
        .card-footer{
            justify-content: center;
            align-items: center;
            padding: 0.4em;
        }
        select, .is-info{
            margin: 0.3em;
        }
    </style>
@endsection

@section('content')
    @if(session()->has('info'))
        <div class="notification is-success">
            {{ session('info') }}
        </div>
    @endif
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">Films</p>
            <div class="select">
                <select onchange="window.location.href=this.value">
                    <option value="{{ route('films.index') }}" @unless ($slug) selected @endunless>Toutes categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ route('films.category', $category->slug) }}"{{ $slug==$category->slug?'seleted':'' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <a class="button is-info" href="{{ route('films.create') }}">Créer un film</a>
        </header>
        <div class="card-content">
            <div class="content">
                <table class="table is-hoverable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Titre</th>
                            <th>Year</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($films as $film)
                            <tr>
                                <td> {{ $film->id }} </td>
                                <td><strong>{{ $film->title }}</strong></td>
                                <td><strong>{{ $film->year }}</strong></td>
                                <td><a class="button is-primary" href="{{ route('films.show', $film->id) }}">Voir</a></td>
                                <td><a class="button is-warning" href="{{ route('films.edit', $film->id) }}">Modifier</a></td>
                                <td>
                                    <form action="{{ route('films.destroy', $film->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="button is-danger" type="submit">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <footer class="card-footer is-centered">
            {{ $films->links() }}
        </footer>
    </div>
@endsection


