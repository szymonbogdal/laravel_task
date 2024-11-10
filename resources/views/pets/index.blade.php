@extends('layouts.app')

@section('content')
  <h1>Pets</h1>
  <a href="{{route('pets.create')}}">New pet</a>

  @if(count($pets) > 0)
    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($pets as $pet)
          <tr>
            <td>{{ $pet['name'] ?? "-" }}</td>
            <td>{{ $pet['status'] ?? "-"}}</td>
            <td>
              <a href="{{ route('pets.show', $pet['id']) }}">Show</a>
              <a href="{{ route('pets.edit', $pet['id']) }}">Edit</a>
              <form action="{{ route('pets.destroy', $pet['id']) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <p>No pets found.</p>
  @endif
@endsection
