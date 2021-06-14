@extends('layout')
@section('content')

    <div class="card mt-4">
        <div class="card-body">
            <form class="form-inline" method="POST" action="{{ route('sorteio.rand') }}">
                @csrf
                <div class="form-group ">
                    <div class="col-md-5 col-sm-5 col-xs-5">                      
                        <input type="number" class="form-control" name="num"
                            placeholder="defina o numero de jogadores">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary ">Sortear</button>
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
                    {{-- @foreach ($jogadores as $jogador)
                <tr>
                    <th scope="row">{{$jogador->id }}</th>
                    <td>{{ $jogador->name}}</td>
                    <td>{{ $jogador->level}}</td>
                    <td>{{ $jogador->goalkeeper == 1 ?'Sim': 'Não' }}</td>
                    <td>editar, deletar</td>
                  </tr>
                @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>

@endsection
