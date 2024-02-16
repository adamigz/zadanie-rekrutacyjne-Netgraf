@extends('layout')

@section('content')
<h1>Patch Pet</h1>
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
      <label class="form-label">Name</label>
      <input type="text" class="form-control" value="{{ $pet->name }}" name="name">
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

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
