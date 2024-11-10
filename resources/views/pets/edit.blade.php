@extends('layouts.app')

@section('content')
  <h1>Edit pet</h1>
  <form method="POST" action="{{route('pets.update', $pet['id'])}}">
    @csrf
    @method('PUT')
    <label>Name</label>
    <input type="text" name="name" value="{{old('name', $pet['name'])}}" required>
    <label>Status</label>
    <select name="status">
      <option value="available" {{old('status', $pet['status']) == 'available' ? 'selected' : ''}}>Available</option>
      <option value="pending" {{old('status', $pet['status']) == 'pending' ? 'selected' : ''}}>Pending</option>
      <option value="sold" {{old('status', $pet['status']) == 'sold' ? 'selected' : ''}}>Sold</option>
    </select>
    <label>Categort ID</label>
    <input type="number" name="category[id]" value="{{old('category.id', $pet['category']['id'] ?? '')}}">
    <label>Categort Name</label>
    <input type="text" name="category[name]" value="{{old('category.name', $pet['category']['name'] ?? '')}}">

    @php
      $existingTags = isset($pet['tags']) ? $pet['tags'] : [];
    @endphp
    <div>
      <h3>Tags</h3>
      @foreach($existingTags as $index => $tag)
        <label>Tag ID</label>
        <input type="number" name="tags[{{$index}}][id]" value="{{ old('tags.'.$index.'.id', $tag['id'] ?? 0)}}">
        <label>Tag Name</label>
        <input type="text" name="tags[{{$index}}][name]" value="{{ old('tags.'.$index.'.name', $tag['name'] ?? "")}}">
        <br>
      @endforeach
      <label>Tag ID</label>
      <input type="number" name="tags[{{count($existingTags)}}][id]">
      <label>Tag Name</label>
      <input type="text" name="tags[{{count($existingTags)}}][name]">
    </div>
    <button type="submit">Save</button>
  </form>
@endsection
