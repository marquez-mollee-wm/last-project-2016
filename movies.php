<?php
require_once('appvars.php');
require_once('header.php');
require_once('startsession.php');

$id = $_GET['idmovies'];

$query = "SELECT * FROM movies WHERE idmovies ='" . $id . "'";

$stmt = $dbh->prepare($query);
$stmt->execute();

$results = $stmt->fetchAll();
?>

<style>
    #moviePic {
        width: 25em;
        margin-left: 30em;
        margin-top: 3em;
    }
    #moviePicInner {
        width: 25em;
        border: solid;
        border-width: .3em;
        border-color: #d32f2f;
    }
</style>

<div class="container">


<?php
foreach($results as $row) {
    // The user row was found so display the user data

    if (!empty($row['name'])) {
        echo '<div id="title"><h3>' . $row['name'] . '</h3></div>';
    }

    echo '<div class="row">';
    if (!empty($row['picture'])) {
        echo '<div id="moviePic"><img id="moviePicInner" src="' . MZ_UPLOADPATH . $row['picture'] .
            '" alt="picture"/></div>';
    }

    echo '</div>';

    echo '<table>';

    if (!empty($row['director'])) {
        echo '<tr><td class="label">Director:</td><td>' . $row['director'] . '</td></tr>';
    }
    if (!empty($row['release'])) {
        echo '<tr><td class="label">Release</td><td>' . $row['release'] . '</td></tr>';
    }
    if (!empty($row['description'])) {
        echo '<tr><td class="label">Description</td><td>' . $row['description'] . '</td></tr>';
    }
    if (!empty($row['rating'])) {
        echo '<tr><td class="label">Rating:</td><td>' . $row['rating'] . '</td></tr>';
    }
    echo '</table>';
} // End of check for a single row of user results
//else {
//    echo '<p class="error">There was a problem accessing the page.</p>';
//}
?>
</div>

<footer class="page-footer red darken-2">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">MovieZ</h5>
                <p class="grey-text text-lighten-4">This is a wiki database for movies that allow fans to upload content to the world with details about their favorite movies.</p>
            </div>
            <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Links</h5>
                <ul>
                    <li><a class="grey-text text-lighten-3" href="index.php">Home</a></li>
                    <li><a class="grey-text text-lighten-3" href="signup.php">Sign Up</a></li>
                    <li><a class="grey-text text-lighten-3" href="login.php">Login</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            © 2016 Copyright MovieZ
        </div>
    </div>
</footer>
</body>