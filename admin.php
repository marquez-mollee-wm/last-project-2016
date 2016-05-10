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
    #adLabel {
        left: 4em;
        margin-top: .5em;
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
        <h3 id="adLabel" class="brand-logo left">- Admin</h3>
        <ul class="right hide-on-med-and-down">
            <li><a href="index.php">Home</a></li>
            <li><a href="...">idk</a></li>
        </ul>
    </div>
</nav>

<?php
require_once('authorize.php');

require_once('appvars.php');

// Connect to the database
$dbh = new PDO('mysql:host=localhost;dbname=MovieZ', 'root', 'root');
// Retrieve the score data from MySQL
$query = "SELECT * FROM movies ";
$stmt= $dbh->prepare($query);
$stmt->execute();
$result= $stmt->fetchAll();
// Loop through the array of score data, formatting it as HTML
echo '<table>';
foreach ($result as $row) {
    // Display the score data
    echo '<tr><td>' . $row['picture'] . '</td>';
    echo '<td><strong>' . $row['name'] . '</strong></td>';
    echo '<td>' . $row['director'] . '</td>';
    echo '<td>' . $row['release'] . '</td>';
    echo '<td>' . $row['description'] . '</td>';
    echo '<td>' . $row['rating'] . '</td>';
    echo '<td><a href="editmovie.php?idmovies='. $row['idmovies'] .
        '&amp;name=' . $row['name'] . '&amp;director=' . $row['director'] .
        '&amp;release=' . $row['release'] . '&amp;description=' . $row['description'] .
        '&amp;rating=' . $row['rating'] .
        '&amp;picture=' . $row['picture'] .'">Edit</a></td>';

    if( $row['approve'] == '0'){
        echo '<td><a href="approvemovie.php?idmovies=' . $row['idmovies'] .
            '&amp;name=' . $row['name'] . '&amp;director=' . $row['director'] .
            '&amp;release=' . $row['release'] . '&amp;description=' . $row['description'] .
            '&amp;rating=' . $row['rating'] .
            '&amp;picture=' . $row['picture'] . '">Approve</a></td></tr>';
    }
}

echo '</table>';

?>
​
</body>
