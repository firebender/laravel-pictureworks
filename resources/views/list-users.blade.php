<!DOCTYPE HTML>
<html>
<head>
    <title>Users</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
</head>

<body class="is-preload">

<div id="wrapper">

    @if ($users->count() == 0)
        <h1>No users found</h1>
    @else
        <h1>Users</h1>

        <table>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Comments</td>
        </tr>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td><a href="{{ route('view-user', ['id' => $user->id]) }}">{{ $user->name }}</a></td>
                <td>{{ $user->comments }}</td>
            </tr>
        @endforeach
        </table>
    @endif

    @include('users::footer')

</div>

</body>
</html>

@include('users::js')
