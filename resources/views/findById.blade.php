@extends('layout')

@section('content')
<form action="{{ route('findById') }}" method="POST" class="container mb-4">
    @method('POST')
    @csrf
    <div class="mb-3">
      <label class="form-label">Pet ID</label>
      <input type="number" name="id" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Find</button>
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
@if (!empty($pet) && isset($pet))
<div class="container">
    <ul class="list-group mb-2">
        <li class="list-group-item">ID: {{ $pet->id }}</li>
        <li class="list-group-item">Name: {{ $pet->name }}</li>
        <li class="list-group-item">Category id: {{ $pet->category->id ?? 'Category is not an object' }}</li>
        <li class="list-group-item">Category name: {{ $pet->category->name ?? 'Category is not an object'  }}</li>
        <li class="list-group-item">Photo urls: @foreach ($pet->photoUrls ?? [] as $url) {{ $url ?? 'PhotoUrls is not array' }}, @endforeach</li>
        <li class="list-group-item">Tags: @foreach ($pet->tags ?? [] as $tag) {{ $tag->name ?? 'Tag is not array of objects' }}, @endforeach</li>
        <li class="list-group-item">Status: {{ $pet->status }}</li>
    </ul>
    <a href="{{ route('patchPet', ['id' => $pet->id]) }}" class="btn btn-success">Update</a>
</div>
@else
    <p class="container">Provide Pet ID</p>
@endif

@endsection
