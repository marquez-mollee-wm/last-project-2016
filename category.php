<?php
require_once ('connect.php');
require_once ('startsession.php');
$category = "no category";

//$stmt = $dbh->prepare("SELECT * FROM movies m LEFT JOIN categories c ON c.idcategories = :category");
$stmt = $dbh->prepare("SELECT * FROM movies m WHERE m.categories_idcategories = :category AND approve = 1");
$stmt->execute(array(':category'=>$_GET['category']));
$results = $stmt->fetchAll();

if($_GET['category'] == 1){
    $category = "Action";
}
if($_GET['category'] == 2){
    $category = "Anime";
}
if($_GET['category'] == 3){
    $category = "Comedy";
}
if($_GET['category'] == 4){
    $category = "Documentary";
}
if($_GET['category'] == 5){
    $category = "Drama";
}
if($_GET['category'] == 6){
    $category = "Family";
}
if($_GET['category'] == 7){
    $category = "Horror";
}
if($_GET['category'] == 8){
    $category = "Sci-Fi";
}
require_once ('header.php');
?>
<style>
    .page-footer{
        position: absolute;
        bottom: 0em;
        width: 100%;
    }
</style>

<div id="searchinfo">
    <h1><?php echo $category;?></h1>

    <table>
        <thead>
        <tr>
            <th>Movies</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if(count($results) > 0) {
            foreach($results as $movie){

                $moviename = $movie['name'];

                echo '<tr>';
                echo "<td><a href='movies.php?id=" . $movie['idmovies'] . "'>{$moviename}</a></td>";
                echo '</tr>';
            }
        }
        else{
            echo '<tr>';
            echo '<td>0 Results Found.</td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
    <?php

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
