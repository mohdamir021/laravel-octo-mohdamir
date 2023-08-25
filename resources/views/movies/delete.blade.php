<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Confirm Delete This Movie?</h1>
    
    <form method="post" action="{{ route('movie.destroy', ['movie' => $movie]) }}">
        @csrf
        @method('delete')
        <div>
            <label>Name:</label>
            <input type="text" name="Title" value="{{ $movie->Title }}" readonly>
        </div>
        <div>
            <label>Genre:</label>
            <input type="text" name="Genre" value="{{ $movie->Genre }}" readonly>
        </div>
        <div>
            <label>Description:</label>
            <input type="text" name="Description" value="{{ $movie->Description }}" readonly>
        </div>

        <input type="submit" value="Delete Movie"/>
        <button><a href="{{ route('movies.index') }}">Cancel</a></button>
    </form>
</body>
</html>