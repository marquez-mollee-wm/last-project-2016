<?php
require_once ('connect.php');
require_once ('startsession.php');

$query = "SELECT * FROM categories";
$stmt = $dbh->prepare($query);
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="en">
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
    .dropdown{
        z-index: 99;
    }
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
        z-index: 5;
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

<body>
<!-- Javascript Stuff -->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<script type="text/javascript" src="scripts.js"></script>

<!-- Dropdown Structure -->
<ul id="dropdown1" class="dropdown-content">
    <li><a href="category.php?category=Action">Action</a></li>
    <li><a href="category.php?category=Anime">Anime</a></li>
    <li><a href="category.php?category=Comedy">Comedy</a></li>
    <li><a href="category.php?category=Documentary">Documentary</a></li>
    <li><a href="category.php?category=Drama">Drama</a></li>
    <li><a href="category.php?category=Family">Family</a></li>
    <li><a href="category.php?category=Horror">Horror</a></li>
    <li><a href="category.php?category=Sci-Fi">Sci-Fi</a></li>
</ul>
<nav class="red darken-4">
    <div class="nav-wrapper">
        <a href="index.php" class="brand-logo"><img class="brand-logo" src="moviez.png"></a>
        <ul class="right hide-on-med-and-down">
            
            <?php if (isset($_SESSION['username'])) {
                echo '<li><a href="logout.php">Log Out (' . $_SESSION['username'] . ')</a></li>';
                echo '<li><a href="createMoviePage.php">Make A Page</a> </li>';

            }
            else{
                echo '<li><a href="login.php">Login</a></li>';
                echo '<li><a href="signup.php">Sign Up</a></li>';
            }
            ?>
            <!-- Dropdown Trigger -->
            <li><a class="dropdown-button" href="#!" data-activates="dropdown1">Categories<i class="material-icons right">arrow_drop_down</i></a></li>
        </ul>
    </div>
</nav>
</body>
