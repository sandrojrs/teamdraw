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
