<?php
// Start the session
require_once('startsession.php');

require_once('appvars.php');
require_once('header.php');

// Connect to the database
$dbh = new PDO('mysql:host=localhost;dbname=MovieZ', 'root', 'root' );

$id = $_GET['idmovies'];
// Grab the profile data from the database
if (!isset($_GET['idmovies'])) {
    $query = "SELECT `name`, director, `release`, description, picture, rating FROM movies WHERE idmovies = '" . $id . "'";
}
$stmt = $dbh->prepare($query);
$stmt->execute();

$results = $stmt->fetchAll();

if (count($results) == 1) {
    // The user row was found so display the user data
    $row = $results[0];
    echo '<table>';
    if (!empty($row['name'])) {
        echo '<tr><td class="label">Name:</td><td>' . $row['name'] . '</td></tr>';
    }
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
    if (!empty($row['picture'])) {
        echo '<tr><td class="label">Picture:</td><td><img src="' . MZ_UPLOADPATH . $row['picture'] .
            '" alt="picture /></td></tr>';
    }
    echo '</table>';
} // End of check for a single row of user results
else {
    echo '<p class="error">There was a problem accessing the page.</p>';
}
?>

<?php
// Insert the page footer
require_once('footer.php');
?>
