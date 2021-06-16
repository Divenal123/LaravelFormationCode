@extends('layout')

@section('content')

<style>
  .uper {
    margin-top: 40px;
  }
</style>

<div class="card uper">
  <div class="card-header">
    Modifier la voiture
  </div>

  <div class="card-body">

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif

      <form method="post" action="{{ route('cars.update', $car->id ) }}">
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="marque">Marque :</label>
              <input type="text" class="form-control" name="marque" value="{{ $car->marque }}"/>
          </div>

          <div class="form-group">
              <label for="cases">Prix :</label>
              <input type="text" class="form-control" name="prix" value="{{ $car->prix }}"/>
          </div>
          <button type="submit" class="btn btn-primary">Modifier</button>
      </form>
  </div>
</div>
@endsection