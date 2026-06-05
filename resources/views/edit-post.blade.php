<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h2>Edit post</h2>

    <form action="/edit-post/{{ $post->id }}" method="post">
        @csrf
        @method('PUT')
        <input type="text" name="title" placeholder="Title" value="{{ $post->title }}"><br><br>
        <textarea name="body" placeholder="Body">{{ $post->body }}</textarea><br>
        <button type="submit">Save</button>
    </form>

</body>

</html>
