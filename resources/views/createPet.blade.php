@extends('layout')

@section('content')
<h1>Create new Pet</h1>
@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form class="container" method="POST" action="{{ route('storePet') }}">
    @method('POST')
    @csrf
    <div class="mb-3">
      <label class="form-label">Id</label>
      <input type="number" class="form-control" name="id">
    </div>
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" class="form-control" name="name">
    </div>
    <div class="mb-3">
        <label class="form-label">Category Id</label>
        <input type="number" class="form-control" name="category_id">
      </div>
      <div class="mb-3">
        <label class="form-label">Catergory Name</label>
        <input type="text" class="form-control" name="category_name">
      </div>
      <div class="mb-3">
        <label class="form-label">Tags (separete with ",")</label>
        <input type="text" class="form-control" name="tags">
      </div>
      <div class="mb-3">
        <label class="form-label">Status</label>
        <select class="form-select" name="status" aria-label="Status">
            <option selected value="available">available</option>
            <option value="pending">pending</option>
            <option value="sold">sold</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="formFile" class="form-label">Photo url</label>
        <input class="form-control" type="text" name="photo_url">
      </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
