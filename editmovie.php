<?php
// Start the session
require_once('startsession.php');

// Insert the page header
$page_title = 'Edit Profile';
require_once('header.php');

require_once('appvars.php');
require_once('connectvars.php');

// Make sure the user is logged in before going any further.
if (!isset($_SESSION['user_id'])) {
    echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';
    exit();
}

// Show the navigation menu
require_once('navmenu.php');

// Connect to the database
$dbh = new PDO('mysql:host=localhost;dbname=mismatchdb', 'root', 'root');

if (isset($_POST['submit'])) {
    // Grab the profile data from the POST
    $first_name =  trim($_POST['firstname']);
    $last_name =  trim($_POST['lastname']);
    $gender =  trim($_POST['gender']);
    $birthdate =  trim($_POST['birthdate']);
    $city =  trim($_POST['city']);
    $state =  trim($_POST['state']);
    $old_picture =  trim($_POST['old_picture']);
    $new_picture =  trim($_FILES['new_picture']['name']);
    $new_picture_type = $_FILES['new_picture']['type'];
    $new_picture_size = $_FILES['new_picture']['size'];
    list($new_picture_width, $new_picture_height) = getimagesize($_FILES['new_picture']['tmp_name']);
    $error = false;

    // Validate and move the uploaded picture file, if necessary
    if (!empty($new_picture)) {
        if ((($new_picture_type == 'image/gif') || ($new_picture_type == 'image/jpeg') || ($new_picture_type == 'image/pjpeg') ||
                ($new_picture_type == 'image/png')) && ($new_picture_size > 0) && ($new_picture_size <= MM_MAXFILESIZE) &&
            ($new_picture_width <= MM_MAXIMGWIDTH) && ($new_picture_height <= MM_MAXIMGHEIGHT)) {
            if ($_FILES['file']['error'] == 0) {
                // Move the file to the target upload folder
                $target = MM_UPLOADPATH . basename($new_picture);
                if (move_uploaded_file($_FILES['new_picture']['tmp_name'], $target)) {
                    // The new picture file move was successful, now make sure any old picture is deleted
                    if (!empty($old_picture) && ($old_picture != $new_picture)) {
                        @unlink(MM_UPLOADPATH . $old_picture);
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
            echo '<p class="error">Your picture must be a GIF, JPEG, or PNG image file no greater than ' . (MM_MAXFILESIZE / 1024) .
                ' KB and ' . MM_MAXIMGWIDTH . 'x' . MM_MAXIMGHEIGHT . ' pixels in size.</p>';
        }
    }

    // Update the profile data in the database
    if (!$error) {
        if (!empty($first_name) && !empty($last_name) && !empty($gender) && !empty($birthdate) && !empty($city) && !empty($state)) {
            // Only set the picture column if there is a new picture
            if (!empty($new_picture)) {
                $query = "UPDATE mismatch_user SET first_name = :first_name, last_name = :last_name, gender = :gender, birthdate = :birthdate, city = :city, state = :state, picture = :new_picture WHERE user_id = '" . $_SESSION['user_id'] . "'";
                $stmt = $dbh->prepare($query);
                $stmt->execute(array(
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'gender' => $gender,
                    'birthdate' => $birthdate,
                    'city' => $city,
                    'state' => $state,
                    'new_picture' => $new_picture
                ));
            }
            else {
                $query = "UPDATE mismatch_user SET first_name = :first_name, last_name = :last_name, gender = :gender, birthdate = :birthdate, city = :city, state = :state WHERE user_id = '" . $_SESSION['user_id'] . "'";
                $stmt = $dbh->prepare($query);
                $stmt->execute(array(
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'gender' => $gender,
                    'birthdate' => $birthdate,
                    'city' => $city,
                    'state' => $state,
                ));
            }


            // Confirm success with the user
            echo '<p>Your profile has been successfully updated. Would you like to <a href="viewprofile.php">view your profile</a>?</p>';


            exit();
        }
        else {
            echo '<p class="error">You must enter all of the profile data (the picture is optional).</p>';
        }
    }
} // End of check for form submission
else {
    // Grab the profile data from the database
    $query = "SELECT first_name, last_name, gender, birthdate, city, state, picture FROM mismatch_user WHERE user_id = '" . $_SESSION['user_id'] . "'";
    $stmt = $dbh->prepare($query);
    $stmt->execute();

    $results =$stmt->fetchAll();
    $row = $results[0];

    if ($row != NULL) {
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $gender = $row['gender'];
        $birthdate = $row['birthdate'];
        $city = $row['city'];
        $state = $row['state'];
        $old_picture = $row['picture'];
    }
    else {
        echo '<p class="error">There was a problem accessing your profile.</p>';
    }
}


?>

<form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MZ_MAXFILESIZE; ?>" />
    <fieldset>
        <legend>Movie Information</legend>
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php if (!empty($name)) echo $name; ?>" /><br />
        <label for="lastname">Director:</label>
        <input type="text" id="lastname" name="lastname" value="<?php if (!empty($last_name)) echo $last_name; ?>" /><br />
        <label for="gender">Release Date:</label>
        <select id="gender" name="gender">
            <option value="M" <?php if (!empty($gender) && $gender == 'M') echo 'selected = "selected"'; ?>>Male</option>
            <option value="F" <?php if (!empty($gender) && $gender == 'F') echo 'selected = "selected"'; ?>>Female</option>
        </select><br />
        <label for="birthdate">Description:</label>
        <input type="text" id="birthdate" name="birthdate" value="<?php if (!empty($birthdate)) echo $birthdate; else echo 'YYYY-MM-DD'; ?>" /><br />
        <label for="city">Rating:</label>
        <input type="text" id="city" name="city" value="<?php if (!empty($city)) echo $city; ?>" /><br />
       
        <input type="hidden" name="old_picture" value="<?php if (!empty($old_picture)) echo $old_picture; ?>" />
        <label for="new_picture">Picture:</label>
        <input type="file" id="new_picture" name="new_picture" />
        <?php if (!empty($old_picture)) {
            echo '<img class="profile" src="' . MM_UPLOADPATH . $old_picture . '" alt="Profile Picture" />';
        } ?>
    </fieldset>
    <input type="submit" value="Save Profile" name="submit" />
</form>

<?php

