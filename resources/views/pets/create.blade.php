@extends('layouts.app')

@section('content')
  <h1>Add pet</h1>
  
  @if ($errors->any())
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  @endif

  <form method="POST" action="{{route('pets.store')}}">
    @csrf
    <label>Name</label>
    <input type="text" name="name" value="{{old('name')}}" required>
    <label>Status</label>
    <select name="status">
      <option value="available" {{old('status') == 'available' ? 'selected' : ''}}>Available</option>
      <option value="pending" {{old('status') == 'pending' ? 'selected' : ''}}>Pending</option>
      <option value="sold" {{old('status') == 'sold' ? 'selected' : ''}}>Sold</option>
    </select>
    <label>Categort ID</label>
    <input type="number" name="category[id]" value="{{old('category.id')}}">
    <label>Categort Name</label>
    <input type="text" name="category[name]" value="{{old('category.name')}}">
    <label>Tag ID</label>
    <input type="number" name="tags[0][id]" value="{{old('tag.id')}}">
    <label>Tag Name</label>
    <input type="text" name="tags[0][name]" value="{{old('tag.name')}}">
    <button type="submit">Save</button>
  </form>
@endsection
