@extends('layout')

@section('content')
<div class="d-flex">
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="{{ request()->fullUrlWithQuery(['status' => 'available'])}}" class="btn btn-outline-primary">available</a>
        <a href="{{ request()->fullUrlWithQuery(['status' => 'pending'])}}" class="btn btn-outline-primary">pending</a>
        <a href="{{ request()->fullUrlWithQuery(['status' => 'sold'])}}" class="btn btn-outline-primary">sold</a>
    </div>
    <p class="text-muted ms-4">Możliwe że nie widać prawej strony tabeli z danymi i opcjami!</p>
</div>
<hr>
<table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Category</th>
        <th scope="col">Name</th>
        <th scope="col">Photo urls</th>
        <th scope="col">Tags</th>
        <th scope="col">Status</th>
        <th scope="col">Options</th>
      </tr>
    </thead>
    <tbody>
        @forelse ($pets as $pet)
            <tr>
                <th scope="row">{{ $pet->id }}</th>
                <td>{{ $pet->category->name ?? "Category is not an array" }}</td>
                <td>{{ $pet->name ?? "Name is not a pet property" }}</td>
                <td>
                    @foreach ($pet->photoUrls ?? [''] as $url)

                        {{ $url ?? "Photourls is not an array of strings" }},
                    @endforeach
                </td>
                <td>
                    @foreach ($pet->tags as $tag)
                        {{ $tag->name ?? "Tag name is not a tag property" }},
                    @endforeach
                </td>
                <td>{{ $pet->status }}</td>
                <td class="d-flex">
                    <a href="{{ route('updatePet', ['id' => $pet->id]) }}" class="btn btn-success me-2">Update</a>
                    <a href="{{ route('deletePet', ['id' => $pet->id]) }}" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">Nie znaleziono pet w podanych filtrach</td>
            </tr>
        @endforelse

    </tbody>
  </table>
@endsection
