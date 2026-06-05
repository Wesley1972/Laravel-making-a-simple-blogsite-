<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @auth
        <p>Welcome authenticated user.</p>
        <p>You're user id is {{ Auth::id() }}</p>

        <form action="/logout" method="post">
            @csrf
            <button type="submit">Logout</button>
        </form><br>

        <div style="border: 2px solid black; margin-bottom: 5px; padding: 5px;">
            <h2>Create a new post</h2>

            <form action="{{ route('create-post') }}" method="post">
                @csrf
                <input type="text" name="title" placeholder="Post title"><br><br>
                <textarea name="body" id="" placeholder="Body content"></textarea><br>
                <button type="submit">Create post</button>
            </form>

        </div>

        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div style="border: 2px solid black">
            <h3>All post</h3>

            @foreach ($posts as $post)
                <div style="border: black solid 1px; padding: 4px; margin: 5px;">
                    <p>User id: {{ $post['user_id'] }}</p>
                    <h3>{{ $post['title'] }} by {{ $post->user->name }}</h3>
                    <p>{{ $post['body'] }}</p>
                    <p><a href="/edit-post/{{ $post->id }}">Edit</a></p>

                    <form action="/delete-post{{ $post->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>

                </div>
            @endforeach

        </div>
    @else
        <div style="border: 2px solid black">
            <h2>Register</h2>

            <form action="{{ route('register') }}" method="post">
                @csrf
                <input type="text" name="name" placeholder="Name"><br>
                <input type="text" name="email" id="" placeholder="Email"><br>
                <input type="text" name="password" placeholder="Password"><br>
                <button type="submit">Register</button>
            </form>

        </div>

        <div style="border: 2px solid black;">
            <h2>Login</h2>

            <form action="{{ route('login') }}" method="post">
                @csrf
                <input type="text" name="login-name" placeholder="Name"><br>
                <input type="text" name="login-password" placeholder="Password"><br>
                <button type="submit">Login</button>
            </form>

        </div>

    @endauth

</body>

</html>
