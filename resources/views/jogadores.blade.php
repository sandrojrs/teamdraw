@extends('layout')
@section('content')

<div class="card mt-4">
    <div class="card-body">
        <form class="row g-3" action="{{ route('jogadores.store') }}" method="POST">
            @csrf
            <div class="col-md-4">
                <label for="name" class="form-label">Nome</label>
                <input name="name" type="text" class="form-control" id="name" required>
            </div>
            <div class="col-md-4">
                <label for="inputPassword4" class="form-label">Nivel</label>
                <input  name="level" type="number" class="form-control" id="number"  min="1" max="5" required
                oninput="this.value = Math.abs(this.value)">
            </div>
            <div class="col-md-4">
                <label for="inputPassword4" class="form-label">Goleiro</label>
                <div class="form-check pt-1">
                    <input class="form-check-input" type="checkbox" value="1" id="goalkeeper" name="goalkeeper">
                  </div>
            </div>
            <div class="col-12 mt-2">
            <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
        <table class=" table m-1">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Jogador</th>
                <th scope="col">Nivel</th>
                <th scope="col">Goleiro</th>
                <th scope="col">Ações</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($jogadores as $jogador)
                <tr>
                    <th scope="row">{{$jogador->id }}</th>
                    <td>{{ $jogador->name}}</td>
                    <td>{{ $jogador->level}}</td>
                    <td>{{ $jogador->goalkeeper == 1 ?'Sim': 'Não' }}</td>
                    <td>editar, deletar</td>
                  </tr>
                @endforeach
            </tbody>
          </table>
    </div>
</div>


@endsection
