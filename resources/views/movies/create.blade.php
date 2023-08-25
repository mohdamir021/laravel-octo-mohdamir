<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Insert Movie</h1>

    <div>
        @if($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif
    </div>

    <form method="post" action="{{ route('movie.store') }}">
        @csrf
        @method('post')
        <div>
            <label>Name:</label>
            <input type="text" name="Title" placeholder="Movie Title">
        </div>
        <div>
            <label>Genre:</label>
            <input type="text" name="Genre" placeholder="Movie Genre">
        </div>
        <div>
            <label>Description:</label>
            <input type="text" name="Description" placeholder="Description">
        </div>

        <input type="submit" value="Insert Movie"/>
    </form>
</body>
</html>