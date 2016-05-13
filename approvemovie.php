<?php
require_once ('authorize.php');
?>
​
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

    .left{
        padding-left: 130px;
    }
    #adLabel {
        left: 4em;
        margin-top: .5em;
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
        <h3 class="brand-logo left" id="adLabel">- Admin</h3>
        <ul class="right hide-on-med-and-down">
            <li><a href="index.php">Home</a></li>
        </ul>
    </div>
</nav>
​
<?php
require_once('appvars.php');


$dbh = new PDO('mysql:host=127.0.0.1;dbname=MovieZ', 'root', 'root');

if (isset($_GET['name']) && isset($_GET['director']) && isset($_GET['release']) && isset($_GET['description']) && isset($_GET['rating'])){
    $id = @$_GET['idmovies'] ;
    $name = (@$_GET['name']) ? $_GET['name'] : $_POST['name'];
    $director = (@$_GET['director']) ? $_GET['director'] : $_POST['director'];
    $release = (@$_GET['release']) ? $_GET['release'] : $_POST['release'];
    $description = (@$_GET['description']) ? $_GET['description'] : $_POST['description'];
    $rating = (@$_GET['rating']) ? $_GET['rating'] : $_POST['rating'];
    $pic = @$_GET['picture'];
}
else if (isset($_POST['id'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
}
else{
    echo '<p class="error">Nothing Selected.</p>';
}


if (isset($_POST['submit'])) {
    if ($_POST['confirm'] == 'Yes') {
        // Connect to the database
        $dbh = new PDO('mysql:host=localhost;dbname=MovieZ', 'root', 'root');

        // Approve the score by setting the approved column in the database
        $query = "UPDATE movies SET approve = 1 WHERE idmovies = '" . $id . "'";
        $stmt = $dbh ->prepare($query);
        $stmt -> execute();


        // Confirm success with the user
        echo '<p>The  movie ' . $name . '  was successfully approved.';
    }
    else {
        echo '<p class="error">Sorry, there was a problem approving the movie.</p>';
    }
}
else if (isset($id) && isset($name) && isset($description)) {

    echo '<p>Are you sure you want to approve the following page?</p>';
    echo '<p><strong>Name: </strong>' . $name . '<br /><strong>Director: </strong>' . $director .
        '<br /><strong>Release: </strong>' . $release .
        '<br /><strong>Description: </strong>' . $description .
    '<br /><strong>Rating: </strong>' . $rating . '</p>';
    echo '<img src="' . MZ_UPLOADPATH . $pic . '" width="160" alt="Movie Image" /><br />';

    echo '<form method="post" action="approvemovie.php">';
    echo '<input class="with-gap" type="radio" name="confirm" value="Yes" id="test1"/>';
    echo '<label for="test1">Yes</label>';
    echo '<input class="with-gap" type="radio" name="confirm" value="No" checked="checked" id="test2"/>';
    echo '<label for="test2">No</label><br />';
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
</html>