@extends('layout')
@section('content')

    <div class="card mt-4">
        <div class="card-body">
            <form class="row g-3" action="{{ route('jogadores.store') }}" method="POST">
                @csrf
                <div class="col-md-4">
                    <label for="name" class="form-label">Nome</label>
                    <input name="name" type="text" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="inputPassword4" class="form-label">Nivel</label>
                    <input name="level" type="number" class="form-control" min="1" max="5" required
                        oninput="this.value = Math.abs(this.value)">
                </div>
                <div class="col-md-4">
                    <label for="inputPassword4" class="form-label">Goleiro</label>
                    <div class="form-check pt-1">
                        <input class="form-check-input" type="checkbox" value="1" name="goalkeeper">
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
                            <th scope="row">{{ $jogador->id }}</th>
                            <td>{{ $jogador->name }}</td>
                            <td>{{ $jogador->level }}</td>
                            <td>{{ $jogador->goalkeeper == 1 ? 'Sim' : 'Não' }}</td>
                            <td>
                                <a href="#modal-jogadores" type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#modal-jogadores" data-id="{{ $jogador->id }}"
                                    data-name="{{ $jogador->name }}" data-level="{{ $jogador->level }}"
                                    data-goalkeeper="{{ $jogador->goalkeeper }}"
                                    data-action="{{ route('jogadores.update', $jogador->id) }}">Atualizar</a>
                                {!! Form::open(['method' => 'DELETE', 'url' => route('jogadores.destroy', $jogador->id), 'style' => 'display:inline']) !!}
                                
                                {!! Form::button('<i class="ft-trash"></i>delete', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'title' => 'Delete Post', 'onclick' => 'return confirm("Confirm delete?")']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <x-modal id="modal-jogadores">
        <form class="row g-3" action="" method="POST" id="form">
            @csrf
            @method('PATCH')
            <input type="hidden" id="id" name='id'>
            <div class="col-md-4">
                <label for="name" class="form-label">Nome</label>
                <input name="name" type="text" class="form-control" id="name" required>
            </div>
            <div class="col-md-4">
                <label for="inputPassword4" class="form-label">Nivel</label>
                <input name="level" type="number" class="form-control" id="number" min="1" max="5" required
                    oninput="this.value = Math.abs(this.value)">
            </div>
            <div class="col-md-4">
                <label for="inputPassword4" class="form-label">Goleiro</label>
                <div class="form-check pt-1">
                    <input class="form-check-input" type="checkbox" value="1" id="goalkeeper" name="goalkeeper">
                </div>
            </div>
    </x-modal>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#modal-jogadores').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id = button.data('id')
                var name = button.data('name')
                var level = button.data('level')
                var goalkeeper = button.data('goalkeeper')
                var action = button.data(action)
                var modal = $(this)
                modal.find('#name').val(name)
                modal.find('#id').val(id)
                modal.find('#number').val(level)
                $("#form").attr("action", action.action); //Will set it
                if (goalkeeper == 1) {
                    $('#goalkeeper').prop('checked', true);
                } else {
                    $('#goalkeeper').prop('checked', false);
                }
            })
        });

    </script>
@endsection
