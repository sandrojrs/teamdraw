@extends('layout')
@section('content')
    <div class="card mt-4">
        <div class="card-body">
            <form class="form-inline" method="POST" action="{{ route('sorteio.rand') }}">
                @csrf
                <div class="form-group ">
                    <div class="col-md-5 col-sm-5 col-xs-5">
                        <input type="number" class="form-control" min=2 name="num"
                            placeholder="defina o numero de jogadores" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary ">Sortear</button>
            </form>
            <table class=" table m-1">
                <thead>
                    <tr>
                        <th scope="col">Jogador</th>
                        <th scope="col">Nivel</th>
                        <th scope="col">Goleiro</th>
                    </tr>
                </thead>
                @if (isset($sorteios))
                    @foreach ($sorteios as $key => $sorteio)
                        <tbody class="pt-4">
                            <tr>
                                <th scope="row mt-2">Time-{{ $key }}</th>
                            </tr>
                            @foreach ($sorteio as $value)
                                <tr>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->level }}</td>
                                    <td>{{ $value->goalkeeper == 1 ? 'Sim' : 'Não' }}</td>
                                </tr>
                            @endforeach
                    @endforeach
                    </tbody>
                @endif
            </table>
        </div>
    </div>
@endsection
