<?php
require_once ('connect.php');

$query = "SELECT * FROM categories";
$stmt = $dbh->prepare($query);
$stmt->execute();

foreach($dbh->query($query) as $row) {
    echo $row['name'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <title>Parallax Template - Materialize</title>
    <link rel="icon" type="image/png" href="moviez.png">

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>

    <!--Javascript-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/materialize.js"></script>
    <script type="text/javascript" src="scripts.js"></script>
</head>

<style>
    .brand-logo {
        width: 1.7em;
        height: 1.7em;
        margin-left: 1.5em;
        margin-top: .1em;
    }

         /* Style The Dropdown Button */
     .dropbtn {
         margin-top: -.2em;
         color: white;
         border: none;
         cursor: pointer;
         height: 3em;
     }

    /* The container <div> - needed to position the dropdown content */
    .dropdown {
        position: relative;
        display: inline-block;
        height: 2em;
    }

    /* Dropdown Content (Hidden by Default) */
    .dropdown-content2 {
        display: none;
        position: relative;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    }

    /* Links inside the dropdown */
    .dropdown-content2 a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    /* Change color of dropdown links on hover */
    .dropdown-content2 a:hover {
        background-color: #f1f1f1
    }

    /* Show the dropdown menu on hover */
    .dropdown:hover .dropdown-content2 {
        display: block;
    }

    /* Change the background color of the dropdown button when the dropdown content is shown */
    .dropdown:hover .dropbtn {
        background-color: #d50000;
    }
</style>

<!-- Dropdown Structure -->
<nav class="red darken-4">
    <div class="nav-wrapper">
        <a href="index.php" class="brand-logo"><img class="brand-logo" src="moviez.png"></a>
        <ul class="right hide-on-med-and-down">
            <li><a href="login.php">Login</a></li>
            <li><a href="signup.php">Sign Up</a></li>
            <!-- Dropdown Trigger -->
            <li><div class="dropdown">
                    <button class="dropbtn red darken-4">Movie Categories</button>
                    <div class="dropdown-content2">
                        <a href="search.php?animal=Action">Action</a>
                        <a href="search.php?animal=Anime">Anime</a>
                        <a href="search.php?animal=Comedy">Comedy</a>
                        <a href="search.php?animal=Documentary">Documentary</a>
                        <a href="search.php?animal=Drama">Drama</a>
                        <a href="search.php?animal=Family">Family</a>
                        <a href="search.php?animal=Horror">Horror</a>
                        <a href="search.php?animal=Sci-Fi">Sci-Fi</a>
                    </div>
                </div></li>
        </ul>
    </div>
</nav>
