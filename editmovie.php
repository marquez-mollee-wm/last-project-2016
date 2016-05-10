<?php
require_once ('appvar.php');
// Connect to the database

$dbh = new PDO('mysql:host=localhost;dbname=MovieZ', 'root', 'root');

$id = (@$_GET['idmovies']) ? $_GET['idmovies'] : $_POST['idmovies'];
$name= (@$_GET['name']) ? $_GET['name'] : $_POST['name'];
$director = (@$_GET['director']) ? $_GET['director'] : $_POST['director'];
$release = (@$_GET['release']) ? $_GET['release'] : $_POST['release'];
$description = (@$_GET['description']) ? $_GET['description'] : $_POST['description'];
$rating = (@$_GET['rating']) ? $_GET['rating'] : $_POST['rating'];
$picture = @$_GET['picture'];

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
    list($new_picture_width, $new_picture_height) = getimagesize($_FILES['new_picture']['tmp_name']);
    $error = false; 

    // Validate and move the uploaded picture file, if necessary
    if (!empty($new_picture)) {
        if ((($new_picture_type == 'image/gif') || ($new_picture_type == 'image/jpeg') || ($new_picture_type == 'image/pjpeg') ||
                ($new_picture_type == 'image/png')) && ($new_picture_size > 0) && ($new_picture_size <= MZ_MAXFILESIZE) &&
            ($new_picture_width <= MZ_MAXIMGWIDTH) && ($new_picture_height <= MZ_MAXIMGHEIGHT)) {
            if ($_FILES['file']['error'] == 0) {
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
                    $query = "UPDATE movies SET `name` = `:name`, director = :director, release = :release, description = :description, rating = :rating ";
                    $stmt = $dbh->prepare($query);
                    $stmt->execute(array(
                        'name' => $name,
                        'director' => $director,
                        'release' => $release,
                        'description' => $description,
                        'rating' => $rating
                    ));
                }
            else {
                $query = "UPDATE movies SET `name` = `:name`, director = :director, release = :release, description = :description, rating = :rating ";
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
            echo '<p>The movie has been successfully updated. Go back to<a href="admin.php">admin page</a></p>';


            exit();
        }
        else {
            echo '<p class="error">You must enter all of the movie data (the picture is optional).</p>';
        }
    }
} // End of check for form submission
else {
    // Grab the profile data from the database
    $query = "SELECT `name`, director, release, description, rating, picture FROM movies WHERE idmovies = '" . $_GET['idmovies'] . "'";
    $stmt = $dbh->prepare($query);
    $stmt->execute();

    $results =$stmt->fetch();
    $row = $results[0];

    if ($row != NULL) {
        $name = $row['name'];
        $director = $row['director'];
        $release = $row['release'];
        $description = $row['description'];
        $rating = $row['rating'];
        $old_picture = $row['picture'];
    }

    else {
        echo '<p class="error">There was a problem accessing the movie.</p>';
    }
}


?>

<form enctype="multipart/form-data" method="post" action="<?php  echo $_SERVER['PHP_SELF']?>">
    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MZ_MAXFILESIZE; ?>" />
    <fieldset>
        <legend>Movie Information</legend>
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php if (!empty($name)) echo $name; ?>" /><br />
        <label for="lastname">Director:</label>
        <input type="text" id="director" name="director" value="<?php if (!empty($director)) echo $director; ?>" /><br />
        <label for="gender">Release Date:</label>
        <input type="date" id="release" name="release" value="<?php if (!empty($release)) echo $release; ?>"><br/>
        <label for="description">Description:</label>
        <input type="text" id="description" name="description" value="<?php if (!empty($description)) echo $description; ?>" /><br />
        <label for="city">Rating:</label>
        <input type="text" id="city" name="rating" value="<?php if (!empty($rating)) echo $rating; ?>" /><br />
        <input type="hidden" name="old_picture" value="<?php if (!empty($old_picture)) echo $old_picture; ?>" />
        <label for="new_picture">Picture:</label>
        <input type="file" id="new_picture" name="new_picture" />
        <?php if (!empty($old_picture)) {
            echo '<img class="profile" src="' . MZ_UPLOADPATH . $old_picture . '" alt="Profile Picture" />';
        } ?>
    </fieldset>
    <input type="submit" value="Save Profile" name="submit" />
</form>

<?php

