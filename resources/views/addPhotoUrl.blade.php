@extends('layout')

@section('content')
<form method="POST" class="container mb-4" enctype="multipart/form-data">
    @method('POST')
    @csrf
    <div class="mb-3">
      <label class="form-label">Pet ID</label>
      <input type="number" name="id" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Aditional metadata</label>
        <input type="text" name="metadata" class="form-control">
    </div>
    <div class="mb-3">
        <label for="formFile" class="form-label">Photo</label>
        <input class="form-control" id="formFile" type="file" name="photo">
    </div>
    <button type="submit" class="btn btn-primary">Upload</button>
</form>
@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@endsection
