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
    #editTable {
        margin-top: 4em;
    }
    #backToAdBtn {
        margin-bottom: 4em;
    }
</style>

<body>
<!-- Javascript Stuff -->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<script type="text/javascript" src="scripts.js"></script>

<nav class="red darken-4">
    <div class="nav-wrapper">
        <a href="admin.php" class="brand-logo"><img class="brand-logo" src="moviez.png"></a>
        <h3 id="adLabel" class="brand-logo left">- Admin</h3>
        <ul class="right hide-on-med-and-down">
            <li><a href="index.php">Home</a></li>
        </ul>
    </div>
</nav>

<div class="container">

    <h3>Edit Movie</h3>
<?php
require_once ('authorize.php');
require_once ('appvar.php');
// Connect to the database

$dbh = new PDO('mysql:host=127.0.0.1;dbname=MovieZ', 'root', 'root');


if (isset($_GET['name']) && isset($_GET['director']) && isset($_GET['release']) && isset($_GET['description']) && isset($_GET['rating'])){
    $id = @$_GET['idmovies'] ;
    $name= (@$_GET['name']) ? $_GET['name'] : $_POST['name'];
    $director = (@$_GET['director']) ? $_GET['director'] : $_POST['director'];
    $release = (@$_GET['release']) ? $_GET['release'] : $_POST['release'];
    $description = (@$_GET['description']) ? $_GET['description'] : $_POST['description'];
    $rating = (@$_GET['rating']) ? $_GET['rating'] : $_POST['rating'];
    $picture = @$_GET['picture'];
}
else if (isset($_POST['id'])){
    $id = $_POST['id'];
}
else{
    echo '<p class="error">Nothing Selected.</p>';
}

if (isset($_POST['submit'])) {
    // Grab the profile data from the POST
    $name =  $_POST['name'];
    $director =  $_POST['director'];
    $release =  $_POST['release'];
    $description=  $_POST['description'];
    $rating =  $_POST['rating'];
    $old_picture =  $_POST['old_picture'];
    $new_picture =  $_FILES['new_picture']['name'];
    $new_picture_type = $_FILES['new_picture']['type'];
    $new_picture_size = $_FILES['new_picture']['size'];
    $error = false;
    // Validate and move the uploaded picture file, if necessary
    if (!empty($new_picture)) {
        if ((($new_picture_type == 'image/gif') || ($new_picture_type == 'image/jpeg') || ($new_picture_type == 'image/pjpeg') ||
                ($new_picture_type == 'image/png')) && ($new_picture_size > 0) && ($new_picture_size <= MZ_MAXFILESIZE) &&
            ($new_picture_width <= MZ_MAXIMGWIDTH) && ($new_picture_height <= MZ_MAXIMGHEIGHT)) {
            if ($_FILES['new_picture']['error'] == 0) {
                // Move the file to the target upload folder
                $target = MZ_UPLOADPATH . basename($new_picture);
                if (move_uploaded_file($_FILES['new_picture']['tmp_name'], $target)) {
                    // The new picture file move was successful, now make sure any old picture is deleted
                    if (!empty($old_picture) && ($old_picture != $new_picture)) {
                        @unlink(MZ_UPLOADPATH . $old_picture);
                    }
                }
                else {
                    // The new picture file move failed, so delete the temporary file and set the error flag
                    @unlink($_FILES['new_picture']['tmp_name']);
                    $error = true;
                    echo '<p class="error">Sorry, there was a problem uploading your picture.</p>';
                }
            }
        }
        else {
            // The new picture file is not valid, so delete the temporary file and set the error flag
            @unlink($_FILES['new_picture']['tmp_name']);
            $error = true;
            echo '<p class="error">Your picture must be a GIF, JPEG, or PNG image file no greater than ' . (MZ_MAXFILESIZE / 1024) .
                ' KB and ' . MZ_MAXIMGWIDTH . 'x' . MZ_MAXIMGHEIGHT . ' pixels in size.</p>';
        }
    }

    // Update the profile data in the database
    if ($error == false) {
        if (!empty($name) && !empty($director) && !empty($release) && !empty($description) && !empty($rating)) {
            // Only set the picture column if there is a new picture
            if (!empty($new_picture)) {
                    $query2 = "UPDATE `movies` SET `name` = :name, `director` = :director, `release` = :release, `description` = :description, `rating` = :rating, `picture` = :picture WHERE idmovies = '" . $id . "'";
                    $stmt2 = $dbh->prepare($query2);
                    $stmt2->execute(array(
                        'name' => $name,
                        'director' => $director,
                        'release' => $release,
                        'description' => $description,
                        'rating' => $rating,
                        'picture' => $new_picture
                    ));
                }
            else {
                
                $query = "UPDATE `MovieZ`.`movies` SET `name` = :name, `director` = :director, `release` = :release, `description` = :description, `rating` = :rating WHERE idmovies = '" . $id . "'";
                $stmt = $dbh->prepare($query);
                $stmt->execute(array(
                    'name' => $name,
                    'director' => $director,
                    'release' => $release,
                    'description' => $description,
                    'rating' => $rating
                ));
            }


            // Confirm success with the user
            echo '<p>The movie has been successfully updated. Go back to <a href="admin.php">admin page</a></p>';


            exit();
        }
        else {
            echo '<p class="error">You must enter all of the movie data (the picture is optional).</p>';
        }
    }
} // End of check for form submission

else {
//
//    // Grab the profile data from the database
//    $query = "SELECT `name`, director, release, description, rating, picture FROM movies WHERE idmovies = '" . $id . "'";
//    $stmt = $dbh->prepare($query);
//    $stmt->execute();
//    $results = $stmt->fetchAll();
//
//    foreach ($results as $row) {
//        $name = $row['name'];
//        $director = $row['director'];
//        $release = $row['release'];
//        $description = $row['description'];
//        $rating = $row['rating'];
//        $old_picture = $row['picture'];
//    }
//    else {
//    echo '<p class="error">There was a problem accessing the movie.</p>';
//    }
}

?>

<form id="editTable" enctype="multipart/form-data" method="post" action="<?php  echo $_SERVER['PHP_SELF']?>">
    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MZ_MAXFILESIZE; ?>" />
    <fieldset>
        <legend>Movie Information</legend>
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php if (!empty($name)) echo $_GET['name']; ?>" /><br />
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="lastname">Director:</label>
        <input type="text" id="director" name="director" value="<?php if (!empty($director)) echo $_GET['director']; ?>" /><br />
        <label for="gender">Release Date:</label>
        <input type="date" id="release" name="release" value="<?php if (!empty($release)) echo $_GET['release']; ?>"><br/>
        <label for="description">Description:</label>
        <input type="text" id="description" length="800" name="description" value="<?php if (!empty($description)) echo $_GET['description']; ?>" /><br />
        <label for="city">Rating:</label>
        <input type="text" id="city" name="rating" value="<?php if (!empty($rating)) echo $_GET['rating']; ?>" /><br />
        <input type="hidden" name="old_picture" value="<?php if (!empty($old_picture)) echo $_GET['picture']; ?>" />
        <label for="new_picture">Picture:</label>
        <input type="file" id="new_picture" name="new_picture" />
        <?php if (!empty($old_picture)) {
            echo '<img class="profile" src="' . MZ_UPLOADPATH . $old_picture . '" alt="Profile Picture" />';
        } ?>
    </fieldset>
    <input type="submit" value="Save Edit" name="submit" /> <?php



            //echo '<button><a href="removemovie.php?idmovies=' . $row['idmovies'] .
            //    '&amp;name=' . $row['name'] . '&amp;director=' . $row['director'] .
            //    '&amp;release=' . $row['release'] . '&amp;description=' . $row['description'] .
            //    '&amp;rating=' . $row['rating'] .
            //    '&amp;picture=' . $row['picture'] . '">Delete</a></butt
    echo '<br>';
    echo '<br>';
    echo '<a href="admin.php" <button id="backToAdBtn" class="btn waves-effect waves-light" type="submit" name="action">Back to Admin';
    echo '<i class="material-icons right">perm_identity</i>';
    echo '</button> </a>';
    ?>
</form>

</div>

</body>