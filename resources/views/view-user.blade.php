<!DOCTYPE HTML>
<html>

<head>
    @if ($user)
        <title>User Card - {{ $user->name }}</title>
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

                <h1>{{ $user->id }} {{ $user->name }}</h1>

                @if ($success !== null)
                    <p>Success {!! $success !!}</p>
                @endif

                <p>{{ $user->comments }}</p>

                <p><a href="{{ route('edit-user', ['id' => $user->id]) }}">Modify</p>
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