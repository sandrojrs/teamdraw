<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Boostrap 5</title>
    <link rel="stylesheet" href={{ asset('css/app.css') }}>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="{{ route('sorteio.index') }}">Sorteio</a>
                    <a class="nav-link" href="{{ route('jogadores.index') }}">Jogadores</a>
                    <a class="nav-link" href="{{ route('presenca.index') }}">Presença</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        @if (Session::has('success'))
            <div class="alert alert-success mt-4">
                <ul>
                    <li>{{ Session::get('success') }}</li>
                </ul>
            </div>
        @elseif(Session::has('error'))
            <div class="alert alert-danger">
                <ul>
                    <li>{{ Session::get('error') }}</li>
                </ul>
            </div>
        @endif
        @yield('content')
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</body>

</html>
