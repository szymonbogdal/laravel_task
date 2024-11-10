<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Pet store</title>
</head>
<body>
  <nav>
    <a href="{{route("pets.index", ['status'=>'available'])}}">Available pets</a>
    <a href="{{route("pets.index", ['status'=>'pending'])}}">Pending pets</a>
    <a href="{{route("pets.index", ['status'=>'sold'])}}">Sold pets</a>
  </nav>
  
  @if(session('error'))
    <div>
        {{session('error')}}
    </div>
  @endif

  @if(session('success'))
    <div>
        {{session('success')}}
    </div>
  @endif


  <main>
    @yield('content')
  </main>
</body>
</html>