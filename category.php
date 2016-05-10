<?php
require_once ('connect.php');
require_once ('startsession.php');

$stmt = $dbh->prepare("SELECT * FROM movies m LEFT JOIN categories c ON c.idcategories = :category");
$stmt->execute(array(':category'=>$_GET['category']));
$results = $stmt->fetchAll();

require_once ('header.php');
?>

<div id="searchinfo">
    <h1><?php echo $_GET['category'];?></h1>

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

<?php
require_once ('footer.php');
?>
