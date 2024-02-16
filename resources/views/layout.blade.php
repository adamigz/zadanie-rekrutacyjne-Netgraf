<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pet CRUD</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <nav class="navbar navbar-expand-lg mb-2 bg-body-secondary">
        <div class="container-fluid">
          <a class="navbar-brand" href="/">Pet</a>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('getByStatus', ['status' => 'available']) }}">Find By Status</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('getById') }}">Find By Id</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('addPet') }}">Add Pet</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('uploadPhoto') }}" ">Add Photo Url</a>
              </li>
            </ul>
          </div>
        </div>
    </nav>
    @if (session('error'))
        <div class="alert alert-warning" role="alert">
            {{session('error')}}
        </div>
    @endif
    @yield('content')
</body>
</html>
