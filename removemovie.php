<?php
require_once('authorize.php');
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
<script type="text/javascript" src="js/scripts.js"></script>

<nav class="red darken-4">
    <div class="nav-wrapper">
        <a href="index.php" class="brand-logo"><img class="brand-logo" src="moviez.png"></a>
        <h3 class="brand-logo left">- Admin</h3>
        <ul class="right hide-on-med-and-down">
            <li><a href="approvemovie.php">Approve</a></li>
            <li><a href="removemovie.php">Edit/Delete Pages</a></li>
        </ul>
    </div>
</nav>

<?php
require_once('appvars.php');

$id = (@$_GET['idmovies']) ? $_GET['idmovies'] : $_POST['idmovies'];
$name= (@$_GET['name']) ? $_GET['name'] : $_POST['name'];
$director = (@$_GET['director']) ? $_GET['director'] : $_POST['director'];
$release = (@$_GET['release']) ? $_GET['release'] : $_POST['release'];
$description = (@$_GET['description']) ? $_GET['description'] : $_POST['description'];
$rating = (@$_GET['rating']) ? $_GET['rating'] : $_POST['rating'];
$pic = @$_GET['pic'];

if (isset($_POST['submit'])) {
    if ($_POST['confirm'] == 'Yes') {

        // Delete the screen shot image file from the server

        $dbh = new PDO('mysql:host=localhost;dbname=MovieZ', 'root', 'root');
        // Delete the score data from the database
        $query = "DELETE FROM movie WHERE id = $id LIMIT 1";
        $stmt = $dbh ->prepare($query);
        $stmt -> execute();
        $result = $stmt->fetchAll();
        // Confirm success with the user
        echo '<p>The movie ' . $name . ' was successfully removed.';
    }
    else {
        echo '<p class="error">The movie was not removed.</p>';
    }
}
else (isset($id) && isset($name) && isset($description)) ;{
    echo '<p>Are you sure you want to remove the following high score?</p>';
    echo '<p><strong>Name: </strong>' . $name . '<br /><strong>Director: </strong>' . $director .
        '<br /><strong>Release: </strong>' . $release .
        '<br /><strong>Description: </strong>' . $description .
        '<br /><strong>Release Date: </strong>' . $release . '</p>';
    echo '<form method="post" action="removemovie.php">';
    echo '<img src="' . MZ_UPLOADPATH . $pic . '" width="160" alt="Score image" /><br />';
    echo '<input type="radio" name="confirm" value="Yes"/> Yes ';
    echo '<input type="radio" name="confirm" value="No" checked="checked"/> No <br />';
    echo '<input type="submit" value="Submit" name="submit" />';
    echo '<input type="hidden" name="id" value="' . $id . '" />';
    echo '<input type="hidden" name="name" value="' . $name . '" />';
    echo '<input type="hidden" name="description" value="' . $description . '" />';
    echo '</form>';
}

echo '<p><a href="admin.php">&lt;&lt; Back to admin page</a></p>';
?>
​
</body>
