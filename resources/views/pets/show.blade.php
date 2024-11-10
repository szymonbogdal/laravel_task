@extends('layouts.app')

@section('content')

  <h1>Pet details</h1>
  <p>ID: {{ $pet['id'] }}</p>
  <p>Name: {{ $pet['name'] ?? '-' }}</p>
  <p>Status: {{ $pet['status'] ?? '-'}}</p>
  <p>Category: {{ $pet['category']['name'] ?? '-' }}</p>

  @if(!empty($pet['tags']))
    <h3>Tags:</h3>
    <ul>
      @foreach($pet['tags'] as $tag)
        <li>{{ $tag['name'] ?? '-'}}</li>
      @endforeach
    </ul>
  @endif
  
  <a href="{{ route('pets.edit', $pet['id']) }}">Edit</a>
  <form action="{{ route('pets.destroy', $pet['id']) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit">Delete</button>
  </form>
@endsection
