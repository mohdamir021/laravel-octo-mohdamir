<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>This is Movie List</h1>
    <div>
        @if (session() -> has('success'))
            <div>{{ session('success') }}</div>
        @endif
    </div>
    <div>
        <a href="{{ route('movie.create') }}">Add Movie</a>
    </div>
    <div>
        <table border="1">
            <tr>
                <th>Movie ID</th>
                <th>Title</th>
                <th>Genre</th>
                <th>Description</th>
                <th>Edit Link</th>
                <th>Delete Link</th>
            </tr>
            @foreach ($movies as $movie)
                <tr>
                    <td>{{ $movie->id }}</td>
                    <td>{{ $movie->Title }}</td>
                    <td>{{ $movie->Genre }}</td>
                    <td>{{ $movie->Description }}</td>
                    <td>
                        <a href="{{ route('movie.edit', ['movie' => $movie]) }}">Edit</a>
                    </td>
                    <td>
                        <a href="{{ route('movie.destroy.ask', ['movie' => $movie]) }}">Delete</a>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</body>
</html>