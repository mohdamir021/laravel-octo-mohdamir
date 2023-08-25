<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Update Movie</h1>

    <div>
        @if($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif
    </div>
    
    <form method="post" action="{{ route('movie.update', ['movie'=>$movie]) }}">
        @csrf
        @method('put')
        <div>
            <label>Name:</label>
            <input type="text" name="Title" value="{{ $movie->Title }}">
        </div>
        <div>
            <label>Genre:</label>
            <input type="text" name="Genre" value="{{ $movie->Genre }}">
        </div>
        <div>
            <label>Description:</label>
            <input type="text" name="Description" value="{{ $movie->Description }}">
        </div>

        <input type="submit" value="Update Movie"/>
        <button><a href="{{ route('movies.index') }}">Cancel</a></button>
    </form>
</body>
</html>