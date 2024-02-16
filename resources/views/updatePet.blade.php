@extends('layout')

@section('content')
<h1>Update Pet</h1>
@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form class="container" method="POST">
    @method('POST')
    @csrf
    <div class="mb-3">
      <label class="form-label">Id</label>
      <input type="number" class="form-control" value="{{ $pet->id }}" name="id">
    </div>
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" class="form-control" value="{{ $pet->name }}" name="name">
    </div>
    <div class="mb-3">
        <label class="form-label">Category Id</label>
        <input type="number" class="form-control" value="{{ $pet->category->id }}" name="category_id">
      </div>
      <div class="mb-3">
        <label class="form-label">Catergory Name</label>
        <input type="text" class="form-control" value="{{ $pet->category->name }}" name="category_name">
      </div>
      <div class="mb-3">
        <label class="form-label">Tags (separete with ",")</label>
        <input type="text" class="form-control" value="@foreach ($pet->tags as $tag){{ $tag->name }},@endforeach" name="tags">
      </div>
      <div class="mb-3">
        <label class="form-label">Status</label>
        <select class="form-select" name="status" aria-label="Status">
            <option @if ($pet->status == 'available')
                selected
            @endif value="available">available</option>
            <option @if ($pet->status == 'pending')
                selected
            @endif value="pending">pending</option>
            <option @if ($pet->status == 'sold')
                selected
            @endif value="sold">sold</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="formFile" class="form-label">Photo url</label>
        <input class="form-control" type="text" value="@foreach ($pet->photoUrls as $url){{$url}},@endforeach" name="photo_url">
      </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
