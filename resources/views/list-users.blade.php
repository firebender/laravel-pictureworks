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
    <section id="main">
        <header>
            <span class="avatar"><img src="images/users/<$user->id>.jpg" alt="" /></span>
            <h1><user->name></h1>
            <p><nl2br(user->comments)</p>
        </header>
    </section>
    
    @include('users::footer')

</div>

</body>
</html>

@include('users::js')