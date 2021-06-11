@extends('layout')
@section('content')
<div class="card mt-4">
    <div class="card-body">
        <form class="row g-3" action="{{ route('presenca.save') }}" method="POST">
            @csrf
            <div class="col-md-4">
                <label for="name" class="form-label">Jogadores</label>
                <select class="selectpicker form-control" name="jogador_id[]" multiple  data-live-search="true" >
                   @foreach ( $jogadores as $jogador )
                   <option value="{{ $jogador->id }}" >{{ $jogador->name }}</option>
                   @endforeach
                  </select>
            </div>
            <div class="col-md-4">
                <label for="name" class="form-label">Data</label>
                <input name="date" type="date" class="form-control" id="date" required>
            </div>
            <div class="col-md-4">
                <label for="inputPassword4" class="form-label">Presença</label>
                <div class="form-check pt-1">
                    <input class="form-check-input" type="checkbox" value="1" id="presenca" name="presenca">
                  </div>
            </div>
            <div class="col-12 mt-2">
            <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
        <table class=" table m-1">
            <thead>
              <tr>
                <th scope="col">Jogador</th>
                <th scope="col">Data</th>
                <th scope="col">Presença</th>
                <th scope="col">Ações</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($presencas as $presenca)
                <tr>
                    <td>{{ $presenca->jogadores->name}}</td>
                    <td>{{ $presenca->date}}</td>
                    <td>{{ $presenca->presenca== 1 ? 'Presente :)' : 'Faltou ;('  }}</td>
                    <td>editar, deletar</td>
                  </tr>
                @endforeach
            </tbody>
          </table>
    </div>
</div>

@endsection
