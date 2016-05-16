<?php
require_once ('connect.php');
require_once ('startsession.php');
require_once ('appvars.php');

if (isset($_POST['formSubmit'])) {

    $errorMessage = false;

    if (empty($_POST['title'])) {
        $errorMessage = "<li>Enter the movie title!</li>";
    }
    if (empty($_POST['director'])) {
        $errorMessage = "<li>Enter the director of the movie!</li>";
    }
    if (empty($_POST['releaseDate'])) {
        $errorMessage = "<li>Enter the release date!</li>";
    }
    if (empty($_POST['description'])) {
        $errorMessage = "<li>Enter your description!</li>";
    }
    if (empty($_POST['rating'])) {
        $errorMessage = "<li>Enter your rating!</li>";
    }

    $title = $_POST['title'];
    $description = $_POST['description'];

    $picture = $_FILES['picture']['name'];
    $picture_type = $_FILES['picture']['type'];
    $picture_size = $_FILES['picture']['size'];
    list($picture_width, $picture_height) = getimagesize($_FILES['picture']['tmp_name']);
    if (!empty($title) && !empty($description) && !empty($picture)) {
        if ((($picture_type == 'image/gif') || ($picture_type == 'image/jpeg') || ($picture_type == 'image/pjpeg') || ($picture_type == 'image/png'))
            && ($picture_size > 0) && ($picture_size <= MZ_MAXFILESIZE)) {
            if ($_FILES['picture']['error'] == 0) {
                // Move the file to the target upload folder
                $target = MZ_UPLOADPATH . $picture;
                if (move_uploaded_file($_FILES['picture']['tmp_name'], $target)) {
                    // Connect to the database
                    require_once ('connect.php');

                    // Send to the DB
                    $stmt = $dbh->prepare("INSERT INTO `MovieZ`.`movies` (`name`, `director`, `release`, `description`, `picture`, `approve`, `rating`, `categories_idcategories`, `users_idusers`) VALUES (:title , :director, :releaseDate, :description, :picture, '0', :rating, :categoryId, :userId)");

                    $result = $stmt->execute(
                        array(
                            'title' => $_POST['title'],
                            'director' => $_POST['director'],
                            'releaseDate' => $_POST['releaseDate'],
                            'description' => $_POST['description'],
                            'picture' => $picture,
                            'rating' => $_POST['rating'],
                            'categoryId' => $_POST['category'],
                            'userId' => $_SESSION['idusers']
                        )
                    );

                    if(!$result){
                        print_r($stmt->errorInfo());
                    }

                    header('Location: index.php');

                }
                else {
                    echo '<p>Sorry, there was a problem uploading your cover image.</p>';
                }
            }
        }
        else {
            echo '<p>The cover photo must be a GIF, JPEG, or PNG image file no greater than ' . (MZ_MAXFILESIZE / 1024) . ' KB in size.</p>';
        }

        // Try to delete the temporary screen shot image file
        @unlink($_FILES['picture']['tmp_name']);
    }
    else {
        echo '<p>Please enter all of the information to add your page.</p>';
    }
}
?>

<?php
require_once('header.php');
?>

<style>
    .makePgButton {
        color: white;
        text-decoration: none;
    }
</style>

<body>
<div class="container">
    <h2 class="red-text text-darken-4">Make Your Page!</h2>
    <div id="addPgFm" class="row red-form form-darken-4">
        <form method="post" enctype="multipart/form-data" class="col s12" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
            <div class="row">
                <div class="input-field col s6">
                    <input id="input_text" type="text" name="title" required>
                    <label for="input_text">Title</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input id="input_text2" type="text" name="director" required>
                    <label for="input_text2">Director</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s3">
                    <input id="releaseDt" name="releaseDate" type="text" maxlength="4" required>
                    <label for="releaseDt">Release Year</label>
                </div>
            </div>
            <div class="row">
                <p>
                    <input class="with-gap" name="category" type="radio" id="actionCat" value="1"/>
                    <label for="actionCat">Action</label>

                    <input class="with-gap" name="category" type="radio" id="animeCat"  value="2"/>
                    <label for="animeCat">Anime</label>
                </p>
                <p>
                    <input class="with-gap" name="category" type="radio" id="comedyCat" value="3"/>
                    <label for="comedyCat">Comedy</label>

                    <input class="with-gap" name="category" type="radio" id="documentaryCat"  value="4"/>
                    <label for="documentaryCat">Documentary</label>
                </p>
                <p>
                    <input class="with-gap" name="category" type="radio" id="dramaCat"  value="5"/>
                    <label for="dramaCat">Drama</label>

                    <input class="with-gap" name="category" type="radio" id="familyCat"  value="6"/>
                    <label for="familyCat">Family</label>
                </p>
                <p>
                    <input class="with-gap" name="category" type="radio" id="horrorCat"  value="7"/>
                    <label for="horrorCat">Horror</label>

                    <input class="with-gap" name="category" type="radio" id="sciFiCat"  value="8"/>
                    <label for="sciFiCat">Sci-Fi</label>
                </p>
            </div>
            <div class="row">
                <div class="input-field col s11">
                    <textarea id="textarea1" name="description" class="materialize-textarea" required></textarea>
                    <label for="sciFiCat">Description</label>
                </div>
            </div>
            <div class="row">
                <div class="file-field input-field">
                    <div class="btn">
                        <span>File</span>
                        <input type="file" id="picture" name="picture">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" placeholder="Upload a Cover For Your Movie!">
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <h5 class="red-text text-darken-4">Score It!</h5>
                <div class="input-field col s9">
                    <p class="range-field">
                        <input type="range" name="rating" id="test5" min="0" max="100" required/>
                    </p>
                </div>
            </div>
            <button class="waves-effect waves-light btn-large" type="submit" name="formSubmit" value="1"><a
                    class="makePgButton">Submit Page</a></button>
        </form>

    </div>
</div>

<?php
require_once('footer.php');
?>

</body>
