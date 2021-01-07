<!DOCTYPE HTML>
<html>

<head>
    @if ($user)
        <title>User Card - {{ $user->name }}</title>
    @endif

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
</head>

<body class="is-preload">

<div id="wrapper">
    @if ($user)
        <section id="main">
            <header>
                <span class="avatar"><img src="images/users/<?=$user->id?>.jpg" alt="" /></span>

                <h1>{{ $user->name }}</h1>
                <p>{{ $user->comments }}</p>
            </header>
        </section>
    @endif

    @include('users::footer')

</div>

@include('users::js')

</body>
</html>