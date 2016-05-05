<?php
?>
<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <title>Moviez</title>
    <link rel="icon" type="image/png" href="moviez.png"/>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="styles.css"/>
</head>

<style>
    .brand-logo {
        width: 1.7em;
        height: 1.7em;
        margin-left: 1.5em;
        margin-top: .1em;
    }
</style>

<body>
<!-- Javascript Stuff -->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<script type="text/javascript" src="scripts.js"></script>

<nav class="red darken-4">
    <div class="nav-wrapper">
        <a href="index.php" class="brand-logo"><img class="brand-logo" src="moviez.png"></a>
        <h3 class="brand-logo left">- Admin</h3>
        <ul class="right hide-on-med-and-down">
            <li><a href="login.php">Approve</a></li>
            <li><a href="signup.php">Edit/Delete Pages</a></li>
        </ul>
    </div>
</nav>
</body>
