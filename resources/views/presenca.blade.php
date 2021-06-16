@extends('layout')
@section('content')
    <div class="card mt-4">
        <div class="card-body">
            <form class="row g-3" action="{{ route('presenca.store') }}" method="POST">
                @csrf
                <div class="col-md-4">
                    <label for="name" class="form-label">Jogadores</label>
                    <select class="selectpicker form-control" name="jogador_id[]" multiple data-live-search="true">
                        @foreach ($jogadores as $jogador)
                            <option value="{{ $jogador->id }}">{{ $jogador->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="name" class="form-label">Data</label>
                    <input name="date" type="date" class="form-control" id="date" required>
                </div>
                <div class="col-md-2">
                    <label for="inputPassword4" class="form-label">Presença</label>
                    <div class="form-check pt-1">
                        <input class="form-check-input" type="checkbox" value="1" id="presenca" name="presenca">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary mt-4">Salvar</button>
                </div>
            </form>
            <div class="card mt-4">
                <div class="card-body">
                    <form class="form-inline" method="POST" action="{{ route('presenca.search') }}">
                        @csrf
                        <div class="form-group mx-sm-3 ">
                            <label for="inputPassword2" class="sr-only">Data</label>
                            <input type="date" class="form-control" name="date">
                        </div>
                        <button type="submit" class="btn btn-primary ">Pesquisar</button>
                    </form>
                </div>
            </div>
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
                            <td>{{ $presenca->jogadores->name }}</td>
                            <td>{{ $presenca->date->format('d/m/Y') }}</td>
                            <td>{{ $presenca->presenca == 1 ? 'Presente' : 'Faltou' }}</td>
                            <td>
                                <a href="#modal-presenca" type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#modal-presenca" data-id="{{ $presenca->id }}"
                                    data-date="{{ $presenca->date }}" data-presenca="{{ $presenca->presenca }}"
                                    data-action="{{ route('presenca.update', $presenca->id) }}">Atualizar</a>
                                {!! Form::open(['method' => 'DELETE', 'url' => route('presenca.destroy', $presenca->id), 'style' => 'display:inline']) !!}
                                {!! Form::button('<i class="ft-trash"></i>delete', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'title' => 'Delete Post', 'onclick' => 'return confirm("Confirm delete?")']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <x-modal id="modal-presenca">
        <form class="row g-3" action="" method="POST" id="form-presenca">
            @method('PATCH');
            @csrf
            <div class="col-md-6">
                <label for="name" class="form-label">Data</label>
                <input name="date" type="date" class="form-control" id="date_modal" required>
            </div>
            <div class="col-md-2">
                <label for="inputPassword4" class="form-label">Presença</label>
                <div class="form-check pt-1">
                    <input class="form-check-input" type="checkbox" value="1" id="presenca_modal" name="presenca">
                </div>
            </div>
    </x-modal>
    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.js" crossorigin="anonymous"></script>
    <script>
        window.addEventListener('load', function() {
            var data = document.getElementById('date');
            data.value = new Date().toLocaleDateString('en-CA');
        })

        $(document).ready(function() {
            $('#modal-presenca').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id = button.data('id')
                var date = button.data('date')
                var dateFormatada = date.replace(/(\d*)-(\d*)-(\d*).*/, '$1-$2-$3');
                var presenca = button.data('presenca')
                var action = button.data(action)
                var modal = $(this)
                console.log(dateFormatada)
                modal.find('#id').val(id)
                modal.find('#date_modal').val(dateFormatada)
                $("#form-presenca").attr("action", action.action); //Will set it
                if (presenca == 1) {
                    $('#presenca_modal').prop('checked', true);
                } else {
                    $('#presenca_modal').prop('checked', false);
                }
            })
        });

    </script>
@endsection
