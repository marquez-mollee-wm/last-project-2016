<?php
require_once('appvar.php');
require_once ('header.php');
$dbh = new PDO('mysql:host=localhost;dbname=MovieZ', 'root', 'root');

if(isset($_GET['idcategories'])) {
    $query = "SELECT idmovies, name, picture FROM movies where categories_idcategories = '" . $_GET['idcategories'] . "'";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();


    echo '<table>';
    foreach ($result as $row) {
        if (is_file(MZ_UPLOADPATH . $row['picture']) && filesize(MZ_UPLOADPATH . $row['picture']) > 0) {
            echo '<tr><td><img src="' . MZ_UPLOADPATH . $row['picture'] . '" alt="' . $row['name'] . '" /></td>';
        } else {
            echo '<tr><td><img src="' . MZ_UPLOADPATH . 'images/nopic.jpg' . '" alt="' . $row['name'] . '" /></td>';
        }
        if (isset($_SESSION['user_id'])) {
            echo '<td><a href="viewmovie.php?user_id=' . $row['idmovies'] . '">' . $row['name'] . '</a></td></tr>';
        } else {
            echo '<td>' . $row['name'] . '</td></tr>';
        }
    }
    echo '</table>';
}