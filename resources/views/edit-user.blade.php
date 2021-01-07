<!DOCTYPE HTML>
<html>

<head>
    @if ($user)
        <title>Edit User Card - {{ $user->name }}</title>
    @else
        <title>User with id {{ $id }} not found</title>
    @endif

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
</head>

<body class="is-preload">

<div id="wrapper">
    <p><a href="{{ route('list-users') }}">List Users</a></p>

    @if ($user)
        <section id="main">
            <header>
                <span class="avatar"><img src="images/users/<?=$user->id?>.jpg" alt="" /></span>

                <h1>Edit User Card {{ $user->name }}</h1>

                @if ($errors->getBag('post')->count() > 0)
                    <div class="alert alert-danger">
                        <p>ERROR</p>
                        <ul>
                            @foreach ($errors->getBag('post')->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="post" action="{{ route('modify-user') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $user->id }}">
                <table>
                <tr>
                    <td>Name</td>
                    <td><input type="text" name="name" value="{{ $user->name }}"></td>
                </tr>
                <tr>
                    <td>Comments</td>
                    <td><textarea name="comments" rows="5" cols="50">{{ $user->comments }}</textarea></td>
                </tr>
                <tr>
                    <td>&#160;</td>
                    <td><input type="submit" value="Modify"></td>
                </tr>
                </table>
            </header>
        </section>
    @else
        <section id="main">
                <h1>User with id {{ $id }} not found</h1>
            </header>
        </section>
    @endif

    @include('users::footer')

</div>

@include('users::js')

</body>
</html>